<?php
session_start();
require_once '../time/jdf.php';
$link = new mysqli("localhost", "root", "", "pharmacy_db");

if(isset($_POST['id'])){
    if(!isset($_SESSION['user_id'])){
        echo json_encode(['success' => false, 'message' => ' لطفا وارد حساب کاربری خود شوید ']);}
    else{
        $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '".$_POST['id']."'");
        $rowDrog = $result_drog->fetch_assoc();
        if($rowDrog['drg_available'] != 0){
            $user_id = $_SESSION['user_id'];
            $time = jdate("Y-m-d H:i:s");
            $result_incomplete_factor = $link->query("SELECT * FROM factor WHERE fac_user_id = '".$user_id."' AND fac_payment_status = '3'");
            $factor_id = 0;
            if($result_incomplete_factor->num_rows > 0){
                $rowIncompleteFactor = $result_incomplete_factor->fetch_assoc();
                $factor_id = $rowIncompleteFactor['fac_id'];
            }
            else {
                $result_new_factor = $link->query("INSERT INTO factor (fac_user_id, fac_date, fac_payment_status) VALUES ('".$user_id."', '".$time."', '3')");
                if($result_new_factor === TRUE){
                    $factor_id = $link->insert_id;
                }
                else {
                    echo json_encode(['success' => false, 'message' => 'خطا در ایجاد فاکتور جدید ! ']);
                }
            }
            $dup = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$factor_id."' AND facde_drog_id = '".$_POST['id']."'");

            if($dup->num_rows > 0){
                echo json_encode(['success' => false, 'message' => 'این محصول در سبد خرید موجود است ! ']);
            }
            else {
                $result_detail = $link->query("INSERT INTO `factor_detail`( `facde_factor_id`, `facde_drog_id`, `facde_count`) VALUES ('".$factor_id."','".$_POST['id']."','1')");
                if($result_detail === TRUE){
                    echo json_encode(['success' => true, 'message' => 'محصول به سبد خرید اضافه شد ! ']);
                }
                else {
                    echo json_encode(['success' => false, 'message' => 'خطا در اضافه کردن جزئیات محصول به سبد خرید ! ']);
                }
            }
        }
        else{
            echo json_encode(['success' => false, 'message' => ' متاسفانه این محصول فعلا موجود نیست ! ']);
        }
    }
}

?>