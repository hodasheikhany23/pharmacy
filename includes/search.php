<?php
$link = new mysqli("localhost", "root", "", "pharmacy_db");

if (isset($_POST['search'])) {
    $search = $_POST['search'];
} else {
    $search = '';
}
if ($search !== '') {
    $like = "%$search%";
    $result = $link->query("SELECT drg_id, drg_name, drg_company FROM drogs WHERE drg_name LIKE '$like' OR drg_company LIKE '$like' LIMIT 5");
    $pages = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $pages[] = $row;
        }
    }
    echo json_encode(['pages' => $pages]);
}
?>