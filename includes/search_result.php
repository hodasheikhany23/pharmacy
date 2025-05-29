<?php
session_start();
$link = new mysqli("localhost", "root", "", "pharmacy_db");
if(isset($_POST["id"])){
    $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '".$_POST["id"]."'");
    $row_drog  = $result_drog->fetch_assoc();
    $result_cat  = $link->query("SELECT * FROM category WHERE cat_id = '".$row_drog['drg_category_id']."'");
    $row_cat = $result_cat->fetch_assoc();
    $result_submenu = $link->query("SELECT * FROM sub_menu WHERE subm_id = '".$row_cat['cat_subm_id']."'");
    $row_submenu = $result_submenu->fetch_assoc();
    $result_menu = $link->query("SELECT * FROM menu WHERE menu_id = '".$row_submenu['subm_menu_id']."'");
    $row_menu = $result_menu->fetch_assoc();

    echo json_encode([
        'success' => true,
        'md' => $row_menu['menu_id'],
        'pd' => $row_submenu['subm_id'],
        'p' => $_POST["id"]
    ]);
}
?>
