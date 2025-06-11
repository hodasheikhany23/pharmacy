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
        require_once "includes/header/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> cosmetics | home </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>

<body>
    <div class="body-container container" id="body-container">
        <div class="row">
            <div class="col-md-3 sidebar">
                <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
                    <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                        <h4 class="ltn__widget-title ltn__widget-title-border-2">دسته بندی ها</h4>
                        <ul>
                            <li><a href="index.php?pg=login&page=profile"><i class="bi bi-person"></i> پروفایل </a></li>
                            <li><a href="index.php?pg=login&page=orders"><i class="bi bi-box2"></i> سفارشات </a></li>
                            <li><a href="index.php?pg=login&page=favorites"><i class="bi bi-heart"></i> علاقه مندی ها </a></li>
                            <li><a href="index.php?pg=login&page=changePass"><i class="bi bi-shield-lock"></i> تغییر رمز عبور  </a></li>
                            <li><a class="btn-danger" style="color: #78261f !important;" href="index.php?logout"><i class="bi bi-box-arrow-right"></i> خروج </a> </li>
                        </ul>
                    </div>
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">محصولات دارای امتیاز برتر</h4>
                        <ul>
                            <?php
                            $select_drogs= $link->query("SELECT * FROM drogs order by drg_rank desc limit 3");
                            while ($row_drogs = $select_drogs->fetch_assoc()) {
                                ?>
                                <li>
                                    <div class="top-rated-product-item clearfix">
                                        <div class="top-rated-product-img">
                                            <?php
                                            echo '<a href="index.php?md=44&pd=33&p='.$row_drogs['drg_id'].'">
                                                    <img style="width: 70px !important; height: 70px !important;" src="uploads/'.$row_drogs['drg_image'].'" alt="#">
                                                    </a>';
                                            ?>
                                        </div>
                                        <div class="top-rated-product-info">
                                            <div class="product-ratting">
                                                <ul>
                                                    <?php
                                                    $drg_rank = $row_drogs['drg_rank'];
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
                                                </ul>
                                            </div>
                                            <h6><a href="index.php?md=44&pd=33&p=<?php echo $row_drogs['drg_id'];?>"><?php echo $row_drogs['drg_name'];?></a></h6>
                                            <div class="product-price">
                                                <?php
                                                $result_off = $link ->query("SELECT * FROM off where off_category_id = '".$row_drogs['drg_category_id']."'");
                                                if($result_off -> num_rows > 0){
                                                    $row_off = $result_off -> fetch_assoc();
                                                    $vl = $row_off['off_value'];
                                                }
                                                else{
                                                    $vl = 0;
                                                }
                                                $off = $row_drogs['drg_price'] * $vl / 100;
                                                $price = $row_drogs['drg_price']-$off;
                                                echo '<del>'.number_format($row_drogs['drg_price']).'</del>';
                                                echo '<span>'.number_format($price).'</span>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </aside>
            </div>
            <?php
            if(isset($_GET['page'])){
                switch($_GET['page']){
                    case 'orders':
                        require_once "profile/includes/orders.php";
                        break;
                    case 'favorites':
                        require_once "profile/includes/favorites.php";
                        break;
                    case 'profile':
                        require_once "profile/includes/profile.php";
                        break;
                    case 'changePass':
                        require_once "profile/includes/changePassword.php";
                        break;
                }
            }
            else{
                require_once "profile/includes/profile.php";
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php
    }
    else{
        require_once "includes/login.php";
    }
    ?>




