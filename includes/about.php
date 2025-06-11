<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> cosmetics | home </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
<?php
$resultPage = $link->query("SELECT * FROM pages WHERE pg_menu_id = '" . $_GET['md'] . "'");
if ($resultPage->num_rows > 0) {
    $rowPage = $resultPage->fetch_assoc();
}
$resultPageDe = $link->query("SELECT * FROM page_detail where pgde_page_id = '" . $rowPage['pg_id'] . "'");
if ($resultPageDe->num_rows != 0) {
    $row = $resultPageDe->fetch_assoc();
}

if($rowPage['pg_status'] == "2"){
    require_once "work.php";
}
else{

$result_info = $link->query("SELECT * FROM info");
if($result_info->num_rows > 0) {
    $row_info = $result_info->fetch_assoc();
}
?>
<div class="container about">
    <div class="d-flex justify-content-end about-section" style="color: white !important;">
        <img class="aboutpage-img" src="<?php echo $row_info['info_doctor_image']; ?>" alt="aboutpage">
        <div class="d-flex flex-column about-text-container w-50">
            <div class="section-title">
                <p>داروخانه آنلاین
                </p>
            </div>
            <p class="about-txt pt-3 text-color-white">
                <?php
                echo $row_info['info_about'];
                ?>
            </p>
        </div>
    </div>
</div>
<div class="container about d-flex justify-content-center">
    <div class="d-flex justify-content-start about-section w-75" style="background-color: whitesmoke; color: var(--color-main) !important;">
        <div class="d-flex flex-column about-text-container w-50">
            <div class="section-title">
                <p  style="color: var(--color-main) !important; border-color: var(--color-main) !important;"> اطلاعات تماس </p>
            </div>
            <div class="about-txt pt-4">
                <p class="mytext-bold" style="font-size: 16px; color: var(--color-2)">
                    <i class="bi bi-telephone mx-2"></i>
                    <?php
                    echo $row_info['info_phone'];
                    ?>
                </p>
                <p class="mytext-bold" style="font-size: 16px; color: var(--color-2)">
                    <i class="bi bi-envelope-at mx-2"></i>
                    <?php
                    echo $row_info['info_email'];
                    ?>
                </p>
                <p class="mytext-bold" style="font-size: 16px; color: var(--color-2)">
                    <i class="bi bi-telegram mx-2"></i>
                    <?php
                    echo $row_info['info_telegram'];
                    ?>
                </p>
                <p class="mytext-bold" style="font-size: 16px; color: var(--color-2)">
                    <i class="bi bi-whatsapp mx-2"></i>
                    <?php
                    echo $row_info['info_whatsapp'];
                    ?>
                </p>
            </div>

        </div>
        <img class="aboutpage-img2" src="img/reception.jpg">
    </div>
</div>
<div class="container mb-5 pb-5">
    <div class="section-title mb-4">
        <p>مدارک و مجوز ها</p>
    </div>
    <div class="row justify-content-center mb-5 pb-5">
        <?php
        $result_license = $link->query("SELECT * FROM license");
        $counter = 0;
        while($row_license = $result_license->fetch_assoc()) {
            $counter++;
            ?>
            <!-- هر کارت -->
            <div class="col-md-3 mb-4 d-flex align-items-stretch">
                <div class="card w-100 shadow-sm border-0">
                    <!-- تصویر در قسمت بالا -->
                    <img src="<?php echo $row_license['lic_image']; ?>" class="card-img-top" style="object-fit: cover; height: 150px;" alt=""/>

                    <!-- قسمت پایین شامل عنوان و لینک -->
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title text-center"><?php echo $row_license['lic_name']; ?></h5>
                        <a href="#" class="btn button btn-primary mx-auto mt-3">
                            <i class="bi bi-link-45deg"></i>
                            مشاهده
                        </a>
                    </div>
                </div>
            </div>

            <?php
            // هر 4 کارت ردیف بندی
            if($counter % 4 == 0) {
                echo '<div class="w-100"></div>'; // خط جدید برای هر 4 کارت
            }
        }
        ?>
    </div>
</div>
<?php
}
?>