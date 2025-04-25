<?php
    defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
    $link = new mysqli("localhost", "root", "", "pharmacy_db");

    $errors = [];
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'edit':
                require_once "admin/includes/updateuser.php";
                break;
            case 'delete':
                $link->query("DELETE FROM users WHERE u_id = '" . clean_id($_GET['id']) . "'");
                if ($link->errno > 0 || $link->affected_rows == 0) {
                    $errors['delete'] = "کاربر مورد نظر در سامانه موجود نیست!";
                }
                else if ($link->affected_rows == 1) {
                    $errors['success_delete'] = "کاربر با موفقیت حذف شد";
                }
                else if ($link->errno == 1451) {
                    $errors['delete'] = "خطا در حذف کاربر: اطلاعات وابسته به کاربر در سامانه موجود است";
                }
                break;
            case 'changePass':
                require_once "admin/includes/changePassword.php";
                break;
        }
    }
    $resultUser = $link -> query("SELECT * FROM users");
        if($resultUser -> num_rows != 0){
            $rowUser = $resultUser -> fetch_array();
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
            <h4 class="mb-4">جدول اطلاعات مخاطبین</h4>
            <a href="index.php?pg=login&page=adduser" type="submit" class="button btn btn-primary sign">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن کاربر
            </a>
        </div>
        <div>
            <table class="table table-bordered table-striped align-middle">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>شماره تلفن</th>
                    <th>آدرس</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($rowUser=$resultUser -> fetch_assoc()){
                    echo '<tr>';
                    echo '<td class="px-4 py-2">'.$rowUser['u_id'].'</td>';
                    echo '<td class="px-4 py-2">'.$rowUser['u_username'].'</td>';
                    echo '<td class="px-4 py-2">'.$rowUser['u_phone'].'</td>';
                    echo '<td class="px-4 py-2 w-75">'.$rowUser['u_address'].'</td>';
                    echo '<td class="d-flex align-content-center px-4 py-2">'
                        . '<a class="btn btn-info text-white me-2" title="ویرایش" href="index.php?pg=login&page=users&action=edit&id=' . $rowUser['u_id'] . '">'
                        . '<i class="fa-solid fa-pen-to-square"></i>'
                        . '</a>'
                        . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=users&action=delete&id='.$rowUser['u_id'].'">'
                        . '<i class="fa-solid fa-trash"></i>'
                        . '</a>'
                        . '<a class="btn btn-warning text-white me-2" title="تغییر رمز عبور" href="index.php?pg=login&page=users&action=changePass&id='.$rowUser['u_id'].'">'
                        . '<i class="fa-solid fa-key"></i>'
                        . '</a>'
                        . '</td>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
