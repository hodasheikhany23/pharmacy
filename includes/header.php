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
        <div class="container text-center d-flex justify-content-between">
            <div class="header-logo header-right">
                <?php
                $result_logo = $link -> query("SELECT * FROM info");
                if ($result_logo->num_rows > 0) {
                    $row_info = $result_logo->fetch_assoc();
                }
                ?>
                <a href="index.php"> <img src="<?php echo $row_info['info_logo'];?>"></a>

                <div class="site-name" style="width: 20px">
                    <h2 class="mytext-large mytext-bold"><?php echo $row_info['info_name'];?></h2>
                </div>
            </div>
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
                                                    <i class="' . $row_icon_tag['ic_tag'] . '"></i>  ' . $row_menu['menu_name'] . '  </a>  
                                                <div class="dropdown-menu w-50 mt-0" aria-labelledby="navbarDropdown" style="  
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
                        </div>
                    </div>
                </div>
            </nav>

            <div class="d-grid gap-2 d-none d-md-flex" style="align-items: center;">
                <?php
                if(isset($_SESSION['username'])){
                    echo ' <div class="dropdown">
                    <a class="btn button dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       <i class="bi bi-person"></i> | 
                        '.$_SESSION['username'].'
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?pg=login">
                        <i class="bi bi-gear"></i>
                        پنل کاربری</a></li>
                        <li><a class="dropdown-item" href="#"> 
                        <i class="bi bi-headset"></i>
                        پشتیبانی</a></li>
                        <li><a class="dropdown-item text-danger" href="index.php?logout">
                        <i class="bi bi-box-arrow-right"></i>
                         خروج</a></li>
                    </ul>
                </div>';
                }
                else{
                    echo ' <a class="button btn btn-primary sign" href="index.php?pg=login"> <i class="bi bi-box-arrow-in-left"></i> <span
                            style="margin-left: 2px;">|</span> 
                      ورود / ثبت نام
                   </a>';
                }
                ?>

                <?php
                if(isset($_SESSION['username'])){
                    echo ' <a class="button btn btn-outline-primary" href="index.php?pg=cart"> <i class="bi bi-bag"></i> <span
                            style="margin-left: 2px;">|</span> سبد خرید </a>';
                }
                ?>

            </div>
        </div>
    </header>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/script.js"></script>

</body>

</html>