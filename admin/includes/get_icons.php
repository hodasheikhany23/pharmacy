<?php
$link = new mysqli("localhost", "root", "", "pharmacy_db");

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => $conn->connect_error]);
    exit;
}

$result_icon = $conn->query("SELECT * FROM icons");

$icons = [];
if ($result_icon) {
    if ($result_icon->num_rows > 0) {
        while ($row_icon = $result_icon->fetch_assoc()) {
            $icons[] = $row_icon;
        }
    }
    $result_icon->close();
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
    exit;
}

echo json_encode(['success' => true, 'icons' => $icons]);
$conn->close();
?>