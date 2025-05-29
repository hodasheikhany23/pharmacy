<?php
require_once "includes/connect.php";
if(isset($_GET['logout'])){
    session_destroy();
    header("location: ../index.php");
}
if(!isset($_SESSION['username'])){
    require_once "includes/login.php";
}
if(isset($_SESSION['username'])){
require_once "includes/header.php";


?>
    <div class="container mt-3 mb-5 pb-5">
        <?php
        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                  <div class="px-5">
                   <i class="fa fa-check-circle"></i>
                    خرید شما با موفقیت انجام شد!
                  </div>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                </div>';
        ?>
        <div class="d-flex justify-content-center">
            <div class="card d-flex flex-column text-center p-5 w-50 border-0" style="height: fit-content">
                <div class="card-title" style="background-color: darkgreen; padding: 1rem 3rem; border-radius: 8px; color: white; ">
                    خرید شما با موفقیت انجام شد
                </div>
                <div class="rounded d-flex flex-column justify-content-center text-center align-content-center mt-3 p-5" style="background-color: var(--color-main); color: whitesmoke;">
                    از اعتماد شما سپاسگزاریم
                    <div class="card-link mt-5">
                        <a class="button btn btn-outline-primary" href="index.php"> <i class="bi bi-house"></i> <span
                                    style="margin-left: 2px;">|</span> بازگشت به صفحه اصلی  </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
    require_once "includes/footer.php";
}
?>