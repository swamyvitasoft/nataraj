<?php include('db.php'); ?>
<?php
$sql = "select * from rates where sno='".$_GET['sno']."' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $fetch= mysqli_fetch_assoc($result) ;
    print_r(json_encode($fetch));
} else {
    echo "No Data";
}
