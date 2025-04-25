<?php
mb_internal_encoding("UTF-8");
$result_menu = $link -> query("SELECT * FROM menu");
$result_submenu = $link -> query("SELECT * FROM sub_menu");

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
                <a class="button btn btn-primary sign" href="index.php?pg=login"> <i class="<?php if(isset($_SESSION['username'])){echo "bi bi-person";}else{echo "bi bi-box-arrow-in-left";} ?>"></i> <span
                            style="margin-left: 2px;">|</span> <?php
                    if(isset($_SESSION['username'])){
                        echo $_SESSION['username'];
                    }
                    else{
                        echo "ورود / ثبت نام";
                    }
                    ?>  </a>

                <a class="button btn btn-outline-primary" href="index.php?pg=cart"> <i class="bi bi-bag"></i> <span
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
                        <?php
                        if ($result_menu->num_rows > 0) {
                            while ($row_menu = $result_menu->fetch_assoc()) {
                                $icon_result_tag = $link -> query("SELECT * FROM icons WHERE ic_id = '".$row_menu['menu_icon']."'");
                                if ($icon_result_tag->num_rows > 0) {
                                    $row_icon_tag = $icon_result_tag->fetch_assoc();
                                }
                                $result_submenu = $link->query("SELECT * FROM sub_menu WHERE subm_menu_id = '".$row_menu['menu_id']."'");
                                if ($result_submenu->num_rows > 0) {
                                        echo '<li class="dropdown position-static">  
                                                <a data-mdb-dropdown-init class="nav-item" href="" id="navbarDropdown"  
                                                   role="button" data-mdb-toggle="dropdown" aria-expanded="false">  
                                                    <i class="' . $row_icon_tag['ic_tag'] . '"></i>  
                                                    ' . $row_menu['menu_name'] . '  
                                                </a>  
                                                <div class="dropdown-menu w-25 mt-0" aria-labelledby="navbarDropdown" style="  
                                                          border-radius: 12px;  
                                                          border-top: 3px solid var(--color-main);">  
                                                    <div class="container">  
                                                        <div class="col p-3 rounded-top">';
                                                            while ($row_submenu = $result_submenu->fetch_assoc()) {
                                                                echo '<div class="row mb-3 mb-lg-0" >  
                                                                <div class="row d-flex justify-content-between list-group list-group-flush mt-1 rounded">  
                                                                    <a href="index.php?md='.$row_menu['menu_id'].'&pd='. $row_submenu['subm_id'] .'" class="list-group-item dropdown list-group-item-action">  
                                                                        '; echo $row_submenu['subm_name'];
                                                                        echo '<i class="bi bi-arrow-left-short" style="float: left;"></i>';
                                                                    echo '</a>';
                                                                echo '</div>';
                                                                echo '</div>';
                                                            }

                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                                else{
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