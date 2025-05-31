<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('16',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors = [];
if(isset($_POST['update'])){
    if (isset($_FILES['image'])) {
        $files = $_FILES['image'];
        $fileTmpPath = $files['tmp_name'];
        $fileName = $files['name'];
        $fileSize = $files['size'];
        $fileType = $files['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $upload_dir = 'banner_images/';
        $new_name = time() . 'includes' . $fileExt;
        $dest_path = $upload_dir . $new_name;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $sql_insert = "UPDATE banners SET banner_image ='" . $dest_path . "', banner_category = '".$_POST['category']."', banner_drog ='".$_POST['drug']."'  where banner_id = '" . $_GET['id'] . "'";
            $link->query($sql_insert);
            if($link->query($sql_insert) === TRUE){
                $errors['success'] = "  تصویر با موفقیت بارگذاری شد";
            }
            else{
                $errors['faild'] = "خطا رد بارگذاری تصویر";

            }
        }

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
        if(isset($errors['faild'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['faild'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-4">  ویرایش تصویر  </h4>
        <a href="index.php?pg=login&page=banners" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span>   لیست تصاویر
        </a>
    </div>
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data" id="slidesForm">
            <div id="dynamic-slides">
                <label for="formFile" class="form-label"> انتخاب فایل</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <?php
            echo '<label for="category" class="form-label mt-4">دسته بندی   </label>  
                <select name="category" id="category" class="form-select rounded mb-3 " aria-label="Default select example"> ';
            $result_submenu = $link->query("SELECT * FROM category");
            if ($result_submenu->num_rows > 0) {
                while ($row_submenu = $result_submenu->fetch_assoc()) {
                    $result_menu = $link->query("SELECT * FROM sub_menu where subm_id = '".$row_submenu['cat_subm_id']."'");
                    if ($result_menu->num_rows > 0) {
                        $row_menu = $result_menu->fetch_assoc();
                    }
                    echo '<option value="' . $row_submenu['cat_id'] . '">' . $row_submenu['cat_name'] . ' __  '.$row_menu['subm_name'].'</option>';
                }
            }
            echo '</select>';
            echo '<label for="category" class="form-label mt-4">محصول    </label>  
                <select name="drug" id="drug" class="form-select rounded mb-3 " aria-label="Default select example"> ';
            echo '<option value=""> هیچ دارویی انتخاب نشده است</option>';
            $result_submenu = $link->query("SELECT * FROM category");
            $result_drg = $link->query("SELECT * FROM drogs");
            if ($result_drg->num_rows > 0) {
                while ($row_drg = $result_drg->fetch_assoc()) {
                    $result_menu = $link->query("SELECT * FROM category where cat_id = '".$row_drg['drg_category_id']."'");
                    if ($result_menu->num_rows > 0) {
                        $row_menu = $result_menu->fetch_assoc();
                    }
                    echo '<option value="' . $row_drg['drg_id'] . '" data-category="' . $row_drg['drg_category_id'] . '">' . $row_drg['drg_name'] . ' __  '.$row_menu['cat_name'].'</option>';                }
            }
            echo '</select>';
            ?>
            <button type="submit" name="update" href="" class="button btn btn-success mt-4">
                <i class="bi bi-upload"></i>
                <span style="margin-left: 2px;">| </span> بارگذاری تصویر
            </button>
        </form>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.querySelector('select[name="category"]'); // سلکت دسته بندی بالا
        const drugSelect = document.querySelector('select[name="category"]'); // سلکت دارو پایین (حواست باشه نام‌ها رو تغییر بده چون هر دو "category" هستند)


        const drugSelectElement = document.querySelector('select[name="drug"]');

        categorySelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            Array.from(drugSelectElement.options).forEach(function(option) {
                const optionCategory = option.getAttribute('data-category');
                if (optionCategory === selectedCategory || selectedCategory === '') {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
            drugSelectElement.selectedIndex = 0;
        });
    });
</script>
