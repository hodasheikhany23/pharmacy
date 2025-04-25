<?php

$conn = new mysqli("localhost", "root", "", "pharmacy_db");

// بررسی اتصال
if ($conn->connect_error) {
    die("اتصال به پایگاه داده با شکست مواجه شد: " . $conn->connect_error);
}

$result_icon = $conn->query("SELECT ic_id, ic_name, ic_tag FROM icons");

$icons = [];
if ($result_icon->num_rows > 0) {
    while ($row_icon = $result_icon->fetch_assoc()) {
        $icons[] = $row_icon;
    }
}
var_dump($icons); // بررسی محتویات $icons
header('Content-Type: application/json');
echo json_encode($icons);
$conn->close();
?>