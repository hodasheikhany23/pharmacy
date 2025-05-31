<?php
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('1',$perm)){
    die("شما دسترسی به این صفحه ندارید");
}
$errors = [];
$fileName = null;
$resultUser = $link -> query("SELECT * FROM page_detail where pgde_page_id = '".$_GET['id']."'");
if($resultUser -> num_rows > 0){
    $rowUpdate = $resultUser -> fetch_assoc();
}
else{
    if(isset($_POST['update'])){
        $is_active = isset($_POST['is_active']) ? 1 : 2;
        if (isset($_FILES['picFile']) && $_FILES['picFile']['error'] === UPLOAD_ERR_OK) {
            $pictureExtention = substr($_FILES['picFile']['name'], strrpos($_FILES['picFile']['name'], '.') + 1);

            if (!in_array($pictureExtention, ['png', 'jpg', 'jpeg'])) {
                $error['picFile'] = 'پسوند تصویر مجاز نیست';
            }

            if ($_FILES['picFile']['size'] > 520000) {
                $error['picFile'] = (isset($error['picFile']) ? $error['picFile'] . "<br>" : "") . 'حجم فایل بیشتر از حد مجاز است';
            }
            if (!isset($error['picFile'])) {
                $fileName = date("YmdHis") . "." . $pictureExtention;
                move_uploaded_file($_FILES['picFile']['tmp_name'], "uploads/" . $fileName);
            }
        }
        else {
            $error['picFile'] = 'فایلی انتخاب نشده است';
        }
        $addResult = $link->query("INSERT INTO page_detail (pgde_title,pgde_content,pgde_page_id,pgde_image) VALUES ('" . $_POST['title']."','" . $_POST['content']  . "', '".$_GET['id']."','".$fileName."' )");
        if($link -> errno == 0){
            $errors['update_user'] = "مطالب صفحه  با موفقیت ثبت شد";
        }
        else{
            $errors['update_user_error'] = "خطا در ثبت اطلاعات";
        }
    }
}
if(isset($_POST['update'])){
    $is_active = isset($_POST['is_active']) ? 1 : 2;
    if (isset($_FILES['picFile']) && $_FILES['picFile']['error'] === UPLOAD_ERR_OK) {
        $pictureExtention = substr($_FILES['picFile']['name'], strrpos($_FILES['picFile']['name'], '.') + 1);

        if (!in_array($pictureExtention, ['png', 'jpg', 'jpeg'])) {
            $error['picFile'] = 'پسوند تصویر مجاز نیست';
        }

        if ($_FILES['picFile']['size'] > 520000) {
            $error['picFile'] = (isset($error['picFile']) ? $error['picFile'] . "<br>" : "") . 'حجم فایل بیشتر از حد مجاز است';
        }
        if (!isset($error['picFile'])) {
            $fileName = date("YmdHis") . "." . $pictureExtention;
            move_uploaded_file($_FILES['picFile']['tmp_name'], "uploads/" . $fileName);
        }
    }
    else {
        $error['picFile'] = 'فایلی انتخاب نشده است';
    }
    $updateResult = $link->query("UPDATE page_detail SET pgde_title = '" . $_POST['title'] . "', pgde_content = '" . $_POST['content'] . "', pgde_image = '" . $fileName . "' WHERE pgde_page_id = '" . clean_id($_GET['id']) . "'");
    if ($link->errno === 0) {
        $errors['update_user'] = "مطالب صفحه با موفقیت ویرایش شد";
    }
    else {
        $errors['update_user'] = "خطا در به‌روزرسانی: " . $link->error;
    }
}
if(isset($_GET['action'])){
    if($_GET['action'] == 'delete'){
        $link -> query("DELETE FROM page_detail where pgde_id = '".$_GET['id']."' ");
        if($link -> errno == 0){
            $errors['update_user'] = "مطالب صفحه  با موفقیت حذف شد";
        }
        else{
            $errors['update_user_error'] = "خطا در حذف اطلاعات";
        }
    }
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
        <h4 class="mb-4">  محتوای صفحه  </h4>
        <a href="index.php?pg=login&page=pages" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست صفحات
        </a>

    </div>
    <div class="form-container">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mt-5 border-top">
                <div class="mb-3">
                    <label for="title" class="form-label">تیتر صفحه </label>
                    <input name="title" type="text" class="form-control" id="title"  value="<?php if(isset($rowUpdate)){echo $rowUpdate['pgde_title'];} ?>">
                </div>
                <div class="form-group">
                    <div class="mb-3">
                        <label class="file-label" for="formFile">تصویر بنر </label>
                        <input class="form-control" type="file" id="formFile" name="picFile">
                    </div>
                    <?php
                    if (isset($errors['picFile'])) {
                        echo $errors['picFile'];
                    }
                    ?>
                </div>
                <div class="card card-outline card-info mb-3 mt-5">
                    <div class="card-header">
                        <h6 class="card-title">
                            متن صفحه
                        </h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                <textarea class="textarea" name="content"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php if(isset($rowUpdate)){ echo $rowUpdate['pgde_content'];} ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="update" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span><?php if(isset($rowUpdate)){echo "ثبت ویرایش";} else{echo "ثبت محتوا";} ?>
            </button>
            <?php
            if(isset($rowUpdate)){
                echo '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=pagecontent&action=delete&id='.$rowUpdate['pgde_id'].'">
                        حذف محتوا
                </a>';
            }
            ?>
        </form>
    </div>

</div>

