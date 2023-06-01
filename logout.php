<?php
ob_start();
session_start();
unset($_SESSION["users_phone"]);
header('Location: index.php');
