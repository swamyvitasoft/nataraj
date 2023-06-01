<?php include('db.php'); ?>
<?php
$sdate = date("Y-m-d");
$sql = "select * from rates inner join sale on rates.sno=sale.rates_id where sdate='" . $sdate . "' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($fetch = $result->fetch_assoc()) {
        $data[] = $fetch;
    }
    print_r(json_encode($data));
} else {
    echo "No Data";
}
