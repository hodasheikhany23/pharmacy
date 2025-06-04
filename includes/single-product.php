<?php
$errors =[];
require_once "time/jdf.php";
$time = jdate("Y-m-d H:i:s");
$resultDrog = $link -> query("SELECT * FROM drogs WHERE drg_id = '".$_GET['p']."'");
if ($resultDrog ->num_rows > 0) {
    $rowDrog = $resultDrog -> fetch_assoc();
}
$result_subm = $link -> query("SELECT * FROM sub_menu WHERE subm_id = '".$_GET['pd']."'");
if ($result_subm ->num_rows > 0) {
    $rowSubm = $result_subm -> fetch_assoc();
}
$result_category = $link -> query("SELECT * FROM category WHERE cat_id = '".$rowDrog['drg_category_id']."'");
if ($result_category ->num_rows > 0) {
    $rowCat = $result_category -> fetch_assoc();
}
if(isset($_POST['add_to_favorites'])){
    if(!isset($_SESSION['user_id'])){
        $errors['username']="لطفا اول وارد حساب کاربری خود شوید";
    }
    $dup = $link->query("SELECT * FROM favorits WHERE fav_drog_id = '".$rowDrog['drg_id']."' AND fav_user_id = '".$_SESSION['user_id']."'");
    if($dup->num_rows > 0){
        $errors['dup'] = "این محصول قبلا به علاقه مندی ها اضافه شده است";
    }
    else{
        $result_favorite = $link -> query("INSERT INTO favorits (fav_drog_id,fav_user_id) VALUES ('".$rowDrog['drg_id']."','".$_SESSION['user_id']."')");
        if($result_favorite){
            $errors['add_fav'] = "محصول به علاقه مندی ها اضافه شد";
        }
        else{
            $errors['err_add_fav'] = "خطا در انجام عملیات";
        }
    }
}
if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['user_id'])){
        $errors['username']="لطفا اول وارد حساب کاربری خود شوید";
    }
    else{
        if($rowDrog['drg_available'] != 0){
            $user_id = $_SESSION['user_id'];
            $result_incomplete_factor = $link->query("SELECT * FROM factor WHERE fac_user_id = '".$user_id."' AND fac_payment_status = '3'");
            $factor_id = 0;
            if($result_incomplete_factor->num_rows > 0){
                $rowIncompleteFactor = $result_incomplete_factor->fetch_assoc();
                $factor_id = $rowIncompleteFactor['fac_id'];
            }
            else {
                $result_new_factor = $link->query("INSERT INTO factor (fac_user_id, fac_date, fac_payment_status) VALUES ('".$user_id."', '".$time."', '3')");
                if($result_new_factor === TRUE){
                    $factor_id = $link->insert_id;
                } else {
                    $errors['create_factor_error'] = "خطا در ایجاد فاکتور جدید: " ;
                }
            }
            $dup = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$factor_id."' AND facde_drog_id = '".$rowDrog['drg_id']."'");

            if($dup->num_rows > 0){
                $errors['dup'] = "این محصول در سبد خرید موجود است";
            }
            else {
                $result_detail = $link->query("INSERT INTO `factor_detail`( `facde_factor_id`, `facde_drog_id`, `facde_count`) VALUES ('".$factor_id."','".$rowDrog['drg_id']."','1')");
                if($result_detail === TRUE){
                    $errors['add'] = "محصول به سبد خرید اضافه شد";
                }
                else {
                    $errors['add_detail_error'] = "خطا در اضافه کردن جزئیات محصول به سبد خرید: ";
                }
            }
        }
        else{
            $errors['available'] = "متاسفانه این محصول فعلا موجود نیست !";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> pharmacy | home </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="breadcrumb-area" style="background-color: transparent !important;" data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="d-flex px-5 py-2 justify-content-center">
                <?php
                if(isset($errors['username'])){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-5"></i>
                            ' .$errors['username'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                if(isset($errors['available'])){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-5"></i>
                            ' .$errors['available'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                if(isset($errors['err_add_fav'])){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-5"></i>
                            ' .$errors['err_add_fav'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                if(isset($errors['dup'])){
                    echo '<div class="alert alert-info d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #120051 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-info-circle" class="mr-5"></i>
                            ' .$errors['dup'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                if(isset($errors['add'])){
                    echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div class="px-5">
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['add'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                if(isset($errors['add_fav'])){
                    echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div class="px-5">
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['add_fav'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="breadcrumb-list">
                            <ul style="color: rgb(13, 13, 13) !important;">
                                <li><a href="index.php"><i class="bi bi-house"></i>  خانه ></a></li>
                                <li style="color: rgb(13, 13, 13) !important;"><a href="index.php?md=44&pd=<?php echo $rowSubm['subm_id'];  ?>"> <?php echo $rowSubm['subm_name'];?> </a> > <?php echo $rowDrog['drg_name'];?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ltn__shop-details-area pb-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner mb-60">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ltn__shop-details-img-gallery">
                                    <div class="ltn__shop-details-large-img">
                                        <img src="uploads/<?php echo $rowDrog['drg_image'];?>" alt="Image" style="width: 400px; border-radius: 12px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <h3><?php echo $rowDrog['drg_name']?></h3>
                                    <h6>محصول شرکت <?php echo '<span style="color: var(--color-3);font-weight: bold;">'.$rowDrog['drg_company'].'</span>';?></h6>
                                    <?php
                                    $drg_rank = $rowDrog['drg_rank'];
                                    echo '<div class="d-flex flex-row justify-content-start mt-2 mb-2 gap-1 p-2">';
                                    for($i=1;$i<=$drg_rank;$i++) {
                                        echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important;"></i>';
                                        if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                            echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);"></i>';
                                        }
                                    }
                                    for($i=1;$i<=5-$drg_rank;$i++) {
                                        echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;"></i>';
                                    }
                                    echo '</div>';
                                    ?>
                                    <hr>
                                    <div>
                                        <p>
                                            <?php echo $rowDrog['drg_caption'];?>
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li> <i class="bi bi-share"></i> اشتراک گذاری:</li>
                                            <li><a href="#" title="Facebook"><i class="bi bi-telegram" style="color: var(--color-main)"></i></a></li>
                                            <li><a href="#" title="Twitter"><i class="bi bi-whatsapp" style="color: green"></i></a></li>
                                            <li><a href="#" title="Linkedin"><i class="bi bi-facebook" style="color: var(--color-main)"></i></a></li>
                                            <li><a href="#" title="Instagram"><i class="bi bi-envelope-at" style="color: darkred"></i></a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab"
                                   href="#liton_tab_details_1_1">توضیحات</a>
                                <a data-bs-toggle="tab" href="#liton_tab_details_1_2" class="">نظرات</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">طریقه مصرف</h4>
                                    <p>
                                       <?php
                                       echo $rowDrog['drg_usage'];
                                       ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_details_1_2">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="title-2 d-block">نظرات <?php echo $rowDrog['drg_name'];?></h4>
                                        <div class="product-ratting d-block" style="font-size: 18px;">
                                            <ul>
                                                <?php
                                                $result_count = $link->query("SELECT COUNT(*) AS count from comment where c_drog_id = '".$rowDrog['drg_id']."'");
                                                $row_count = $result_count->fetch_assoc();
                                                $count = $row_count['count'];
                                                for($i=1;$i<=$drg_rank;$i++) {
                                                    echo '<i class="bi bi-star-fill d-flex " style="color: goldenrod !important;"></i>';
                                                    if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                                        echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);"></i>';
                                                    }
                                                }
                                                for($i=1;$i<=5-$drg_rank;$i++) {
                                                    echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;"></i>';
                                                }
                                                ?>
                                                <li style="font-size: 18px;" class="review-total px-3"> <a href="#"> (<?php echo $count;?> نظر)</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- comment-area -->
                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner" id="comments-container">
                                            <ul id="comments-list">
                                                <?php
                                                $result_comment= $link->query("SELECT * FROM comment WHERE c_drog_id='".$rowDrog['drg_id']."'");
                                                while ($row_comment= $result_comment->fetch_assoc()) {
                                                    $user = $link->query("SELECT * FROM users WHERE u_id = '".$row_comment['c_user_id']."'");
                                                    $row_user = $user->fetch_assoc();
                                                ?>
                                                <li>
                                                    <div class="ltn__comment-item clearfix p-3 rounded" style="background-color: rgba(18,107,241,0.07)">
                                                        <div class="ltn__commenter-img">
                                                        <?php
                                                        if(isset($row_user['u_image']) && !empty($row_user['u_image'])) {
                                                            echo '<img src="'.$row_user['u_image'].'" style="width: 50px; height: 50px;">';
                                                        }
                                                        else{
                                                            echo '<img src="img/profile.png" style="width: 50px; height: 50px;">';
                                                        }
                                                        ?>
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#"><?php echo $row_user['u_username']; ?></a></h6>
                                                            <div class="d-flex flex-row justify-content-start align-items-end">
                                                                <?php
                                                                if(isset($row_comment['c_title']) && !empty($row_comment['c_title'])) {
                                                                    echo '<h6 style="font-size: 14px; font-weight: bold;"> '.$row_comment['c_title'].' </h6>';
                                                                }
                                                                ?>
                                                                <div class="product-ratting px-3">
                                                                    <ul>
                                                                        <?php
                                                                        if(isset($row_comment['c_rank']) && !empty($row_comment['c_rank'])) {
                                                                            $c = 0;
                                                                            for($i=1;$i<=$row_comment['c_rank'];$i++) {
                                                                                $c++;
                                                                                echo '<li><i class="bi bi-star-fill m-1 mt-0" style="font-size: 14px;"></i></li>';
                                                                            }
                                                                            if($c<5){
                                                                                for($i=1;$c<5;$i++) {
                                                                                    $c++;
                                                                                    echo '<li><i class="bi bi-star m-1 mt-0" style="font-size: 14px;"></i></li>';
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2">
                                                                <p>
                                                                    <?php
                                                                    if(isset($row_comment['c_text']) && !empty($row_comment['c_text'])) {
                                                                        echo $row_comment['c_text'];
                                                                    }
                                                                    ?>
                                                                </p>
                                                            </div>
                                                            <span class="ltn__comment-reply-btn">
                                                                <?php
                                                                if(isset($row_comment['c_date']) && !empty($row_comment['c_date'])) {
                                                                    echo dateFormat($row_comment['c_date']);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($_SESSION['user_id']))
                                    {
                                    ?>
                                    <div class= "mb-5 rounded p-4" style="background-color: rgba(60,123,191,0.07);">
                                        <h4 class="title-2">ارسال نظر</h4>
                                        <div class="mb-30">
                                            <div class="add-a-review">
                                                <h6>امتیاز شما به محصول:</h6>
                                                <div class="product-ratting" id="rating-stars" data-selected="0" style="cursor:pointer;">
                                                    <ul style="list-style:none; padding:0; display:flex;">
                                                        <li><i class="bi bi-star" data-star="1" style="font-size: 16px;"></i></li>
                                                        <li><i class="bi bi-star" data-star="2" style="font-size: 16px;"></i></li>
                                                        <li><i class="bi bi-star" data-star="3" style="font-size: 16px;"></i></li>
                                                        <li><i class="bi bi-star" data-star="4" style="font-size: 16px;"></i></li>
                                                        <li><i class="bi bi-star" data-star="5" style="font-size: 16px;"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <input class="d-none" name="rank" id="rank" value="5">
                                        <input class="input-item border-0 p-2 mb-4 rounded" name="title" id="title" placeholder="عنوان">
                                        <div class="rounded">
                                            <textarea id="comment" class="rounded" placeholder="نظر خود را بنویسید..."></textarea>
                                        </div>
                                        <div class="btn-wrapper">
                                            <button onclick="submit_comment(<?php echo $rowDrog['drg_id']; ?>)" class="btn button btn-primary"
                                                    type="submit">ارسال</button>
                                        </div>
                                        <div id="success" class="d-none alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #0d3300 !important;" role="alert">
                                            <div class="px-5">
                                                <i class="bi bi-check-all"></i>
                                                موفق
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        echo '<div class="mb-5 rounded p-4">';
                                        echo 'برای ثبت دیدگاه لطفا ابتدا وارد حساب کاربری شوید.';
                                        echo '</div>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab End -->
                </div>
                <div class="col-lg-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <ul>
                                <li>
                                    <span>دسته بندی:</span>
                                    <span>
                                    <?php
                                    echo '<span class="badge bg-secondary">'.$rowCat['cat_name'].'</span>';
                                    ?>
                                </span>
                                    <br>
                                    <span>موجودی :</span>
                                    <span>
                                    <?php
                                    if($rowDrog['drg_available']==0){
                                        echo '<span class="badge bg-danger">ناموجود</span>';
                                    }
                                    else{
                                        echo '<span class="badge bg-info text-dark">'.$rowDrog['drg_available'].' عدد </span>';
                                    }
                                    ?>
                                </span>
                                </li>
                            </ul>
                            <hr>
                            <div class="product-price">
                                <?php
                                $result_off = $link ->query("SELECT * FROM off where off_category_id = '".$rowCat['cat_id']."'");
                                if($result_off -> num_rows > 0){
                                    $row_off = $result_off -> fetch_assoc();
                                    if($row_off['off_status']==1){
                                        if($row_off['off_drug_id']!= null){
                                            if($rowDrog['drg_id']==$row_off['off_drug_id']){
                                                $vl = $row_off['off_value'];
                                            }
                                            else{
                                                $vl = 0;
                                            }
                                        }
                                        else{
                                            $vl = $row_off['off_value'];
                                        }
                                    }
                                    else{
                                        $vl = 0;
                                    }
                                }
                                else{
                                    $vl = 0;
                                }
                                $off = $rowDrog['drg_price'] * $vl / 100;
                                $price = $rowDrog['drg_price']-$off;
                                if($off > 0){

                                ?>
                                <div class="d-flex justify-content-around">
                                    <span class="badge bg-danger text-white text-center rounded-pill" style="font-size: 14px"><?php echo $vl; ?>%</span>
                                    <del style="font-size: 16px"><?php echo number_format($rowDrog['drg_price']);?></del>
                                </div>
                                <?php

                                }
                                ?>
                                <br>
                                <p style="font-size: 20px; color: black"><?php echo number_format($price); ?> <span style="font-size: 12px; color: black;">تومان</span></p>
                            </div>
                            <hr>
                            <form method="post" action="">
                                <button class="button btn btn-primary" name="add_to_cart"> <i class="bi bi-bag-plus"></i> <span
                                            style="margin-left: 2px;">|</span>افزودن به سبد خرید </button>
                                <button class="btn button button2 add-to-favorite" name="add_to_favorites" style="background-color: #dc483c !important;"><i
                                            class="bi bi-heart"></i></button>
                            </form>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <script>
        const stars = document.querySelectorAll('#rating-stars i');

        stars.forEach(star => {
            star.onclick = () => {
                const selectedRating = parseInt(star.getAttribute('data-star'));
                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-star')) <= selectedRating) {
                        s.classList.remove('bi-star');
                        s.classList.add('bi-star-fill');
                    } else {
                        s.classList.remove('bi-star-fill');
                        s.classList.add('bi-star');
                    }
                });
                const rank = document.getElementById('rank');
                rank.value = selectedRating;
                // console.log('امتیاز ثبت شده:', selectedRating);
            };
        });
        function submit_comment(id) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/submit_comment.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            let rank = document.getElementById('rank').value;
            let comment = document.getElementById('comment').value;
            let title = document.getElementById('title').value;

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            const msg = document.getElementById('success');
                            msg.classList.remove('d-none');
                            msg.innerHTML = 'دیدگاه شما با موفقیت ثبت شد.';

                            document.getElementById('comment').value = '';
                            document.getElementById('title').value = '';
                            document.getElementById('rank').value = '0';
                        }
                        else {
                            const msg = document.getElementById('massage');
                            msg.classList.remove('d-none');
                            msg.innerHTML = response.message;
                        }
                    }
                    else {
                        alert('خطا در ارتباط با سرور');
                    }
                }
            };
            xhr.send('id=' + encodeURIComponent(id) + '&rank=' + encodeURIComponent(rank)  + '&title=' + encodeURIComponent(title) +'&comment='+encodeURIComponent(comment));
        }
    </script>

