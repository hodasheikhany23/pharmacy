<?php
$result_blog= $link->query("SELECT * FROM blog WHERE blg_id = '".$_GET['blog']."'");
if($result_blog->num_rows>0){
    $row_blog = $result_blog->fetch_assoc();
}
$errors =[];
if(isset($_POST['sub_comment'])){
    if(isset($_POST['comment']) && isset($_POST['rank'])) {
        $id = $_GET['blog'];
        $comment = $_POST['comment'];
        $rank = $_POST['rank'];
        $time = jdate('Y-m-d');
        $result = $link->query("INSERT INTO blog_comment (bc_user_id, bc_blog_id, bc_comment, bc_rank,bc_date) VALUES ('".$_SESSION['user_id']."', '".$id."', '".$comment."', '".$rank."','".$time."')");
        if ($link->errno==0) {
            $result_select = $link->query("SELECT bc_rank FROM blog_comment WHERE bc_blog_id='".$id."'");
            $sum = 0;
            $count = 0;
            while ($row = $result_select->fetch_assoc()) {
                $sum += $row["bc_rank"];
                $count++;
            }
            $avg = $count > 0 ? $sum / $count : 0;
            $result_update = $link->query("UPDATE blog SET blg_rank = $avg WHERE blg_id = '".$id."'");
            if ($result_update) {
                $errors['success'] = "دیدگاه شما با موفقیت ثبت شد";
            }
        }
        else{
            $errors['failed'] = "خطا در ثبت دیدگاه  ";
        }
    }
}
?>
<style>
    .sidebar{
        padding-top: 0px;
        padding-bottom: 1px;
        position: static;
        transform: none;
        margin-top: 2rem !important;
    }
</style>
<section class="page-body">
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-3 sidebar">
                    <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">مقالات مرتبط   </h4>
                            <ul>
                                <?php
                                $list = [];
                                $label = $link->query("SELECT blgde_label FROM blog_detail WHERE blgde_blog_id = '" . $row_blog['blg_id'] . "' AND blgde_label IS NOT NULL");
                                while ($row_label = $label->fetch_array()) {
                                    $list[] = $row_label['blgde_label'];
                                }

                                $list_string = "'" . implode("','", $list) . "'";
                                $result_all = $link->query("SELECT * FROM blog_detail WHERE blgde_label IN ($list_string) GROUP BY blgde_blog_id Limit 3");
                                while ($row_all = $result_all->fetch_assoc()) {
                                    if($row_all['blgde_blog_id'] != $row_blog['blg_id']){
                                        $result_blog_all = $link->query("SELECT * FROM blog WHERE blg_id = '" . $row_all['blgde_blog_id'] . "' AND blg_id != '" . $row_blog['blg_id'] . "'");
                                        $row_blog_all = $result_blog_all->fetch_assoc();


                                    ?>
                                    <li>
                                        <div class="top-rated-product-item clearfix card border-0 px-1 py-3 d-flex flex-column justify-content-center align-items-center gap-3 rounded">
                                            <div>
                                                <?php
                                                echo '<a href="index.php?md=47&blog='.$row_blog_all['blg_id'].'">
                                        <img class="rounded" style="width: 200px !important; height: auto !important;" src="'.$row_blog_all['blg_cover'].'" alt="#">
                                    </a>';
                                                ?>
                                            </div>
                                            <div>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <?php
                                                        $drg_rank = $row_blog_all['blg_rank'];
                                                        for($i=1;$i<=$drg_rank;$i++) {
                                                            echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important; font-size: 12px;"></i>';
                                                            if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                                                echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);font-size: 12px;"></i>';
                                                            }
                                                        }
                                                        for($i=1;$i<=5-$drg_rank;$i++) {
                                                            echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;font-size: 12px;"></i>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <p class="badge bg-secondary" style="font-size: 12px"><i class="bi bi-tag me-2"></i><?php echo $row_blog_all['blg_tag']?> </p>
                                                <h6><a href="index.php?md=47&blog=<?php echo $row_blog_all['blg_id']; ?>"><?php echo $row_blog_all['blg_title'];?></a></h6>
                                                <div class="product-price">
                                                    <?php
                                                    echo '<p style="color: #737373 !important; font-size: 12px"><i class="bi bi-calendar-event me-2"></i>' .$row_blog_all['blg_date'].'</p>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }

                                }
                                ?>
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-md-9 mt-5 mb-5">
                    <?php
                    if(isset($errors['success'])){
                        echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div class="px-5">
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['success'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                    }
                    if(isset($errors['failed'])){
                        echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-5"></i>
                            ' .$errors['failed'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                    }
                    ?>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php?md=47">همه مقالات</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $row_blog['blg_title']; ?></li>
                        </ol>
                    </nav>
                    <div class=" mb-5">
                        <div class="ltn__page-details-inner ltn__blog-details-inner">
                            <div class="ltn__blog-meta rounded">
                                <ul>
                                    <li class="ltn__blog-category rounded">
                                        <a href="#" class="rounded text-white"><?php echo $row_blog['blg_tag']; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <img style="width: 850px; height: 400px; border-radius: 16px; object-fit: cover;" src="<?php echo $row_blog['blg_cover']; ?>"
                            </div>
                            <h2 class="ltn__blog-title mt-5">
                                <?php
                                echo $row_blog['blg_title'];
                                ?>
                            </h2>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date">
                                        <i class="bi bi-calendar-event text-gray-900" style="color: #0c0000"></i>
                                         <?php echo $row_blog['blg_date']; ?>
                                    </li>
                                    <li>
                                        <div class="product-ratting d-flex flex-row justify-content-between">
                                            <ul>
                                                <?php
                                                $drg_rank = $row_blog['blg_rank'];
                                                for($i=1;$i<=$drg_rank;$i++) {
                                                    echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important; font-size: 12px;"></i>';
                                                    if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                                        echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);font-size: 12px;"></i>';
                                                    }
                                                }
                                                for($i=1;$i<=5-$drg_rank;$i++) {
                                                    echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;font-size: 12px;"></i>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <hr>
                            <?php
                            $result_detail = $link->query("SELECT * FROM blog_detail WHERE blgde_blog_id = '".$row_blog['blg_id']."'");
                            while($row_detail = $result_detail->fetch_assoc()){
                                if($row_detail['blgde_heading']!='null' && $row_detail['blgde_heading']!=''){
                                    echo '<h3>'.$row_detail['blgde_heading'].'</h3>';
                                }
                                if($row_detail['blgde_paragraph']!='null' && $row_detail['blgde_paragraph']!=''){
                                    echo '<p>'.$row_detail['blgde_paragraph'].'</p>';
                                }
                                if($row_detail['blgde_image']!='null' && $row_detail['blgde_image']!=''){
                                    echo '<img class="mt-4 mb-4 mx-2" style="border-radius:16px; width:400px; height:300px; object-fit:cover;" src="'.$row_detail['blgde_image'].'">';
                                }
                                if($row_detail['blgde_link']!='null' && $row_detail['blgde_link']!=''){
                                    echo '</br><a style="color:var(--color-main) !important; text-decoration:underline !important;" href="'.$row_detail['blgde_link'].'"><i class="bi bi-link-45deg"></i>'.$row_detail['blgde_link_name'].'</a></br>';
                                }
                            }
                            ?>
                        </div>
                        <div class="ltn__blog-tags-social-media mt-80 row">
                            <div class="ltn__tagcloud-widget col-lg-8">
                                <h4>بر چسب ها</h4>
                                <ul>
                                    <?php
                                    $result_label = $link->query("SELECT blgde_label FROM blog_detail WHERE blgde_blog_id='".$row_blog['blg_id']."'");
                                    while($row_label = $result_label->fetch_assoc()){
                                        if(isset($row_label['blgde_label']) && $row_label['blgde_label']!='null' && $row_label['blgde_label']!=''){
                                            echo '<li><a href="#" class="rounded text-white bg-secondary px-3 py-2">'.$row_label['blgde_label'].'</a></li>';
                                        }

                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="ltn__social-media text-right col-lg-4">
                                <h4>اشتراک گذاری</h4>
                                <ul>
                                    <li><a href="#" title="Facebook"><i class="bi bi-facebook"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="bi bi-twitter"></i></a></li>
                                    <li><a href="#" title="telegram"><i class="bi bi-telegram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <?php
                        if(isset($_SESSION['user_id']))
                        {
                            ?>
                            <div class= "mb-5 rounded p-4" style="background-color: rgba(60,123,191,0.07);">
                                <h4 class="title-2">ارسال نظر</h4>
                                <div class="mb-30">
                                    <div class="add-a-review">
                                        <h6 class="m-0">امتیاز شما به این مقاله:</h6>
                                        <div class="product-ratting mx-3 mt-1" id="rating-stars" data-selected="0" style="cursor:pointer;">
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
                                <form method="post" action="">
                                    <input class="d-none" name="rank" id="rank" value="5">
                                    <div class="rounded">
                                        <textarea name="comment" id="comment" class="rounded" placeholder="نظر خود را بنویسید..."></textarea>
                                    </div>
                                    <div class="btn-wrapper">
                                        <button name="sub_comment" class="btn button btn-primary"
                                                type="submit">ارسال</button>
                                    </div>
                                    <div id="success" class="d-none alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #0d3300 !important;" role="alert">
                                        <div class="px-5">
                                            <i class="bi bi-check-all"></i>
                                            موفق
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                                    </div>
                                </form>

                            </div>
                            <?php
                        }
                        else{
                            echo '<div class="mb-5 rounded p-4">';
                            echo 'برای ثبت دیدگاه لطفا ابتدا وارد حساب کاربری شوید.';
                            echo '</div>';
                        }
                        ?>
                        <div class="ltn__comment-area mb-30">
                            <div class="ltn__comment-inner" id="comments-container">
                                <ul id="comments-list">
                                    <?php
                                    $result_comment= $link->query("SELECT * FROM blog_comment WHERE bc_blog_id='".$row_blog['blg_id']."'");
                                    while ($row_comment= $result_comment->fetch_assoc()) {
                                        $user = $link->query("SELECT * FROM users WHERE u_id = '".$row_comment['bc_user_id']."'");
                                        $row_user = $user->fetch_assoc();
                                        ?>
                                        <li>
                                            <div class="ltn__comment-item clearfix p-3 rounded" style="background-color: rgba(18,107,241,0.07)">
                                                <div class="ltn__commenter-img">
                                                    <?php
                                                    if(isset($row_user['u_image']) && !empty($row_user['u_image'])) {
                                                        echo '<img src="uploads/'.$row_user['u_image'].'" style="width: 50px; height: 50px;">';
                                                    }
                                                    else{
                                                        echo '<img src="img/profile.png" style="width: 50px; height: 50px;">';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="ltn__commenter-comment">
                                                    <div class="row">
                                                        <div class="d-flex flex-row justify-content-start align-items-end">
                                                            <h6><a href="#"><?php echo $row_user['u_username']; ?></a></h6>
                                                            <div class="product-ratting px-3">
                                                                <ul>
                                                                    <?php
                                                                    if(isset($row_comment['bc_rank']) && !empty($row_comment['bc_rank'])) {
                                                                        $c = 0;
                                                                        for($i=1;$i<=$row_comment['bc_rank'];$i++) {
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
                                                    </div>

                                                    <div class="mt-2">
                                                        <p>
                                                            <?php
                                                            if(isset($row_comment['bc_comment']) && !empty($row_comment['bc_comment'])) {
                                                                echo $row_comment['bc_comment'];
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <span class="ltn__comment-reply-btn">
                                                                <?php
                                                                if(isset($row_comment['bc_date']) && !empty($row_comment['bc_date'])) {
                                                                    echo $row_comment['bc_date'];
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
</script>
