<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $admin_id = $_SESSION['admin_id'];
    $sql = "INSERT INTO approvals (item_id, admin_id, status, reviewed_at) 
            VALUES ('$item_id','$admin_id','rejected',NOW())";
    $conn->query($sql);
}
header("Location: dashboard.php");
exit();
?>
