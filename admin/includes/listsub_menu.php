<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
$errors = [];

if(isset($_POST['submit_submenu'])){
    if(isset($_POST['sub_name']) && isset($_GET['id'])){
        $resultSubMenu = $link -> query(" INSERT INTO sub_menu (subm_name, subm_menu_id) VALUES ('".$_POST['sub_name']."', '".$_GET['id']."')");
        if($link->errno == 0){
            $errors['sub_menu'] = "زیر منو با موفقیت افزوده شد";
        }
        else{
            $errors['sub_menu_error'] = "خطا در ثبت زیر منو";
        }
    }
}
if(isset($_GET['action'])){
    if($_GET['action'] == 'deletesub'){
        $link -> query("DELETE FROM sub_menu WHERE subm_id = '".$_GET['subid']."'");
        if($link->errno == 0){
            $errors['sub_menu'] = "زیر منو با موفقیت حذف شد";
        }
        else if ($link -> errno == 1451){
            $errors['delete'] = "خطا در حذف: این منو دارای اطلاعات وابسته (زیر منو یا صفحه) است. لطفا ابتدا اطلاعات وابسته را حذف کنید.";
        }
        else{
            $errors['sub_menu_error'] = "خطا در حذف";
        }
    }
}
$resultMenu = $link -> query("SELECT * FROM sub_menu where subm_menu_id = '".$_GET['id']."'");
$resultSubMenu = $link -> query("SELECT * FROM menu");
if($resultSubMenu ->num_rows != 0){
    $rowMenu = $resultSubMenu -> fetch_assoc();
}
?>
<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['sub_menu'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['sub_menu'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['sub_menu_error'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['sub_menu_error'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <?php
        $resultMenuName=$link -> query("SELECT * FROM menu where menu_id = '".$_GET['id']."'");
        if($resultMenuName ->num_rows != 0 && $link->errno == 0){
            $rowMenuName=$resultMenuName -> fetch_assoc();
        }
        ?>
        <h4 class="mb-4">
            لیست زیر منو ها
            <?php
            if (isset($rowMenuName)){
                echo '<span style="color: #3C7BBF">(' .$rowMenuName['menu_name']. ')</span>';
            }
            ?>
        </h4>
        <a href="index.php?pg=login&page=menus" type="submit" class="button btn btn-primary sign">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span>لیست منو های اصلی
        </a>
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
                echo '<tr id="row_'.$rowMenu['subm_id'].'">';
                echo '<td class="px-4 py-2">'.$rowMenu['subm_id'].'</td>';
                echo '<td class="px-4 py-2" id="name_'.$rowMenu['subm_id'].'">'.$rowMenu['subm_name'].'</td>';
                echo '<td class="d-flex align-content-center px-4 py-2">'
                    .'<button class="edit-button btn btn-warning text-white me-2"
                        onclick="edit(' . $rowMenu['subm_id'] . ')"
                        data-id="' . $rowMenu['subm_id'] . '"
                        data-icon="' . $rowMenu['subm_id'] . '"
                        id="edit-button-' . $rowMenu['subm_id'] . '">
                        <i class="fa-solid fa-edit"></i>
                    </button>'
                    . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=listsub_menu&id='.$rowMenu['subm_menu_id'].'&action=deletesub&subid='.$rowMenu['subm_id'].'">'
                    . '<i class="fa-solid fa-trash"></i>'
                    . '</a>'
                    . '</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td class="px-4 py-2"></td>';
            echo '<td class="px-4 py-2"><form method="post" action="" class="form-inline"><input name="sub_name" class="form-text border-0 p-2 rounded w-50" type="text" value="منوی جدید">
                    <button name="submit_submenu" class="btn btn-info text-white me-2 w-25" title="ثبت">
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
<script>
    function edit(rowId) {
        const nameCell = document.getElementById('name_' + rowId);
        const originalName = nameCell.textContent;

        nameCell.innerHTML = `
        <input type="text" class="d-inline form-text border-0 p-2 rounded w-25" value="${originalName}" id="editName_${rowId}">
        <button class="btn btn-success btn-sm me-2" style="width: 10%!important;" id="saveButton_${rowId}" data-id="${rowId}">ثبت</button>
        <button class="btn btn-secondary btn-sm"  style="width: 10%!important;"  onclick="cancelEdit(${rowId}, '${originalName}')">لغو</button>`;

        document.getElementById('saveButton_' + rowId).onclick = function() {
            const newName = document.getElementById('editName_' + rowId).value;

            const xhrPost = new XMLHttpRequest();
            xhrPost.open('POST', 'admin/includes/update_sub.php', true);
            xhrPost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhrPost.onload = function() {
                if (xhrPost.status === 200) {
                    nameCell.innerHTML = newName;
                } else {
                    alert('خطا در به‌روزرسانی: ' + xhrPost.status);
                    nameCell.innerHTML = originalName;
                }
            };
            const params = 'menu_id=' + encodeURIComponent(rowId) +
                '&menu_name=' + encodeURIComponent(newName) ;
            xhrPost.send(params);
        };
    }

    function cancelEdit(rowId, originalName) {
        const nameCell = document.getElementById('name_' + rowId);
        nameCell.innerHTML = originalName;
    }
</script>

