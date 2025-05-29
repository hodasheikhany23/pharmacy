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

    ?>
    <div class="col-md-9 border-0">
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
                                                    echo '<img src="uploads/'.$row_user['u_image'].'" style="width: 70px; height: 70px;">';
                                                }
                                                else{
                                                    echo '<img src="img/profile.png" style="width: 70px; height: 70px;">';
                                                }
                                                ?>
                                            </div>

                                            <div class="d-flex flex-column mx-3 g-3 mt-2">
                                                <a type="button" href="" class="btn btn-success text-white px-4" style="font-size: 12px !important;">بارگزاری تصویر</a>
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