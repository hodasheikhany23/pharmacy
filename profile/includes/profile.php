<?php
$errors = [];
if(!isset($_SESSION["user_id"])){
    $errors['login'] = "لطفا ابتدا وارد سایت شوید";
}
else{
    $link = new mysqli("localhost", "root", "", "pharmacy_db");
    $result = $link->query("SELECT * FROM favorits WHERE `fav_user_id` = '".$_SESSION['user_id']."'");
    $result_menu = $link -> query("SELECT * FROM menu");
    if($result_menu->num_rows > 0) {
        $row_menu = $result_menu -> fetch_assoc();
    }
    $user = $link->query("SELECT * FROM users WHERE u_id = '" . $_SESSION['user_id'] . "'");
    $row_user = $user->fetch_assoc();
    if(isset($_POST['sub_image'])){
        if(isset($_FILES['image']))
        {
            $pictureExtention = substr($_FILES['image']['name'], strrpos($_FILES['image']['name'], '.')+1);
            if(!in_array($pictureExtention, ['png', 'jpg', 'jpeg','webp'])) {
                $errors['type'] = '<div class="alert" role="alert">' . 'پسوند مجاز نیست' . ' </div>';
            }
            if($_FILES['image']['size'] > 520000) {
                $errors['image']= (isset($errors['image'])? $errors['image']."<br>":"").'<div class="alert" role="alert">' . 'حجم فایل بیشتر از حد مجاز است' . ' </div>';
            }
            if(!isset($errors['image']) && !isset($errors['type'])) {
                $files = $_FILES['image'];
                $upload_dir = 'uploads/';
                $new_name = time() . 'includes.' . $pictureExtention;
                $dest_path = $upload_dir . $new_name;
                $fileTmpPath = $files['tmp_name'];

                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                    $sql_insert = "UPDATE users SET u_image ='" . $dest_path . "' WHERE u_id = '" . $_SESSION['user_id'] . "'";

                    if($link->query($sql_insert) === TRUE) {
                        $errors['success'] = "تصویر با موفقیت بارگذاری شد";
                    } else {
                        $errors['faild'] = "خطا در بارگذاری تصویر در پایگاه داده";
                    }
                }
                else {
                    $errors['upload'] = "خطا در آپلود فایل";
                }

            }
        }
        else{
            $errors['image'] = '<div class="alert" role="alert">' . '  لطفا تصویر را انتخاب کنید' . ' </div>';
        }
    }
    ?>
    <style>
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.26) !important;
        }
        .modal-content {
            background-color: #f8f9fa;
        }
    </style>
    <div class="col-md-9 border-0">
        <?php
        if(isset($errors['success'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #0b2c00 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-circle-check" class="mr-3"></i>
                            ' .$errors['success'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['faild'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['faild'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['image'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['image'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['type'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['type'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['upload'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['upload'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
        <div class="card m-3 p-4 border-0" style="border-radius: 24px; background-color: transparent !important;">
            <div class="item">

                <div class="container my-4 ">
                    <div class="section-title" style="margin-top: 0 !important; padding: 0 !important;">
                        <p style="margin-top: 0 !important;"> پروفایل</p>
                    </div>
                    <div id="resultsContainer">
                        <div class="card mb-5 p-4 border-0" style="border-radius: 24px; background-color: transparent !important;">
                            <div class="rounded-3 border-0 mb-5 d-flex flex-wrap justify-content-center ">
                                <div class="card rounded border-0 p-5" style=" color: black!important;">
                                    <div class="row g-4 p-3">
                                        <div class="d-flex flex-row">
                                            <div>
                                                <?php
                                                if(isset($row_user['u_image']) && !empty($row_user['u_image'])) {
                                                    echo '<img src="'.$row_user['u_image'].'" style="width: 70px; height: 70px;">';
                                                }
                                                else{
                                                    echo '<img src="img/profile.png" style="width: 70px; height: 70px;">';
                                                }
                                                ?>
                                            </div>

                                            <div class="d-flex flex-column mx-3 g-3 mt-2">
                                                <button class="btn btn-success text-white px-4" style="font-size: 12px !important;" data-bs-toggle="modal" data-bs-target="#exampleModal0" data-bs-whatever="@getbootstrap0"><i class="fas fa-pencil-alt"></i> بارگذاری تصویر   </button>

                                                <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel0" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel0"> بارگذاری تصویر پروفایل  </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="" enctype="multipart/form-data">
                                                                    <div class="mb-3">
                                                                        <label for="formFile" class="form-label">بارگذاری تصویر:</label>
                                                                        <input name="image" class="form-control" type="file" id="formFile">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                                                        <button class="btn button btn-primary" name="sub_image"><i class="bi bi-upload"></i> ثبت    </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a type="button" href="index.php?logout" class="btn btn-danger text-white mt-1" style="font-size: 12px !important;">خروج</a>
                                            </div>

                                        </div>
                                        <div class=" w-100 pt-3">
                                            <h5 class="fw-bold mb-4" ><?php echo $_SESSION['username']?> </h5>
                                            <p class="mb-2"><strong> نام و نام خانوادگی: </strong><?php echo $row_user['u_fname'].' '.$row_user['u_lname'];?></p>
                                            <p class="mb-2"><strong>شماره تلفن:</strong> <?php echo $row_user['u_phone'];?></p>
                                            <?php
                                            if(isset($row_user['u_city'])){
                                                switch ($row_user['u_city']) {
                                                    case 'mashhad':
                                                        $city = 'مشهد';
                                                        break;
                                                    case 'torghabe':
                                                        $city = 'ظرقیه';
                                                        break;
                                                }
                                            }
                                            else{
                                                $city = '';
                                            }
                                            ?>
                                            <p class="mb-2"><strong>شهر:</strong> <?php echo $city;?></p>
                                            <p class="mb-2"><strong>اخرین بازدید شما از سایت :</strong> <?php
                                                echo $row_user['u_time'];?></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>