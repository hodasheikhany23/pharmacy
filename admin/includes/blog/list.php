<?php
defined('site') or die('Acces denied');

if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
if(!in_array('9',$perm) && !in_array('10',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors=[];
if(isset($_GET['action']) && $_GET['action'] == 'delete'){
    $resultBlog = $link->query("DELETE FROM blog WHERE blg_id = ".$_GET['id']);
    if($link->errno==0){
        $errors['success'] = "مقاله با موفقیت حذف شد";
    }
    else{
        $errors['failed'] = "خطا در حذف";
    }
}
$resultBlog = $link->query("SELECT * FROM blog");

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
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-4">لیست مقالات  </h4>
        <a href="index.php?pg=login&page=addblog" type="submit" class="button btn btn-primary sign">
            <i class="fa-solid fa-plus"></i>
            <span style="margin-left: 2px;">| </span> افزودن مقاله جدید
        </a>
    </div>
    <div>
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>تصویر کاور</th>
                <th>تیتر </th>
                <th>تاریخ انتشار</th>
                <th>تگ </th>
                <th>وضعیت انتشار </th>
                <th>امتیاز </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            while($rowBlog=$resultBlog -> fetch_assoc()){
                echo '<tr>';
                echo '<td class="px-4 py-2">'.$rowBlog['blg_id'].'</td>';
                echo '<td class="px-4 py-2"><img style="width: 50px; height: auto;" src="'.$rowBlog['blg_cover'].'"></td>';
                echo '<td class="px-4 py-2">'.$rowBlog['blg_title'].'</td>';
                echo '<td class="px-4 py-2">'.$rowBlog['blg_date'].'</td>';
                echo '<td class="px-4 py-2">'.$rowBlog['blg_tag'].'</td>';
                if($rowBlog['blg_status'] == 0){
                    echo '<td class="px-4 py-2"> <span class="badge bg-secondary">پیش نویس</span></td>';
                }
                else if($rowBlog['blg_status'] == 1){
                    echo '<td class="px-4 py-2"> <span class="badge bg-success">منتشر شده </span></td>';
                }

                echo '<td class="px-4 py-2"><span class="badge bg-warning p-2">'.$rowBlog['blg_rank'].'<i class="bi bi-star-fill m-1" style="color: #fbf5e5 !important;"></i></span>
                    </td>';
                echo '<td class="d-flex align-content-center px-4 py-2">'
                    . '<a class="btn btn-info text-white me-2" title="ویرایش" href="index.php?pg=login&page=editblogs&id=' . $rowBlog['blg_id'] . '">'
                    . '<i class="fa-solid fa-pen-to-square"></i>'
                    . '</a>';
                if(in_array('10',$perm)){
                    echo  '<a class="btn btn-danger text-white me-2" title="حذف" href="index.php?pg=login&page=blogs&action=delete&id='.$rowBlog['blg_id'].'">'
                        . '<i class="fa-solid fa-trash"></i>'
                        . '</a>';
                }

                echo '<a class="btn btn-warning text-white me-2" title="مطالب مقاله " href="index.php?pg=login&page=blogcontent&id='.$rowBlog['blg_id'].'">'
                . '<i class="fa-solid fa-bars-staggered"></i>'
                . '</a>'
                . '</td>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
