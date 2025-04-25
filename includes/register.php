<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> pharmacy | home </title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
<?php
require_once 'includes/header.php';
?>
<div class="clearfix"></div>
<section class="container-fluid text-lg-right text-center mt-4 p-3 mb-5">
    <div class="container">
        <div class="row d-flex align-items-center pt-lg-5">
            <div class="col-lg-7 pl-lg-5 text-center order-2 order-lg-1">
                <div class="section-title" style="padding: 0 !important; margin: 0 !important;">
                    <span class="line"></span>
                    <p>ثبت نام کاربر </p>
                    <span class="line"></span>
                </div>
                <?php
                function clean_data($value)
                {
                    $value = trim($value);
                    $value = str_replace('ي', 'ی', $value);
                    $value = strip_tags($value);
                    return $value;
                }

                $error = [];
                if (isset($_POST['submit'])) {
                    if (isset($_POST['fName']) && mb_strlen(clean_data($_POST['fName'])) > 1) {
                        echo $_POST['fName'];
                        echo '<br>';
                    } else {
                        $error['fName'] = '<div class="alert" role="alert">' . 'نام باید حداقل 2 کاراکتر باشد' . ' </div>';
                    }
                    if (isset($_POST['fName']) && mb_strlen(clean_data($_POST['lName'])) > 2) {
                        echo $_POST['lName'];
                        echo '<br>';
                    } else {
                        $error['lName'] = '<div class="alert" role="alert">' . 'نام خانوادگی باید حداقل 3 کاراکتر باشد' . ' </div>';
                    }
                    if (isset($_POST['phone']) && mb_strlen(clean_data($_POST['phone'])) > 10 && is_numeric(clean_data($_POST['phone']))) {
                        echo $_POST['phone'];
                        echo '<br>';
                    } else {
                        $error['phone'] = '<div class="alert" role="alert">' . 'شماره موبایل باید عددی و 10 رقم باشد' . ' </div>';
                    }
                    if (isset($_POST['email'])) {
                        echo $_POST['email'];
                        echo '<br>';
                    }
                    if (isset($_POST['citySelect'])) {
                        echo $_POST['citySelect'];
                        echo '<br>';
                    } else {
                        $error['citySelect'] = '<div class="alert" role="alert">' . 'لطفا شهر خود را انتخاب کنید' . ' </div>';
                    }
                    if (empty($_POST['password'])) {
                        $error['password'] = '<div class="alert" role="alert">' . 'رمز عبور خود را وارد کنید' . ' </div>';
                    } else if (empty($_POST['confirmPassword'])) {
                        $error['confirmPassword'] = '<div class="alert" role="alert">' . 'تکرار رمز عبور را وارد کنید' . ' </div>';
                    } else {
                        if ($_POST['password'] === $_POST['confirmPassword']) {
                            echo $_POST['password'];
                        } else {
                            $error['confirmPassword'] = '<div class="alert" role="alert">' . 'رمز عبور و تکرار آن برابر نیستند' . ' </div>';
                        }
                    }
                    if (!isset($_POST['genderRadio'])) {
                        $error['genderRadio'] = "یک گزینه را انتخاب کنید";
                        echo '<br>';
                    }
                    if (isset($_POST['genderRadio']) && !in_array($_POST['genderRadio'], ['woman','man'])) {
                        $error['genderRadio'] = "لطفا از بین گزینه های موجود انتخاب کنید";
                    }
                    if (isset($_POST['description'])) {
                        echo $_POST['description'];
                        echo '<br>';
                    }
                    if (isset($_POST['iAgree'])) {
                        $checkAgree = true;
                    } else {
                        $checkAgree = false;
                        $error['checkAgree'] = '<div class="alert" role="alert">' . 'لطفا قوانین را مطالعه و گزینه قبول قوانین را انتخاب کنید' . ' </div>';
                    }

                    $pictureExtention = substr($_FILES['picFile']['name'], strrpos($_FILES['picFile']['name'], '.')+1);
                    if(!in_array($pictureExtention, ['png', 'jpg', 'jpeg'])) {
                        $error['picFile'] = '<div class="alert" role="alert">' . 'پسوند مجاز نیست' . ' </div>';
                    }
                    if($_FILES['picFile']['size'] > 520000) {
                        $error['picFile']= (isset($error['picFile'])? $error['picFile']."<br>":"").'<div class="alert" role="alert">' . 'حجم فایل بیشتر از حد مجاز است' . ' </div>';
                    }
                    if(!isset($error['picFile'])) {
                        $fileName = date("YmdHis") . "pharmacy" .$pictureExtention;
                        move_uploaded_file($_FILES['picFile']['tmp_name'], "uploads/" . $fileName);
                        echo $_FILES['picFile']['name'];
                        echo "<br>";
                    }
                    echo $checkAgree;
                }
                ?>
                <div class="card p-5">
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
                                <div class="form-group">
                                    <div class="mb-3">
                                        <label class="file-label" for="formFile">بارگذاری تصویر</label>
                                        <input class="form-control" type="file" id="formFile" name="picFile" value="picFile">
                                    </div>
                                    <?php
                                    if (isset($error['picFile'])) {
                                        echo $error['picFile'];
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genderRadio"
                                               id="inlineRadio1" value="woman">
                                        <label class="form-check-label" for="inlineRadio1">خانم</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="genderRadio"
                                               id="inlineRadio2" value="man">
                                        <label class="form-check-label" for="inlineRadio2">مرد</label>
                                    </div>
                                    <?php
                                    if (isset($error['genderRadio'])) {
                                        echo $error['genderRadio'];
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
                                    <input type="password" name="password" class="form-control mb-2"
                                           placeholder="رمز عبور*" value="<?php
                                    if (isset($_POST['password'])) {
                                        echo $_POST['password'];
                                    }
                                    ?>">
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

                                <div class="form-group">
                                        <textarea class="form-control" name="description" rows="3"
                                                  placeholder="توضیحات"><?php
                                            if (isset($_POST['description'])) {
                                                echo $_POST['description'];
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
                                     style="font-size: 12px !important; color: #3C7BBF !important;">
                                    <a href="login.php" style="color: #3C7BBF !important;">ثبت نام کرده اید؟ وارد
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
<div class="text-center p-3" style="background-color: #e9ecef;">
    <p>&copy; 2025 کلیه حقوق محفوظ است. | طراحی شده توسط hoda</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/script.js"></script>

</body>

</html>