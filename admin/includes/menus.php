<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('1',$perm) && !in_array('2',$perm) && !in_array('3',$perm)){
    die("شما دسترسی به این صفحه ندارید");
}
$result_icon = $link -> query("SELECT * FROM icons");
$errors = [];
if(isset($_POST['submit_add'])){
    if(!empty($_POST['menu_name'])){
        $menu_name = $_POST['menu_name'];
    }
    else{
        $errors['menu'] = "   نام منو را وارد کنید";
    }
    if(isset($_POST['icon_menu'])){
        $menu_icon = $_POST['icon_menu'];
    }
    else{
        $menu_icon = 6;
    }
    $menuDuplicate = $link->query("SELECT * FROM menu WHERE menu_name = '" . $_POST['menu_name'] . "'");
    if($menuDuplicate->num_rows == 0 && isset($menu_name)){
        $result = $link -> query("INSERT INTO menu (menu_name, menu_icon) VALUES ('".$menu_name."','".$menu_icon."')");
        if($link -> errno == 0){
            $errors['success_add'] = "منوی جدید با موفقیت ثبت شد";
        }
        else{
            echo $link->error;
        }
    }
    else{
        $errors['menu'] = "نام منو نمیتواند تکراری باشد";
    }
}
if(isset($_GET['action'])){
    switch($_GET['action']){
        case "delete":
            if($_GET['id'] != '44' && $_GET['id'] != '47' && $_GET['id'] != '49') {
                $result = $link->query("DELETE FROM `menu` WHERE `menu`.`menu_id` = '" . $_GET['id'] . "'");
                if ($link->errno == 0) {
                    $errors['success_delete'] = "منو با موفقیت حذف شد";
                    require_once "admin\includes/menus.php";
                } else if ($link->errno == 1451) {
                    $errors['delete'] = "خطا در حذف: این منو دارای اطلاعات وابسته (زیر منو یا صفحه) است. لطفا ابتدا اطلاعات وابسته را حذف کنید.";
                } else {
                    echo $link->error;
                    echo $link->errno;
                    $errors['delete'] = "خطا در حذف منو";
                }
            }
            else{
                $errors['delete'] = " این منو قابل حذف شدن نیست! برای حذف آن با پشتیبانی فنی تماس بگیرید. ";
            }
            break;
        case 'edit':
            $result = $link -> query("SELECT * FROM menu WHERE menu_id = '".clean_id($_GET['id'])."'");
            if($link -> errno == 0){
                $row = $result->fetch_assoc();
                $menu_name = $row['menu_name'];
                $menu_icon = $row['menu_icon'];
            }
    }


}
$resultMenu = $link -> query("SELECT * FROM menu");
?>

<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['success_add'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert" id="success-add">  
            <div>  
                <i class="fa fa-check-circle"></i>  
                ' . $errors['success_add'] . '  
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>  
          </div>';
        }
        if(isset($errors['menu'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert" id="menu-error">  
            <div>  
                <i class="fa fa-exclamation-triangle"></i>  
                ' . $errors['menu'] . '  
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>  
          </div>';
        }
        if(isset($errors['success_delete'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert" id="success-delete">  
            <div>  
                <i class="fa fa-check-circle"></i>  
                ' . $errors['success_delete'] . '  
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>  
          </div>';
        }
        if(isset($errors['delete'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert" id="delete-error">  
            <div>  
                <i class="fa fa-exclamation-triangle"></i>  
                ' . $errors['delete'] . '  
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>  
          </div>';
        }
        ?>
    </div>
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4>لیست منو ها</h4>
    </div>
    <div>
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody id="menuTableBody">
            <?php
            if(in_array('1',$perm)) {
                echo '<tr>';
                echo '<td class="px-4 py-2">ایجاد</td>';
                echo '<td class="px-4 py-2">  
            <form method="post" action="" class="row g-1">  
                <div class="col-auto">
                    <input name="menu_name" class="form-text border-0 p-2 rounded" type="text" placeholder=" نام منو" style="height: 35px !important;">  
                </div>
                <div class="col-auto">
                <select name="icon_menu" class="form-select rounded mr-2" aria-label="Default select example">  
                    <option selected disabled>   انتخاب نماد منو</option>';

                if ($result_icon->num_rows > 0) {
                    while ($row_icon = $result_icon->fetch_assoc()) {
                        echo '<option value="' . $row_icon['ic_id'] . '"><i class="' . $row_icon['ic_tag'] . '"></i>' . $row_icon['ic_name'] . ' </option>';
                    }
                }

                echo '      </select>  
                </div>
               
                    <button name="submit_add" class="btn btn-info text-white me-2 w-25" title="ثبت">  
                        <i class="fa-solid fa-plus me-2"></i>  
                        ثبت  
                    </button>     
            </form>  
          </td>';
                echo '<td class="d-flex align-content-center py-2"></td>';
                echo '</tr>';
            }

            while($rowMenu = $resultMenu->fetch_assoc()) {
                echo '<tr id="row_'.$rowMenu['menu_id'].'">';
                echo '<td class="px-4 py-2">'.$rowMenu['menu_id'].'</td>';
                echo '<td class="px-4 py-2" id="name_'.$rowMenu['menu_id'].'">'.$rowMenu['menu_name'].'</td>';
                echo '<td class="d-flex align-content-center px-4 py-2">';
                if(in_array('1',$perm)) {
                    echo '<button class="edit-button btn btn-warning text-white me-2"
                        onclick="editRow(' . $rowMenu['menu_id'] . ', ' . $rowMenu['menu_icon'] . ')"
                        data-id="' . $rowMenu['menu_id'] . '"
                        data-icon="' . $rowMenu['menu_icon'] . '"
                        id="edit-button-' . $rowMenu['menu_id'] . '">
                        <i class="fa-solid fa-edit"></i>
                    </button>';
                }
                if(in_array('2',$perm)) {
                    if ($rowMenu['menu_id'] != '44' && $rowMenu['menu_id'] != '47' && $rowMenu['menu_id'] != '49') {
                        echo '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=menus&action=delete&id=' . $rowMenu['menu_id'] . '">'
                            . '<i class="fa-solid fa-trash"></i>'
                            . '</a>';
                    }
                }
                if(in_array('3',$perm)) {
                    if ($rowMenu['menu_id'] == '44') {
                        echo '<a class="btn btn-info text-white me-2" title="مشاهده زیر منو ها" href="index.php?pg=login&page=listsub_menu&id=' . $rowMenu['menu_id'] . '">'
                            . '<i class="fa-solid fa-bars-staggered"></i>'
                            . '</a>'
                            . '</td>';
                    }
                }
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function editRow(rowId, iconId) {
        const nameCell = document.getElementById('name_' + rowId);
        const originalName = nameCell.textContent;

        // ساخت فرم ویرایش
        nameCell.innerHTML = `
        <input type="text" class="d-inline form-text border-0 p-2 rounded w-25" value="${originalName}" id="editName_${rowId}">
        <select name="icon_menu" id="editIcon_${rowId}" class="d-inline form-select rounded" style="width: 25% !important;">
            <option disabled>انتخاب نماد منو</option>
        </select>
        <button class="btn btn-success btn-sm me-2" style="width: 10%!important;" id="saveButton_${rowId}" data-id="${rowId}">ثبت</button>
        <button class="btn btn-secondary btn-sm"  style="width: 10%!important;"  onclick="cancelEdit(${rowId}, '${originalName}')">لغو</button>`;
        // درخواست آیکون‌ها
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'admin/includes/get_icons.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const rawData = JSON.parse(xhr.responseText);
                    const iconsArray = rawData.icons;

                    const selectEl = document.getElementById('editIcon_' + rowId);
                    iconsArray.forEach(function(icon) {
                        const selectedAttr = (icon.ic_id == iconId) ? 'selected' : '';
                        selectEl.innerHTML += `<option value="${icon.ic_id}" ${selectedAttr}>${icon.ic_name}</option>`;
                    });
                }
                catch(e) {
                    console.error("Error parsing JSON:", e);
                }
            }
            else {
                console.error('ایراد در دریافت آیکون‌ها', xhr.status);
            }
        };
        xhr.send();


        document.getElementById('saveButton_' + rowId).onclick = function() {
            const newName = document.getElementById('editName_' + rowId).value;
            const newIcon = document.getElementById('editIcon_' + rowId).value;

            const xhrPost = new XMLHttpRequest();
            xhrPost.open('POST', 'admin/includes/update_menu.php', true);
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
                '&menu_name=' + encodeURIComponent(newName) +
                '&icon_menu=' + encodeURIComponent(newIcon);
            xhrPost.send(params);
        };
    }

    // تابع لغو ویرایش
    function cancelEdit(rowId, originalName) {
        const nameCell = document.getElementById('name_' + rowId);
        nameCell.innerHTML = originalName;
    }
</script>
