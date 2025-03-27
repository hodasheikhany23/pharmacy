<?php
if(!isset($_SESSION['username'])){
    die("Please <a href='includes/login.php'>login</a> to access this page");
}
$errors = [];
if(isset($_POST['submit_add'])){
    if(isset($_POST['menu_name'])){
        $menu_name = $_POST['menu_name'];
    }
    else{
        echo "Menu name is required";
    }
    $menuDuplicate = $link->query("SELECT * FROM menu WHERE menu_name = '" . $_POST['menu_name'] . "'");
    if($menuDuplicate->num_rows == 0){
        $result = $link -> query("INSERT INTO menu (menu_name) VALUES ('".$menu_name."')");
        if($link -> errno == 0){
            $errors['add_menu'] = "منوی جدید با موفقیت ثبت شد";
        }
        else{
            echo $link->error;
        }
    }
}
if(isset($_GET['action'])){
    switch($_GET['action']){
        case "delete":
            $result = $link -> query("DELETE FROM menu WHERE menu_id = '".$_GET['id']."'");
            if($link -> errno == 0){
                $errors['delete_menu'] = "منو با موفقیت حذف شد";
            }
            else if ($link -> errno == 1451){
                $errors['delete_menu'] = "خطا در حذف: این منو دارای زیر منو است. لطفا ابتدا زیر منو های مربوط را حذف کنید.";
            }
            else{
                $errors['delete_menu'] = "خطا در حذف منو";
            }
            break;
    }
}
$resultMenu = $link -> query("SELECT * FROM menu");
?>

<div class="container">
    <div class="section-title">
        <h4>لیست منو ها</h4>
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
            while($rowMenu=$resultMenu -> fetch_assoc()){
                echo '<tr>';
                echo '<td class="px-4 py-2">'.$rowMenu['menu_id'].'</td>';
                echo '<td class="px-4 py-2">'.$rowMenu['menu_name'].'</td>';
                echo '<td class="d-flex align-content-center px-4 py-2">'
                    . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?page=menus&action=delete&id='.$rowMenu['menu_id'].'">'
                    . '<i class="fa-solid fa-trash"></i>'
                    . '</a>'
                    . '<a class="btn btn-info text-white me-2" title="مشاهده زیر منو ها" href="index.php?page=listsub_menu&id='.$rowMenu['menu_id'].'">'
                    . '<i class="fa-solid fa-bars-staggered"></i>'
                    . '</a>'
                    . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td class="px-4 py-2"></td>';
            echo '<td class="px-4 py-2"><form method="post" action="" class="form-inline"><input name="menu_name" class="form-text border-0 p-2 rounded w-50" type="text" value="منوی جدید">
                    <button name="submit_add" class="btn btn-info text-white me-2 w-25" title="ثبت">
                    <i class="fa-solid fa-plus me-2" ></i>
                     ثبت
                    </button>
                    </form></td>';
            echo '<td class="d-flex align-content-center py-2">'
                . '</td>';
            echo '</tr>';
            ?>
            </tbody>
        </table>
    </div>
</div>
