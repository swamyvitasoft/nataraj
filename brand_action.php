<?php include('db.php'); ?>
<?php
if (empty($_POST['sno'])) {
    $sql = "insert into rates (brand_name, ac, nonac, janatha, bdate) values ('" . $_POST['brand_name'] . "', '" . $_POST['ac'] . "', '" . $_POST['nonac'] . "', '" . $_POST['janatha'] . "', '" . date("Y-m-d H:i:s") . "')";
    if ($conn->query($sql) === TRUE) {
        $rates_id = $conn->insert_id;
        $sql1 = "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', 'ac','" . $_POST['brand_name'] . "','0','0','0','0','0','" . $_POST['ac'] . "','0','" . date("Y-m-d H:i:s") . "');";
        $sql1 .= "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', 'nonac','" . $_POST['brand_name'] . "','0','0','0','0','0','" . $_POST['nonac'] . "','0','" . date("Y-m-d H:i:s") . "');";
        $sql1 .= "insert into sale(rates_id, counter, bname, opening, receipts, total, sales, balance, rate, amount, sdate) values ('" . $rates_id . "', 'janatha','" . $_POST['brand_name'] . "','0','0','0','0','0','" . $_POST['janatha'] . "','0','" . date("Y-m-d H:i:s") . "')";
        if (mysqli_multi_query($conn, $sql1)) {
            echo "brand successfully saved";
        } else {
            echo "Error1: " . $sql1 . "<br>" . $conn->error;
        }
    }
} else {
    $sql = "update rates set brand_name='" . $_POST['brand_name'] . "',ac='" . $_POST['ac'] . "',nonac='" . $_POST['nonac'] . "',janatha='" . $_POST['janatha'] . "',load_data=2,bdate='" . date("Y-m-d H:i:s") . "' WHERE sno='" . $_POST['sno'] . "' ";
    if ($conn->query($sql) === TRUE) {
        echo "brand successfully saved";
    } else {
        echo "Error2: " . $sql . "<br>" . $conn->error;
    }
}
exit;
