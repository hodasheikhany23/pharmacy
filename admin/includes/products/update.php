<?php
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
defined('site') or die('Acces denied');

$errors = [];
if(isset($_POST['update'])){
    if(isset($_POST['name'])){
        $name = clean_data($_POST['name']) ;
    }
    else{
        $errors['username'] = "نام محصول را وارد کنید" ;
    }
    if (isset($_FILES['picFile']) && $_FILES['picFile']['error'] === UPLOAD_ERR_OK) {
        $pictureExtention = substr($_FILES['picFile']['name'], strrpos($_FILES['picFile']['name'], '.') + 1);
        if (!in_array($pictureExtention, ['png', 'jpg', 'jpeg','webp'])) {
            $errors['picFile'] = 'پسوند تصویر مجاز نیست';
        }

        if ($_FILES['picFile']['size'] > 520000) {
            $errors['picFile'] = (isset($errors['picFile']) ? $errors['picFile'] . "<br>" : "") . 'حجم فایل بیشتر از حد مجاز است';
        }
        if (!isset($errors['picFile'])) {
            $fileName = $name.date("YmdHis") . "." . $pictureExtention;
            move_uploaded_file($_FILES['picFile']['tmp_name'], "uploads/" . $fileName);
        }
    } else {
        $errors['picFile'] = 'فایلی انتخاب نشده است';
    }
    if (!isset($errors['picFile'])) {
        if(isset($name)){
            $resultAdd = $link->query("UPDATE drogs SET drg_name='". $_POST['name'] ."', drg_company='". $_POST['company'] ."', drg_price='". $_POST['price'] ."', drg_available='". $_POST['available'] ."', drg_category_id='". $_POST['category'] ."', drg_caption='". $_POST['content'] ."', drg_image='".$fileName."',drg_usage = '".$_POST['usage']."' WHERE drg_id=' ". $_GET['id'] ."'");
            if($link->errno == 0){
                $errors['add_user'] = "محصول با موفقیت ویرایش شد";
            }
            else{
                $errors['add_user_error'] = "خطا در ذخیره محصول";
            }
        }
    }
}
$resultSelect = $link->query("SELECT * FROM drogs WHERE drg_id = '".$_GET['id']."'");
if($link->errno == 0){
    $rowSelect = $resultSelect->fetch_assoc();
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
    if(isset($errors['username'])){
        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['username'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
    }
    if(isset($errors['picFile'])){
        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['picFile'].'
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
    ?>
</div>
<div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
    <h4 class="mb-4" style="margin-top: 24px !important; padding-top: 0 !important;">  ویرایش محصول  </h4>
    <a href="index.php?pg=login&page=products" class="button btn btn-primary">
        <i class="fa-solid fa-list"></i>
        <span style="margin-left: 2px;">| </span> لیست محصولات
    </a>
</div>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="name" class="form-label">نام محصول</label>
            <input name="name" type="text" class="form-control" id="name" value="<?php if(isset($rowSelect['drg_name'])){echo $rowSelect['drg_name'];} ?>">
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label class="file-label" for="formFile">تصویر محصول </label>
                <input class="form-control" type="file" id="formFile" name="picFile">
            </div>
            <?php
            if (isset($errors['picFile'])) {
                echo $errors['picFile'];
            }
            ?>
        </div>
        <div class="mb-4">
            <label for="company" class="form-label">شرکت تولیدی</label>
            <input name="company" type="text" class="form-control" id="name" value="<?php if(isset($rowSelect['drg_company'])){echo $rowSelect['drg_company'];} ?>">
        </div>
        <div class="mb-4">
            <label for="price" class="form-label">قیمت </label>
            <input name="price" type="text" class="form-control" id="name" value="<?php if(isset($rowSelect['drg_price'])){echo $rowSelect['drg_price'];} ?>">
        </div>
        <div class="mb-4">
            <label for="available" class="form-label">تعداد موجود در انبار </label>
            <input name="available" type="text" class="form-control" id="name" value="<?php if(isset($rowSelect['drg_available'])){echo $rowSelect['drg_available'];} ?>">
        </div>
        <div class="mb-3">
            <?php
            echo '<label for="category" class="form-label">دسته بندی   </label>  
                <select name="category" class="form-select rounded mb-3 " aria-label="Default select example"> ';
            $result_submenu = $link->query("SELECT * FROM category");
            if ($result_submenu->num_rows > 0) {
                while ($row_submenu = $result_submenu->fetch_assoc()) {
                    $result_menu = $link->query("SELECT * FROM sub_menu where subm_id = '".$row_submenu['cat_subm_id']."'");
                    if ($result_menu->num_rows > 0) {
                        $row_menu = $result_menu->fetch_assoc();
                    }
                    if($row_submenu['cat_id'] == $rowSelect['drg_category_id']){
                        $selected = "selected";
                    }
                    else{
                        $selected = "";
                    }
                    echo '<option value="' . $row_submenu['cat_id'] . '" ' . $selected . '>' . $row_submenu['cat_name'] . ' __  '.$row_menu['subm_name'].'</option>';
                }
            }
            echo '</select>';
            ?>
        </div>
        <div class="card-body pad">
            <label for="content" class="form-label">توضیحات    </label>
            <div class="mb-3">
                <textarea class="textarea" name="content"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php if(isset($rowSelect['drg_caption'])){echo $rowSelect['drg_caption'];} ?></textarea>
            </div>
            <label for="usage" class="form-label">طریقه مصرف    </label>
            <div class="mb-3">
                <textarea class="textarea" name="usage"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php if(isset($rowSelect['drg_caption'])){echo $rowSelect['drg_usage'];} ?></textarea>
            </div>
        </div>
        <button type="submit" name="update" href="" class="button btn btn-success">
            <i class="fa-solid fa-edit"></i>
            <span style="margin-left: 2px;">| </span> ویرایش
        </button>
    </form>
</div>

