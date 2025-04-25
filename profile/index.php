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
    <div class="body-container container" id="body-container">
        <div class="col-md-3 sidebar">
            <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
                <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                    <h4 class="ltn__widget-title ltn__widget-title-border-2">دسته بندی ها</h4>
                    <ul>
                        <li><a href="index.php?pg=login&page=prof"><i class="bi bi-person"></i> پروفایل </a></li>
                        <li><a href="index.php?pg=login&page=orders"><i class="bi bi-box2"></i> سفارشات </a></li>
                        <li><a href="index.php?pg=login&page=favorites"><i class="bi bi-heart"></i> علاقه مندی ها </a></li>
                        <li><a class="btn-danger" style="color: #78261f !important;" href="index.php?logout"><i class="bi bi-box-arrow-right"></i> خروج </a> </li>
                    </ul>
                </div>
                <!-- Top Rated Product Widget -->
                <div class="widget ltn__top-rated-product-widget">
                    <h4 class="ltn__widget-title ltn__widget-title-border">محصولات دارای امتیاز برتر</h4>
                    <ul>
                        <li>
                            <div class="top-rated-product-item clearfix">
                                <div class="top-rated-product-img">
                                    <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                </div>
                                <div class="top-rated-product-info">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="product-details.html">ماسک سه لایه</a></h6>
                                    <div class="product-price">
                                        <span>89،000تومان</span>
                                        <del>100،000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="top-rated-product-item clearfix">
                                <div class="top-rated-product-img">
                                    <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                </div>
                                <div class="top-rated-product-info">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="product-details.html">میکروسکوپ</a></h6>
                                    <div class="product-price">
                                        <span>1،210،000تومان</span>
                                        <del>1،236،000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="top-rated-product-item clearfix">
                                <div class="top-rated-product-img">
                                    <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                                </div>
                                <div class="top-rated-product-info">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6><a href="product-details.html">ژل ضد عفونی کننده</a></h6>
                                    <div class="product-price">
                                        <span>56،000تومان</span>
                                        <del>70،000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>
        </div>
        <?php
        if(isset($_GET['page'])){
            switch($_GET['page']){
                case 'orders':
                    require_once "profile/includes/products.php";
            }
        }
        ?>
    </div>
</body>
</html>
<?php
    }
    else{
        require_once "includes/login.php";
    }
    ?>




