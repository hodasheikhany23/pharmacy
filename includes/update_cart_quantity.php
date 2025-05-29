<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$link = new mysqli("localhost", "root", "", "pharmacy_db");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['detail_id']) && isset($_POST['quantity'])) {
        $detailId = intval($_POST['detail_id']);
        $quantity = intval($_POST['quantity']);
        $total_price = floatval($_POST['total_price']);
        $total_benefit = floatval($_POST['benefit']);
        $final_price = floatval($_POST['final_price']);

        if ($detailId <= 0 || $quantity < 1) {
            echo json_encode(['success' => false, 'message' => 'داده‌های نامعتبر']);
            exit;
        }
//        $selectFactor = $link->query("SELECT * FROM factor_detail WHERE facde_id = '".$detailId."'");
//        $factor_deatil = $selectFactor->fetch_assoc();
//        $factor_id = $factor_deatil['facde_fac_id'];
//        $updateFactor = $link -> query("UPDATE factor SET fac_price = ".$total_price.", fac_benefit = ".$total_benefit.", fac_finalPrice = '".$final_price."' WHERE fac_id = '".$factor_id."'");
//        if ($link->errno != 0) {
//            echo json_encode(['success' => false, 'message' => 'مشکل اینجاست']);
//        }
        $updateQuery = "UPDATE factor_detail SET facde_count = '".$quantity."' WHERE facde_id = '".$detailId."'";
        if ($link->query($updateQuery) === TRUE){
            echo json_encode(['success' => true]);
        }
        else {
            echo json_encode(['success' => false, 'message' => 'خطا در بروزرسانی داده‌ها: ' . $link->error]);
        }
    }

    if (isset($_POST['remove_id'])) {
        $removeId = intval($_POST['remove_id']);
        $factorIdResult = $link->query("SELECT facde_factor_id FROM factor_detail WHERE facde_id = '".$removeId."'");
        if($factorIdResult->num_rows > 0){
            $row=$factorIdResult->fetch_assoc();
            $factorId = $row['facde_factor_id'];
            $checkProductsResult = $link->query("SELECT COUNT(*) AS count FROM factor_detail WHERE facde_factor_id = '".$factorId."'");
            if($checkProductsResult->num_rows > 0){
                $row_count=$checkProductsResult->fetch_assoc();
                $count = $row_count['count'];
                if($count == 1){
                    $removeQuery = "DELETE FROM factor_detail WHERE facde_id = '".$removeId."'";
                    $removeFactor = "DELETE FROM factor WHERE fac_id = '".$factorId."'";
                    if($link->query($removeQuery) === TRUE && $link->query($removeFactor) === TRUE) {
                        echo json_encode(['success' => true]);
                    }
                    else {
                        echo json_encode(['success' => false, 'message' => $link->error]);
                    }
                }
                else{
                    $removeQuery = "DELETE FROM factor_detail WHERE facde_id = '".$removeId."'";
                    if($link->query($removeQuery) === TRUE) {
                        echo json_encode(['success' => true]);
                    }
                    else {
                        echo json_encode(['success' => false, 'message' => $link->error]);
                    }
                }
            }
        }
        else {
            echo json_encode(['success' => false, 'message' => 'خطا در حذف داده‌ها: ' . $link->error]);
        }
    }

    $link->close();
} else {
    echo json_encode(['success' => false, 'message' => 'درخواست نامعتبر']);
}
?>