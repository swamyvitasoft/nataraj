<?php include('db.php'); ?>
<?php
$sql1 = "select * from rates where status=1";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    while ($fetch1 = $result1->fetch_assoc()) {
        $rates_id = $fetch1['sno'];
        $sql2 = "select * from sale where rates_id='" . $rates_id . "' and status=1 order by sales_id desc limit 3";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            while ($fetch2 = $result2->fetch_assoc()) {
                $sales_id = $fetch2['sales_id'];
                $counter = $fetch2['counter'];
                $bname = $fetch2['bname'];
                $opening = $fetch2['opening'];
                $receipts = $fetch2['receipts'];
                $total = $fetch2['total'];
                $sales = $fetch2['sales'];
                $balance = $fetch2['balance'];
                $rate = $fetch2['rate'];
                $amount = $fetch2['amount'];
                $sdate = $fetch2['sdate'];
                if ($counter == 'ac') {
                    $price = $fetch1['ac'];
                } elseif ($counter == 'nonac') {
                    $price = $fetch1['nonac'];
                } elseif ($counter == 'janatha') {
                    $price = $fetch1['janatha'];
                }

                $day_before = $sdate;
                $day_today = date('Y-m-d');
                if ($day_today == $day_before) {
                    $sql5 = "update sale set receipts='" . $receipts . "', total='" . $total . "', sales='" . $sales . "', balance='" . $balance . "', rate='" . $price . "', amount='" . $amount . "' WHERE sales_id='" . $sales_id . "' ";
                    $sql6 = "update rates set load_data=1";
                    $bool = $conn->query($sql6);
                } else {
                    $sql5 = "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', '" . $counter . "','" . $bname . "','" . $balance . "','0','" . $balance . "','0','" . $balance . "','" . $price . "','0','" . date("Y-m-d H:i:s") . "')";
                }
               $bool = $conn->query($sql5);
                echo $sql;
            }
        } else {
            $sql3 = "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', 'ac','" . $fetch1['brand_name'] . "','0','0','0','0','0','" . $fetch1['ac'] . "','0','" . date("Y-m-d H:i:s") . "');";
            $sql3 .= "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', 'nonac','" . $fetch1['brand_name'] . "','0','0','0','0','0','" . $fetch1['nonac'] . "','0','" . date("Y-m-d H:i:s") . "');";
            $sql3 .= "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', 'janatha','" . $fetch1['brand_name'] . "','0','0','0','0','0','" . $fetch1['janatha'] . "','0','" . date("Y-m-d H:i:s") . "')";
            if (mysqli_multi_query($conn, $sql3)) {
                $bool = TRUE;
            }
        }
    }
} else {
    echo "No New Data";
}
?>