<?php
    defined('site') or die("access Denied");
    require_once "includes/connect.php";
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: index.php");
    }
    if(!isset($_SESSION['username'])){
        require_once "includes/login.php";
    }
    if(isset($_SESSION['username'])){
        require_once "admin/includes/header.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> pharmacy | home </title>
    <link rel="stylesheet" href="admin/style/style.css">
    <link rel="stylesheet" href="admin/style/admin.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="body-container container" id="body-container">
        <?php
        if(isset($_GET['page'])){
            switch ($_GET['page']){
                case 'info':
                    require_once "admin/includes/info/show.php";
                    break;
                case 'banners':
                    require_once "admin/includes/banner/banner.php";
                    break;
                case 'editbanner':
                    require_once "admin/includes/banner/update.php";
                    break;
                case 'slider':
                    require_once "admin/includes/slider/slider.php";
                    break;
                case 'editslider':
                    require_once "admin/includes/slider/update.php";
                    break;
                case 'addslider':
                    require_once "admin/includes/slider/add.php";
                    break;
                case 'users':
                    require_once "admin/includes/users.php";
                    break;
                case 'adduser':
                    require_once "admin/includes/adduser.php";
                    break;
                case 'menus':
                    require_once "admin/includes/menus.php";
                    break;
                case 'addsub_menu':
                    require_once "admin/includes/addsub_menu.php";
                    break;
                case 'listsub_menu':
                    require_once "admin/includes/listsub_menu.php";
                    break;
                case 'categories':
                    require_once "admin/includes/category/category.php";
                    break;
                case 'products':
                    require_once "admin/includes/products/products.php";
                    break;
                case 'addproducts':
                    require_once "admin/includes/products/add.php";
                    break;
                case 'updateproducts':
                    require_once "admin/includes/products/update.php";
                    break;
                case 'pages':
                    require "admin/includes/pages/pages.php";
                    break;
                case 'editpages':
                    require_once "admin/includes/pages/update.php";
                    break;
                case 'pagecontent':
                    require_once "admin/includes/pages/content.php";
                    break;
                case 'addpage':
                    require_once "admin/includes/pages/addpage.php";
                    break;
                case 'profile':
                    require_once "admin/includes/profile/profile.php";
                    break;
                case 'dashboard':
                    require_once "admin/includes/dashboard.php";
                    break;
                case 'createoff':
                    require_once "admin/includes/off/off.php";
                    break;
                case 'editoff':
                    require_once "admin/includes/off/update.php";
                    break;
                case 'addoff':
                    require_once "admin/includes/off/add.php";
                    break;
                case 'addoffpro':
                    require_once "admin/includes/off/addpo.php";
                    break;
                case 'blogs':
                    require_once "admin/includes/blog/list.php";
                    break;
                case 'addblog':
                    require_once "admin/includes/blog/add.php";
                    break;
                case 'editblogs':
                    require_once "admin/includes/blog/update.php";
                    break;
                case 'blogcontent':
                    require_once "admin/includes/blog/content.php";
                    break;
                default:
                    require_once "admin/includes/header.php";
                    break;

            }
        }
        else{
            require_once "admin/includes/dashboard.php";
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




