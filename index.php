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
    <?php
        require_once 'include/header.php';
    ?>


    <!-- hero banner -->
    <div class="hero-banner container mt-4">
        <div class="row banners-row">
            <div id="carousel-top" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carousel-top" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carousel-top" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carousel-top" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item c-item">
                        <img src="img/hero-banner1.jpg" class="d-block w-100 c-img" alt="...">
                    </div>
                    <div class="carousel-item c-item">
                        <img src="img/hero-banner2.jpg" class="d-block w-100 c-img" alt="...">
                    </div>
                    <div class="carousel-item c-item active">
                        <img src="img/HERO-BANNER3.jpg" class="d-block w-100 c-img" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-top" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-top" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>
    </div>

    <!-- categories -->
    <div class="categories container text-center">
        <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
            <div class="col">
                <div class="categori"><img class="cat-img" src="img/cat1.jpg" alt="Category 1"></div>
            </div>
            <div class="col">
                <div class="categori"><img class="cat-img" src="img/cat2.jpg" alt="Category 2"></div>
            </div>
            <div class="col">
                <div class="categori"><img class="cat-img" src="img/cat3.jpg" alt="Category 3"></div>
            </div>
            <div class="col">
                <div class="categori"><img class="cat-img" src="img/cat4.jpg" alt="Category 4"></div>
            </div>
            <div class="col">
                <div class="categori"><img class="cat-img" src="img/cat1.jpg" alt="Category 1"></div>
            </div>
            <div class="col">
                <div class="categori"><img class="cat-img" src="img/cat3.jpg" alt="Category 3"></div>
            </div>
        </div>
    </div>

    <!-- products slider -->
    <div class="container product-carousel">
        <div class="section-title">
            <span class="line"></span>
            <p>محصولات پربازدید</p>
            <span class="line"></span>

        </div>
        <div id="productCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card carousel-card">
                                <img src="img/p1.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card  carousel-card">
                                <img src="img/p3.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card carousel-card">
                                <img src="img/p2.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card carousel-card">
                                <img src="img/p4.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card carousel-card">
                                <img src="img/p5.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card  carousel-card">
                                <img src="img/p3.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card carousel-card">
                                <img src="img/p2.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 col-md-3 product-card">
                            <div class="card carousel-card">
                                <img src="img/p4.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title">محصول ۱</p>
                                    <p class="card-price">16,000 تومان</p>
                                    <button class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <button class="btn button button2 btn-primary view-product"><i
                                            class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-bottom">
                <div class="controls">
                    <button class="carousel-control-prev product-carousel-control-prev" type="button"
                        data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon product-carousel-control-prev-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>

                    </button>
                    <button class="carousel-control-next product-carousel-control-next" type="button"
                        data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon product-carousel-control-next-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <a class="view-more-btn" href="#">همه محصولات<i class="bi bi-arrow-left"></i></a>
            </div>


        </div>
    </div>



    <!-- large categorie banners -->

    <div class="container">
        <div class="large-categories">
            <div class="row g-8">
                <div class="col-sm-6 col-md-8"><img class="Lcat-img" src="img/large-cat1.png"></div>
                <div class="col-6 col-md-4"><img class="Lcat-img" src="img/large-cat2.png"></div>
            </div>
        </div>
    </div>




    <!-- tab categore -->

    <!-- <div class="container mt-5">  
        <h2 class="text-center">دسته‌بندی محصولات</h2>  
        
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">  
            <li class="nav-item">  
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">دسته ۱</a>  
            </li>  
            <li class="nav-item">  
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">دسته ۲</a>  
            </li>  
            <li class="nav-item">  
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">دسته ۳</a>  
            </li>  
        </ul>  
    
        <div class="tab-content mt-4">  
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">  
                <div class="row">  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۱">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۱</h5>  
                                <p class="card-text">توضیحات محصول ۱</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۲">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۲</h5>  
                                <p class="card-text">توضیحات محصول ۲</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat1.jpg" class="card-img-top" alt="محصول ۳">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۳</h5>  
                                <p class="card-text">توضیحات محصول ۳</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat1.jpg" class="card-img-top" alt="محصول ۴">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۴</h5>  
                                <p class="card-text">توضیحات محصول ۴</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat1.jpg" class="card-img-top" alt="محصول ۵">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۵</h5>  
                                <p class="card-text">توضیحات محصول ۵</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat1.jpg" class="card-img-top" alt="محصول ۶">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۶</h5>  
                                <p class="card-text">توضیحات محصول ۶</p>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">  
                <div class="row">  
                  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۱">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۱</h5>  
                                <p class="card-text">توضیحات محصول ۷</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۲">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۲</h5>  
                                <p class="card-text">توضیحات محصول ۸</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۳">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۳</h5>  
                                <p class="card-text">توضیحات محصول ۹</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۴">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۴</h5>  
                                <p class="card-text">توضیحات محصول ۱۰</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۵">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۵</h5>  
                                <p class="card-text">توضیحات محصول ۱۱</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat2.jpg" class="card-img-top" alt="محصول ۶">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۶</h5>  
                                <p class="card-text">توضیحات محصول ۱۲</p>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">  
                <div class="row">  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat3.jpg" class="card-img-top" alt="محصول ۱">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۱</h5>  
                                <p class="card-text">توضیحات محصول ۱۳</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat3.jpg" class="card-img-top" alt="محصول ۲">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۲</h5>  
                                <p class="card-text">توضیحات محصول ۱۴</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat3.jpg" class="card-img-top" alt="محصول ۳">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۳</h5>  
                                <p class="card-text">توضیحات محصول ۱۵</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat3.jpg" class="card-img-top" alt="محصول ۴">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۴</h5>  
                                <p class="card-text">توضیحات محصول ۱۶</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat3.jpg" class="card-img-top" alt="محصول ۵">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۵</h5>  
                                <p class="card-text">توضیحات محصول ۱۷</p>  
                            </div>  
                        </div>  
                    </div>  
                    <div class="col-md-4">  
                        <div class="card mb-4">  
                            <img src="img/cat3.jpg" class="card-img-top" alt="محصول ۶">  
                            <div class="card-body">  
                                <h5 class="card-title">محصول ۶</h5>  
                                <p class="card-text">توضیحات محصول ۱۸</p>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>   -->
    <div class="care-product-container">
        <div class="container text-center">
            <div class="section-title ">
                <span class="line"></span>
                <p>محصولات پیشگیری و مراقبت</p>
                <span class="line"></span>
    
            </div>
            <div class="row row-cols-3">
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/p6.png" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#">ماسک </a></h6>
                                    <div class="product-price">
                                        <span>10,000تومان</span>
                                        <del>15,000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/p6.png" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#">محلول ضدعفونی دست </a></h6>
                                    <div class="product-price">
                                        <span>10,000تومان</span>
                                        <del>15,000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/p6.png" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#">ماسک </a></h6>
                                    <div class="product-price">
                                        <span>10,000تومان</span>
                                        <del>15,000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/cat1.jpg" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#">محصول ضدعفونی دست </a></h6>
                                    <div class="product-price">
                                        <span>10,000تومان</span>
                                        <del>15,000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/cat1.jpg" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#">دستکش </a></h6>
                                    <div class="product-price">
                                        <span>10,000تومان</span>
                                        <del>15,000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="img/cat1.jpg" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body ">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#">دستکش </a></h6>
                                    <div class="product-price">
                                        <span>10,000تومان</span>
                                        <del>15,000تومان</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- blog carousel -->
    <div class="container blog-carousel">
        <div class="section-title">
            <span class="line"></span>
            <p>مقالات اخیر  </p>
            <span class="line"></span>

        </div>
        <div id="blogCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">

                        <div class="col-md-4 col-6 col-md-3 ">
                            <div class="card  carousel-card blog-card">
                                <img src="img/blog-img1.jpg" class="blog-card-img-top" alt="محصول 1">

                                <div class="card-body blog-card-body">
                                    <div class="blog-info">
                                        <ul>
                                            <li class="blog-date">
                                                <a href="#"><i class="bi bi-calendar"></i> 23اسفند، 1403</a>
                                            </li>
                                            <li class="blog-tags">
                                                <a href="#"><i class="bi bi-tags"></i> گیاهان دارویی </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="blog-card-title"> نام مقاله</p>
                                    <p class="blog-card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه  گرافیک است چاپگرها و متون بلکه روزروزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                            <a class="view-more-btn blog-view-more-btn" href="#">بیشتر <i class="bi bi-arrow-left"></i></a>
                                        </ul>
                                        
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 col-md-3 ">
                            <div class="card  carousel-card blog-card">
                                <img src="img/blog-img1.jpg" class="blog-card-img-top" alt="محصول 1">

                                <div class="card-body blog-card-body">
                                    <div class="blog-info">
                                        <ul>
                                            <li class="blog-date">
                                                <a href="#"><i class="bi bi-calendar"></i> 23اسفند، 1403</a>
                                            </li>
                                            <li class="blog-tags">
                                                <a href="#"><i class="bi bi-tags"></i> گیاهان دارویی </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="blog-card-title"> نام مقاله</p>
                                    <p class="blog-card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه  گرافیک است چاپگرها و متون بلکه روزروزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                            <a class="view-more-btn blog-view-more-btn" href="#">بیشتر <i class="bi bi-arrow-left"></i></a>
                                        </ul>
                                        
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 col-md-3 ">
                            <div class="card  carousel-card blog-card">
                                <img src="img/blog-img1.jpg" class="blog-card-img-top" alt="محصول 1">

                                <div class="card-body blog-card-body">
                                    <div class="blog-info">
                                        <ul>
                                            <li class="blog-date">
                                                <a href="#"><i class="bi bi-calendar"></i> 23اسفند، 1403</a>
                                            </li>
                                            <li class="blog-tags">
                                                <a href="#"><i class="bi bi-tags"></i> گیاهان دارویی </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="blog-card-title"> نام مقاله</p>
                                    <p class="blog-card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه  گرافیک است چاپگرها و متون بلکه روزروزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                            <a class="view-more-btn blog-view-more-btn" href="#">بیشتر <i class="bi bi-arrow-left"></i></a>
                                        </ul>
                                        
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4 col-6 col-md-3 ">
                            <div class="card  carousel-card blog-card">
                                <img src="img/blog-img1.jpg" class="blog-card-img-top" alt="محصول 1">

                                <div class="card-body blog-card-body">
                                    <div class="blog-info">
                                        <ul>
                                            <li class="blog-date">
                                                <a href="#"><i class="bi bi-calendar"></i> 23اسفند، 1403</a>
                                            </li>
                                            <li class="blog-tags">
                                                <a href="#"><i class="bi bi-tags"></i> گیاهان دارویی </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="blog-card-title"> نام مقاله</p>
                                    <p class="blog-card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه  گرافیک است چاپگرها و متون بلکه روزروزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                            <a class="view-more-btn blog-view-more-btn" href="#">بیشتر <i class="bi bi-arrow-left"></i></a>
                                        </ul>
                                        
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 col-md-3 ">
                            <div class="card  carousel-card blog-card">
                                <img src="img/blog-img1.jpg" class="blog-card-img-top" alt="محصول 1">

                                <div class="card-body blog-card-body">
                                    <div class="blog-info">
                                        <ul>
                                            <li class="blog-date">
                                                <a href="#"><i class="bi bi-calendar"></i> 23اسفند، 1403</a>
                                            </li>
                                            <li class="blog-tags">
                                                <a href="#"><i class="bi bi-tags"></i> گیاهان دارویی </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="blog-card-title"> نام مقاله</p>
                                    <p class="blog-card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه  گرافیک است چاپگرها و متون بلکه روزروزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                            <a class="view-more-btn blog-view-more-btn" href="#">بیشتر <i class="bi bi-arrow-left"></i></a>
                                        </ul>
                                        
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6 col-md-3 ">
                            <div class="card  carousel-card blog-card">
                                <img src="img/blog-img1.jpg" class="blog-card-img-top" alt="محصول 1">

                                <div class="card-body blog-card-body">
                                    <div class="blog-info">
                                        <ul>
                                            <li class="blog-date">
                                                <a href="#"><i class="bi bi-calendar"></i> 23اسفند، 1403</a>
                                            </li>
                                            <li class="blog-tags">
                                                <a href="#"><i class="bi bi-tags"></i> گیاهان دارویی </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <p class="blog-card-title"> نام مقاله</p>
                                    <p class="blog-card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه  گرافیک است چاپگرها و متون بلکه روزروزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star-half"></i></a></li>
                                            <li><a href="#"><i class="bi bi-star"></i></a></li>
                                            <a class="view-more-btn blog-view-more-btn" href="#">بیشتر <i class="bi bi-arrow-left"></i></a>
                                        </ul>
                                        
                                    </div>
                                   
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="section-bottom">
                <div class="controls">
                    <button class="carousel-control-prev product-carousel-control-prev" type="button"
                        data-bs-target="#blogCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon product-carousel-control-prev-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>

                    </button>
                    <button class="carousel-control-next product-carousel-control-next" type="button"
                        data-bs-target="#blogCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon product-carousel-control-next-icon"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <a class="view-more-btn" href="#">همه مقالات<i class="bi bi-arrow-left"></i></a>
            </div>


        </div>
    </div>

    <?php
    require_once "include/footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>