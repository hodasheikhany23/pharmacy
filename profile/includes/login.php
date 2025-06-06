﻿<?php
    defined('site') or die('access denied!');
    $errors = [];
    if(isset($_POST['submit'])){
        $result = $link->query("SELECT * FROM users WHERE u_username = '" . addslashes($_POST['username']) . "' AND u_password = '" . md5($_POST['password']) . "' AND u_is_admin = '1'");
        if(!isset($_POST['username']) || empty($_POST['username'])){
            $errors['username'] = " لطفا نام کاربری خود را وارد کنید";
        }
        if(!isset($_POST['password']) || empty($_POST['password'])){
            $errors['password'] = 'لطفا رمز عبور  خود را وارد کنید';
        }
        if($result -> num_rows == 1){
            $time = date("Y-m-d H:i:s");
            $link -> query("UPDATE users SET u_time = '".$time."'  WHERE u_username = '".$_POST['username']."' AND u_password = '".md5($_POST['password'])."'");
            $row = $result -> fetch_assoc();
            $_SESSION['username'] = $row['u_username'];
            $_SESSION['password'] = $row['u_password'];
            $_SESSION['phone'] = $row['u_phone'];
            $_SESSION['fname'] = $row['u_fname'];
            $_SESSION['lname'] = $row['u_lname'];
            $_SESSION['address'] = $row['u_address'];
            $_SESSION['time'] = $row['u_time'];
        }
        else if(!empty($_POST['username']) && !empty($_POST['password']) && $result -> num_rows == 0){
            $errors['login_failed'] = " نام کاربری یا رمز عبور اشتباه است";
        }
    }
    if(!isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> pharmacy | home </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="admin-login-bg">
    <nav class="login-header main-header navbar navbar-expand navbar-light d-flex justify-content-between" >
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link" style="color: #d0d0d0 !important;">بازگشت به سایت</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link" style="color: #d0d0d0 !important;"> درباره ما </a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link" style="color: #d0d0d0 !important;"> تماس با پشتیبان فنی: 09155586565 </a>
            </li>
        </ul>
    </nav>
    <section class="container d-flex flex-column justify-content-center text-lg-right text-center mt-4 p-5 mb-5 ">
        <div class="row align-items-center p-5" style="width: 100%">
            <div class="col-lg-7 text-center" style="width: 100%">
                <div class="section-title d-flex justify-content-center" style="padding: 0 !important; margin: 0 !important; color: white">
                    <p style="color: white">ورود ادمین</p>
                </div>
                <div class="card admin-login-card p-5" style="background-color: transparent; border: blue 2px solid; color: white">
                    <?php
                    if(isset($errors['login_failed'])){
                        echo '<div class="alert alert-danger py-3" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            '.$errors['login_failed'].'
                          </div>
                        </div>';
                    }
                    ?>
                    <form class="contact-form" action="" method="post">
                        <div class="form-row d-flex justify-content-center flex-column">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control mb-2 login-form-control" placeholder="نام کاربری">
                            </div>
                            <?php
                            if(isset($errors['username'])){
                                echo '<div class="alert" role="alert" style="color: #fb8b8b !important;"> <i class="fa fa-exclamation-triangle" style="margin-left: 1em;"></i>'  .$errors['username']. ' </div>';
                            }
                            ?>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control mb-2 login-form-control" placeholder="رمز عبور">
                            </div>
                            <?php
                            if(isset($errors['password'])){
                                echo '<div class="alert" role="alert" style="color: #fb8b8b !important;"> <i class="fa fa-exclamation-triangle" style="margin-left: 1em;"></i>' .$errors['password']. ' </div>';
                            }
                            ?>
                            <div style="display: flex; justify-content: center; flex-direction: column;">
                                <div style="margin-left: 1em;">
                                    <button type="submit" name="submit" class="button btn btn-primary sign">
                                        <i class="bi bi-box-arrow-in-left"></i>
                                        <span style="margin-left: 2px;">| </span>ورود به پنل ادمین
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="text-center p-3" style="background-color: transparent; color: #a3b0e8">
        <p>&copy; 2025 کلیه حقوق محفوظ است. | طراحی شده توسط hoda</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <?php
    }
    ?>

</body>

</html>