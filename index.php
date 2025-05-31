<?php
    session_start();
    session_regenerate_id();
    define('site',1);
    require_once "includes/connect.php";
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> pharmacy | home </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    if(isset($_GET['pg']) && $_GET['pg']=="login" && isset($_SESSION['username']) && $_SESSION['is_admin']=='1'){
        require_once "admin/index.php";
    }
    elseif (isset($_GET['pg']) && $_GET['pg']=="login" && isset($_SESSION['username']) && $_SESSION['is_admin']=='0'){
            require_once "profile/index.php";
    }
    else{
        require_once 'includes/header.php';

        if(isset($_GET['md'])){
            if(isset($_GET['pd'])){
                if(isset($_GET['p'])){
                    require_once("includes/single-product.php");
                }
                else{
                    require_once("includes/products.php");
                }
            }
            else if (isset($_GET['blog'])){
                require_once ("includes/blog_deatil.php");
            }
            else{
                $resultpage = $link->query("SELECT * FROM pages WHERE pg_menu_id = ".$_GET['md']."");
                if($resultpage -> num_rows != 0){
                    $row = $resultpage -> fetch_assoc();
                    switch($row['pg_type']){
                        case '1':
                            require_once("includes/topBanner.php");
                            break;
                        case '2':
                            require_once("includes/sidebarpage.php");
                            break;
                        case '3':
                            require_once("includes/blank.php");
                            break;
                        case '4':
                            require_once("includes/blankfefef.php");
                            break;
                        case '5':
                            require_once("includes/contact.php");
                            break;
                        case '6':
                            require_once("includes/about.php");
                            break;
                    }
                }
                else if($_GET['md']=='47'){
                    require_once("includes/blog.php");
                }
                else{
                    require_once("includes/work.php");
                }
            }

        }
        else if (isset($_GET['pg'])) {
            switch ($_GET['pg']) {
                case 'login':
                    if(!isset($_SESSION['username'])){
                        require_once("includes/login.php");
                    }
//                    else if ($_SESSION['is_admin'] == '1') {
//                        header("location: index.php");
//                    }
//                    else if ($_SESSION['is_admin'] == '0') {
//                        require_once("profile/index.php");
//                    }
                    break;
                case 'register':
                    require_once("includes/register.php");
                    break;
                case 'cart':
                    require_once("includes/cart.php");
                    break;
                case 'payment':
                    require_once("includes/payment.php");
                    break;
            }
        }
        else{


    ?>


    <!-- hero banner -->
    <div class="hero-banner container mt-4">
        <div class="d-flex justify-content-center align-items-center align-content-center">
            <?php
        if(isset($_SESSION['alert_login']) && $_SESSION['alert_login'] === true){
            echo '<div class="w-50 alert alert-success d-flex justify-content-center align-items-center px-5 py-3 text-center mytext-black animate-appearAndFade" role="alert">
                        <i style="color: #062e20 !important;" class="bi bi-check-circle me-3"></i>
                      <div style="color: #062e20 !important;">
                      کاربر  ' .$_SESSION['username'].' خوش آمدید.
                      </div>
                    </div>';
            $_SESSION['alert_login'] = false;
        }
        ?>
        </div>
        <?php
        $result_slider = $link->query("SELECT * FROM slider");

        $slides = [];
        if ($result_slider && $result_slider->num_rows > 0) {
            while ($slides_row = $result_slider->fetch_assoc()) {
                $slides[] = $slides_row;
            }
        }
        ?>
        <div class="row banners-row">
            <div id="carousel-top" class="carousel slide">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < count($slides); $i++): ?>
                        <button type="button" data-bs-target="#carousel-top" data-bs-slide-to="<?php echo $i; ?>"
                                class="<?php echo ($i === 0) ? 'active' : ''; ?>"
                                aria-current="<?php echo ($i === 0) ? 'true' : 'false'; ?>"
                                aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($slides as $index => $slide): ?>
                        <div class="carousel-item c-item <?php echo ($index === 0) ? 'active' : ''; ?>" >
                            <?php
                            if($slide['slide_drug'] != '0'){
                                $cat2 = $link->query("SELECT * FROM category WHERE cat_id = ".$slide['slide_category']);
                                $row_cat2 = $cat2->fetch_assoc();
                                $subm2 = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat2['cat_subm_id']);
                                $row_subm2 = $subm2->fetch_assoc();
                                $menu2 = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm2['subm_menu_id']);
                                $row_menu2 = $menu2->fetch_assoc();
                                $a = 'index.php?md=44&pd='.$row_subm2['subm_id'].' &p='.$slide['slide_drug'].'';
                            }
                            else{
                                $cat2 = $link->query("SELECT * FROM category WHERE cat_id = ".$slide['slide_category']);
                                $row_cat2 = $cat2->fetch_assoc();
                                $subm2 = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat2['cat_subm_id']);
                                $row_subm2 = $subm2->fetch_assoc();
                                $menu2 = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm2['subm_menu_id']);
                                $row_menu2 = $menu2->fetch_assoc();
                                $a = 'index.php?md=44&pd='.$row_subm2['subm_id'].' &cat='.$slide['slide_category'].'';
                            }

                            ?>
                            <a href="<?php echo $a;?>"><img src="<?php echo htmlspecialchars($slide['slide_image']); ?>" class="d-block w-100 c-img" alt="Slide <?php echo $index + 1; ?>"></a>
                        </div>
                    <?php endforeach; ?>
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
            <?php
            $result_banner = $link->query("SELECT * FROM banners where banner_position = '1'");
            while ($row_banner = $result_banner->fetch_assoc()) {
                $result_cat = $link->query("SELECT * FROM category where cat_id = '".$row_banner['banner_category']."'");
                if($result_cat->num_rows != 0){
                    $row_cat = $result_cat->fetch_assoc();
                    $result_subm = $link->query("SELECT * FROM sub_menu where subm_id = '".$row_cat['cat_subm_id']."'");
                    $row_subm = $result_subm->fetch_assoc();
                }
           ?>
            <div class="col">
                <div class="categori"><a href="index.php?md=44&pd=<?php echo $row_subm['subm_id']; ?>&p=<?php echo $row_banner['banner_drog']; ?>"><img class="cat-img" src="<?php echo $row_banner['banner_image'] ?>" alt="Category 1"></a></div>
            </div>
                <?php
             }
            ?>
        </div>
    </div>

    <!-- products slider -->
    <div class="product-carousel">
        <div class="container">
            <div class="section-title">
                <p>محصولات جدید</p>
            </div>
            <div id="productCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $result_drog = $link->query("SELECT * FROM drogs ORDER BY drg_id DESC LIMIT 8");
                    $products = [];
                    if ($result_drog) {
                        while ($row = $result_drog->fetch_assoc()) {
                            $products[] = $row;
                        }
                    }
                    $slides = array_chunk($products, 4);
                    ?>
                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($slides as $index => $slideProducts): ?>
                                <div class="carousel-item <?= ($index == 0) ? 'active' : '' ?>">

                                    <div class="row d-flex justify-content-between flex-nowrap">
                                        <?php foreach ($slideProducts as $product): ?>
                                            <?php
                                                $cat = $link->query("SELECT * FROM category WHERE cat_id = ".$product['drg_category_id']);
                                                $row_cat = $cat->fetch_assoc();
                                                $subm = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat['cat_subm_id']);
                                                $row_subm = $subm->fetch_assoc();
                                                $menu = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm['subm_menu_id']);
                                                $row_menu = $menu->fetch_assoc();
                                            ?>
                                            <div class="row product-card mx-0 w-25">
                                                <?php
                                                echo '<a href="index.php?md='.$row_menu['menu_id'].'&pd='.$row_subm['subm_id'].'&p='.$product['drg_id'].'">';
                                                ?>
                                                <div class="card carousel-card">
                                                    <img style="width: 250px; height: 250px; object-fit: cover" src="uploads/<?= $product['drg_image']; ?>" class="card-img-top" alt="<?= $product['drg_name']; ?>">
                                                    <div class="card-body">
                                                        <p class="card-title"><?= $product['drg_name']; ?></p>
                                                        <p class="card-price"><?= $product['drg_price']; ?> تومان</p>
                                                        <button class="btn button button2 btn-primary add-for-shop">
                                                            <i class="bi bi-bag-plus"></i>
                                                        </button>
                                                        <button class="btn button button2 btn-primary add-to-favorite">
                                                            <i class="bi bi-heart"></i>
                                                        </button>
                                                        <?php
                                                        echo ' <a href="index.php?md='.$row_menu['menu_id'].'&pd='.$row_subm['subm_id'].'&p='.$product['drg_id'].'" class="btn button button2 btn-primary view-product">
                                                            <i class="bi bi-eye"></i>
                                                        </a>';
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php
                                                echo '</a>';
                                                ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            <?php endforeach; ?>
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

    </div>
    <div class="container about">
        <div class="d-flex about-section">
            <div class="d-flex flex-column about-text-container">
                <div class="section-title">
                    <p> داروخانه آنلاین</p>
                </div>
                <p class="about-txt pt-5 truncate-multiline ">
                    <?php
                    $row_info = $link->query("SELECT * FROM info");
                    $row_info = $row_info->fetch_assoc();
                    echo $row_info['info_about'];
                    ?>
                </p>
                <a class="button btn" href="index.php?md=49" style="width: 30%; background-color: white !important; color: #0D0C3A !important;"> درباره ما  </a>
            </div>
            <div class="d-flex flex-column justify-content-center" style="align-items: center">
                <?php
                $result_license = $link->query("SELECT * FROM license");
                while ($row_license = $result_license->fetch_assoc()) {
                    echo '<img class="about-item m-2" title="'.$row_license['lic_name'].'" style="width: 80px; height: auto;" src="'.$row_license['lic_image'].'">';
                }
                ?>
                <a class="view-more-btn" href="index.php?md=49" style="color: white !important;">همه مجوز ها<i class="bi bi-arrow-left"></i></a>
            </div>
            <img class="about-img" src="img/phph.jpg">
        </div>
    </div>

    <!-- large categorie banners -->

    <div class="container">
        <div class="large-categories">
            <div class="row g-8">
                <?php
                $result2 = $link->query("SELECT * FROM banners where banner_position = '2'");
                $row2 = $result2->fetch_assoc();
                if($row2['banner_drog'] != '0'){
                    $cat2 = $link->query("SELECT * FROM category WHERE cat_id = ".$row2['banner_category']);
                    $row_cat2 = $cat2->fetch_assoc();
                    $subm2 = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat2['cat_subm_id']);
                    $row_subm2 = $subm2->fetch_assoc();
                    $menu2 = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm2['subm_menu_id']);
                    $row_menu2 = $menu2->fetch_assoc();
                    $a = 'index.php?md=44&pd='.$row_subm2['subm_id'].'&p='. $row2['banner_drog'].'';
                }
                else{
                    $cat2 = $link->query("SELECT * FROM category WHERE cat_id = ".$row2['banner_category']);
                    $row_cat2 = $cat2->fetch_assoc();
                    $subm2 = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat2['cat_subm_id']);
                    $row_subm2 = $subm2->fetch_assoc();
                    $menu2 = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm2['subm_menu_id']);
                    $row_menu2 = $menu2->fetch_assoc();
                    $a = 'index.php?md=44&pd='.$row_subm2['subm_id'].'&cat='. $row2['banner_category'].'';
                }

                $result3 = $link->query("SELECT * FROM banners where banner_position = '3'");
                $row3 = $result3->fetch_assoc();
                if($row3['banner_drog'] != '0'){
                    $cat3 = $link->query("SELECT * FROM category WHERE cat_id = ".$row3['banner_category']);
                    $row_cat3 = $cat3->fetch_assoc();
                    $subm3 = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat3['cat_subm_id']);
                    $row_subm3 = $subm3->fetch_assoc();
                    $menu3 = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm3['subm_menu_id']);
                    $row_menu3 = $menu3->fetch_assoc();
                    $b = 'index.php?md=44&pd='.$row_subm3['subm_id'].'&p='. $row3['banner_drog'].'';
                }
                else{
                    $cat3 = $link->query("SELECT * FROM category WHERE cat_id = ".$row2['banner_category']);
                    $row_cat3 = $cat3->fetch_assoc();
                    $subm3 = $link->query("SELECT * FROM sub_menu WHERE subm_id = ".$row_cat2['cat_subm_id']);
                    $row_subm3 = $subm3->fetch_assoc();
                    $menu3 = $link->query("SELECT * FROM menu WHERE menu_id = ".$row_subm2['subm_menu_id']);
                    $row_menu3 = $menu3->fetch_assoc();
                    $b = 'index.php?md=44&pd='.$row_subm2['subm_id'].'&cat='. $row3['banner_category'].'';
                }
                echo ' <div class="col-sm-6 col-md-8"><a href="'.$a.'"><img class="Lcat-img" src="'.$row2['banner_image'].'"></a></div>
                <div class="col-6 col-md-4"><a href="'.$b.'"><img class="Lcat-img" src="'.$row3['banner_image'].'"></a></div>';
                ?>
            </div>
        </div>
    </div>


    <div class="care-product-container">
        <div class="container text-center">
            <div class="section-title ">
                <p>محصولات پرفروش </p>
            </div>
            <div class="row row-cols-3">
                <?php
                $best_selling = $link->query("SELECT * FROM drogs ORDER BY drg_sales DESC LIMIT 6");
                while ($row_sale = $best_selling->fetch_assoc()) {

                ?>
                <div class="col">
                    <div class="card care-product mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <?php
                                echo '<img src="uploads/'.$row_sale['drg_image'].'" class="img-fluid" alt="...">';
                                ?>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body care-product-body">
                                    <div class="product-ratting">
                                        <ul>
                                            <?php
                                            $drg_rank = $row_sale['drg_rank'];
                                            for($i=1;$i<=$drg_rank;$i++) {
                                                echo '<li><i class="bi bi-star-fill d-flex" style="color: goldenrod !important;"></i></li>';
                                                if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                                    echo '<li><i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);"></i></li>';
                                                }
                                            }
                                            for($i=1;$i<=5-$drg_rank;$i++) {
                                                echo '<li><i class="bi bi-star d-flex" style="color: goldenrod !important;"></i></li>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <h6 class="product-title"><a href="#"><?php echo $row_sale['drg_name'];?> </a></h6>
                                    <div class="product-price">
                                        <?php
                                        $result_off = $link->query("SELECT * FROM off where off_category_id = '" . $row_sale['drg_category_id'] . "'");
                                        if ($result_off->num_rows > 0) {
                                            $row_off = $result_off->fetch_assoc();
                                            $vl = $row_off['off_value'];
                                        } else {
                                            $vl = 0;
                                        }
                                        $off = $row_sale['drg_price'] * $vl / 100;
                                        $price = $row_sale['drg_price'] - $off;
                                        echo '<span>' . number_format($price) . ' تومان</span>';
                                        echo '<del>' . number_format($row_sale['drg_price']) . 'تومان</del>';

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- blog carousel -->
    <div class="container blog-carousel">
        <div class="section-title" style="margin-top: 20px !important;">
            <p>مقالات اخیر</p>
        </div>
        <div id="blogCarousel" class="carousel slide">
            <div class="carousel-inner">
                <?php
                $result_blog = $link->query("SELECT * FROM blog where blg_status = '1' ORDER BY blg_id DESC LIMIT 6");
                $blogs = [];
                if ($result_blog) {
                    while ($row_blog = $result_blog->fetch_assoc()) {
                        $blogs[] = $row_blog;
                    }
                }
                $slides = array_chunk($blogs, 3);
                ?>

                <?php foreach ($slides as $index => $slideBlogs): ?>
                    <div class="carousel-item <?= ($index == 0) ? 'active' : '' ?>">
                        <div class="row">
                            <?php foreach ($slideBlogs as $blog): ?>
                                <?php
                                $detail = $link->query("SELECT * FROM blog_detail WHERE blgde_blog_id = ".$blog['blg_id']);
                                $row_detail = $detail->fetch_assoc();
                                ?>
                                <div class="col-md-4">
                                    <div class="card carousel-card blog-card">
                                        <img src="<?php echo $blog['blg_cover'] ?>" class="blog-card-img-top" alt="<?php echo $blog['blg_title'] ?>">

                                        <div class="card-body blog-card-body">
                                            <div class="blog-info">
                                                <ul>
                                                    <li class="blog-date">
                                                        <a href="#"><i class="bi bi-calendar"></i> <?php echo $blog['blg_date'] ?></a>
                                                    </li>
                                                    <li class="blog-tags">
                                                        <a href="#"><i class="bi bi-tags"></i> <?php echo $blog['blg_tag'] ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <p class="blog-card-title"><?php echo $blog['blg_title'] ?></p>
                                            <?php
                                            $para = [];
                                            $result_p = $link->query("SELECT * FROM blog_detail WHERE blgde_blog_id = '".$blog['blg_id']."' and blgde_paragraph != 'null' order by blgde_id limit 1");
                                            if ($result_p->num_rows > 0) {
                                                $row_p = $result_p->fetch_assoc();
                                                echo '<p class="blog-card-text">'.substr($row_p['blgde_paragraph'], 0, 150) .'...</p>';
                                            }


                                            ?>

                                            <div class="product-ratting d-flex flex-row justify-content-between">
                                                <div class="product-ratting d-flex flex-row justify-content-start">
                                                    <?php
                                                    $drg_rank = $blog['blg_rank'];
                                                    for($i=1;$i<=$drg_rank;$i++) {
                                                        echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important; font-size: 12px;"></i>';
                                                        if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                                            echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);font-size: 12px;"></i>';
                                                        }
                                                    }
                                                    for($i=1;$i<=5-$drg_rank;$i++) {
                                                        echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;font-size: 12px;"></i>';
                                                    }
                                                    ?>
                                                </div>

                                                <a class="view-more-btn blog-view-more-btn" href="blog-detail.php?id=<?php echo $blog['blg_id'] ?>">بیشتر <i class="bi bi-arrow-left"></i></a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
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
        }
    require_once "includes/footer.php";
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>