<?php include('db.php'); ?>
<?php
if (!empty($_POST['sales_id'])) {
    $today = $_POST['today'];
    $sales_id = $_POST['sales_id'];
    $field_name = $_POST['field_name'];
    $data = $_POST['data1'];
    $sql = "select * from sale where sales_id='" . $sales_id . "' ";
    $result = $conn->query($sql);
    $fetch = $result->fetch_assoc();
    $sdate = $fetch['sdate'];
    $opening = $fetch['opening'];
    $sql2 = '';
    if ($field_name == "receipts") {
        $receipts = $data;
        $total = $opening + $receipts;
        $sales = $fetch['sales'];
        $balance = $total - $sales;
        $sql2 = "update sale set receipts='" . $receipts . "', total='" . $total . "', balance='" . $balance . "', sdate='" . $today . "' WHERE sales_id='" . $sales_id . "' ";
        $bool = $conn->query($sql2);
    }
    if ($field_name == "balance") {
        $balance = $data;
        $total = $fetch['total'];
        $sales = $total - $balance;
        $rate = $fetch['rate'];
        $amount = $sales * $rate;
        $sql2 = "update sale set sales='" . $sales . "', balance='" . $balance . "', amount='" . $amount . "', sdate='" . $today . "' WHERE sales_id='" . $sales_id . "' ";
        $bool = $conn->query($sql2);
        $sql1 = "select * from balance_sheet where bs_date = '" . $sdate . "' ";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {

            $sql4 = "select sum(amount) as amount from sale where counter = '".$fetch['counter']."' and  sdate = '" . $sdate . "' ";
            $result4 = $conn->query($sql4);
            $fetch4 = $result4->fetch_assoc();
            $amount1 = $fetch4['amount'];

            $fetch1 = $result1->fetch_assoc();

            if ($fetch['counter'] == 'ac') {
                $ac = $amount1;
                $grand_total = $ac+$fetch1['nonac']+$fetch1['janatha']-$fetch1['expenditure'];
                $sql3 = "update balance_sheet set ac='" . $ac . "',grand_total='" . $grand_total . "' where bs_date = '" . $sdate . "' ";
            }
            if ($fetch['counter'] == 'nonac') {
                $nonac = $amount1;
                $grand_total = $nonac+$fetch1['ac']+$fetch1['janatha']-$fetch1['expenditure'];
                $sql3 = "update balance_sheet set nonac='" . $nonac . "',grand_total='" . $grand_total . "'  where bs_date = '" . $sdate . "' ";
            }
            if ($fetch['counter'] == 'janatha') {
                $janatha = $amount1;
                $grand_total = $janatha+$fetch1['nonac']+$fetch1['ac']-$fetch1['expenditure'];
                $sql3 = "update balance_sheet set janatha='" . $janatha . "',grand_total='" . $grand_total . "'  where bs_date = '" . $sdate . "' ";
            }
        } else {
            $ac = 0;
            $nonac = 0;
            $janatha = 0;
            if ($fetch['counter'] == 'ac') {
                $ac = $amount;
            }
            if ($fetch['counter'] == 'nonac') {
                $nonac = $amount;
            }
            if ($fetch['counter'] == 'janatha') {
                $janatha = $amount;
            }
            $grand_total = $ac + $nonac + $janatha;
            $sql3 = "insert into balance_sheet (bs_date,ac,nonac,janatha,expenditure,grand_total) values ('" . $sdate . "','" . $ac . "','" . $nonac . "','" . $janatha . "','0','" . $grand_total . "')";
        }
        $bool = $conn->query($sql3);
    }
    if ($bool === TRUE) {
        echo $fetch['counter'];
    } else {
        echo "Error1: " . $sql . "<br>" . $conn->error;
    }
}
?>