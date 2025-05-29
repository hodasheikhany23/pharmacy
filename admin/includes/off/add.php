<?php
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
    defined('site') or die('Acces denied');

$errors = [];
    if(isset($_POST['submit'])){
        $is_active = isset($_POST['is_active']) ? 1 : 2;
        $resultDuplicate = $link->query("SELECT * FROM off WHERE off_name = '" . $_POST['name'] . "'");
        if($resultDuplicate->num_rows != 0){
            $errors['duplicate'] = "این  تخفیف در سامانه موجود است. لطفا نام  جدیدی وارد کنید";
        }
        else{
            if(isset($_POST['name'])){
                if(mb_strlen(clean_data($_POST['name'])) > 2){
                    $name = clean_data($_POST['name']) ;
                }
                else{
                    $errors['username'] = "نام تخفیف باید بیشتر از 2 کاراکتر باشد";
                }
            }
            else{
                $errors['username'] = "نام تخفیف را وارد کنید" ;
            }
            if(isset($name)){
                $link->query("INSERT INTO off (off_name,off_value, off_category_id, off_status) VALUES ('" . $name . "', '" . $_POST['value'] . "', '" .  $_POST['menu'] . "', '" .  $is_active . "')");
                if($link->errno == 0){
                    $errors['add_user'] = "تخفیف جدید با موفقیت ثبت شد";
                }
                else{
                    $errors['add_user_error'] = "خطا در ذخیره اطلاعات";
                }
            }
        }
    }

    ?>
<?php
if(isset($errors['username'])){
    echo '<div class="alert" role="alert">' . $errors['username'] . ' </div>';
}
?>
<div class="d-flex px-5 py-2 justify-content-center">
    <?php
    if(isset($errors['add_user'])){
        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['add_user'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
    }
    if(isset($errors['add_user_error'])){
        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['add_user_error'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
    }
    if(isset($errors['duplicate'])){
        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['duplicate'].'
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
    <h4 class="mb-4">  افزودن تخفیف  </h4>
    <a href="index.php?pg=login&page=createoff" class="button btn btn-primary">
        <i class="fa-solid fa-list"></i>
        <span style="margin-left: 2px;">| </span> لیست تخفیف ها
    </a>
</div>
<div class="form-container">
    <form method="post" action="">
        <div class="mb-4">
            <label for="name" class="form-label">نام تخفیف</label>
            <input name="name" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <?php
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
                    echo '<option value="' . $row_submenu['cat_id'] . '">' . htmlspecialchars($row_submenu['cat_name']) . ' __ ' . htmlspecialchars($menuName) . '</option>';
                }
            }
            echo '</select>';
            ?>
        </div>
        <div class="mb-3">
            <label for="value" class="form-label">مقدار تخفیف (درصد) </label>
            <input name="value" type="text" class="form-control" id="value" placeholder="برای مثال 10">
        </div>
        <div class="mb-3 form-check">
            <input name="is_active" type="checkbox" class="form-check-input" id="is_active" checked>
            <label class="form-check-label" for="is_active">فعال   </label>
        </div>
        <button type="submit" name="submit" href="" class="button btn btn-success">
            <i class="fa-solid fa-plus"></i>
            <span style="margin-left: 2px;">| </span> افزودن
        </button>
    </form>
</div>

