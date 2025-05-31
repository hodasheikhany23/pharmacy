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
if(isset($_POST['sub-image'])){
    $files = $_FILES['image'];
    $fileTmpPath = $files['tmp_name'];
    $fileName = $files['name'];
    $fileSize = $files['size'];
    $fileType = $files['type'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $upload_dir = 'uploads/';
    $new_name = time() . '.' . $fileExt;
    $dest_path = $upload_dir . $new_name;

    $priority = 0;
    if(move_uploaded_file($fileTmpPath, $dest_path)) {
        $result_priority = $link -> query("SELECT blgde_priority FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."'");
        if($result_priority->num_rows > 0){
            while($row_priority = $result_priority->fetch_assoc()){
                $priority+=1;
            }
        }
        $result_title = $link->query("INSERT INTO blog_detail (blgde_blog_id,blgde_image,blgde_priority) VALUES ('".$_GET['id']."','". $dest_path."','".$priority."')");
        if($link->errno==0){
            $errors['success'] = 'تصویر مورد نظر با موفقیت افزوده شد';
        }
        else{
            $errors['failed'] = 'خطا در افزودن تصویر';
        }
    }

}
if(isset($_POST['sub-link'])){
    $title = $_POST['title'];
    $a = $_POST['link'];
    $priority = 0;
    $result_priority = $link -> query("SELECT blgde_priority FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."'");
    if($result_priority->num_rows > 0){
        while($row_priority = $result_priority->fetch_assoc()){
            $priority+=1;
        }
    }
    $result_title = $link->query("INSERT INTO blog_detail (blgde_blog_id,blgde_link_name,blgde_link,blgde_priority) VALUES ('".$_GET['id']."','". $title."','".$a."','".$priority."')");
    if($link->errno==0){
        $errors['success'] = 'بخش مورد نظر با موفقیت افزوده شد';
    }
    else{
        $errors['failed'] = 'خطا در افزودن بخش';
    }
}
if(isset($_POST['sub-para'])){
    $text = $_POST['text'];
    $priority = 0;
    $result_priority = $link -> query("SELECT blgde_priority FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."'");
    if($result_priority->num_rows > 0){
        while($row_priority = $result_priority->fetch_assoc()){
            $priority+=1;
        }
    }
    $result_title = $link->query("INSERT INTO blog_detail (blgde_blog_id,blgde_paragraph,blgde_priority) VALUES ('".$_GET['id']."','". $text."','".$priority."')");
    if($link->errno==0){
        $errors['success'] = 'بخش مورد نظر با موفقیت افزوده شد';
    }
    else{
        $errors['failed'] = 'خطا در افزودن بخش';
    }
}
if(isset($_POST['sub-label'])){
    $text = $_POST['label'];
    $array = explode("،", $text);
    $priority = 0;
    foreach($array as $label){
        $result_priority = $link -> query("SELECT blgde_priority FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."'");
        if($result_priority->num_rows > 0){
            while($row_priority = $result_priority->fetch_assoc()){
                $priority+=1;
            }
        }
        $result_title = $link->query("INSERT INTO blog_detail (blgde_blog_id,blgde_label,blgde_priority) VALUES ('".$_GET['id']."','". $label."','".$priority."')");
    }
    if($link->errno==0){
        $errors['success'] = 'برچسب  با موفقیت افزوده شد';
    }
    else{
        $errors['failed'] = 'خطا در افزودن برچسب';
    }
}
if(isset($_POST['sub-h'])){
    $title = $_POST['title'];
    $priority = 0;
    $result_priority = $link -> query("SELECT blgde_priority FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."'");
    if($result_priority->num_rows > 0){
        while($row_priority = $result_priority->fetch_assoc()){
            $priority+=1;
        }
    }
    $result_title = $link->query("INSERT INTO blog_detail (blgde_blog_id,blgde_heading,blgde_priority) VALUES ('".$_GET['id']."','". $title."','".$priority."')");
    if($link->errno==0){
        $errors['success'] = 'بخش مورد نظر با موفقیت افزوده شد';
    }
    else{
        $errors['failed'] = 'خطا در افزودن بخش';
    }
}
if(isset($_POST['edit_img'])){
    $files = $_FILES['image'];
    $fileTmpPath = $files['tmp_name'];
    $fileName = $files['name'];
    $fileSize = $files['size'];
    $fileType = $files['type'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $upload_dir = 'uploads/';
    $new_name = time() . '.' . $fileExt;
    $dest_path = $upload_dir . $new_name;
    $id = $_POST['id'];
    if(move_uploaded_file($fileTmpPath, $dest_path)) {
        $result_title = $link->query("UPDATE blog_detail SET blgde_image = '" . $dest_path . "' WHERE blgde_id = '" . $id . "'");
        if ($link->errno == 0) {
            $errors['success'] = 'تصویر مورد نظر با موفقیت ویرایش شد';
        } else {
            $errors['failed'] = 'خطا در ویرایش تصویر';
        }
    }
}
if(isset($_POST['edit_label'])){
    $text = $_POST['label'];
    $array = explode("،", $text);
    $result_del = $link->query("DELETE FROM blog_detail WHERE blgde_label IS NOT NULL and blgde_blog_id = '".$_GET['id']."'");
    $priority = 0;
    foreach($array as $label){
        $result_priority = $link -> query("SELECT blgde_priority FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."'");
        if($result_priority->num_rows > 0){
            while($row_priority = $result_priority->fetch_assoc()){
                $priority+=1;
            }
        }
        $result_title = $link->query("INSERT INTO blog_detail (blgde_blog_id,blgde_label,blgde_priority) VALUES ('".$_GET['id']."','". $label."','".$priority."')");
    }
    if($link->errno==0){
        $errors['success'] = 'برچسب  با موفقیت ویرایش شد';
    }
    else{
        $errors['failed'] = 'خطا در ویرایش برچسب';
    }
}
if(isset($_POST['edit_paragraph'])){
    $text = $_POST['text'];
    $id = $_POST['id'];
    $result_title = $link->query("UPDATE blog_detail SET blgde_paragraph = '".$text."' WHERE blgde_id = '".$id."'");
    if($link->errno==0){
        $errors['success'] = 'پاراگراف مورد نظر با موفقیت ویرایش شد';
    }
    else{
        $errors['failed'] = 'خطا در ویرایش پاراگراف';
    }
}
if(isset($_POST['edit_heading'])){
    $title = $_POST['title'];
    $id = $_POST['id'];
    $result_title = $link->query("UPDATE blog_detail SET blgde_heading = '".$title."' WHERE blgde_id = '".$id."'");
    if($link->errno==0){
        $errors['success'] = 'تیتر مورد نظر با موفقیت ویرایش شد';
    }
    else{
        $errors['failed'] = 'خطا در ویرایش تیتر';
    }
}
if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $result_delete = $link->query("DELETE FROM blog_detail WHERE blgde_id = '".$_GET['idd']."'");
    if($result_delete){
        $errors['success'] = 'بخش مورد نظر با موفقیت حذف شد';
    }
    else{
        $errors['failed'] = 'خطا در حذف';
    }
}

$result_blogde = $link->query("SELECT * FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."' order by blgde_priority");

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
        <h4 class="mb-4">مطالب مقاله   </h4>
        <a href="index.php?pg=login&page=blogs" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست مقالات
        </a>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center align-content-center">
        <div class="d-flex justify-content-center align-items-center align-content-center flex-column">
            <img src="<?php echo $row_blog['blg_cover']; ?>" style="width: 800px; height: 400px; object-fit: cover; border-radius: 12px">
            <h2 class="mt-4"><?php echo $row_blog['blg_title']?></h2>
        </div>
        <div class="w-100 mt-3 d-flex justify-content-center align-items-center flex-column">
            <div class="mt-2 w-75 card border-0 bg-white rounded d-flex flex-row justify-content-between align-items-center align-content-center gap-4 px-4 py-3">
                <form method="post" class="w-75">
                    <div class="mb-3">
                        <?php
                        $list = [];
                        $label = $link->query("SELECT blgde_label FROM blog_detail WHERE blgde_blog_id = '".$_GET['id']."' AND blgde_label IS NOT NULL");
                        while($row_label = $label->fetch_array()){
                            $list[] = $row_label['blgde_label'];
                        }
                        if(isset($list)){
                            $string = implode("،",$list);
                        }
                        ?>
                        <label for="exampleFormControlTextarea1" class="form-label">  برچسب ها (برای جداسازی از " ، " استفاده کنید)</label>
                        <textarea name="label" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php if(isset($string))echo $string; ?></textarea>
                        <?php
                        if(isset($string)&& $string!=""){
                            echo '<button type="submit" name="edit_label" href="" class="button btn btn-success mt-1">
                            <i class="fa-solid fa-pencil-alt"></i> <span style="margin-left: 2px;">| </span> ویرایش </button>';
                        }
                        else{
                            echo '<button type="submit" name="sub-label" href="" class="button btn btn-success mt-1">
                            <i class="fa-solid fa-check"></i> <span style="margin-left: 2px;">| </span> ثبت </button>';
                        }
                        ?>

                    </div>
                </form>
            </div>
            <?php
            if($result_blogde->num_rows > 0){
               while ($row_blogde = $result_blogde->fetch_assoc()){
                   echo '<div class="w-75 d-flex justify-content-between flex-row">';
                   if(isset($row_blogde['blgde_heading'])) {
                       echo '<div class="mt-2 w-75 card border-0 bg-white rounded d-flex flex-row justify-content-between align-items-center align-content-center gap-4 px-4 py-3">';
                       echo '<h4>' . $row_blogde['blgde_heading'] . '</h4>';
                       echo '</div>';
                       echo '<div class="mt-2 mx-3 d-flex flex-row card rounded border-0 px-4 py-3" style="height: 70px !important;">
                    <button class="btn btn-info text-white me-2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row_blogde['blgde_id'] . '" data-bs-whatever="@getbootstrap' . $row_blogde['blgde_id'] . '" title="ویرایش">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                     <div class="modal fade" id="exampleModal' . $row_blogde['blgde_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row_blogde['blgde_id'] . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش تیتر  </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input style="visibility: hidden" type="text" name="id" class="form-control" id="recipient-name" value="' . $row_blogde['blgde_id'] . '">
                                            <label for="recipient-name" class="col-form-label">تیتر:</label>
                                            <input type="text" name="title" class="form-control" id="recipient-name" value="' . $row_blogde['blgde_heading'] . '">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                            <button class="btn button btn-primary" name="edit_heading"><i class="fas fa-pencil-alt"></i> ویرایش</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger text-white me-2" href="index.php?pg=login&page=blogcontent&id='.$row_blog['blg_id'].'&action=delete&idd=' . $row_blogde['blgde_id'] . '" title="حذف">
                    <i class="fa-solid fa-trash"></i>
                    </a>
                    </div>';
                   }
                   if(isset($row_blogde['blgde_paragraph'])) {
                       echo '<div class="mt-2 w-75 card border-0 bg-white rounded d-flex flex-row justify-content-between align-items-center align-content-center gap-4 px-4 py-3">';
                       echo '<p>' . $row_blogde['blgde_paragraph'] . '</p>';
                       echo '</div>';
                       echo '<div class="mt-2 mx-3 d-flex flex-row card rounded border-0 px-4 py-3" style="height: 70px !important;">
                    <button class="btn btn-info text-white me-2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row_blogde['blgde_id'] . '" data-bs-whatever="@getbootstrap' . $row_blogde['blgde_id'] . '" title="ویرایش">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                     <div class="modal fade" id="exampleModal' . $row_blogde['blgde_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row_blogde['blgde_id'] . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش پاراگراف  </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input style="visibility: hidden" type="text" name="id" class="form-control" id="recipient-name" value="' . $row_blogde['blgde_id'] . '">
                                            <label for="recipient-name" class="col-form-label">پارگراف:</label>
                                            <textarea style="height: 400px!important;" type="text" name="text" class="form-control" id="recipient-name">' . $row_blogde['blgde_paragraph'] . '</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                            <button class="btn button btn-primary" name="edit_paragraph"><i class="fas fa-pencil-alt"></i> ویرایش</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger text-white me-2" href="index.php?pg=login&page=blogcontent&id='.$row_blog['blg_id'].'&action=delete&idd=' . $row_blogde['blgde_id'] . '" title="حذف">
                    <i class="fa-solid fa-trash"></i>
                    </a>
                    </div>';
                   }
                   if(isset($row_blogde['blgde_link'])) {
                       echo '<div class="mt-2 w-75 card border-0 bg-white rounded d-flex flex-row justify-content-between align-items-center align-content-center gap-4 px-4 py-3">';
                       echo '<a class="text-decoration-underline" style="color:var(--color-main)!important;" href="'.$row_blogde['blgde_link'].'"><i class="bi bi-link-45deg mx-2"></i>' . $row_blogde['blgde_link_name'] . '</a>';
                       echo '</div>';
                       echo '<div class="mt-2 mx-3 d-flex flex-row card rounded border-0 px-4 py-3" style="height: 70px !important;">
                    <button class="btn btn-info text-white me-2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row_blogde['blgde_id'] . '" data-bs-whatever="@getbootstrap' . $row_blogde['blgde_id'] . '" title="ویرایش">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                     <div class="modal fade" id="exampleModal' . $row_blogde['blgde_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row_blogde['blgde_id'] . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش پاراگراف  </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input style="visibility: hidden" type="text" name="id" class="form-control" id="recipient-name" value="' . $row_blogde['blgde_id'] . '">
                                            <label for="recipient-name" class="col-form-label">پارگراف:</label>
                                            <textarea style="height: 400px!important;" type="text" name="text" class="form-control" id="recipient-name">' . $row_blogde['blgde_paragraph'] . '</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                            <button class="btn button btn-primary" name="edit_paragraph"><i class="fas fa-pencil-alt"></i> ویرایش</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger text-white me-2" href="index.php?pg=login&page=blogcontent&id='.$row_blog['blg_id'].'&action=delete&idd=' . $row_blogde['blgde_id'] . '" title="حذف">
                    <i class="fa-solid fa-trash"></i>
                    </a>
                    </div>';
                   }
                   if(isset($row_blogde['blgde_image'])) {
                       echo '<div class="mt-2 w-75 card border-0 bg-white rounded d-flex flex-row justify-content-between align-items-center align-content-center gap-4 px-4 py-3">';
                       echo '<img style="width: 500px; height:300px; object-fit:cover;" src="' . $row_blogde['blgde_image'] . '">';
                       echo '</div>';
                       echo '<div class="mt-2 mx-3 d-flex flex-row card rounded border-0 px-4 py-3" style="height: 70px !important;">
                    <button class="btn btn-info text-white me-2" data-bs-toggle="modal" data-bs-target="#exampleModal' . $row_blogde['blgde_id'] . '" data-bs-whatever="@getbootstrap' . $row_blogde['blgde_id'] . '" title="ویرایش">
                    <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                     <div class="modal fade" id="exampleModal' . $row_blogde['blgde_id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $row_blogde['blgde_id'] . '" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش پاراگراف  </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <input style="visibility: hidden" type="text" name="id" class="form-control" id="recipient-name" value="' . $row_blogde['blgde_id'] . '">
                                            <label for="recipient-name" class="col-form-label">تصویر:</label>
                                            <input name="image" value="بارگذاری تصویر" required class="form-control" type="file" id="formFile">                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                            <button class="btn button btn-primary" name="edit_img"><i class="fas fa-pencil-alt"></i> ویرایش</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-danger text-white me-2" href="index.php?pg=login&page=blogcontent&id='.$row_blog['blg_id'].'&action=delete&idd=' . $row_blogde['blgde_id'] . '" title="حذف">
                    <i class="fa-solid fa-trash"></i>
                    </a>
                    </div>';
                   }
                   echo '</div>';

               }
            }
            ?>
        </div>
        <form method="post" action="" id="content" enctype="multipart/form-data" class="d-none w-75 px-4 py-3 mt-5 card border-0 bg-white rounded d-flex flex-column justify-content-between align-items-center align-content-center">
        </form>
        <div class="mt-3 card border-0 bg-white rounded d-flex flex-row justify-content-between align-items-center align-content-center gap-4 px-4 py-3 mb-5 w-75">
            <h6> <i class="fa-solid fa-plus mx-3"></i>افزودن بخش </h6>
            <div>
                <button class="btn btn-primary button" onclick="add_h()"><i class="bi bi-type-h3"></i>تیتر</button>
                <button class="btn btn-primary button" onclick="add_paragraph()"><i class="bi bi-text-paragraph"></i>پاراگراف</button>
                <button class="btn btn-primary button" onclick="add_image()"><i class="bi bi-card-image"></i>تصویر</button>
                <button class="btn btn-primary button" onclick="add_link()"><i class="bi bi-link-45deg"></i>لینک</button>

            </div>
        </div>

    </div>

</div>

<script>
    function add_link(){
        let div = document.getElementById('content');
        div.classList.remove('d-none');
        div.innerHTML='<div class="mb-4 w-100"><label for="title" class="form-label"> ایجاد لینک: </label>'+
            '<input name="title" type="text" placeholder="متن" class="form-control" id="title" required> </div>'+
            '<input name="link" placeholder="آدرس لینک" type="text" class="form-control" id="title" required> </div>'+
            '<button type="submit" name="sub-link" href="" class="button btn btn-success mt-1">'+
            '<i class="fa-solid fa-check"></i> <span style="margin-left: 2px;">| </span> ثبت </button>';
    }
    function add_image(){
        let div = document.getElementById('content');
        div.classList.remove('d-none');
        div.innerHTML='<div class="mb-4 w-100"><label for="image" class="form-label">افزودن تصویر </label>'+
            ' <input name="image" value="بارگذاری تصویر" required class="form-control" type="file" id="formFile"> </div>'+
            '<button type="submit" name="sub-image" href="" class="button btn btn-success mt-1">'+
            '<i class="fa-solid fa-check"></i> <span style="margin-left: 2px;">| </span> بارگذاری </button>';
    }
    function add_paragraph(){
        let div = document.getElementById('content');
        div.classList.remove('d-none');
        div.innerHTML='<div class="mb-4 w-100"><label for="text" class="form-label">افزودن پارگراف </label>'+
            '<textarea name="text" type="text" class="form-control" style="max-height: 400px; min-height: 300px;" id="text" required></textarea> </div>'+
            '<button type="submit" name="sub-para" href="" class="button btn btn-success mt-1">'+
            '<i class="fa-solid fa-check"></i> <span style="margin-left: 2px;">| </span> ثبت </button>';
    }
    function add_h(){
        let div = document.getElementById('content');
        div.classList.remove('d-none');
        div.innerHTML='<div class="mb-4"><label for="title" class="form-label">افزودن تیتر </label>'+
            '<input name="title" type="text" class="form-control" id="title" required> </div>'+
            '<button type="submit" name="sub-h" href="" class="button btn btn-success mt-1">'+
            '<i class="fa-solid fa-check"></i> <span style="margin-left: 2px;">| </span> ثبت </button>';
    }
</script>