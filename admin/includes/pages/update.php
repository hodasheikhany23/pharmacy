<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('1',$perm)){
    die("شما دسترسی به این صفحه ندارید");
}
$errors = [];
if(isset($_POST['update'])){
    $is_active = isset($_POST['is_active']) ? 1 : 2;
    $updateResult = $link -> query("UPDATE pages SET pg_name = '" . $_POST['name']  . "',pg_type = '" . $_POST['type']  . "' ,pg_menu_id = '" . $_POST['menu']  . "' ,pg_status = '" . $is_active  . "' where pg_id = '".$_GET['id']."' ");
    if($link -> errno == 0){
        $errors['update_user'] = "مطالب صفحه  با موفقیت ویرایش شد";
    }
    else{
        $errors['update_user_error'] = "خطا در ویرایش اطلاعات";
    }
}
$resultPage = $link -> query("SELECT * FROM pages where pg_id = '".$_GET['id']."'");
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
        <h4 class="mb-4">  ویرایش صفحه  </h4>
        <a href="index.php?pg=login&page=pages" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span> لیست صفحات
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="name" class="form-label">نام صفحه</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php if(isset($rowPage)){echo trim($rowPage['pg_name']);} ?>">
            </div>
            <div class="mb-3">
                <?php
               echo '<label for="menu" class="form-label">منو </label>  
                <select name="menu" class="form-select rounded mb-3" aria-label="Default select example"> ';
                $result_submenu = $link->query("SELECT * FROM menu");
                if ($result_submenu->num_rows > 0) {
                    while ($row_submenu = $result_submenu->fetch_assoc()) {
                        $selected = (isset($rowPage) && $row_submenu['menu_id'] == $rowPage['pg_menu_id']) ? 'selected' : '';
                        echo '<option value="' . $row_submenu['menu_id'] . '" ' . $selected . '>' . $row_submenu['menu_name'] . '</option>';

                    }
                }
                echo '</select>';
                ?>
            </div>
            <div class="mb-3">
                <?php
                echo '<label for="type" class="form-label">نوع صفحه </label>  
                <select name="type" class="form-select rounded mb-3" aria-label="Default select example"> ';
                $result_type = $link->query("SELECT * FROM page_type");
                if ($result_type->num_rows > 0) {
                    while ($row_type = $result_type->fetch_assoc()) {
                        // Use a ternary operator to determine if the option should be selected
                        $selected = (isset($rowPage) && $row_type['pgt_id'] == $rowPage['pg_type']) ? 'selected' : '';
                        echo '<option value="' . $row_type['pgt_id'] . '" ' . $selected . '>' . $row_type['pgt_name'] . '</option>';
                    }
                }
                echo '</select>';
                ?>
            </div>
            <div class="mb-3 form-check">
                <input name="is_active" type="checkbox" class="form-check-input" id="is_active"
                    <?php if (isset($rowPage) && $rowPage['pg_status'] == 1) echo 'checked'; ?> >
                <label class="form-check-label" for="is_active">صفحه فعال است  </label>
            </div>
            <div class="mt-5 border-top">
            <button type="submit" name="update" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> ثبت ویرایش
            </button>
        </form>
    </div>

</div>

