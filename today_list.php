<?php include('db.php'); ?>
<?php
$counter = $_POST['counter'];
$bs_date = $_POST['today'];
$sql = "select * from balance_sheet where bs_date = '" . $bs_date . "' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    $fetch = $result->fetch_assoc();
    if ($counter == 'ac') {
        $data[] = $fetch['ac'];
    } elseif ($counter == 'nonac') {
        $data[] = $fetch['nonac'];
    } elseif ($counter == 'janatha') {
        $data[] = $fetch['janatha'];
    }
    $sql1 = "select sum(amount) as amount from expenditure where counter='" . $counter . "' and edate = '" . $bs_date . "' ";
    $result1 = $conn->query($sql1);
    $fetch1 = $result1->fetch_assoc();
    $data[] = $fetch1['amount'];
    print_r(json_encode($data));
} else {
    echo "No Data";
}
