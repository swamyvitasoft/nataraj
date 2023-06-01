<?php include('db.php'); ?>
<?php
$sql = "select * from sale where counter='".$_POST['counter']."' and sdate='".$_POST['today']."' and status=1 ";
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
