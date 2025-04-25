<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
$link = new mysqli("localhost", "root", "", "pharmacy_db");
$resultUser = $link -> query("SELECT * FROM users where u_id = '".$_GET['id']."'");
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
        $updateResult = $link->query("UPDATE users SET u_password = '" . md5($_POST['newPassword']) . "' where u_id = '".$_GET['id']."' ");
        if($link -> errno == 0){
            $errors['update_user'] = "رمز عبور کاربر با موفقیت ویرایش شد";

        }
        else{
            $errors['update_user_error'] = "خطا در ویرایش رمز عبور";
        }
    }
}

?>
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
    <div class="section-title">
        <h4 class="mb-4" style="margin-top: 0 !important; padding-top: 0 !important;">  ویرایش رمز عبور کاربر  </h4>
        <a href="index.php?pg=login&page=users" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست کاربران
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="username" class="form-label">نام کاربری</label>
                <input name="username" type="text" class="form-control" id="username" value="<?php if(isset($rowUpdate)){echo trim($rowUpdate['u_username']);} ?>" readonly>
            </div>
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
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> ثبت ویرایش
            </button>
        </form>
    </div>
</div>

