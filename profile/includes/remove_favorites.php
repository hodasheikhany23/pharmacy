<?php
session_start();
$link = new mysqli("localhost", "root", "", "pharmacy_db");
if (isset($_POST['remove_id'])) {
    $removeId = intval($_POST['remove_id']);
    $result = $link->query("DELETE FROM favorits WHERE fav_user_id = '".$_SESSION['user_id']."' AND fav_drog_id = '".$removeId."'");
    if ($result === true) {
        echo json_encode(['success' => true]);
    }
    else {
        echo json_encode(['success' => false, 'message' => 'خطا در حذف داده‌ها: ' . $link->error]);
    }
}

$link->close();
?>