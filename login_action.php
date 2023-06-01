<?php include('db.php'); ?>
<?php
ob_start();
session_start();
$sql = "select * from users where email='" . $_POST['email'] . "' and password='" . $_POST['password'] . "' and status=1 ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $fetch = $result->fetch_assoc();
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['users_phone'] = $fetch['phone'];
    header('Location: sheets.php');
} else {
    header('Location: index.php');
}
