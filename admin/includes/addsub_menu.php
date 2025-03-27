<?php
if(!isset($_SESSION['username'])){
    die("Please <a href='includes/login.php'>login</a> to access this page");
}
$errors = [];
$resultMenu = $link -> query("SELECT * FROM menu");
if($resultMenu ->num_rows != 0){
    $rowMenu = $resultMenu -> fetch_assoc();
}
if(isset($_POST['submit_submenu'])){
    if(isset($_POST['sub_name']) && isset($_POST['menu_name'])){
         $resultSubMenu = $link -> query(" INSERT INTO sub_menu (subm_name, subm_menu_id) VALUES ('".$_POST['sub_name']."', '".$_POST['menu_name']."')");
        if($link->errno == 0){
            $errors['sub_menu'] = "Sub menu added";
        }
    }
}
if(isset($errors['sub_menu'])){
    echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['sub_menu'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
}
?>

<div class="section-title">
    <h4 class="mb-4">ایجاد زیر منو</h4>
</div>
<div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="sub_name" class="form-label">نام زیر منو</label>
                <input name="sub_name" type="text" class="form-control" id="sub_name" required>
            </div>
            <?php
            if(isset($errors['username'])){
                echo '<div class="alert" role="alert">' . $errors['username'] . ' </div>';
            }
            ?>
            <label for="menu_name" class="form-label"> انتخاب منوی اصلی</label>
            <select class="form-select mb-5" size="5" aria-label=".form-select-lg example" id="menu_name" name="menu_name">
                <?php
                while($rowMenu = $resultMenu -> fetch_assoc()){
                    echo '<option value="' . $rowMenu['menu_id'] . '">' . $rowMenu['menu_name'] . '</option>';
                }
                ?>
            </select>
            <button type="submit" name="submit_submenu" href="" class="button btn btn-success">
                <i class="fa-solid fa-plus"></i>
                <span style="margin-left: 2px;">| </span> افزودن
            </button>
        </form>
    </div>