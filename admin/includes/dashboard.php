<?php
require_once "includes/connect.php";
require_once "time/jdf.php";
?>
<div class="container">
    <div class="section-title" style="margin-top: 0 !important; padding-top: 0 !important;">
        <p class="mb-4" style="font-size: 16px; margin-top: 24px !important; padding-top: 8px !important;">داشبورد</p>
        <a href="index.php?page=dashboard" class="button btn btn-primary">
            <i class="bi bi-globe"></i>
            <span style="margin-left: 2px;">| </span> سایت
        </a>
    </div>
    <div class="row gap-4 mb-4">
        <div class=" alert alert-primary col-sm dash-card dash-card-time py-3 px-4 d-flex justify-content-between" style="color: #0D0C3A!important; align-items: center">
            <div class="d-flex gap-3">
                <div class="icon-box icon-box-time">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="title mr-3 mt-2" style="font-size: 16px">
                    آخرین بازدید
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold">
                    <?php
                    echo $_SESSION['time'];
                    ?>
                </div>
            </div>
        </div>
        <div class="alert alert-success col-sm dash-card dash-card-time py-3 px-4 d-flex justify-content-between" style="color: #002300!important; align-items: center">
            <div class="d-flex align-content-center justify-content-center gap-3">
                <div class="icon-box icon-box-time" style="background-color: var(--secondary-color-1)">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="title mr-3 mt-2" style="font-size: 16px">
                    هم اکنون
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" id="clock">
                    00:00:00
                </div>
            </div>
        </div>
    </div>
    <div class="row gap-3">

        <div class="alert alert-success col-sm dash-card py-4 px-5 d-flex justify-content-between" style="color: #0c0000!important; align-items: center">
            <div class="d-flex gap-3">
                <div class="icon-box" style="background-color: var(--secondary-color-1)">
                    <i class="bi bi-calendar3-event"></i>
                </div>
                <div class="title mr-3 mt-4" style="font-size: 16px">
                    فروش امروز
                </div>
            </div>
            <?php
            $sum = 0;
            $today = jdate("Y-m-d");
            $today_factor = $link->query("SELECT * FROM factor WHERE fac_date LIKE '$today%'");
            if (!$today_factor) {
                echo $link->error;
            }
            else{
                while ($row_today = $today_factor->fetch_assoc()) {
                    $result = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_today['fac_id']."'");
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $sum += $row['facde_count'];
                    }
                }
            }
            ?>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" style="font-size: 32px">
                    <?php
                    echo $sum;
                    ?>
                </div>
            </div>
        </div>
        <div class=" alert alert-warning col-sm dash-card py-5 px-5 d-flex justify-content-between" style="color: #0c0000 !important; align-items: center">
            <div class="d-flex gap-3">
                <div class="icon-box" style="background-color: var(--secondary-color-3)">
                    <i class="bi bi-cash"></i>
                </div>
                <div class="title mr-3 mt-4" style="font-size: 16px">
                    فروش کل
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" style="font-size: 24px">
                    <?php
                    $sum2 = 0;
                    $sum_factor = $link->query("SELECT * FROM factor");
                    if (!$sum_factor){
                        echo $link->error;
                    }
                    else{
                        while ($row_factor = $sum_factor->fetch_assoc()) {
                            $result = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_factor['fac_id']."'");
                            if ($result) {
                                $row = $result->fetch_assoc();
                                $sum2 += $row['facde_count'];
                            }
                        }
                    }
                    echo $sum2;
                    ?>
                </div>
            </div>
        </div>
        <div class="alert alert-primary col-sm dash-card py-4 px-4 d-flex justify-content-between" style="color: #0c0000!important; align-items: center">
            <div class="d-flex gap-3">
                <div class="icon-box" style="background-color: var(--color-main)">
                    <i class="bi bi-people"></i>
                </div>
                <div class="title mr-3 mt-4" style="font-size: 16px">
                    تعداد کاربران
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" style="font-size: 24px">
                    <?php
                    $sum_users = $link->query("SELECT count(*) as user_count FROM users where u_is_admin = '0'");
                    if ($sum_users) {
                        $row_users = $sum_users->fetch_assoc();
                        echo $row_users['user_count'];
                    }

                    ?>
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-5 section-admin" style="margin-top: 0 !important; padding-top: 0 !important;" >
        <div class="section-title mt-5" style="padding-top: 0 !important;">
            <p style="margin-top: 24px !important; padding-top: 8px !important;">پرفروش ترین محصولات</p>
        </div>
        <table class="table table-bordered custom-table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">تصویر</th>
                <th scope="col">نام محصول</th>
                <th scope="col">شرکت تولیدکننده</th>
                <th scope="col">تعداد خریداری شده (امروز) </th>
                <th scope="col">تعداد خریداری‌شده کل</th>
                <th scope="col">امتیاز کاربران </th>
                <th scope="col">تعداد موجود در انبار</th>
                <th scope="col">قیمت</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count =0;
            $best_selling = $link->query("SELECT * FROM drogs ORDER BY drg_sales DESC LIMIT 6");
            while ($row_sale = $best_selling->fetch_assoc()) {
                $count++;
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td>
                    <?php
                    echo '<img src="uploads/'.$row_sale['drg_image'].'" class="img-fluid" alt="...">';
                    ?>
                </td>
                <td>
                    <?php
                    echo $row_sale['drg_name'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $row_sale['drg_company'];
                    ?>
                </td>
                <td>
                    <?php
                    $sum3 = 0;
                    $today = jdate("Y-m-d");
                    if(isset($row_sale['drg_id'])) {
                        $today_factor = $link->query("SELECT * FROM factor WHERE fac_date LIKE '$today%'");
                        if(!$today_factor) {
                            echo $link->error;
                        }
                        else{
                            while ($row_today = $today_factor->fetch_assoc()) {
                                $result = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_today['fac_id']."' and facde_drog_id = '".$row_sale['drg_id']."'");
                                if ($result) {
                                    $row2 = $result->fetch_assoc();
                                    if(isset($row2['facde_count'])) {
                                        $sum3 += $row2['facde_count'];
                                    }
                                }
                            }
                        }
                        echo $sum3;
                    }
                    else{
                        echo 0;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    echo '<span class="badge bg-success p-2">'.$row_sale['drg_sales'].'</span>';
                    ?>
                </td>
                <td>
                    <?php
                    echo '<span class="badge bg-warning p-2">';
                    echo $drg_rank = $row_sale['drg_rank'];
                    echo '<i class="bi bi-star-fill m-1" style="color: #fbf5e5 !important;"></i>';
                    echo '</span>';
                    ?>
                </td>
                <td><?php
                    if($row_sale['drg_available']>=5){
                        $av = '<span class="badge bg-success p-2">'.$row_sale['drg_available'].' </span>';
                    }
                    elseif ($row_sale['drg_available']<5 && $row_sale['drg_available']>0){
                        $av = '<span class="badge bg-warning p-2">'.$row_sale['drg_available'].' </span>';
                    }
                    elseif ($row_sale['drg_available']==0){
                        $av = '<span class="badge bg-danger p-2">ناموجود</span>';
                    }
                    echo $av;
                    ?>
                </td>
                <td>
                    <?php
                    echo number_format($row_sale['drg_price']).' تومان ' ;
                    ?>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-between mt-1 mb-5 gap-5 me-3">
        <div class="col-lg-7  mt-5 section-admin">
            <div class="card border-0">
                <!-- Card header -->
                <div class="card-header border-bottom p-4">
                    <h5 class="card-header-title">مقالات پربازدید</h5>
                </div>

                <!-- Card body START -->
                <div class="card-body p-4" style="height: 440px !important;">
                    <div>
                        <?php
                        $result_comment = $link->query("SELECT * FROM comment ORDER BY c_id DESC LIMIT 4");
                        while ($row_comment = $result_comment->fetch_assoc()) {
                            $comment_user = $link->query("SELECT * FROM users WHERE u_id='".$row_comment['c_user_id']."'");
                            $row_comment_user = $comment_user->fetch_assoc();
                            ?>
                            <div class="d-flex justify-content-between position-relative">
                                <div class="d-sm-flex">
                                    <div class="icon-lg bg-purple bg-opacity-10 text-purple rounded-2 flex-shrink-0">
                                        <?php
                                        if(isset($row_comment_user['u_image']) && !empty($row_comment_user['u_image'])){
                                            $image = $row_comment_user['u_image'];
                                        }
                                        else{
                                            $image = "img/profile.png";
                                        }
                                        echo '<img src='.$image.' alt="avatar" class="rounded-circle" width="50" height="50">';
                                        ?>

                                    </div>
                                    <div class="ms-0 ms-sm-3 mt-2 mt-sm-0">
                                        <h6 class="mb-0 fw-normal"><a href="#" class="stretched-link"><?php echo $row_comment_user['u_username']; ?>  </a></h6>
                                        <p class="mb-0"><?php echo $row_comment['c_text']; ?></p>
                                        <span class="small"><?php echo dateFormat($row_comment['c_date']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- Card body END -->

                <!-- Card footer START -->
                <div class="card-footer border-top">
                    <div class="alert alert-primary d-flex align-items-center mb-0 py-2 px-2 justify-content-between">
                        <div>
                            <small class="mb-0 text-black">20 دیدگاه دیگر</small>
                        </div>
                        <div class="">
                            <a class="btn btn-sm btn-success-soft mb-0" href="#!"> مشاهده همه </a>
                        </div>
                    </div>
                </div>
                <!-- Card footer START -->
            </div>
        </div>
        <div class="col-lg-6 col-xxl-4  mt-5 section-admin">
            <div class="card border-0">
                <!-- Card header -->
                <div class="card-header border-bottom p-4">
                    <h5 class="card-header-title"> دیدگاه های اخیر</h5>
                </div>

                <!-- Card body START -->
                <div class="card-body p-4" style="height: 440px !important;">
                    <div>
                        <?php
                        $result_comment = $link->query("SELECT * FROM comment ORDER BY c_id DESC LIMIT 4");
                        while ($row_comment = $result_comment->fetch_assoc()) {
                            $comment_user = $link->query("SELECT * FROM users WHERE u_id='".$row_comment['c_user_id']."'");
                            $row_comment_user = $comment_user->fetch_assoc();
                        ?>
                        <div class="d-flex justify-content-between position-relative">
                            <div class="d-sm-flex">
                                <div class="icon-lg bg-purple bg-opacity-10 text-purple rounded-2 flex-shrink-0">
                                    <?php
                                    if(isset($row_comment_user['u_image']) && !empty($row_comment_user['u_image'])){
                                        $image = $row_comment_user['u_image'];
                                    }
                                    else{
                                        $image = "img/profile.png";
                                    }
                                    echo '<img src='.$image.' alt="avatar" class="rounded-circle" width="50" height="50">';
                                    ?>

                                </div>
                                <div class="ms-0 ms-sm-3 mt-2 mt-sm-0">
                                    <h6 class="mb-0 fw-normal"><a href="#" class="stretched-link"><?php echo $row_comment_user['u_username']; ?>  </a></h6>
                                    <p class="mb-0"><?php echo $row_comment['c_text']; ?></p>
                                    <span class="small"><?php echo dateFormat($row_comment['c_date']); ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- Card body END -->

                <!-- Card footer START -->
                <div class="card-footer border-top">
                    <div class="alert alert-primary d-flex align-items-center mb-0 py-2 px-2 justify-content-between">
                        <div>
                            <small class="mb-0 text-black">20 دیدگاه دیگر</small>
                        </div>
                        <div class="">
                            <a class="btn btn-sm btn-success-soft mb-0" href="#!"> مشاهده همه </a>
                        </div>
                    </div>
                </div>
                <!-- Card footer START -->
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock(){
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('clock').textContent = timeString;
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>