<?php
defined('site') or die('access denied!');
require_once "time/jdf.php";
$errors = [];
if(isset($_POST['submit'])){
    $result = $link->query("SELECT * FROM users WHERE u_username = '" . addslashes($_POST['username']) . "' AND u_password = '" . md5($_POST['password']) . "'");
    if(!isset($_POST['username']) || empty($_POST['username'])){
        $errors['username'] = " لطفا نام کاربری خود را وارد کنید";
    }
    if(!isset($_POST['password']) || empty($_POST['password'])){
        $errors['password'] = 'لطفا رمز عبور  خود را وارد کنید';
    }
    if($result -> num_rows == 1){
        $time = jdate("Y-m-d H:i:s");
        $link -> query("UPDATE users SET u_time = '".$time."'  WHERE u_username = '".$_POST['username']."' AND u_password = '".md5($_POST['password'])."'");
        $row = $result -> fetch_assoc();
        $_SESSION['username'] = $row['u_username'];
        $_SESSION['password'] = $row['u_password'];
        $_SESSION['phone'] = $row['u_phone'];
        $_SESSION['fname'] = $row['u_fname'];
        $_SESSION['lname'] = $row['u_lname'];
        $_SESSION['address'] = $row['u_address'];
        $_SESSION['time'] = $row['u_time'];
        $_SESSION['is_admin'] = $row['u_is_admin'];
        $_SESSION['user_id'] = $row['u_id'];
        $_SESSION['alert_login'] = true;
        if($_SESSION['is_admin'] == 1){
            echo '<script>window.location.reload();</script>';
        }
        else if($_SESSION['is_admin'] == 0){
            echo '<script>window.location.replace("index.php");</script>';
        }
    }
    else if(!empty($_POST['username']) && !empty($_POST['password']) && $result -> num_rows == 0){
        $errors['login_failed'] = " نام کاربری یا رمز عبور اشتباه است";
    }
}
if(!isset($_SESSION['username'])){
?>
<body>
    <div class="clearfix"></div>

    <section class="container-fluid text-lg-right text-center p-3 mb-5">
        <div class="container mb-5">
            <div class="d-flex px-5 py-2 justify-content-center">
            <?php
            if(isset($errors['username'])){
                echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['username'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
            }
            if(isset($errors['password'])){
                echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['password'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
            }
            if(isset($errors['login_failed'])){
                echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['login_failed'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
            }
            ?>
        </div>
            <div class="row d-flex align-items-center mb-5">

                <div class="col-lg-7 pl-lg-5 text-center order-2 order-lg-1 mb-5">
                    <div class="section-title" style="padding: 0 !important; margin: 0 !important;">
                        <p>ورود   </p>
                    </div>
                    <div class="card p-5 mb-5">
                        <form class="contact-form" method="post" action="">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <input type="text" name="username" class="form-control mb-2" placeholder="نام کاربری" >
                                </div>
                                <div class="form-group col-12">
                                    <input type="password" name="password" id="pass" class="form-control mb-2" placeholder="رمز عبور" style="position: relative">
                                    <span id="togglePassword" class="toggle-password" title="نمایش/مخفی کردن رمز عبور" style="position: absolute; top: 12px; left: 32px;"><i class="bi bi-eye"></i></span>
                                </div>
                                <div style="display: flex; justify-content: center; flex-direction: column;">
                                    <div style="margin-left: 1em;">
                                        <button class="button btn btn-primary sign" name="submit"> <i class="bi bi-box-arrow-in-left" style="font-size: 16px !important;"></i> <span
                                            style="margin-left: 2px;">| </span>ورود </button>
                                    </div>
                                    <div class="btn btn-link" style="font-size: 12px !important; color: #3C7BBF !important;">
                                        <a href="index.php?pg=register" style="color: #3C7BBF !important;">ثبت نام نکرده اید؟ از این قسمت اقدام کنید </a>
                                    </div>
                                </div>
                                
                            </div>




                        </form>
                    </div>
                </div>

                <div class="col-lg-5 d-flex align-items-center order-1 order-lg-2">
                    <img src="Img/login-img.png" class="img-fluid wapp" />
                </div>

            </div>

        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function validateLoginForm(form, loginFailed = false) {
            const errors = {};

            const username = form.username.value.trim();
            const password = form.password.value;

            if (!username) {
                errors.username = "لطفا نام کاربری خود را وارد کنید";
            }

            if (!password) {
                errors.password = "لطفا رمز عبور خود را وارد کنید";
            }

            if (loginFailed && username && password) {
                errors.login_failed = "نام کاربری یا رمز عبور اشتباه است";
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

    <?php
    }
    ?>
</body>