<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> pharmacy | home </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="fonts/fonts.css">
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
                <img src="img/logo.svg">
                <div class="site-name">
                    <h2 class="mytext-large mytext-bold">ONLINE<br>PHARMACY</h2>
                </div>
            </div>
            <div class="header-search header-center">
                <input class="search-input" name="searchbox" placeholder="جست و جو">
                <button class="search-button"><i class="bi bi-search"></i></button>
            </div>
            <div class="d-grid gap-2 d-none d-md-flex">
                <a class="button btn btn-primary sign" href="#"> <i class="bi bi-box-arrow-in-left"></i> <span
                        style="margin-left: 2px;">|</span> ورود / ثبت نام </a>
                <a class="button btn btn-outline-primary" href="#"> <i class="bi bi-bag"></i> <span
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
                            <a data-mdb-dropdown-init class="nav-item " href="#" id="navbarDropdown" role="button"
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
                        <li class="nav-item"><a href="#">
                                <i class="bi bi-bookmark"></i>وبلاگ
                            </a></li>
                        <li class="nav-item"><a href="#">
                                <i class="bi bi-file-earmark-text"></i>استعلام نسخه
                            </a></li>
                        <li class="nav-item"><a href="#">
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

    <div class="clearfix"></div>

    <section class="container-fluid text-lg-right text-center mt-4 p-3 mb-5">
        <div class="container">

            <div class="row d-flex align-items-center pt-lg-5">

                <div class="col-lg-7 pl-lg-5 text-center order-2 order-lg-1">
                    <div class="section-title" style="padding: 0 !important; margin: 0 !important;">
                        <span class="line"></span>
                        <p>ورود کاربر   </p>
                        <span class="line"></span>
            
                    </div>
                    <div class="card p-5">
                        <form class="contact-form">


                            <div class="form-row">
                                <div class="form-group col-12">
                                    <input type="text" class="form-control mb-2" placeholder="نام کاربری" >

                                </div>
                                <div class="form-group col-12">
                                    <input type="password" class="form-control mb-2" placeholder="رمز عبور">

                                </div>
                                <div style="display: flex; justify-content: center; flex-direction: column;">
                                    <div style="margin-left: 1em;">
                                        <a class="button btn btn-primary sign" href="#"> <i class="bi bi-box-arrow-in-left"></i> <span
                                            style="margin-left: 2px;">| </span>ورود </a>
                                    </div>
                                    <div class="btn btn-link" style="font-size: 12px !important; color: #3C7BBF !important;">
                                        <a href="sign-up.php" style="color: #3C7BBF !important;">ثبت نام نکرده اید؟ از این قسمت اقدام کنید </a>
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



    <div class="text-center p-3" style="background-color: #e9ecef;">
        <p>&copy; 2025 کلیه حقوق محفوظ است. | طراحی شده توسط hoda</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>