<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username'])){
    die("Please <a href='includes/login.php'>login</a> to access this page");
}
$errors = [];
if(isset($_POST['submit_add'])){
    if(isset($_POST['cat_name'])){
        $cat_name = $_POST['cat_name'];
    }
    else{
        echo "category name is required";
    }
    $catDuplicate = $link->query("SELECT * FROM category WHERE cat_name = '" . $_POST['cat_name'] . "'");
    if($catDuplicate->num_rows == 0){
        $result = $link -> query("INSERT INTO category (cat_name, cat_subm_id) VALUES ('".$cat_name."','".$_POST['subm_category']."')");
        if($link -> errno == 0){
            $errors['add_category'] = "منوی جدید با موفقیت ثبت شد";
        }
        else{
            echo $link->error;
        }
    }
}
if(isset($_GET['action'])){
    switch($_GET['action']){
        case "delete":
            $result = $link -> query("DELETE FROM category WHERE cat_id = '".$_GET['id']."'");
            if($link -> errno == 0){
                $errors['delete_category'] = "منو با موفقیت حذف شد";
            }
            else if ($link -> errno == 1451){
                $errors['delete_category'] = "خطا در حذف: این منو دارای زیر منو است. لطفا ابتدا زیر منو های مربوط را حذف کنید.";
            }
            else{
                $errors['delete_category'] = "خطا در حذف منو";
            }
            break;
    }
}
$resultcategory = $link -> query("SELECT * FROM category");
?>
<div class="container">
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4>لیست دسته بندی ها</h4>
    </div>
    <div>
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($rowcategory=$resultcategory -> fetch_assoc()){
                echo '<tr>';
                echo '<td class="px-4 py-2">'.$rowcategory['cat_id'].'</td>';
                echo '<td class="px-4 py-2">'.$rowcategory['cat_name'].'</td>';
                echo '<td class="d-flex align-content-center px-4 py-2">'
                    . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?page=categories&action=delete&id='.$rowcategory['cat_id'].'">'
                    . '<i class="fa-solid fa-trash"></i>'
                    . '</a>'
                    . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td class="px-4 py-2"></td>';
            echo '<td class="px-4 py-2">  
                    <form method="post" action="" class="form-inline">  
                        <input name="cat_name" class="form-text border-0 p-2 rounded w-50" type="text" value="دسته بندی جدید">  
                        <select name="subm_category" class="form-select rounded mr-2" style="width: 25% !important;" aria-label="Default select example">  
                            <option selected disabled>  انتخاب زیر منو   </option>';
            $result_submenu = $link -> query("SELECT * FROM sub_menu");
            if ($result_submenu->num_rows > 0) {
                while ($row_submenu = $result_submenu->fetch_assoc()) {
                    echo '<option value="' . $row_submenu['subm_id'] . '">' . $row_submenu['subm_name'] . '</option>';
                }
            }

            echo '      </select> 
                        <button name="submit_add" class="btn btn-info text-white me-2" style="width: 15% !important;" title="ثبت">  
                            <i class="fa-solid fa-plus me-2"></i>  
                            ثبت  
                        </button>  
                    </form>  
                  </td>';
            echo '<td class="d-flex align-content-center py-2"></td>';
            echo '</tr>';
            ?>
            </tbody>
        </table>
    </div>
</div>


