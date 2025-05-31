<?php
defined('site') or die('Acces denied');
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('9',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors = [];
$result_blog = $link->query("SELECT * FROM blog WHERE blg_id = '".$_GET['id']."'");
if($result_blog->num_rows > 0){
    $row_blog = $result_blog->fetch_assoc();
}
if(isset($_POST['submit'])){
    if (isset($_FILES['image']) && isset($_POST['name']) && isset($_POST['tag'])) {
        $files = $_FILES['image'];
        $fileTmpPath = $files['tmp_name'];
        $fileName = $files['name'];
        $fileSize = $files['size'];
        $fileType = $files['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $upload_dir = 'uploads/';
        $new_name = time() . '.' . $fileExt;
        $dest_path = $upload_dir . $new_name;
        $time = jdate("Y-F");
        $status = $_POST["status"];
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $sql_insert = "UPDATE blog SET blg_status = '".$_POST["status"]."', blg_title = '".$_POST['name']."', blg_cover = '".$dest_path."', blg_tag = '".$_POST['tag']."', blg_date = '".$time."' WHERE blg_id = '".$_GET['id']."'";
            if($link->query($sql_insert) === TRUE){
                $errors['success'] = "  اطلاعات با موفقیت ویرایش شد";
            }
            else{
                $errors['failed'] = "خطا در ویرایش اطلاعات";

            }
        }
    }
    else{
        $errors['failed'] = "لطفا همه اطلاعات را وارد کنید";
    }
}
?>
<div class="container">

    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['success'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['success'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['failed'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['failed'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 1rem !important; padding-top: 0 !important;">
        <h4 class="mb-4">ویرایش مقاله  </h4>
        <a href="index.php?pg=login&page=blogs" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست مقالات
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="form-label">نام مقاله</label>
                <input name="name" type="text" class="form-control" id="name" required value="<?php if(isset($row_blog['blg_title'])) echo $row_blog['blg_title']; ?>">
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">موضوع (تگ) </label>
                <input name="tag" type="text" class="form-control" id="tag" required value="<?php if(isset($row_blog['blg_tag'])) echo $row_blog['blg_tag']; ?>">
            </div>
            <div id="dynamic-slides">
                <label for="formFile" class="form-label"> تصویر کاور </label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="mb-3 mt-4">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1"
                        <?php echo ($row_blog['blg_status'] == '1') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="inlineRadio1">حالت انتشار</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0"
                        <?php echo ($row_blog['blg_status'] == '0') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="inlineRadio2">حالت پیش‌نویس</label>
                </div>
            </div>
            <button type="submit" name="submit" href="" class="button btn btn-success mt-4">
                <i class="fa-solid fa-pencil-alt"></i>
                <span style="margin-left: 2px;">| </span> ویرایش
            </button>
        </form>
    </div>
</div>