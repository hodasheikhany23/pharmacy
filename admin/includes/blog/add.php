<?php
defined('site') or die('Acces denied');
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('9',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors = [];
$messages = [];
if(isset($_POST['submit'])){
    if (isset($_FILES['image']) && isset($_POST['name']) && isset($_POST['tag'])) {
        if (mb_strlen(clean_data($_POST['name'])) > 2) {
            $name = clean_data($_POST['name']);
        }
        else {
            $errors['name'] = '<div class="alert" role="alert">' . 'نام باید حداقل 2 کاراکتر باشد' . ' </div>';
        }
        if (mb_strlen(clean_data($_POST['tag'])) > 2) {
            $tag = clean_data($_POST['tag']);
        }
        else {
            $errors['tag'] = '<div class="alert" role="alert">' . 'تگ باید حداقل 2 کاراکتر باشد' . ' </div>';
        }
        $pictureExtention = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.')+1);
        if(!in_array($pictureExtention, ['png', 'jpg', 'jpeg','webp'])) {
            $errors['type'] = '<div class="alert" role="alert">' . 'پسوند مجاز نیست' . ' </div>';
        }
        if($_FILES['image']['size'] > 520000) {
            $errors['image']= (isset($errors['image'])? $errors['image']."<br>":"").'<div class="alert" role="alert">' . 'حجم فایل بیشتر از حد مجاز است' . ' </div>';
        }
        $status = 0;
        if(isset($_POST['status'])) {
            if($_POST['status'] === '0' || $_POST['status'] === '1') {
                $status = (int)$_POST['status'];
            } else {
                $errors['status'] = "مقدار وضعیت انتشار نامعتبر است!";
            }
        }
        if(empty($errors)) {
            $files = $_FILES['image'];
            $upload_dir = 'uploads/';
            $new_name = time() . '.' . $pictureExtention;
            $dest_path = $upload_dir . $new_name;
            $fileTmpPath = $files['tmp_name'];
            $time = jdate("Y,F");
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $sql_insert = "INSERT INTO blog (blg_title, blg_cover, blg_date, blg_tag, blg_status) VALUES ('".$name."', '".$dest_path."', '".$time."', '".$tag."','".$status."')";
                if($link->query($sql_insert) === TRUE){
                    $messages['success'] = "  اطلاعات با موفقیت بارگذاری شد";
                }
                else{
                    $messages['failed'] = "خطا رد بارگذاری اطلاعات";

                }
            }
        }

    }
    else{
        $messages['failed'] = "لطفا همه اطلاعات را وارد کنید";
    }
}
?>
<div class="container">

    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($messages['success'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$messages['success'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($messages['failed'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$messages['failed'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 1rem !important; padding-top: 0 !important;">
        <h4 class="mb-4">افزودن مقاله جدید  </h4>
        <a href="index.php?pg=login&page=blogs" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست مقالات
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="form-label">نام مقاله</label>
                <input name="name" type="text" class="form-control" id="name" required>
                <?php
                if(isset($errors['name'])){
                    echo '<div class="alert" role="alert">' . $errors['name'] . ' </div>';
                }
                ?>
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">موضوع (تگ) </label>
                <input name="tag" type="text" class="form-control" id="tag" required>
                <?php
                if(isset($errors['tag'])){
                    echo '<div class="alert" role="alert">' . $errors['tag'] . ' </div>';
                }
                ?>
            </div>
            <div id="dynamic-slides">
                <label for="formFile" class="form-label"> تصویر کاور </label>
                <input class="form-control" type="file" id="formFile" name="image">
                <?php
                if(isset($errors['image'])){
                    echo '<div class="alert" role="alert">' . $errors['image'] . ' </div>';
                }
                if(isset($errors['type'])){
                    echo '<div class="alert" role="alert">' . $errors['type'] . ' </div>';
                }
                ?>
            </div>
            <div class="mb-3 mt-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
                    <label class="form-check-label" for="inlineRadio1">حالت انتشار </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                    <label class="form-check-label" for="inlineRadio2">حالت پیش نویس </label>
                </div>
                <?php
                if(isset($errors['status'])){
                    echo '<div class="alert" role="alert">' . $errors['status'] . ' </div>';
                }
                ?>
            </div>
            <button type="submit" name="submit" href="" class="button btn btn-success mt-4">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن
            </button>
        </form>
    </div>
</div>