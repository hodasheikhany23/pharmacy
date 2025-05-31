<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('15',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors = [];
if(isset($_POST['update'])){
    $is_active = isset($_POST['is_active']) ? 1 : 2;
    $updateResult = $link -> query("UPDATE off SET off_name = '" . $_POST['name']  . "',off_value = '" . $_POST['value']  . "' ,off_category_id = '" . $_POST['menu']  . "' ,off_status = '" . $is_active  . "' where off_id = '".$_GET['id']."' ");
    if($link -> errno == 0){
        $errors['update_user'] = "تخفیف با موفقیت ویرایش شد";
    }
    else{
        $errors['update_user_error'] = "خطا در ویرایش تخفیف";
    }
}
$resultPage = $link -> query("SELECT * FROM off where off_id = '".$_GET['id']."'");
if($link -> errno == 0){
    $rowPage = $resultPage -> fetch_assoc();
}

?>
<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['update_user'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['update_user'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['update_user_error'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['update_user_error'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['username'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['username'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-4">  ویرایش تخفیف  </h4>
        <a href="index.php?pg=login&page=createoff" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست تخفیف ها
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="name" class="form-label">نام تخفیف</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php if(isset($rowPage)){echo trim($rowPage['off_name']);} ?>">
            </div>
            <div class="mb-3">
                <?php
                $selectedMenuId = isset($_POST['menu']) ? $_POST['menu'] : '';

                $result_submenu = $link->query("SELECT * FROM category");
                echo '<label for="menu" class="form-label">دسته بندی </label>  
                <select name="menu" class="form-select rounded mb-3" aria-label="Default select example"> ';
                $result_submenu = $link->query("SELECT * FROM category");
                if ($result_submenu->num_rows > 0) {
                    while ($row_submenu = $result_submenu->fetch_assoc()) {
                        $menuName = ''; // مقدار پیش‌فرض
                        $result_menu = $link->query("SELECT * FROM sub_menu WHERE subm_id = '".$row_submenu['cat_subm_id']."'");
                        if ($result_menu && $result_menu->num_rows > 0) {
                            $row_menu = $result_menu->fetch_assoc();
                            $menuName = $row_menu['subm_name'];
                        }

                        $selected = ($row_submenu['cat_id'] == $selectedMenuId) ? ' selected' : '';

                        echo '<option value="' . htmlspecialchars($row_submenu['cat_id']) . '"' . $selected . '>'
                            . htmlspecialchars($row_submenu['cat_name']) . ' __ ' . htmlspecialchars($menuName)
                            . '</option>';
                    }
                }
                echo '</select>';
                ?>
            </div>
            <div class="mb-3">
                <div class="mb-4">
                    <label for="value" class="form-label"> مقدار تخفیف (درصد)</label>
                    <input name="value" type="text" class="form-control" id="value" value="<?php if(isset($rowPage)){echo trim($rowPage['off_value']);} ?>">
                </div>
            </div>
            <div class="mb-3 form-check">
                <input name="is_active" type="checkbox" class="form-check-input" id="is_active"
                    <?php if (isset($rowPage) && $rowPage['off_status'] == 1) echo 'checked'; ?> >
                <label class="form-check-label" for="is_active">تخفیف فعال است  </label>
            </div>
            <div class="mt-5 border-top">
            <button type="submit" name="update" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> ثبت ویرایش
            </button>
        </form>
    </div>

</div>

