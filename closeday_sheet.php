<?php include('db.php'); ?>
<?php
$sql = "select sum(amount) as amount,counter,sdate from sale group by sdate,counter";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($fetch= mysqli_fetch_assoc($result)){
        $amount = $fetch['amount'];
        $counter = $fetch['counter'];
        $sdate = $fetch['sdate'];
    }
} else {
    echo "No Data";
}
