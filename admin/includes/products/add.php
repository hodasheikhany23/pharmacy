<?php
    if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
        die("Please <a href='index.php?pg=login'>login</a> to access this page");
    }
    defined('site') or die('Acces denied');

$errors = [];
    if(isset($_POST['submit'])){
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
                $result = $link -> query("SELECT * FROM drogs WHERE drg_name='$name' AND drg_company = '".$_POST['company']."'");
                if($result->num_rows > 0){
                    $errors['duplicate'] = 'این محصول قبلا در سامانه اضافه شده است.';
                }
                else{
                    $resultAdd = $link->query("INSERT INTO drogs (drg_name, drg_company, drg_price, drg_available, drg_category_id, drg_caption, drg_image) VALUES ('". $_POST['name'] ."', '". $_POST['company'] ."', '". $_POST['price'] ."', '". $_POST['available'] ."', '". $_POST['category'] ."', '". $_POST['content'] ."','".$fileName."')");
                    if($link->errno == 0){
                        $errors['add_user'] = "محصول جدید با موفقیت ثبت شد";
                    }
                    else{
                        $errors['add_user_error'] = "محصول در ذخیره اطلاعات";
                    }
                }
            }
        }
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
    <h4 class="mb-4" >   افزودن محصول  </h4>
    <a href="index.php?pg=login&page=products" class="button btn btn-primary">
        <i class="fa-solid fa-list"></i>
        <span style="margin-left: 2px;">| </span> لیست محصولات
    </a>
</div>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="name" class="form-label">نام محصول</label>
            <input name="name" type="text" class="form-control" id="name">
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
            <input name="company" type="text" class="form-control" id="name">
        </div>
        <div class="mb-4">
            <label for="price" class="form-label">قیمت </label>
            <input name="price" type="text" class="form-control" id="name">
        </div>
        <div class="mb-4">
            <label for="available" class="form-label">تعداد موجود در انبار </label>
            <input name="available" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <?php
            echo '<label for="category" class="form-label">دسته بندی   </label>  
                <select name="category" class="form-select rounded mb-3 " aria-label="Default select example"> ';
            $result_submenu = $link->query("SELECT * FROM category");
            if ($result_submenu->num_rows > 0) {
                while ($row_submenu = $result_submenu->fetch_assoc()) {
                    echo '<option value="' . $row_submenu['cat_id'] . '">' . $row_submenu['cat_name'] . '</option>';
                }
            }
            echo '</select>';
            ?>
        </div>
        <div class="card-body pad">
            <label for="content" class="form-label">توضیحات    </label>
            <div class="mb-3">
                <textarea class="textarea" name="content"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
        </div>
        <button type="submit" name="submit" href="" class="button btn btn-success">
            <i class="fa-solid fa-plus"></i>
            <span style="margin-left: 2px;">| </span> افزودن
        </button>
    </form>
</div>

