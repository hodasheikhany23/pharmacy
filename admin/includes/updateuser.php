<?php
defined('site') or die('Access denied');

if (!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1') {
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('11',$perm) && !in_array('14',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors = [];

if (isset($_POST['update'])) {
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // بررسی و پاکسازی یوزرنیم
    if (isset($_POST['username'])) {
        if (mb_strlen($_POST['username']) > 2) {
            $username = $_POST['username']; // فرض بر این است که کنترل شده است
        }
        else {
            $errors['username'] = "نام کاربری باید بیشتر از 2 کاراکتر باشد";
        }
    }
    else {
        $errors['username'] = "نام کاربری را وارد کنید";
    }

    // بررسی شماره تلفن
    if (!empty($_POST['phone'])) {
        if (mb_strlen($_POST['phone']) == 11 && is_numeric($_POST['phone'])) {
            $phone = $_POST['phone'];
        }
        else {
            $errors['phone'] = 'شماره موبایل باید عددی و 11 رقم باشد';
        }
    }
    else {
        $phone = null; // در صورت عدم وارد کردن شماره تلفن
    }

    // بررسی آدرس
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    }
    else {
        $address = '';
    }

    // اگر خطا نبود، عملیات بروزرسانی انجام می‌شود
    if (isset($username) && !isset($errors['username']) && !isset($errors['phone'])) {
        // فرض بر این است که کاربر با این ID وجود دارد
        $user_id = $_GET['id'];

        // ساختن کوئری به صورت دستی (بدون اسکیپ کردن)
        $sql = "UPDATE users SET u_username='" . $username . "',u_phone='" . ($phone !== null ? $phone : '') . "',u_address='" . $address . "',u_is_admin='" . $is_admin . "'WHERE u_id='" . $user_id . "'";
        $link->query($sql);
        if ($link->errno == 0) {
            $errors['update_user'] = "مشخصات کاربر با موفقیت ویرایش شد";
        }
        else {
            $errors['update_user_error'] = "خطا در ویرایش اطلاعات";
        }
    }
}

// گرفتن اطلاعات کاربر قبل از ویرایش
$resultUser = $link->query("SELECT * FROM users WHERE u_id='" . $_GET['id'] . "'");

if ($resultUser && $resultUser->num_rows > 0) {
    $rowUpdate = $resultUser->fetch_assoc();
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
        if(isset($errors['username'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['username'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['phone'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['phone'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-4">  ویرایش کاربر  </h4>
        <a href="index.php?pg=login&page=users" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست کاربران
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="username" class="form-label">نام کاربری</label>
                <input name="username" type="text" class="form-control" id="username" value="<?php if(isset($rowUpdate)){echo trim($rowUpdate['u_username']);} ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">شماره تلفن</label>
                <input name="phone" type="tel" class="form-control" id="phone"  value="<?php if(isset($rowUpdate)){echo $rowUpdate['u_phone'];} ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">آدرس</label>
                <input name="address" class="form-control" id="address" type="text" value="<?php if(isset($rowUpdate)){ echo $rowUpdate['u_address'];} ?>">
            </div>
            <div class="mb-3 form-check">
                <input name="is_admin" type="checkbox" class="form-check-input" id="isAdmin"
                    <?php if (isset($rowUpdate) && $rowUpdate['u_is_admin'] == 1) echo 'checked'; ?> >
                <label class="form-check-label" for="isAdmin">کاربر ادمین است</label>
            </div>
            <button type="submit" name="update" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> ثبت ویرایش
            </button>
        </form>
    </div>
</div>

