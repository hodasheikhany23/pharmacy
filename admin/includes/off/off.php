<?php
    defined('site') or die('Acces denied');
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
    $errors = [];
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'edit':
                require_once "includes/off/update.php";
                break;
            case 'delete':
                $result =  $link->query("DELETE FROM off WHERE `off`.`off_id` = '".$_GET['id']."'");
                if ($link->affected_rows == 1 && $link->errno==0) {
                    $errors['success_delete'] = "تخفیف با موفقیت حذف شد";
                }
                else if ($link->errno == 1451) {
                    $errors['delete'] = "خطا در حذف تخفیف: اطلاعات وابسته به تخفیف در سامانه موجود است";
                }
                else if($link->errno > 0){
                    $errors['delete'] = "خطا در حذف تخفیف";
                }
                break;
        }
    }
    ?>

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
        <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
            <h4 class="mb-4">لیست تخفیف ها  </h4>
            <div>
                <a href="index.php?pg=login&page=addoff" type="submit" class="button btn btn-primary add1 ">
                    <i class="fa-solid fa-plus"></i>
                    <span style="margin-left: 2px;">|</span>  افزودن تخفیف برای دسته بندی
                </a>
                <a href="index.php?pg=login&page=addoffpro" type="submit" class="button btn btn-primary add2 ">
                    <i class="fa-solid fa-plus"></i>
                    <span style="margin-left: 2px;">|</span>  افزودن تخفیف برای محصول
                </a>
            </div>

        </div>
        <div>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام تخفیف</th>
                    <th>مقدار تخفیف </th>
                    <th>دسته بندی</th>
                    <th>محصول </th>
                    <th>وضعیت</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $resultPages = $link->query("SELECT * FROM off");
                if($resultPages -> num_rows != 0){
                    while($rowPage=$resultPages -> fetch_assoc()){
                        $resultMenu = $link -> query("SELECT * FROM category WHERE cat_id = '" . $rowPage['off_category_id'] . "'");
                        $rowMenu = $resultMenu -> fetch_assoc();
                        switch ($rowPage['off_status']) {
                            case '1':
                                $pg_status = '<span class="badge bg-success p-2">فعال</span> ';
                                break;
                            case '2':
                                $pg_status = '<span class="badge bg-danger p-2">غیرفعال</span>';
                                break;
                        }
                        $resultDrug= $link -> query("SELECT * FROM drogs WHERE drg_id = '" . $rowPage['off_drug_id'] . "'");
                        if($resultDrug->num_rows != 0){
                            $rowDrug = $resultDrug->fetch_assoc();
                            $drug = '<span class="badge bg-info p-2">'.$rowDrug['drg_name'].'</span>';
                        }
                        else{
                            $drug = '<span class="badge bg-warning p-2">تعریف نشده</span>';
                        }
                        echo '<tr>';
                        echo '<td class="px-4 py-2">'.$rowPage['off_id'].'</td>';
                        echo '<td class="px-4 py-2 w-75">'.$rowPage['off_name'].'</td>';
                        echo '<td class="px-4 py-2 w-25"><span class="badge bg-danger p-2">'.$rowPage['off_value'].'%</span></td>';
                        echo '<td class="px-4 py-2 w-25"><span class="badge bg-success p-2">'.$rowMenu['cat_name'].'</span></td>';
                        echo '<td class="px-4 py-2 w-25">'.$drug.'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$pg_status.'</td>';
                        echo '<td class="d-flex align-content-center px-4 py-2">'
                            . '<a class="btn btn-info text-white me-2" title="ویرایش" href="index.php?pg=login&page=editoff&id=' . $rowPage['off_id'] . '">'
                            . '<i class="fa-solid fa-pen-to-square"></i>'
                            . '</a>'
                            . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=createoff&action=delete&id='.$rowPage['off_id'].'">'
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
