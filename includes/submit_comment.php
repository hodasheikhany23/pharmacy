<?php
session_start();
$link = new mysqli("localhost", "root", "", "pharmacy_db");
if(isset($_POST['id']) && isset($_POST['comment']) && isset($_POST['rank']) && isset($_POST['title'])) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => ' لطفا وارد حساب کاربری خود شوید ']);
        exit;
    }
    $id = $_POST['id'];
    $comment = $_POST['comment'];
    $rank = $_POST['rank'];
    $title = $_POST['title'];
    $time = time();
    $result = $link->query("INSERT INTO comment (c_user_id, c_drog_id, c_text, c_rank, c_title, c_date) VALUES ('".$_SESSION['user_id']."', '".$id."', '".$comment."', '".$rank."', '".$title."','".$time."')");
    if ($result) {
        $result_select = $link->query("SELECT c_rank FROM comment WHERE c_drog_id='".$id."'");
        $sum = 0; $count = 0;
        while ($row = $result_select->fetch_assoc()) {
            $sum += $row["c_rank"];
            $count++;
        }
        $avg = $count > 0 ? $sum / $count : 0;
        $result_update = $link->query("UPDATE drogs SET drg_rank = $avg WHERE drg_id = '".$id."'");
        if ($result_update) {
            echo json_encode(['success' => true]);
            exit;
        }
    }
    echo json_encode(['success' => false, 'message' => 'خطا در انجام عملیات']);
    exit;
}
?>