<?php
mb_internal_encoding("UTF-8");
$result_menu = $link -> query("SELECT * FROM menu");
$result_submenu = $link -> query("SELECT * FROM sub_menu");
require_once 'time/jdf.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> هدر </title>
</head>

<body>

    <header class="header">
        <div class="header-container">
            <div class="row v-center">
                <div class="header-item item-right">
                    <div class="logo">
                        <?php
                        $result_logo = $link -> query("SELECT * FROM info");
                        if ($result_logo->num_rows > 0) {
                            $row_info = $result_logo->fetch_assoc();
                        }
                        ?>
                        <a href="index.php"> <img src="<?php echo $row_info['info_logo'];?>"></a>
                    </div>
                </div>
                <div class="header-item item-center">
                    <div class="overlay"></div>
                    <nav class="menu">

                        <div class="mobile-menu-head">
                            <div class="mobile-menu-close"><i class="fas fa-times"></i></div>
                            <div class="current-menu-title"></div>
                            <div class="go-back"><i class="fas fa-angle-left"></i></div>
                        </div>

                        <ul class="main-menu">
                            <li>
                                <a href="index.php">خانه</a>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#" class="list-title"><i class="bi bi-list mx-1"></i>فروشگاه <i class="bi bi-chevron-down" style="font-size: 10px!important;"></i></a>
                                <div class="sub-menu mega-menu mega-menu-column-4">
                                        <?php
                                        $row_menu = $result_menu->fetch_assoc();
                                        $result_submenu = $link -> query("SELECT * FROM sub_menu");
                                        while ($row_submenu = $result_submenu->fetch_assoc()) {
                                            echo '<div class="list-item">';
                                            echo '<a href="index.php?md=44&pd='. $row_submenu['subm_id'] .'"> <h4 class="title"> '.$row_submenu['subm_name'].'</h4></a>';
                                            $result_category= $link->query("SELECT * FROM category WHERE cat_subm_id = '".$row_submenu['subm_id']."'");
                                            $cat = [];
                                            while ($row_category = $result_category->fetch_assoc()) {
                                                $_result_drogs= $link->query("SELECT  COUNT(*) AS total FROM drogs where drg_category_id='".$row_category['cat_id']."'");
                                                $cat[$row_category['cat_id']] = $row_category['cat_id'];
                                                echo '<ul>';
                                                echo '<li><a href="index.php?md=44&pd='.$row_submenu['subm_id'].'&cat='.$row_category['cat_id'].'">'.$row_category['cat_name'].'</a></li>';
                                                echo '</ul>';
                                            }
                                            echo '</div>';
                                        }
                                        ?>
                                    <div class="list-item">
                                        <img src="img/20250419181427.png" alt="">
                                    </div>

                                </div>
                            </li>
                            <?php
                            if ($result_menu->num_rows > 0) {
                                while ($row_menu = $result_menu->fetch_assoc()) {
                                    $icon_result_tag = $link -> query("SELECT * FROM icons WHERE ic_id = '".$row_menu['menu_icon']."'");
                                    if ($icon_result_tag->num_rows > 0) {
                                        $row_icon_tag = $icon_result_tag->fetch_assoc();
                                    }
                                    $result_submenu = $link->query("SELECT * FROM sub_menu WHERE subm_menu_id = '".$row_menu['menu_id']."'");
                                        if($row_menu['menu_id']!=44){
                                            echo '<li class="nav-item">  
                                        <a href="index.php?md='. $row_menu['menu_id'] .'">  
                                            <i class="' . $row_icon_tag['ic_tag'] . '"></i>' . $row_menu['menu_name'] . '  
                                        </a>  
                                      </li>';
                                        }


                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
                <div class="header-item item-left">
                    <div class="mobile-nav-trigger">
                        <span></span>
                    </div>
                    <a href="#" class="search-icon"><i class="bi bi-search"></i></a>
                    <a href="#" class="user-icon"><i class="bi bi-person"></i></a>
                    <a href="#"><i class="bi bi-bag"></i></a>


                </div>
            </div>
        </div>
    </header>
    <div class="search-overlay"></div>
    <div class="search-box">
        <div class="search-form">
            <input type="text" placeholder="جست و جو کنید" class="search-text-box">
            <button class="submit-search"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="header-sidebar">
        <a href="#" class="header-side-exit"><i class="bi bi-x-lg"></i></a>
        <div class="profile-img">   
            <img src="includes/header/img/user-icon.png">
        </div>
        <ul>
            <?php
            if(!isset($_SESSION['username'])){
                echo '
            <li>
                <a href="index.php?pg=login">ورود/ثبت نام</a>
            </li>';
            }
            else{
                echo ' <li>
                <a href="index.php?pg=login">پروفایل ('.$_SESSION['username'].')</a>
            </li>
            <li>
                <a href="index.php?pg=login&page=favorites">علاقه مندی ها</a>
            </li>
            <li>
                <a href="/index.php?pg=support">پشتیبانی</a>
            </li>
            <li>
                <a href="index.php?logout">خروج</a>
            </li>';
            }
           ?>

        </ul>

    </div>
    <script src="js/all.min.js"></script>
    <script src="js/header.js"></script>
</body>

</html>