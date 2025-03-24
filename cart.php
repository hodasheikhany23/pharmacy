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

    <div class="breadcrumb-area" style="background-color: transparent !important;" data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="breadcrumb-list">
                            <ul style="color: rgb(13, 13, 13) !important;">
                                <li><a href="index.php"><i class="bi bi-house"></i> خانه</a></li>
                                <li style="color: rgb(13, 13, 13) !important;"> > سبد خرید </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container mb-4">
        <div class="row">

            <div class="col-xl-4 order-xl-1 pt-3 order-1 mb-3">

                <div class="card side-category p-4 mb-3" style="border-radius: 24px;">
                    <ul class="list-unstyled">

                        <li class="p-3 bg-title-sidebar">قیمت کالا ها (3 عدد):

                            <div class="d-flex align-items-center justify-content-center">
                                800.000 تومان
                            </div>

                        </li>
                        <li class="p-3">سود شما از خرید:

                            <div class="d-flex align-items-center justify-content-center">
                                80,000 تومان
                            </div>

                        </li>
                        <li class="p-3 bg-title-sidebar">قیمت نهایی (3 عدد):
                            <div class="d-flex align-items-center justify-content-center">
                                720,000 تومان
                            </div>
                        </li>

                    </ul>
                    <li style="padding: 1em;">
                        هزینه این سفارش هنوز پرداخـت نشده و در صورت اتمــام موجــودی
                        کالا ها از سبد خرید شما حدف می شوند.
                    </li>
                    <div class="d-grid gap-2 d-none d-md-flex ">
                        <a class="button btn btn-primary bg-success btn-success" href="#"> <i
                                class="bi bi-check-lg"></i> <span style="margin-left: 2px;">| </span>ثبت خرید و پرداخـت
                        </a>
                        <a class="button btn btn-outline-primary" href="#"> <i class="bi bi-arrow-bar-right"></i><span
                                style="margin-left: 2px;"></span> بازگشت </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 order-xl-0 order-0 mb-3">

                <div class="card m-3 p-4" style="border-radius: 24px;">
                    <div class="item">

                        <div class="">

                            <div class="d-flex align-items-center justify-content-between" style="padding-bottom: 1em; margin-bottom: 2em; border-bottom: 1px solid rgba(128, 128, 128, 0.325);">
                                <div class="col-lg-3">
                                    <img src="Img/p1.png" alt="" style="width: 50%;">
                                </div>
                                <div class="col-lg-3">محصول 1 </div>
                                <div class="col-lg-3">800.000 تومان</div>
                                <div class="col-lg-3">
                                    <div
                                        class="input-group d-flex align-items-center justify-content-center cart-increment radius20">

                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn p-3" data-type="plus"
                                                data-field="">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </span>

                                        <input type="text" id="quantity" name="quantity"
                                            class="input-cart form-control input-number" value="1" min="1" max="100">

                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn p-3" data-type="minus"
                                                data-field="">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </span>

                                    </div>
                                </div>

                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-cart bt-cart cart-res">
                                <div class="col-lg-3">
                                    <img src="Img/p2.png" alt="" style="width: 50%;">
                                </div>
                                <div class="col-lg-3">محصول 2 </div>
                                <div class="col-lg-3">600.000 تومان</div>
                                <div class="col-lg-3">
                                    <div
                                        class="input-group d-flex align-items-center justify-content-center cart-increment radius20">

                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn p-3" data-type="plus"
                                                data-field="">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </span>

                                        <input type="text" id="quantity" name="quantity"
                                            class="input-cart form-control input-number" value="1" min="1" max="100">

                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-left-minus btn p-3" data-type="minus"
                                                data-field="">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </span>


                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>

    <footer>
        <div class="container">
            <div class="row">

                <div class="col-md-4 gap-4">
                    <div class="footer-logo header-right">
                        <img src="img/logo.svg">
                        <div class="site-name">
                            <h2 class="mytext-large mytext-bold">ONLINE<br>PHARMACY</h2>
                        </div>
                    </div>
                    <p class="footer-about">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                        طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                        شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد</p>
                </div>
                <div class="col-md-4 gap-4">
                    <h5 class="footer-quick-access">لینک های دسترسی سریع</h5>
                    <ul class="list-unstyled">
                        <li><a class="quick-access-link" href="#">>> خانه </a></li>
                        <li><a class="quick-access-link" href="#">>> درباره ما</a></li>
                        <li><a class="quick-access-link" href="#">>> محصولات</a></li>
                        <li><a class="quick-access-link" href="#">>> تماس با ما </a></li>
                    </ul>
                </div>

                <div class="col-md-4 gap-4">
                    <h5>اطلاعات تماس</h5>
                    <p>تلفن: ۰۱۲۳۴۵۶۷۸۹</p>
                    <p>ایمیل: ddwqqr@example.com</p>
                    <p>آدرس: پرستار1</p>
                    <img src="img/enamad.png" alt="مجوز 1" width="50">
                    <img src="img/salamat.png" alt="مجوز 2" width="50">

                </div>


            </div>

        </div>
    </footer>
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