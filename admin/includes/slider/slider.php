<?php
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
defined('site') or die('Acces denied');
if(!in_array('16',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'edit':
            require_once "admin/includes/slider/update.php";
            break;
        case 'delete':
            $link->query("DELETE FROM slider WHERE slide_id = '" . $_GET['id'] . "'");
            if ($link->errno > 0 || $link->affected_rows == 0) {
                $errors['delete'] = "تصویر مورد نظر در سامانه موجود نیست!";
            }
            else if ($link->affected_rows == 1) {
                $errors['success_delete'] = "تصویر با موفقیت حذف شد";
            }
            else if ($link->errno == 1451) {
                $errors['delete'] = "خطا در حذف تصویر: اطلاعات وابسته به محصول در سامانه موجود است";
            }
            break;
    }
}
?>

<div class="container mt-5">
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-4">تصاویر اسلایدر    </h4>
        <a href="index.php?pg=login&page=addslider" type="submit" class="button btn btn-primary sign">
            <i class="fa-solid fa-plus"></i>
            <span style="margin-left: 2px;">| </span> افزودن تصویر
        </a>
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
            <table class="table table-bordered table-striped align-middle">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $resultPages = $link->query("SELECT * FROM slider");
                if($resultPages -> num_rows != 0){
                    while($rowPage=$resultPages -> fetch_assoc()){
                        echo '<tr>';
                        echo '<td class="px-4 py-2">'.$rowPage['slide_id'].'</td>';
                        echo '<td class="px-4 py-2 w-25"><img style="width: 260px; height: auto" src="'.$rowPage['slide_image'].'" </td>';
                        echo '<td class="d-flex align-content-center px-4 py-2">'
                            . '<a class="btn btn-info text-white me-2" title="ویرایش" href="index.php?pg=login&page=editslider&id=' . $rowPage['slide_id'] . '">'
                            . '<i class="fa-solid fa-pen-to-square"></i>'
                            . '</a>'
                            . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=slider&action=delete&id='.$rowPage['slide_id'].'">'
                            . '<i class="fa-solid fa-trash"></i>'
                            . '</a>'
                            . '</td>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
