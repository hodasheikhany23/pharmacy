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

<section class="page-body">
    <div class="container">
        <div class="section-title no-margin">
            <p>  داروخانه</p>     
        </div>
        <div class="container-fluid">  
            <div class="row mt-4">  
                <div class="col-md-3 sidebar">  
                    <h4 class="filter-title">فیلتر بر اساس قیمت</h4>  
                    <input type="range" class="form-control-range mb-3" id="priceRange" min="1500" max="400000" oninput="this.nextElementSibling.value = this.value;">  
                    <output>  <span class="highlight">1500</span> تومان تا <span class="highlight">400000</span> تومان</output>  
                    <h4 class="filter-title">فیلتر مارک محصول</h4>  
                    <div class="row">  
                        <div class="col-4">
                            <a class="btn btn-secondary mt-1" href="products.php?page=1"> برند 1</a>
                            <a class="btn btn-secondary mt-1" href="products.php?page=2"> برند 2</a>
                            <a class="btn btn-secondary mt-1" href="products.php?page=3"> برند 3</a>
                            <a class="btn btn-secondary mt-1" href="products.php?page=4"> برند 4</a>
                        </div>  
                        <div class="col-4">
                            <a class="btn btn-secondary mt-1" href="#"> برند 5</a>
                            <a class="btn btn-secondary mt-1" href="#"> برند 6</a>
                            <a class="btn btn-secondary mt-1" href="#"> برند 7</a>
                            <a class="btn btn-secondary mt-1" href="#"> برند 8</a>
                        </div>  
                    </div>  

    
                    <h4 class="filter-title">محصولات دارای امتیاز برتر</h4>  
                    <div class="product-card">  
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
                    <div class="product-card">  
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
                    <div class="product-card">  
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
    
                
                <div class="col-md-9">  
                    <div class="breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="breadcrumb-inner">
                                        <div class="breadcrumb-list">
                                            <ul>
                                                <li>  محصولات  </li>
                                                <?php

                                                if(isset($_GET['page'])){
                                                    $page = $_GET['page'];
                                                    switch ($page) {
                                                        case '1':
                                                            echo "<li>  محصولات تقویت مو </li>";
                                                            break;
                                                        case '2':
                                                            echo "<li>  محصولات تقویت پوست </li>";
                                                            break;
                                                    }
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        switch ($page) {
                            case '1':
                                    ?>
                    <div class="row" style="padding: 2em; display: flex; justify-content: center;">           
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                    <?php
                                break;
                            case '2':


                    ?>
                    <div class="row" style="padding: 2em; display: flex; justify-content: center;">
                        <div class="col-md-3 gap-2 col-6 col-md-3 product-card shop-card">
                            <div class="card carousel-card">
                                <img src="img/p7.png" class="card-img-top" alt="محصول 1">
                                <div class="card-body">
                                    <p class="card-title"> شامپو فوم پالمنیکس پلاس</p>
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
                    <?php
                               
                                break;
                        }
                    }
                    ?>

                    <nav aria-label="Page navigation example" class="pangination">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="#">قبلی</a></li>
                          <li class="page-item"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">بعدی</a></li>
                        </ul>
                    </nav>   
                </div>
                
            </div> 
            
        </div>  
    
    </div>
   
   </section>
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