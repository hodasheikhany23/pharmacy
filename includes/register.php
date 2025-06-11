<?php
require_once 'includes/connect.php';
$error = [];
if (isset($_POST['submit'])) {
    if (isset($_POST['fName']) && mb_strlen(clean_data($_POST['fName'])) > 1) {
        $fname = clean_data($_POST['fName']);
    } else {
        $error['fName'] = '<div class="alert" role="alert">' . 'نام باید حداقل 2 کاراکتر باشد' . ' </div>';
    }
    if (isset($_POST['fName']) && mb_strlen(clean_data($_POST['lName'])) > 2) {
        $lname = clean_data($_POST['lName']);
    } else {
        $error['lName'] = '<div class="alert" role="alert">' . 'نام خانوادگی باید حداقل 3 کاراکتر باشد' . ' </div>';
    }
    if (isset($_POST['username']) && mb_strlen(clean_data($_POST['username'])) > 1) {
        $username = clean_data($_POST['username']);
    } else {
        $error['fName'] = '<div class="alert" role="alert">' . 'نام باید حداقل 2 کاراکتر باشد' . ' </div>';
    }
    if (isset($_POST['phone']) && mb_strlen(clean_data($_POST['phone'])) > 10 && is_numeric(clean_data($_POST['phone']))) {
        $phone = clean_data($_POST['phone']);
    }
    else {
        $error['phone'] = '<div class="alert" role="alert">' . 'شماره موبایل باید عددی و 10 رقم باشد' . ' </div>';
    }
    if (isset($_POST['citySelect'])) {
        $city = clean_data($_POST['citySelect']);
    }
    else {
        $error['citySelect'] = '<div class="alert" role="alert">' . 'لطفا شهر خود را انتخاب کنید' . ' </div>';
    }
    if (empty($_POST['password'])) {
        $error['password'] = '<div class="alert" role="alert">' . 'رمز عبور خود را وارد کنید' . ' </div>';
    } else if (empty($_POST['confirmPassword'])) {
        $error['confirmPassword'] = '<div class="alert" role="alert">' . 'تکرار رمز عبور را وارد کنید' . ' </div>';
    } else {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $password = $_POST['password'];
        }
        else {
            $error['confirmPassword'] = '<div class="alert" role="alert">' . 'رمز عبور و تکرار آن برابر نیستند' . ' </div>';
        }
    }
    if (isset($_POST['iAgree'])) {
        $checkAgree = true;
    } else {
        $checkAgree = false;
        $error['checkAgree'] = '<div class="alert" role="alert">' . 'لطفا قوانین را مطالعه و گزینه قبول قوانین را انتخاب کنید' . ' </div>';
    }
    if(isset($_POST['picFile']))
    {
        $pictureExtention = substr($_FILES['picFile']['name'], strrpos($_FILES['picFile']['name'], '.')+1);
        if(!in_array($pictureExtention, ['png', 'jpg', 'jpeg'])) {
            $error['picFile'] = '<div class="alert" role="alert">' . 'پسوند مجاز نیست' . ' </div>';
        }
        if($_FILES['picFile']['size'] > 520000) {
            $error['picFile']= (isset($error['picFile'])? $error['picFile']."<br>":"").'<div class="alert" role="alert">' . 'حجم فایل بیشتر از حد مجاز است' . ' </div>';
        }
        if(!isset($error['picFile'])) {
            $fileName = date("YmdHis") . "cosmetics" .$pictureExtention;
            move_uploaded_file($_FILES['picFile']['tmp_name'], "uploads/" . $fileName);
        }
    }
    else{
        $fileName=null;
    }
    if(isset($_POST['address'])) {
        $address = clean_data($_POST['address']);
    }
    if(empty($error)&& $checkAgree) {
        $resultRegister = $link->query("INSERT INTO users (u_username, u_password, u_phone, u_address,u_fname,u_lname,u_city,u_image) values ('".$username."','".md5($password)."','".$phone."','".$address."','".$fname."','".$lname."','".$city."','".$fileName."')");
        if($link->errno==0) {
            $errors['register'] = "ثبت نام با موفقیت انجام شد";
            echo '<script>window.location.replace("index.php?pg=login");</script>';
        }
        else {
            $errors['err_register']="خطا در انجام عملیات!";
        }
    }
}
?>
<div class="clearfix"></div>
<section class="container-fluid text-lg-right text-center pb-5 mb-5">
    <div class="container  mb-5">
        <div class="row d-flex align-items-center mb-5">
            <div class="col-lg-7 pl-lg-5 text-center order-2 order-lg-1">
                <div class="section-title" style="padding: 0 !important; margin: 0 !important;">
                    <p>ثبت نام کاربر </p>
                </div>
                <div class="card p-5">
                    <?php
                    if(isset($errors['err_register'])){
                        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                                  <div class="px-5">
                                   <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                                    ' .$errors['err_register'].'
                                  </div>
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                                </div>';
                    }
                    if(isset($errors['register'])){
                        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #003907 !important;" role="alert">
                                  <div class="px-5">
                                   <i class="bi bi-check-all" class="mr-3"></i>
                                    ' .$errors['register'].'
                                  </div>
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                                </div>';
                    }
            ?>
                    <form class="contact-form" method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control mb-2" name="fName" placeholder="نام*"
                                           value="<?php
                                           if (isset($_POST['fName'])) {
                                               echo $_POST['fName'];
                                           }
                                           ?>">
                                    <?php
                                    if (isset($error['fName'])) {
                                        echo $error['fName'];
                                    }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control mb-2" name="lName"
                                           placeholder="نام خانوادگی*" value="<?php
                                    if (isset($_POST['lName'])) {
                                        echo $_POST['lName'];
                                    }
                                    ?>">
                                    <?php
                                    if (isset($error['lName'])) {
                                        echo $error['lName'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group ">
                                    <input type="text" class="form-control mb-2" name="phone"
                                           placeholder="شماره موبایل*" value="<?php
                                    if (isset($_POST['phone'])) {
                                        echo $_POST['phone'];
                                    }
                                    ?>">
                                    <?php
                                    if (isset($error['phone'])) {
                                        echo $error['phone'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="file-label" for="formFile" style="font-size: 14px">بارگذاری تصویر پروفایل (الزامی نیست*) </label>
                                        <input class="form-control" type="file" id="formFile" name="picFile" value="picFile">
                                    </div>
                                    <?php
                                    if (isset($error['picFile'])) {
                                        echo $error['picFile'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="iAgree" value="i agree"
                                               id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            قوانین را مطالعه کردم و قبول دارم.
                                        </label>
                                    </div>
                                    <?php
                                    if (isset($error['checkAgree'])) {
                                        echo $error['checkAgree'];
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control mb-2"
                                           placeholder="نام کاربری" value="<?php
                                    if (isset($_POST['username'])) {
                                        echo $_POST['username'];
                                    }
                                    ?>">
                                    <?php
                                    if (isset($error['username'])) {
                                        echo $error['username'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input style="position: relative;" id="pass" type="password" name="password" class="form-control mb-2"
                                           placeholder="رمز عبور*" value="<?php
                                    if (isset($_POST['password'])) {
                                        echo $_POST['password'];
                                    }
                                    ?>">
                                    <span id="togglePassword" class="toggle-password" title="نمایش/مخفی کردن رمز عبور" style="position: absolute; top: 65px; left: 32px;"><i class="bi bi-eye"></i></span>

                                    <?php
                                    if (isset($error['password'])) {
                                        echo $error['password'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group ">
                                    <input type="password" name="confirmPassword" class="form-control mb-2"
                                           placeholder="تکرار رمز عبور*" value="<?php
                                    if (isset($_POST['confirmPassword'])) {
                                        echo $_POST['confirmPassword'];
                                    }
                                    ?>">
                                    <?php
                                    if (isset($error['confirmPassword'])) {
                                        echo $error['confirmPassword'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group ">
                                    <select name="citySelect" class="form-control form-select mb-2 form-select-sm">
                                        <option disabled selected> شهر خود را انتخاب کنید*</option>
                                        <option value="mashhad">مشهد</option>
                                        <option value="toeghabe"> طرقبه</option>
                                        <option value="shandiz"> شاندیز</option>
                                    </select>
                                    <?php
                                    if (isset($error['citySelect'])) {
                                        echo $error['citySelect'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group ">
                                    <label for="address">آدرس</label>
                                    <textarea name="address" id="address"><?php
                                        if (isset($_POST['address'])) {
                                            echo $_POST['address'];
                                        }
                                        ?></textarea>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center; flex-direction: column;">
                                <div style="margin-left: 1em;">
                                    <button type="submit" name="submit" class="btn button btn-primary sign">
                                        <i class="bi bi-box-arrow-in-left"></i>
                                        <span style="margin-left: 2px;">| </span>ثبت نام
                                    </button>
                                </div>
                                <div class="btn btn-link"
                                     style="font-size: 14px !important; color: #3C7BBF !important;">
                                    <a href="index.php?pg=login" style="color: #3C7BBF !important;">ثبت نام کرده اید؟ وارد
                                        شوید </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 d-flex align-items-center order-1 order-lg-2">
                <img src="Img/login-img.png" class="img-fluid wapp"/>
            </div>
        </div>
    </div>
</section>
<script>
    function clean_data(input) {
        return input.trim();
    }

    function validateForm(form) {
        const errors = {};

        const fName = clean_data(form.fName.value);
        if (!fName || fName.length < 2) {
            errors.fName = '<div class="alert" role="alert">نام باید حداقل 2 کاراکتر باشد</div>';
        }

        const lName = clean_data(form.lName.value);
        if (!lName || lName.length < 3) {
            errors.lName = '<div class="alert" role="alert">نام خانوادگی باید حداقل 3 کاراکتر باشد</div>';
        }

        const username = clean_data(form.username.value);
        if (!username || username.length < 2) {
            errors.username = '<div class="alert" role="alert">نام باید حداقل 2 کاراکتر باشد</div>';
        }

        const phone = clean_data(form.phone.value);
        if (!phone || phone.length < 10 || isNaN(phone)) {
            errors.phone = '<div class="alert" role="alert">شماره موبایل باید عددی و 10 رقم باشد</div>';
        }

        const city = clean_data(form.citySelect.value);
        if (!city) {
            errors.citySelect = '<div class="alert" role="alert">لطفا شهر خود را انتخاب کنید</div>';
        }

        const password = form.password.value;
        const confirmPassword = form.confirmPassword.value;

        if (!password) {
            errors.password = '<div class="alert" role="alert">رمز عبور خود را وارد کنید</div>';
        } else if (!confirmPassword) {
            errors.confirmPassword = '<div class="alert" role="alert">تکرار رمز عبور را وارد کنید</div>';
        } else if (password !== confirmPassword) {
            errors.confirmPassword = '<div class="alert" role="alert">رمز عبور و تکرار آن برابر نیستند</div>';
        }

        if (!form.iAgree.checked) {
            errors.checkAgree = '<div class="alert" role="alert">لطفا قوانین را مطالعه و گزینه قبول قوانین را انتخاب کنید</div>';
        }

        return errors;
    }
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('pass');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type');
        if (type === 'password') {
            passwordInput.setAttribute('type', 'text');
            togglePassword.innerHTML = '<i class="bi bi-eye-slash"  style="font-size: 16px !important;"></i>';
        } else {
            passwordInput.setAttribute('type', 'password');
            togglePassword.innerHTML = '<i class="bi bi-eye"  style="font-size: 16px !important;"></i>';
        }
    });
</script>
