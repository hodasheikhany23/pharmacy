<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>صفحه مدیریت داروخانه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .section {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        .header-top {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .logo-img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
        .header-top button {
            margin-left: 20px;
        }
        .title-with-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h4, h5 {
            margin-bottom: 10px;
        }
        /* استایل برای کارت کامل */
        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .profile-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .progress {
            height: 8px;
            border-radius: 4px;
        }
        .progress-bar {
            background-color: #4e73df;
        }
        .footer-btn {
            min-width: 46px;
            min-height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        /* بخش تصاویر مدارک */
        .docs-images img {
            max-height: 120px;
            width: auto;
            border-radius: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="px-4 pt-4">
<?php
if(!in_array('17',$perm)) {
    die("شما مجوز دسترسی به این صفحه را ندارید");
}
$errors=[];
if (isset($_POST['sub_update_lic'])) {
    if (isset($_FILES['pic'])) {
        $files = $_FILES['pic'];
        $fileTmpPath = $files['tmp_name'];
        $fileName = $files['name'];
        $fileSize = $files['size'];
        $fileType = $files['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $upload_dir = 'uploads/';
        $new_name = time() . '.' . $fileExt;
        $dest_path = $upload_dir . $new_name;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $sql_update = "UPDATE license SET lic_name ='".clean_data($_POST['name'])."',lic_image='".$dest_path."',lic_link='".$_POST['link']."' WHERE lic_id='".$_POST['id']."'";
            if($link->query($sql_update) === TRUE){
                $errors['success'] = "ویرایش با موفقیت انجام شد";
            }
            else {
                $errors['fail'] = "خطا در ویرایش اطلاعات";
            }
        }

    }
}
if (isset($_POST['sub_add_lic'])) {
    if (isset($_FILES['pic'])) {
        $files = $_FILES['pic'];
        $fileTmpPath = $files['tmp_name'];
        $fileName = $files['name'];
        $fileSize = $files['size'];
        $fileType = $files['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $upload_dir = 'uploads/';
        $new_name = time() . '.' . $fileExt;
        $dest_path = $upload_dir . $new_name;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $sql_update = "INSERT INTO license (lic_name,lic_image,lic_link) VALUES ('".clean_data($_POST['name'])."','".$dest_path."','".$_POST['link']."')";
            if($link->query($sql_update) === TRUE){
                $errors['success'] = "ذخیره با موفقیت انجام شد";
            }
            else {
                $errors['fail'] = "خطا در ذخیره اطلاعات";
            }
        }

    }
}
if (isset($_POST['sub_contact'])) {
    if(isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }
    else{
        $errors['fail'] = "شماره موبایل را وارد کنید";
    }
    if(isset($_POST['telegram'])) {
        $telegram = $_POST['telegram'];
    }
    else{
        $errors['fail'] = "ایدی تلگرام را وارد کنید";
    }
    if(isset($_POST['whatsapp'])) {
        $whatsapp = $_POST['whatsapp'];
    }
    else{
        $errors['fail'] = " شماره واتساپ را وارد کنید";
    }
    if(isset($_POST['email'])) {
        $email= $_POST['email'];
    }
    else {
        $errors['fail'] = "ایمیل را وارد کنید";
    }
    $result_name = $link->query("UPDATE info SET info_phone='".$phone."', info_email='".$email."', info_whatsapp='".$whatsapp."', info_telegram='".$telegram."'");
    if ($link->affected_rows > 0) {
        $errors['success'] = "ویرایش با موفقیت انجام شد";
    } else {
        $errors['fail'] = "خطا در ویرایش اطلاعات";
    }
}
if (isset($_POST['sub_about'])) {
    if(isset($_POST['about'])) {
        $about = $_POST['about'];
        $result_name = $link->query("UPDATE info SET info_about='$about'");
        if ($link->affected_rows > 0) {
            $errors['success'] = "ویرایش با موفقیت انجام شد";
        } else {
            $errors['fail'] = "خطا در ویرایش اطلاعات";
        }
    }
}
if (isset($_POST['sub_address'])) {
    if(isset($_POST['address'])) {
        $address = $_POST['address'];
        $result_name = $link->query("UPDATE info SET info_address='$address'");
        if ($link->affected_rows > 0) {
            $errors['success'] = "ویرایش با موفقیت انجام شد";
        } else {
            $errors['fail'] = "خطا در ویرایش اطلاعات";
        }
    }
}
if (isset($_POST['sub_name'])) {
    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $result_name = $link->query("UPDATE info SET info_name='$name'");
        if ($link->affected_rows > 0) {
            $errors['success'] = "ویرایش با موفقیت انجام شد";
        } else {
            $errors['fail'] = "خطا در ویرایش اطلاعات";
        }
    }
}
if (isset($_POST['sub_logo'])) {
    if (isset($_FILES['logo'])) {
        $files = $_FILES['logo'];
        $fileTmpPath = $files['tmp_name'];
        $fileName = $files['name'];
        $fileSize = $files['size'];
        $fileType = $files['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $upload_dir = 'uploads/';
        $new_name = time() . '.' . $fileExt;
        $dest_path = $upload_dir . $new_name;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $sql_update = "UPDATE info SET info_logo ='". $dest_path . "'";
            $link->query($sql_update);
            if($link->query($sql_update) === TRUE){
                $errors['success'] = "ویرایش با موفقیت انجام شد";
            }
            else {
                $errors['fail'] = "خطا در ویرایش اطلاعات";
            }
        }

    }
}
if (isset($_POST['sub_doc'])) {
    if (isset($_FILES['image'])) {
        $files = $_FILES['image'];
        $fileTmpPath = $files['tmp_name'];
        $fileName = $files['name'];
        $fileSize = $files['size'];
        $fileType = $files['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $upload_dir = 'uploads/';
        $new_name = time() . 'includes' . $fileExt;
        $dest_path = $upload_dir . $new_name;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $sql_update = "UPDATE info SET info_doctor_name ='" . clean_data($_POST['name']) . "', info_doctor_image='" . $dest_path . "'";
            $link->query($sql_update);
            if($link->query($sql_update) === TRUE){
                $errors['success'] = "ویرایش با موفقیت انجام شد";
            }
            else {
                $errors['fail'] = "خطا در ویرایش اطلاعات";
            }
        }

    }
}
$result_info = $link->query("SELECT * FROM info");
if($result_info->num_rows > 0) {
    $row_info = $result_info->fetch_assoc();
}


?>
<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['success'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert" id="success-add">  
            <div>  
                <i class="fa fa-check-circle"></i>  
                ' . $errors['success'] . '  
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>  
          </div>';
        }
        if(isset($errors['fail'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert" id="success-add">  
            <div>  
               <i class="fa fa-exclamation-triangle"></i>  
                ' . $errors['fail'] . '  
            </div>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>  
          </div>';
        }
        ?>
    </div>
</div>
<div class="d-flex justify-content-between mt- gap-2">
    <div class="section mt-2 col-md-6">
        <div class="title-with-btn">
            <h4> لوگو</h4>
            <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal0" data-bs-whatever="@getbootstrap0"><i class="fas fa-pencil-alt"></i> ویرایش لوگو  </button>
            <div class="modal fade" id="exampleModal0" tabindex="-1" aria-labelledby="exampleModalLabel0" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel0"> ویرایش لوگو </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">بارگذاری لوگو:</label>
                                <input name="logo" class="form-control" type="file" id="formFile">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                <button class="btn button btn-primary" name="sub_logo"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="d-flex align-items-center">
            <div>
                <img src="<?php echo $row_info['info_logo'] ?>" class="logo-img border-0" alt="لوگو" />
            </div>
        </div>
    </div>

    <!-- نام داروخانه -->
    <div class="section mt-2 col-md-6"">
        <div class="title-with-btn">
            <h4>نام داروخانه</h4>
            <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"><i class="fas fa-pencil-alt"></i> ویرایش نام داروخانه </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> ویرایش نام داروخانه</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">نام جدید:</label>
                                    <input type="text" name="name" class="form-control" id="recipient-name" value="<?php echo $row_info['info_name'];?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                    <button class="btn button btn-primary" name="sub_name"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div>
                <p><?php echo $row_info['info_name'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between mt- gap-2">
    <div class="section col-md-6">
        <div class="title-with-btn mb-3">
            <h4>نام داروساز</h4>
            <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap2"><i class="fas fa-pencil-alt"></i> ویرایش مشخصات مسئول داروخانه </button>
            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش مشخصات داروساز </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">نام :</label>
                                    <input type="text" name="name" class="form-control" id="recipient-name" value="<?php echo $row_info['info_doctor_name'];?>">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">تصویر:</label>
                                    <input name="image" class="form-control" type="file" id="formFile">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                    <button class="btn button btn-primary" name="sub_doc"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <img src="<?php echo $row_info['info_doctor_image'] ?>" class="profile-img" alt="پزشک" />
            <div class="ms-3">
                <p class="mb-0"><?php echo $row_info['info_doctor_name'] ?></p>
            </div>
        </div>
    </div>
    <div class="section col-md-6">
        <div class="title-with-btn mb-3">
            <h4>آدرس داروخانه </h4>
            <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getbootstrap3"><i class="fas fa-pencil-alt"></i> ویرایش آدرس   </button>
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش آدرس  </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="">
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">آدرس  :</label>
                                    <textarea type="text" name="address" class="form-control" id="recipient-name"><?php echo $row_info['info_address']; ?></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                    <button class="btn button btn-primary" name="sub_address"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="ms-3">
                <p class="mb-0"><?php echo $row_info['info_address'] ?></p>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <h5 class="mb-2">درباره ما</h5>
    <p>
        <?php echo $row_info['info_about'] ?>
    </p>
    <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-bs-whatever="@getbootstrap4"><i class="fas fa-pencil-alt"></i> ویرایش درباره ما</button>
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش متن درباره ما  </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">متن :</label>
                            <textarea style="height: 400px!important;" type="text" name="about" class="form-control" id="recipient-name"><?php echo $row_info['info_about']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                            <button class="btn button btn-primary" name="sub_about"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between mt- gap-2">
    <div class="section col-md-6">
        <h5>اطلاعات تماس</h5>
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                شماره تماس
                <span class="fw-bold"><?php echo $row_info['info_phone'] ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                آی‌دی تلگرام
                <span class="fw-bold"><?php echo $row_info['info_telegram'] ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                آی‌دی واتساپ
                <span class="fw-bold"><?php echo $row_info['info_whatsapp'] ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                ایمیل
                <span class="fw-bold"><?php echo $row_info['info_email'] ?></span>
            </li>
        </ul>
        <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal5" data-bs-whatever="@getbootstrap5"><i class="fas fa-pencil-alt"></i> ویرایش اطلاعات تماس </button>
        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel5" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel2"> ویرایش اطلاعات تماس  </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">موبایل :</label>
                                <input type="text" name="phone" class="form-control" id="recipient-name" value="<?php echo $row_info['info_phone'];?>">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">تاگرام :</label>
                                <input type="text" name="telegram" class="form-control" id="recipient-name" value="<?php echo $row_info['info_telegram'];?>">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">واتساپ :</label>
                                <input type="text" name="whatsapp" class="form-control" id="recipient-name" value="<?php echo $row_info['info_whatsapp'];?>">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">ایمیل :</label>
                                <input type="text" name="email" class="form-control" id="recipient-name" value="<?php echo $row_info['info_email'];?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                <button class="btn button btn-primary" name="sub_contact"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section col-md-6">
        <div class="d-flex justify-content-between">
            <h5 class="mb-3"> مدارک و مجوز ها</h5>
            <button class="btn button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal6" data-bs-whatever="@getbootstrap6"><i class="fas fa-plus"></i> افزودن مدرک</button>
            <div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel6" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel0"> افزودن مدرک/مجوز  </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label"> نام مجوز:</label>
                                    <input name="name" class="form-control" type="text" id="formFile">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">بارگذاری تصویر:</label>
                                    <input name="pic" class="form-control" type="file" id="formFile">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label"> لینک مجوز:</label>
                                    <input name="link" class="form-control" type="text" id="formFile">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                    <button class="btn button btn-primary" name="sub_add_lic"><i class="fas fa-plus"></i> افزودن    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex docs-images mb-3 flex-wrap">
        <?php
        $result_license = $link->query("SELECT * FROM license");
        if($result_license->num_rows > 0) {
            while($row_license = $result_license->fetch_assoc()) {
                echo '<div class="d-flex flex-column align-items-start justify-content-center">';
                echo '<img src="'.$row_license['lic_image'].'" alt="'.$row_license['lic_name'].'" />';
                echo '
                <button class="btn button btn-primary btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#exampleModal7" data-bs-whatever="@getbootstrap7"><i class="fas fa-pencil-alt"></i> ویرایش </button>
                    <div class="modal fade" id="exampleModal7" tabindex="-1" aria-labelledby="exampleModalLabel7" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel0"> ویرایش مدرک </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" enctype="multipart/form-data">
                                     <input name="id" value="'.$row_license['lic_id'].'" class="form-control hide" type="text" id="formFile" style="visibility:hidden;">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label"> نام مجوز:</label>
                                            <input name="name" class="form-control" type="text" id="formFile">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">بارگذاری تصویر:</label>
                                            <input name="pic" class="form-control" type="file" id="formFile">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label"> لینک مجوز:</label>
                                            <input name="link" class="form-control" type="text" id="formFile">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                                            <button class="btn button btn-primary" name="sub_update_lic"><i class="fas fa-pencil-alt"></i> ویرایش    </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> ';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>