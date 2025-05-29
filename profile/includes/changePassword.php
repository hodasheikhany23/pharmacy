<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username'])){
    die("Please <a href='includes/login.php'>login</a> to access this page");
}
$link = new mysqli("localhost", "root", "", "pharmacy_db");
$resultUser = $link -> query("SELECT * FROM users where u_id = '".$_SESSION['user_id']."'");
if($resultUser -> num_rows > 0){
    $rowUpdate = $resultUser -> fetch_assoc();
}

$errors = [];
if(isset($_POST['update'])){
    if($rowUpdate['u_password'] != md5($_POST['oldPassword'])){
        $errors['update_user_error'] = "خطا در ویرایش رمز عبورررر";
    }
    if(strlen($_POST['newPassword']) < 8 ){
        $errors['update_user_error'] = "رمز عبور باید حداقل 8 کاراکتر باشد";
    }
    if ($_POST['newPassword'] != $_POST['confirmPassword']){
        $errors['update_user_error'] = "رمز عبور و تکرار آن برابر نیستند ";
    }
    if(!isset($errors['update_user_error'])){
        $updateResult = $link->query("UPDATE users SET u_password = '" . md5($_POST['newPassword']) . "' where u_id = '".$_SESSION['user_id']."' ");
        if($link -> errno == 0){
            $errors['update_user'] = "رمز عبور کاربر با موفقیت ویرایش شد";

        }
        else{
            $errors['update_user_error'] = "خطا در ویرایش رمز عبور";
        }
    }
}

?>
<div class="col-md-9 border-0">
    <div class="card m-3 p-4 border-0" style="border-radius: 24px; background-color: transparent !important;">
        <div class="item">
            <div class="container">
                <div class="d-flex px-5 py-2 justify-content-center">
                    <?php
                    if(isset($errors['update_user'])){
                        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['update_user'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                    }
                    if(isset($errors['update_user_error'])){
                        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['update_user_error'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                    }
                    ?>
                </div>
            <div class="container my-4 ">
                <div class="section-title" style="margin-top: 0 !important; padding: 0 !important;">
                    <p style="margin-top: 0 !important;"> تغییر رمز عبور</p>
                </div>
                <div id="resultsContainer">
                    <div class="card mb-5 p-4 border-0 w-100" style="border-radius: 24px; background-color: transparent !important;">
                        <div class="rounded-3 border-0 mb-5 d-flex flex-wrap justify-content-center ">
                            <div class="card rounded border-0 p-5 w-100 d-flex justify-content-center align-items-center" style=" color: black!important;">
                                <form method="post" action="" class="w-50">
                                    <div class="mb-3">
                                        <label for="oldPassword" class="form-label">رمزعبور </label>
                                        <input name="oldPassword" type="password" class="form-control" id="oldPassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="newPassword" class="form-label"> رمز عبور جدید</label>
                                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirmPassword" class="form-label">تکرار رمز عبور </label>
                                        <input name="confirmPassword" type="password" class="form-control" id="confirmPassword">
                                    </div>
                                    <button type="submit" name="update" href="" class="button btn btn-success">
                                        <i class="bi bi-key"></i>
                                        <span style="margin-left: 2px;">| </span>
                                        تغییر رمز عبور

                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

