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

$sql = $conn->query("UPDATE sub_menu SET subm_name='". $menu_name . "' WHERE subm_id=" . $menu_id);

if ($conn->affected_rows > 0) {
    echo json_encode(['success' => true]);
}
else {
    echo json_encode(['success' => false, 'message' => 'خطا در بروزرسانی: ' . $conn->error]);
}

$conn->close();
?>