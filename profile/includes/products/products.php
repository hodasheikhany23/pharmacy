<?php
    defined('site') or die('Acces denied');

    if(!isset($_SESSION['username'])){
        die("Please <a href='includes/login.php'>login</a> to access this page");
    }
    $errors = [];
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'edit':
                require_once "includes/products/update.php";
                break;
            case 'delete':
                $link->query("DELETE FROM drogs WHERE drg_id = '" . $_GET['id'] . "'");
                if ($link->errno > 0 || $link->affected_rows == 0) {
                    $errors['delete'] = "محصول مورد نظر در سامانه موجود نیست!";
                }
                else if ($link->affected_rows == 1) {
                    $errors['success_delete'] = "محصول با موفقیت حذف شد";
                }
                else if ($link->errno == 1451) {
                    $errors['delete'] = "خطا در حذف محصول: اطلاعات وابسته به محصول در سامانه موجود است";
                }
                break;
        }
    }
    $resultDrogs = $link -> query("SELECT * FROM drogs");
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
        <div class="section-title">
            <h4 class="mb-4">لیست محصولات  </h4>
            <a href="index.php?page=addproducts" type="submit" class="button btn btn-primary sign">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن محصول
            </a>
        </div>
        <div>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام محصول</th>
                    <th>شرکت  </th>
                    <th>قیمت</th>
                    <th>متن</th>
                    <th>موجودی</th>
                    <th>دسته بندی</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if($resultDrogs -> num_rows != 0){
                    while($rowDrog=$resultDrogs -> fetch_assoc()){
                        echo '<tr>';
                        echo '<td class="px-4 py-2">'.$rowDrog['drg_id'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowDrog['drg_name'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowDrog['drg_company'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowDrog['drg_price'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowDrog['drg_caption'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowDrog['drg_available'].'</td>';
                        echo '<td class="px-4 py-2 w-25">'.$rowDrog['drg_category_id'].'</td>';
                        echo '<td class="d-flex align-content-center px-4 py-2">'
                            . '<a class="btn btn-info text-white me-2" title="ویرایش" href="index.php?page=updateproducts&id=' . $rowDrog['drg_id'] . '">'
                            . '<i class="fa-solid fa-pen-to-square"></i>'
                            . '</a>'
                            . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?page=products&action=delete&id='.$rowDrog['drg_id'].'">'
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
