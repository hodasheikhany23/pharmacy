<?php
    session_start();
    session_regenerate_id();
    define('site',1);
    require_once "includes/connect.php";
    if(isset($_GET['logout'])){
        session_destroy();
        header("location: index.php");
    }
    if(!isset($_SESSION['username'])){
        require_once "includes/login.php";
    }
    if(isset($_SESSION['username'])){
        require_once "includes/header.php";
    }
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
        <?php
        if(isset($_GET['page'])){
            switch ($_GET['page']){
                case 'users':
                    require_once "includes/users.php";
                    break;
                case 'adduser':
                    require_once "includes/adduser.php";
                default:
                    require_once "includes/header.php";
                    break;

            }
        }
        else{
            require_once "includes/dashboard.php";
        }
        ?>
    </div>
</body>
</html>





