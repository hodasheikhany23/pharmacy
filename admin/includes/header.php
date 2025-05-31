<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Hoda">

    <title>admin_Dashboard</title>

    <!-- Custom fonts for this template-->
    <!-- Custom styles for this template-->
    <link href="style/admin.css" rel="stylesheet">
    <link href="style/admin.min.css" rel="stylesheet">
    <link href="../fonts/fonts.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <a href="index.php" class="nav-link">وبسایت</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">پشتیبان فنی</a>
            </li>
        </ul>
        <div class="search-wrapper">
            <div class="search-box">
                <input type="text" class="search-input form-control" placeholder="جست و جو...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>
        <ul class="navbar-nav ml-auto" id="massage-navbar">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fa fa-envelope" style="font-size: larger"></i>
                    <span class="badge badge-danger navbar-badge massages-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center">
                   33
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar active d-flex flex-column" id="sidebar" style="width: 16rem !important;"> <!-- added active class for default open -->
    <button class="close-sidebar" id="close-sidebar"><i class="fa-solid fa-xmark"></i></button>
    <div class="sidebar-header" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="ویرایش پروفایل">
        <a href="index.php?pg=login&page=profile">
            <img src="admin/img/user.png" alt="Profile" class="profile-pic">
            <span>
            <?php
            echo $_SESSION['username'];
            ?>
        </span>
        </a>
    </div>
    <?php
    if(in_array('17',$perm)){
    ?>
    <div class="sidebar-header" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-html="true" title="مشخصات داروخانه" style="background-color: var(--color-main)">
        <a href="index.php?pg=login&page=info"><span style="color: white;">
                <i class="bi bi-info-circle me-1"></i>
           مشخصات داروخانه
        </span>
        </a>
    </div>
    <?php
    }
    ?>
    <a class="sidebar-item" href="index.php?pg=login&page=dashboard">
        <i class="fa-solid fa-gauge"></i>
        داشبورد
    </a>
    <?php
    if(in_array('3',$perm) || in_array('2',$perm) || in_array('1',$perm)){
    ?>
    <a class="sidebar-item" href="index.php?pg=login&page=menus">
        <i class="fa-solid fa-list"></i>
        منو ها
    </a>
    <?php
    }
    if(in_array('3',$perm) || in_array('2',$perm) || in_array('1',$perm)){
    ?>
    <a class="sidebar-item menu-sub-parent" onclick="sub()" href="index.php?pg=login&page=pages">
        <i class="fa-solid fa-file"></i>
        صفحات
    </a>
    <?php
    }
    if(in_array('4',$perm) || in_array('5',$perm) || in_array('6',$perm)){
    ?>
        <div class="sidebar-item sidebar-item-more" id="toggleCollapse2" data-bs-toggle="collapse" data-bs-target="#collapsemore2" aria-expanded="false" aria-controls="collapsemore2">
            <i class="fa-solid fa-bottle-droplet"></i> دارو ها
            <i id="collapseIcon" class="fa-solid fa-angle-down"></i>
        </div>
        <div class="collapse" id="collapsemore2">
            <div class="card card-body border-0">
                    <a class="sidebar-item" href="index.php?pg=login&page=categories">
                        <i class="fa-solid fa-grip"></i>
                       دسته بندی
                    </a>
                    <a class="sidebar-item" href="index.php?pg=login&page=products" style="background-color: transparent !important; color: #1b1b1b">
                        <i class="fa-solid fa-bottle-droplet"></i>
                        لیست محصولات
                    </a>
            </div>
        </div>
    <?php
    }
    if(in_array('9',$perm) || in_array('10',$perm)){
    ?>
    <a class="sidebar-item" href="index.php?pg=login&page=blogs">
        <i class="fa-solid fa-bookmark"></i>
        مقالات
    </a>
    <?php
    }
    if(in_array('11',$perm) || in_array('12',$perm) || in_array('13',$perm) || in_array('14',$perm)){
    ?>
    <a class="sidebar-item" href="index.php?pg=login&page=users">
        <i class="fa-solid fa-users"></i> کاربران
    </a>
    <?php
    }
    if(in_array('15',$perm) || in_array('16',$perm)){

    ?>
    <div class="sidebar-item sidebar-item-more" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa-solid fa-list"></i> سایر
        <i id="collapseIcon" class="fa-solid fa-angle-down"></i>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body border-0">
            <?php
            if(in_array('15',$perm)){
            ?>
            <a class="sidebar-item" href="index.php?pg=login&page=createoff">
                   <i class="fa-solid fa-tag"></i>
                   ایجاد تخفیف
            </a>
            <?php
            }
            if(in_array('16',$perm)){
            ?>
            <a class="sidebar-item" href="index.php?pg=login&page=slider">
                <i class="bi bi-image"></i>
                اسلایدر
            </a>
            <a class="sidebar-item" href="index.php?pg=login&page=banners" style="background-color: transparent !important; color: #1b1b1b">
                <i class="bi bi-file-image"></i>
                بنر ها
            </a>
            <?php
            }
            ?>
        </div>
    </div>
    <?php
    }
    if(in_array('19',$perm) || in_array('20',$perm)|| in_array('21',$perm)){
    ?>
    <a class="sidebar-item" style="background-color: var(--color-main); color: white !important;;" href="index.php?pg=login&page=support">
        <i class="bi bi-headset"></i>
        پشتیبانی
    </a>
    <?php
    }
    ?>
    <a href="index.php?logout" class="sidebar-item"><i class="fa-solid fa-right-from-bracket"></i>  خروج</a>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>  