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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
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
<div class="sidebar active d-flex flex-column" id="sidebar" style="width: 16rem !important;"> <!-- added active class for default open -->
    <button class="close-sidebar" id="close-sidebar"><i class="fa-solid fa-xmark"></i></button>
    <div class="sidebar-header" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="ویرایش پروفایل">
        <img src="img/user.png" alt="Profile" class="profile-pic">
        <span>
            <?php
            echo $_SESSION['username'];
            ?>
        </span>
    </div>
    <a class="sidebar-item" href="index.php">
        <i class="fa-solid fa-gauge"></i>
        داشبورد
    </a>
    <a class="sidebar-item" href="index.php?menus">
        <i class="fa-solid fa-list"></i>
        منو ها
    </a>
    <a class="sidebar-item" href="index.php?pages">
        <i class="fa-solid fa-file"></i>
        صفحات
    </a>
    <a class="sidebar-item" href="index.php?products">
    <i class="fa-solid fa-bottle-droplet"></i>
        دارو ها
    </a>
    <a class="sidebar-item" href="index.php?blogs">
        <i class="fa-solid fa-bookmark"></i>
        مقالات
    </a>
    <a class="sidebar-item" href="index.php?categories">
        <i class="fa-solid fa-grip"></i> دسته بندی دارو ها
    </a>
    <a class="sidebar-item" href="index.php?page=users">
        <i class="fa-solid fa-users"></i> کاربران
    </a>
    <div class="sidebar-item sidebar-item-more" id="toggleCollapse" data-bs-toggle="collapse" data-bs-target="#collapsemore" aria-expanded="false" aria-controls="collapsemore">
        <i class="fa-solid fa-list"></i> سایر
        <i id="collapseIcon" class="fa-solid fa-angle-down"></i>
    </div>
    <div class="collapse" id="collapsemore">
        <div class="card card-body">
            <a class="sidebar-item" href="index.php?page=createoff">
                   <i class="fa-solid fa-tag"></i>
                   ایجاد تخفیف
            </a>
            <a class="sidebar-item" href="index.php?page=delivermethod">
                <i class="fa-solid fa-cart-flatbed-suitcase"></i>
                شیوه ارسال
            </a>
            <a class="sidebar-item" href="index.php?page=paymentmethod" style="background-color: transparent !important; color: #1b1b1b">
                <i class="fa-solid fa-credit-card"></i>
                شیوه پرداخت
            </a>
        </div>
    </div>
    <a href="index.php?logout" class="sidebar-item"><i class="fa-solid fa-right-from-bracket"></i>  خروج</a>

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

    document.addEventListener("DOMContentLoaded", function() {
        var collapsemore = document.getElementById('collapsemore');
        var sidebarItemMore = document.querySelector('.sidebar-item-more');

        sidebarItemMore.addEventListener("click", function() {
            collapsemore.classList.toggle('show');
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleCollapse = document.getElementById('toggleCollapse');
        const collapseIcon = document.getElementById('collapseIcon');
        const collapsemore = document.getElementById('collapsemore');

        toggleCollapse.addEventListener("click", function() {
            // بررسی وضعیت کالاپس برای تغییر آیکون
            if (collapsemore.classList.contains('show')) {
                collapseIcon.classList.remove('fa-angle-up');
                collapseIcon.classList.add('fa-angle-down');
                collapsemore.classList.remove('show'))
            } else {
                collapseIcon.classList.remove('fa-angle-down');
                collapseIcon.classList.add('fa-angle-up');
            }
        });

        // اضافه کردن رویداد برای تغییر آیکون در صورتی که دیگر باز شود
        collapsemore.addEventListener('shown.bs.collapse', function () {
            collapseIcon.classList.remove('fa-angle-down');
            collapseIcon.classList.add('fa-angle-up');
        });

        // اضافه کردن رویداد برای تغییر آیکون در صورتی که بسته شود
        collapsemore.addEventListener('hidden.bs.collapse', function () {
            collapseIcon.classList.remove('fa-angle-up');
            collapseIcon.classList.add('fa-angle-down');
        });
    });
</script>
</body>

</html>  