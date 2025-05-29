<?php
session_start();
$link = new mysqli("localhost", "root", "", "pharmacy_db");
if(isset($_POST['id'])){
    if(!isset($_SESSION['user_id'])){
        echo json_encode(['success' => false, 'message' => ' لطفا وارد حساب کاربری خود شوید ']);
    }
    else{
        $dup = $link->query("SELECT * FROM favorits WHERE fav_drog_id = '".$_POST['id']."' AND fav_user_id = '".$_SESSION['user_id']."'");
        if($dup->num_rows > 0){
            echo json_encode(['success' => false, 'message' => 'این محصول در لیست علاقه مندی ها موجود است']);
        }
        else{
            $result_favorite = $link -> query("INSERT INTO favorits (fav_drog_id,fav_user_id) VALUES ('".$_POST['id']."','".$_SESSION['user_id']."')");
            if($result_favorite){
                $errors['add_fav'] = "محصول به علاقه مندی ها اضافه شد";
                echo json_encode(['success' => true]);
            }
            else{
                echo json_encode(['success' => false, 'message' => 'خطا در انجام عملیات']);

            }
        }
    }

}
?>