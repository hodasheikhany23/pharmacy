<?php
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
defined('site') or die('Acces denied');

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'edit':
            require_once "admin/includes/banner/update.php";
            break;
    }
}
?>

<div class="container mt-5">
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-0 me-4">بنر ها     </h4>
    </div>
    <div class="container">
        <div class="d-flex px-5 py-2 justify-content-center">
            <?php
            if(isset($errors['success_delete'])){
                echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['success_delete'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
            }
            if(isset($errors['delete'])){
                echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['delete'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
            }
            ?>
        </div>
        <div>
            <div class="categories container text-center">
                <div class="row row-cols-2 row-cols-lg-6 g-2 g-lg-3">
                    <?php
                    $result = $link->query("SELECT * FROM banners where banner_position = '1'");
                    while ($row = $result->fetch_assoc()) {
                       echo '<div class="col" >
                        <div class="categori" ><img class="cat-img" src = "'.$row['banner_image'].'" alt = "Category 1" ></div >
                        <div class="card rounded mt-3 border-0 d-flex flex-row p-2 justify-content-center align-items-center" >
                        ویرایش تصویر
                            <a class="btn btn-info text-white me-2" title = "ویرایش" href = "index.php?pg=login&page=editbanner&id=' . $row['banner_id'] . '">
                                <i class="fa-solid fa-pen-to-square" ></i >
                            </a >
                          
                        </div >
                    </div >';
                   }
                    ?>

                </div>
            </div>
            <div class="container mt-5 pt-5 mb-5">
                <div class="large-categories">
                    <div class="row g-8">
                    <?php
                    $result2 = $link->query("SELECT * FROM banners where banner_position = '2'");
                    $row2 = $result2->fetch_assoc();
                    $result3 = $link->query("SELECT * FROM banners where banner_position = '3'");
                    $row3 = $result3->fetch_assoc();
                    echo '<div class="col-sm-6 col-md-8"><img class="Lcat-img" src="'.$row2['banner_image'].'">
                            <div class="card rounded mt-3 border-0 d-flex flex-row p-2 justify-content-center align-items-center" >
                            ویرایش تصویر
                            <a class="btn btn-info text-white me-2" title = "ویرایش" href = "index.php?pg=login&page=editbanner&id=' . $row2['banner_id'] . '">
                                <i class="fa-solid fa-pen-to-square" ></i >
                            </a >
                          
                        </div ></div>';
                    echo '<div class="col-6 col-md-4"><img class="Lcat-img" src="'.$row3['banner_image'].'">
                            <div class="card rounded mt-3 border-0 d-flex flex-row p-2 justify-content-center align-items-center" >
                        ویرایش تصویر
                            <a class="btn btn-info text-white me-2" title = "ویرایش" href = "index.php?pg=login&page=editbanner&id=' . $row3['banner_id'] . '">
                                <i class="fa-solid fa-pen-to-square" ></i >
                            </a >
                          
                        </div ></div>';

                    ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
