<?php
mb_internal_encoding("UTF-8");
?>
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
    <!-- Header -->
    <header>
        <div class="container text-center">
            <div class="header-logo header-right">
                <a href="index.php"> <img src="img/logo.svg"></a>

                <div class="site-name">
                    <h2 class="mytext-large mytext-bold">ONLINE<br>PHARMACY</h2>
                </div>
            </div>
            <div class="header-search header-center">
                <input class="search-input" name="searchbox" placeholder="جست و جو">
                <button class="search-button"><i class="bi bi-search"></i></button>
            </div>
            <div class="d-grid gap-2 d-none d-md-flex">
                <a class="button btn btn-primary sign" href="sign-up.php"> <i class="bi bi-box-arrow-in-left"></i> <span
                            style="margin-left: 2px;">|</span> ورود / ثبت نام </a>
                <a class="button btn btn-outline-primary" href="cart.php"> <i class="bi bi-bag"></i> <span
                            style="margin-left: 2px;">|</span> سبد خرید </a>
            </div>
        </div>
    </header>

    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" id="hamburger-button">
                    <span class="hamburger-icon"><i class="bi bi-list"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto ps-lg-0" style="padding-left: 0.15rem">
                        <li class="dropdown position-static">
                            <a data-mdb-dropdown-init class="nav-item " href="products.php" id="navbarDropdown"
                               role="button"
                               data-mdb-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-list"></i>
                                محصولات
                            </a>
                            <div class="dropdown-menu w-100 mt-0" aria-labelledby="navbarDropdown" style="
                                                      border-top-left-radius: 0;
                                                      border-top-right-radius: 0;
                                                    ">
                                <div class="container">
                                    <div class="row my-4">
                                        <div class="col-md-4 col-lg-3 mb-3 mb-lg-0">
                                            <div class="list-group list-group-flush">
                                                <a href=""
                                                   class="list-group-item dropdown list-group-item-action">آرایشی
                                                    بهداشتی</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 1</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 2</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 3</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 4</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 5</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-3 mb-3 mb-lg-0">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action"> تقویت
                                                    پوست و مو </a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 1</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 2</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 3</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 4</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 5</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-3 mb-3 mb-lg-0">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action">مکمل
                                                    کودکان </a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 1</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 2</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 3</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 4</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 5</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-3 mb-3 mb-lg-0">
                                            <div class="list-group list-group-flush">
                                                <a href="" class="list-group-item list-group-item-action"> مکمل و
                                                    ویتامین بزرگسالان </a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 1</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 2</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 3</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 4</a>
                                                <a href="" class="list-item list-group-item-action"> زیر منو 5</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item"><a href="blog.php">
                                <i class="bi bi-bookmark"></i>وبلاگ
                            </a></li>
                        <li class="nav-item"><a href="#">
                                <i class="bi bi-file-earmark-text"></i>استعلام نسخه
                            </a></li>
                        <li class="nav-item"><a href="about.php">
                                <i class="bi bi-info-square"></i>مشخصات داروخانه
                            </a></li>
                    </ul>

                    <ul class="info-box">
                        <li class="info-box-item">09154326098<i class="bi bi-phone"></i></li>
                        <li class="info-box-item">051-32456657<i class="bi bi-telephone"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Hamburger Menu for Mobile -->
    <div class="hamburger-menu" id="hamburger-menu">
        <div class="hamburger-header d-flex justify-content-between align-items-center">
            <h4>منو</h4>
            <button class="btn-close" id="close-hamburger">
                <i class="bi bi-x"></i>
            </button>
        </div>
        <ul class="mobile-menu">
            <li><a href="#">ورود | ثبت نام</a></li>
            <li><a href="#">سبد خرید</a></li>
            <li><a href="#">محصولات</a></li>
            <li><a href="#">وبلاگ</a></li>
            <li><a href="#">استعلام نسخه</a></li>
            <li><a href="#">مشخصات داروخانه</a></li>
            <li class="info-box-item">09154326098<i class="bi bi-phone"></i></li>
            <li class="info-box-item">051-32456657<i class="bi bi-telephone"></i></li>
        </ul>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/script.js"></script>

</body>

</html>