<?php
defined('site') or die('Access denied');
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1') {
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('11',$perm) && !in_array('14',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors = [];
if (isset($_POST['submit'])) {
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;
    $username = '';
    $password = '';
    $phone = '';
    $address = '';

    if (isset($_POST['username'])) {
        $username_input = clean_data($_POST['username']);
        if (mb_strlen($username_input) > 2) {
            $username = $username_input;
        } else {
            $errors['username'] = "نام کاربری باید بیشتر از ۲ کاراکتر و تنها شامل حروف، اعداد و خط‌تیره باشد.";
        }
    }
    else {
        $errors['username'] = "نام کاربری را وارد کنید.";
    }
    if (isset($_POST['phone'])) {
        $phone_input = clean_data($_POST['phone']);
        if (mb_strlen($phone_input) == 11 && is_numeric($phone_input)) {
            $resultDuplicate = $link->query("SELECT * FROM users WHERE u_phone = '$phone_input'");
            if ($resultDuplicate->num_rows != 0) {
                $errors['duplicate'] = "این شماره موبایل در سامانه موجود است. لطفا شماره جدید وارد کنید.";
            }
            else {
                $phone = $phone_input;
            }
        }
        else {
            $errors['phone'] = 'شماره موبایل باید عددی و 11 رقم باشد';
        }
    }
    else {
        $errors['phone'] = 'شماره تلفن را وارد کنید';
    }

    if (isset($_POST['password'])) {
        if (mb_strlen($_POST['password']) < 8) {
            $errors['password'] = "رمز عبور باید حداقل 8 کاراکتر باشد.";
        } elseif ($_POST['password'] != $_POST['confirm_password']) {
            $errors['password'] = "رمز عبور و تکرار آن برابر نیستند.";
        } else {
            $password = $_POST['password'];
        }
    }
    else {
        $errors['password'] = "رمز عبور را وارد کنید.";
    }
    if (isset($_POST['address'])) {
        $address = trim($_POST['address']);
    }

    // در صورت نداشتن خطا، درج در دیتابیس
    if (empty($errors)) {
        $sql = "INSERT INTO users (u_username, u_password, u_phone, u_address, u_is_admin) VALUES ('" . $username . "','" . md5($password) . "','" . $phone . "','" . $address . "'," . $is_admin . ")";
        $link->query($sql);
        $user_id = $link->insert_id;
        if ($link->errno == 0) {
            $errors['add_user'] = "کاربر با موفقیت ثبت شد .";
            if(isset($_POST['perm']) && is_array($_POST['perm'])) {
                foreach ($_POST['perm'] as $perm) {
                    $result_role = $link->query("INSERT INTO admin_role (ar_user_id, ar_permission_id) VALUES ('".$user_id."','".$perm."')");
                    if ($link->errno == 0) {
                        $errors['add_user'] = "کاربر با موفقیت ثبت شد .";
                    }
                    else{
                        $errors['add_user_error'] = "خطا در ذخیره اطلاعات. لطفاً مجدداً تلاش کنید.";
                    }
                }
            }
        }
        else {
            $errors['add_user_error'] = "خطا در ذخیره اطلاعات. لطفاً مجدداً تلاش کنید.";
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
    <div class="section-title" style="margin-top: 0 !important; padding-top: 0 !important;">
        <h4 class="mb-4">افزودن کاربر جدید  </h4>
        <a href="index.php?pg=login&page=users" class="button btn btn-primary">
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
            <?php
            if(in_array('14', $perm)){
                echo '<div class="mb-3 form-check">
                <input name="is_admin" type="checkbox" class="form-check-input" id="isAdmin" onchange="roles()">
                <label class="form-check-label" for="isAdmin">کاربر ادمین است</label>
            </div>
            <div class="mb-3 form-check" id="role_box">

            </div>';
            }
            ?>

            <button type="submit" name="submit" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن
            </button>
        </form>
    </div>
</div>

<script>
    function roles(){
        let div = document.getElementById('role_box');
        let main_check = document.getElementById('isAdmin');
        if(main_check.checked){
            div.innerHTML = '<div class="mb-3 form-check d-flex flex-row flex-wrap gap-3">'+
                '<?php

                    $result_permissions = $link->query("SELECT * FROM permissions where per_parent = '0' order by per_id DESC");
                    while($row_permissions = $result_permissions->fetch_assoc()){
                        echo '<div class="card rounded border-0 p-3" style="width: 47%">';
                        echo '<div class="m-3"><input onchange="check('.$row_permissions['per_id'].',)" name="perm[]" value="'.$row_permissions['per_id'].'" type="checkbox" class="form-check-input" id="perm_'.$row_permissions['per_id'].'">';
                        echo '<label class="form-check-label" for="perm_'.$row_permissions['per_id'].'"> '.$row_permissions['per_name'].'</label>';
                        echo '<p style="font-size: 0.8em; color: #777; margin: 0 0 10px 25px;">'.$row_permissions['per_caption'].'</p></div>';
                        $result_child = $link->query("SELECT * FROM permissions where per_parent = '".$row_permissions['per_id']."'");
                        while($row_child = $result_child->fetch_assoc()){
                            echo '<div style="margin-right: 24px;">';
                            echo '<input name="perm[]" value="'.$row_child['per_id'].'" type="checkbox" class="form-check-input child_of_'.$row_permissions['per_id'].'" data-parent="'.$row_permissions['per_id'].'" id="perm_'.$row_child['per_id'].'">';
                            echo '<label class="form-check-label" for="perm[]"> '.$row_child['per_name'].'</label>';
                            echo '<p style="font-size: 0.8em; color: #777; margin: 0 0 10px 25px;">'.$row_child['per_caption'].'</p>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    ?>'+
                '</div>';

        }
        else {
            div.innerHTML='';
        }

    }
    function check(id) {
        let parent = document.getElementById('perm_' + id);
        const children = document.querySelectorAll('.child_of_' + id);
        children.forEach(childCheckbox => {
            childCheckbox.checked = parent.checked;
        });
    }

</script>