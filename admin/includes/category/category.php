<?php
defined('site') or die('access denied');

if(!isset($_SESSION['username'])){
    die("Please <a href='includes/login.php'>login</a> to access this page");
}
$errors = [];
if(isset($_POST['submit_add'])){
    if(isset($_POST['cat_name'])){
        $cat_name = clean_data($_POST['cat_name']);
    }
    else{
        echo "نام دسته بندی را وارد کنید";
    }
    if(isset($_POST['subm_category'])){
        $subm_category = clean_data($_POST['subm_category']);
    }
    else{
        $errors['menu'] = "منو را انتخاب کنید";
    }
    $catDuplicate = $link->query("SELECT * FROM category WHERE cat_name = '" . $_POST['cat_name'] . "'");
    if(isset($subm_category)){
        $result = $link -> query("INSERT INTO category (cat_name, cat_subm_id) VALUES ('".$cat_name."','". $subm_category."')");
        if($link -> errno == 0){
            $errors['add_category'] = "منوی جدید با موفقیت ثبت شد";
        }
        else{
            $errors['menu'] = "منو را انتخاب کنید";
        }
    }
}
if(isset($_GET['action'])){
    switch($_GET['action']){
        case "delete":
            $result = $link -> query("DELETE FROM category WHERE cat_id = '".clean_id($_GET['id'])."'");
            if($link -> errno == 0 && $link->affected_rows>0){
                $errors['delete_category'] = "منو با موفقیت حذف شد";
            }
            else if ($link -> errno == 1451){
                $errors['err_delete_category'] = "خطا در حذف:محصولات مربوط به این دسته بندی را ویرایش یا حذف کنید.";
            }
            else if($link->affected_rows <= 0){
                $errors['err_delete_category'] = "دسته بندی مورد نظر در سامانه موجود نیست";
            }
            else{
                $errors['err_delete_category'] = "خطا در حذف منو";
            }
            break;
    }
}
$resultcategory = $link -> query("SELECT * FROM category");
?>
<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['delete_category'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['delete_category'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['add_category'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div>
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['add_category'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['err_delete_category'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['err_delete_category'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['menu'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div>
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['menu'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
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
            echo '<tr>';
            echo '<td class="px-4 py-2"></td>';
            echo '<td class="px-4 py-2">
                    <form method="post" action="" class="d-flex flex-row align-items-center justify-content-start">
                        <div class="w-50" >
                            <input name="cat_name" class="form-text border-0 p-2 rounded" type="text" value="دسته بندی جدید">
                        </div>
                        <div>
                            <select name="subm_category" class="form-select rounded mr-2" aria-label="Default select example">
                                <option selected disabled>  انتخاب زیر منو   </option>';
            $result_submenu = $link -> query("SELECT * FROM sub_menu");
            if ($result_submenu->num_rows > 0) {
                while ($row_submenu = $result_submenu->fetch_assoc()) {
                    echo '<option value="' . $row_submenu['subm_id'] . '">' . $row_submenu['subm_name'] . '</option>';
                }
            }

            echo '      </select>
                        </div>
                        <div class="col-auto">
                            <button name="submit_add" class="btn btn-info text-white me-2" title="ثبت">
                                <i class="fa-solid fa-plus me-2"></i>
                                ثبت
                            </button>
                        </div>
                    </form>
                </td>';
            echo '<td class="d-flex align-content-center py-2"></td>';
            echo '</tr>';
            while($rowcategory=$resultcategory -> fetch_assoc()){
                echo '<tr id="row_'.$rowcategory['cat_id'].'">';
                echo '<td class="px-4 py-2">'.$rowcategory['cat_id'].'</td>';
                echo '<td class="px-4 py-2" id="name_'.$rowcategory['cat_id'].'">'.$rowcategory['cat_name'].'</td>';
                echo '<td class="d-flex align-content-center px-4 py-2">';
                echo '<button class="edit-button btn btn-warning text-white me-2"
                        onclick="edit(' . $rowcategory['cat_id'] . ')"
                        data-id="' . $rowcategory['cat_id'] . '"
                        data-icon="' . $rowcategory['cat_id'] . '"
                        id="edit-button-' . $rowcategory['cat_id'] . '">
                        <i class="fa-solid fa-edit"></i>
                    </button>'
                    . '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=categories&action=delete&id='.$rowcategory['cat_id'].'">'
                    . '<i class="fa-solid fa-trash"></i>'
                    . '</a>'
                    . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function edit(rowId) {
        const nameCell = document.getElementById('name_' + rowId);
        const originalName = nameCell.textContent;

        // ساخت فرم ویرایش
        nameCell.innerHTML = `
        <input type="text" class="d-inline form-text border-0 p-2 rounded w-25" value="${originalName}" id="editName_${rowId}">
        <button class="btn btn-success btn-sm me-2" style="width: 10%!important;" id="saveButton_${rowId}" data-id="${rowId}">ثبت</button>
        <button class="btn btn-secondary btn-sm"  style="width: 10%!important;"  onclick="cancelEdit(${rowId}, '${originalName}')">لغو</button>`;

        document.getElementById('saveButton_' + rowId).onclick = function() {
            const newName = document.getElementById('editName_' + rowId).value;

            const xhrPost = new XMLHttpRequest();
            xhrPost.open('POST', 'admin/includes/category/update_category.php', true);
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

