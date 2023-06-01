<?php include('db.php'); ?>
<?php
$today = $_POST['today'];
$sql = "insert into expenditure (counter, amount, reason, edate) values ('" . $_POST['counter'] . "', '" . $_POST['amount'] . "', '" . $_POST['reason'] . "', '" . $today . "')";
if ($conn->query($sql) === TRUE) {
    $sql1 = "select * from balance_sheet where bs_date = '" . $today . "' ";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        $fetch1 = $result1->fetch_assoc();
        $grand_total = $fetch1['grand_total'] - $_POST['amount'];
        $expenditure = $fetch1['expenditure'] + $_POST['amount'];
        $sql3 = "update balance_sheet set expenditure='" . $expenditure . "',grand_total='" . $grand_total . "'  where bs_id = '" . $fetch1['bs_id'] . "' ";
    } else {
        $sql3 = "insert into balance_sheet (bs_date,ac,nonac,janatha,expenditure,grand_total) values ('" . $today . "','0','0','0','" . $_POST['amount'] . "','0')";
    }
    $bool = $conn->query($sql3);
    echo "expenditure successfully saved";
} else {
    echo "Error2: " . $sql . "<br>" . $conn->error;
}
exit;
