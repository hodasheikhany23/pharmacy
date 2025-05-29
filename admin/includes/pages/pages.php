<?php
    defined('site') or die('Acces denied');
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
    $errors = [];
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'edit':
                require_once "includes/pages/update.php";
                break;
            case 'delete':
                $result =  $link->query("DELETE FROM pages WHERE `pages`.`pg_id` = '".$_GET['id']."'");
                if ($link->affected_rows == 1 && $link->errno==0) {
                    $errors['success_delete'] = "صفحه با موفقیت حذف شد";
                }
                else if ($link->errno == 1451) {
                    $errors['delete'] = "خطا در حذف صفحه: اطلاعات وابسته به صفحه در سامانه موجود است";
                }
                else if($link->errno > 0){
                    $errors['delete'] = "خطا در حذف صفحه";
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
            <h4 class="mb-4">لیست صفحات  </h4>
            <a href="index.php?pg=login&page=addpage" type="submit" class="button btn btn-primary sign">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن صفحه
            </a>
        </div>
        <div>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام صفحه</th>
                    <th>نوع صفحه </th>
                    <th>منو</th>
                    <th>وضعیت</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $resultPages = $link->query("SELECT * FROM pages");
                if($resultPages -> num_rows != 0){
                    while($rowPage=$resultPages -> fetch_assoc()){
                        $resultMenu = $link -> query("SELECT * FROM menu WHERE menu_id = '" . $rowPage['pg_menu_id'] . "'");
                        $rowMenu = $resultMenu -> fetch_assoc();
                        switch ($rowPage['pg_type']) {
                            case 1:
                                $pg_type = '<span class="badge bg-info p-2">بنر ابتدای صفحه</span>';
                                break;
                            case 2:
                                $pg_type = '<span class="badge bg-warning p-2"> سایدبار  </span>';
                                break;
                            case 3:
                                $pg_type = '<span class="badge bg-secondary p-2"> ساده </span>';
                                break;
                            case 4:
                                $pg_type = "سایدبار و بنر ";
                                break;
                            case 5:
                                $pg_type = " فرم تماس ";
                                break;
                            case 6:
                                $pg_type = '<span class="badge bg-success p-2"> درباره ما </span>';
                                break;
                        }
                        switch ($rowPage['pg_status']) {
                            case '1':
                                $pg_status = '<span class="badge bg-success p-2">فعال</span>';
                                break;
                            case '2':
                                $pg_status = '<span class="badge bg-danger p-2">غیرفعال</span>';
                                break;
                        }
                        echo '<tr>';
                        echo '<td class="px-4 py-2">'.$rowPage['pg_id'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowPage['pg_name'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$pg_type.'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowMenu['menu_name'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$pg_status.'</td>';
                        echo '<td class="d-flex align-content-center px-4 py-2">'
                            . '<a class="btn btn-info text-white me-2" title="ویرایش" href="index.php?pg=login&page=editpages&id=' . $rowPage['pg_id'] . '">'
                            . '<i class="fa-solid fa-pen-to-square"></i>'
                            . '</a>';
                            if($rowPage['pg_id'] != 6){
                                echo  '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=pages&action=delete&id='.$rowPage['pg_id'].'">'
                                . '<i class="fa-solid fa-trash"></i>'
                                . '</a>';
                                echo '<a class="btn btn-warning text-white me-2" title="محتوای صفحه" href="index.php?pg=login&page=pagecontent&id='.$rowPage['pg_id'].'">'
                                    . '<i class="fa-solid fa-bars-staggered"></i>'
                                    . '</a>'
                                    . '</td>';
                            }
                            else{
                                echo '<a class="btn btn-warning text-white me-2" title="محتوای صفحه" href="index.php?pg=login&page=info">'
                                    . '<i class="fa-solid fa-bars-staggered"></i>'
                                    . '</a>'
                                    . '</td>';
                            }

                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
