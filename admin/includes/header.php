<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Hoda">

    <title>admin_Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../fonts/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="style/admin.css" rel="stylesheet">
    <link href="style/admin.min.css" rel="stylesheet">
    <link href="../fonts/fonts.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/c0d1944c94.js" crossorigin="anonymous"></script>
</head>

<body id="page-top" dir="rtl" class="sidebar-active">
<!--navbar-->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" id="menu-toggle" role="button" aria-controls="offcanvasRight">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index.html" class="nav-link">وبسایت</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">پشتیبان فنی</a>
            </li>
        </ul>
        <div class="search-wrapper">
            <div class="search-box">
                <input type="text" class="search-input form-control" placeholder="جست و جو...">
                <i class="fas fa-search search-icon"></i>
                <div class="suggestions">
                    <div class="recent-searches">جست و جو های اخیر</div>
                    <div class="suggestion-item"><i class="fas fa-history"></i> مورد 1</div>
                    <div class="suggestion-item"><i class="fas fa-history"></i> مورد 2</div>
                    <div class="suggestion-item"><i class="fas fa-fire"></i> بیشترین جست و جو: مورد 4</div>
                </div>
            </div>
        </div>
        <ul class="navbar-nav ml-auto" id="massage-navbar">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-envelope" style="font-size: larger"></i>
                    <span class="badge badge-danger navbar-badge massages-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                   \dhl 1
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar active" id="sidebar" style="width: 16rem !important;"> <!-- added active class for default open -->
    <button class="close-sidebar" id="close-sidebar"><i class="fa-solid fa-xmark"></i></button>
    <div class="sidebar-header" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="ویرایش پروفایل">
        <img src="img/user.png" alt="Profile" class="profile-pic">
        <span>
            <?php
            echo $_SESSION['username'];
            ?>
        </span>
    </div>
    <div class="sidebar-item"><i class="fa-solid fa-gauge"></i>داشبورد</div>
<!--    <div class="sidebar-item dropdown">-->
<!--        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" aria-expanded="false">-->
<!--            <i class="fa fa-plus"></i> افزودن-->
<!--        </a>-->
<!--        <div class="dropdown-menu">-->
<!--            <a class="dropdown-item" href="#"><i class="fa-solid fa-list"></i> منو ها </div></a>-->
<!--            <a class="dropdown-item" href="#">گزینه 2</a>-->
<!--            <a class="dropdown-item" href="#">گزینه 3</a>-->
<!--        </div>-->
<!--    </div-->
    <div class="sidebar-item"><i class="fa-solid fa-list"></i> منو ها </div>
    <div class="sidebar-item"><i class="fa-solid fa-file"></i>  صفحات</div>
    <div class="sidebar-item"><i class="fa-solid fa-bottle-droplet"></i>  دارو ها</div>
    <div class="sidebar-item"><i class="fa-solid fa-bookmark"></i>  مقالات</div>
    <div class="sidebar-item"><i class="fa-solid fa-grip"></i>  دسته بندی محصول</div>
    <div class="sidebar-item"><i class="fa-solid fa-users"></i>  کاربران</div>
    <div class="sidebar-item"><i class="fa-solid fa-right-from-bracket"></i>  خروج</div>
</div>

<script>
    // Toggle sidebar
    document.getElementById('menu-toggle').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        const massage_navbar = document.getElementById('massage-navbar');
        const body_container = document.getElementById('body-container');
        massage_navbar.classList.toggle('ml-auto');
        sidebar.classList.toggle('active');
        body_container.classList.toggle('body-container');
        document.body.classList.toggle('sidebar-active'); // Add a class to body to handle layout changes
    });

    // Close sidebar
    document.getElementById('close-sidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        const massage_navbar = document.getElementById('massage-navbar');
        const body_container = document.getElementById('body-container');
        sidebar.classList.remove('active');
        massage_navbar.classList.toggle('ml-auto');
        body_container.classList.toggle('body-container');
        document.body.classList.remove('sidebar-active'); // Remove layout changes

    });

    // تعویض `data-bs-toggle` با ویژگی فعال‌کننده Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
    });

</script>
</body>

</html>  