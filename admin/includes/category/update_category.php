<?php
$conn = new mysqli("localhost", "root", "", "pharmacy_db");
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => $conn->connect_error]);
    exit;
}

$menu_id = isset($_POST['menu_id']) ? intval($_POST['menu_id']) : 0;
$menu_name = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';

if ($menu_id <= 0 || empty($menu_name)) {
    echo json_encode(['success' => false, 'message' => 'اطلاعات نامعتبر است.']);
    exit;
}

$sql = "UPDATE category SET cat_name='" . $conn->real_escape_string($menu_name) . "' WHERE cat_id=" . $menu_id;

// اجرای کوئری
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'خطا در بروزرسانی: ' . $conn->error]);
}

// بستن اتصال
$conn->close();
?>