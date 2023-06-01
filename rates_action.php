<?php include('db.php'); ?>
<?php
$sql = "select * from rates where status=1 order by brand_name asc ";
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
