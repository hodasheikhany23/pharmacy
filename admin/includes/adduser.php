<?php
    if(!isset($_SESSION['username'])){
        die("Please <a href='includes/login.php'>login</a> to access this page");
    }
    $errors = [];
    if(isset($_POST['submit'])){
        $is_admin = isset($_POST['is_admin']) ? 1 : 0;
        $resultDuplicate = $link->query("SELECT * FROM users WHERE u_username = '" . $_POST['username'] . "'");
        if($resultDuplicate->num_rows != 0){
            $errors['duplicate'] = "این نام کاربری در سامانه موجود است. لطفا نام کاربری جدیدی وارد کنید";
        }
        else{
            if(isset($_POST['username'])){
                if(mb_strlen(clean_data($_POST['username'])) > 2){
                    $username = clean_data($_POST['username']) ;
                }
                else{
                    $errors['username'] = "نام کاربری باید بیشتر از 2 کاراکتر باشد";
                }
            }
            else{
                $errors['username'] = "نام کاربری را وارد کنید" ;
            }
            if(strlen($_POST['password']) < 8){
                $errors['password'] = "رمز عبور باید حداقل 8 کاراکتر باشد";
            }
            else if($_POST['password'] != $_POST['confirm_password']){
                $errors['password'] = "رمز عبور  و تکرار آن برابر نیستند";
            }
            else{
                $password = $_POST['password'];
            }
            if (isset($_POST['phone'])) {
                if(mb_strlen(clean_data($_POST['phone'])) == 11 && is_numeric(clean_data($_POST['phone']))){
                    $phone = clean_data($_POST['phone']);
                }
                else{
                    $errors['phone'] = 'شماره موبایل باید عددی و 11 رقم باشد' ;
                }
            }
            else{
                $phone = null;
            }
            if(isset($_POST['address'])){
                $address = clean_data($_POST['address']);
            }
            if(isset($username) && isset($password)){
                $link->query("INSERT INTO users (u_username, u_password, u_phone, u_address, u_is_admin) VALUES ('" . $username . "', '" . md5($password) . "', '" .  $phone . "', '" .  $address . "','".$is_admin."')");

                if($link->errno == 0){
                    $errors['add_user'] = "کاربر جدید با موفقیت ثبت شد";
                }
                else{
                    $errors['add_user_error'] = "خطا در ذخیره اطلاعات";
                }
            }
        }
    }

    ?>
<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['add_user'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['add_user'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['duplicate'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['duplicate'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['add_user_error'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['add_user_error'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title">
        <h4 class="mb-4">افزودن کاربر جدید  </h4>
        <a href="index.php?page=users" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست کاربران
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="username" class="form-label">نام کاربری</label>
                <input name="username" type="text" class="form-control" id="username" required>
            </div>
            <?php
            if(isset($errors['username'])){
                echo '<div class="alert" role="alert">' . $errors['username'] . ' </div>';
            }
            ?>
            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input name="password" type="password" class="form-control" id="password" required>
            </div>
            <?php
            if(isset($errors['password'])){
                echo '<div class="alert" role="alert">' . $errors['password'] . ' </div>';
            }
            ?>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">تکرار رمز عبور </label>
                <input name="confirm_password" type="password" class="form-control" id="confirmpassword" required>
            </div>
            <?php
            if(isset($errors['confirmpassword'])){
                echo '<div class="alert" role="alert">' . $errors['confirmpassword'] . ' </div>';
            }
            ?>
            <div class="mb-3">
                <label for="phone" class="form-label">شماره تلفن</label>
                <input name="phone" type="tel" class="form-control" id="phone">
            </div>
            <?php
            if(isset($errors['phone'])){
                echo '<div class="alert" role="alert">' . $errors['phone'] . ' </div>';
            }
            ?>
            <div class="mb-3">
                <label for="address" class="form-label">آدرس</label>
                <textarea name="address" class="form-control" id="address" rows="3"></textarea>
            </div>
            <div class="mb-3 form-check">
                <input name="is_admin" type="checkbox" class="form-check-input" id="isAdmin">
                <label class="form-check-label" for="isAdmin">کاربر ادمین است</label>
            </div>
            <button type="submit" name="submit" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن
            </button>
        </form>
    </div>
</div>

