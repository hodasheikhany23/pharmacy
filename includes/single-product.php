<?php
$errors =[];
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
if(isset($_POST['add_to_cart'])){
    if(!isset($_SESSION['username'])){
        $errors['username']="لطفا اول وارد حساب کاربری خود شوید";
    }
    else{
        $time = date("Y-m-d H:i:s");
        $result_factor = $link -> query("INSERT INTO factor (fac_user_id, fac_date) VALUES ('".$_SESSION['user_id']."', '".$time."')");
        $select_factor = $link -> query("SELECT * FROM factor WHERE fac_user_id = '".$_SESSION['user_id']."'");
        if($link -> errno==0){
            $rowFactor = $select_factor -> fetch_assoc();
            $result_detail = $link -> query("INSERT INTO `factor_detail`( `facde_factor_id`, `facde_drog_id`, `facde_count`) VALUES ('".$rowFactor['fac_id']."','".$rowDrog['drg_id']."','1')");

        }
        else{
            echo $link->error;
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="breadcrumb-list">
                            <ul style="color: rgb(13, 13, 13) !important;">
                                <li><a href="index.php"><i class="bi bi-house"></i>  خانه ></a></li>
                                <li style="color: rgb(13, 13, 13) !important;"><?php echo $rowSubm['subm_name'];?> > <?php echo $rowDrog['drg_name'];?></li>
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
                                    <?php
                                    $drg_rank = $rowDrog['drg_rank'];
                                    echo '<div class="d-flex flex-row justify-content-start mt-2 mb-2 gap-1 p-2">';
                                    for($i=1;$i<=$drg_rank;$i++) {
                                        echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important;"></i>';
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
                                    <h4 class="title-2">درباره دستگاه فشار سنج مدل L5-S</h4>
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از
                                        طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                        لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف
                                        بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و
                                        آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت
                                        بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در
                                        زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود
                                        در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل
                                        حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                                        اساسا مورد استفاده قرار گیرد.
                                    </p>
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از
                                        طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که
                                        لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف
                                        بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و
                                        آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت
                                        بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در
                                        زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود
                                        در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل
                                        حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                                        اساسا مورد استفاده قرار گیرد.لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم
                                        از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه
                                        و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد
                                        نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی
                                        در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد،
                                        تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان
                                        خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت
                                        که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل
                                        دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_details_1_2">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">نظرات درباره محصول</h4>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                            <li class="review-total"> <a href="#"> (95 نظر)</a></li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <!-- comment-area -->
                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner">
                                            <ul>
                                                <li>
                                                    <div class="ltn__comment-item clearfix">
                                                        <div class="ltn__commenter-img">
                                                            <img src="img/testimonial/1.jpg" alt="Image">
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#">امیررضا رفیعی</a></h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>لورم ایپسوم متن ساختگی با معنی و مفهوم نامعتبر در
                                                                راستای بهبود ظاهری متون برای طراحان قدم برمیدارد.
                                                            </p>
                                                            <span class="ltn__comment-reply-btn">3 مرداد 1401</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ltn__comment-item clearfix">
                                                        <div class="ltn__commenter-img">
                                                            <img src="img/testimonial/3.jpg" alt="Image">
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#">marzie</a></h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>لورم ایپسوم متن ساختگی با معنی و مفهوم نامعتبر در
                                                                راستای بهبود ظاهری متون برای طراحان قدم برمیدارد.
                                                            </p>
                                                            <span class="ltn__comment-reply-btn">3 مرداد 1401</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ltn__comment-item clearfix">
                                                        <div class="ltn__commenter-img">
                                                            <img src="img/testimonial/2.jpg" alt="Image">
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#">نگین درخشنده</a></h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                    class="fas fa-star-half-alt"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p>لورم ایپسوم متن ساختگی با معنی و مفهوم نامعتبر در
                                                                راستای بهبود ظاهری متون برای طراحان قدم برمیدارد.
                                                            </p>
                                                            <span class="ltn__comment-reply-btn">3 مرداد 1401</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- comment-reply -->
                                    <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                        <form action="#">
                                            <h4 class="title-2">ارسال نظر</h4>
                                            <div class="mb-30">
                                                <div class="add-a-review">
                                                    <h6>امتیاز شما به محصول:</h6>
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <textarea placeholder="نظر خود را بنویسید..."></textarea>
                                            </div>
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" placeholder="نام ....">
                                            </div>
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" placeholder="ایمیل...">
                                            </div>
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <input type="text" name="website" placeholder="آدرس سایت...">
                                            </div>
                                            <label class="mb-0"><input type="checkbox" name="agree"> ذخیره ایمیل،نام
                                                و آدرس وبسایت برای ارسال نظر در آینده</label>
                                            <div class="btn-wrapper">
                                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase"
                                                        type="submit">ارسال</button>
                                            </div>
                                        </form>
                                    </div>
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
                                    <strong>دسته بندی:</strong>
                                    <span>
                                    <?php
                                    echo $rowCat['cat_name'];
                                    ?>
                                </span>
                                </li>
                            </ul>
                            <hr>
                            <div class="product-price">
                                <span style="font-size: 20px">490،000تومان</span>
                                <del>510،000تومان</del>
                            </div>
                            <hr>
                            <form method="post" action="">
                                <button class="button btn btn-primary" name="add_to_cart"> <i class="bi bi-bag-plus"></i> <span
                                            style="margin-left: 2px;">|</span>افزودن به سبد خرید </button>
                                <button class="btn button button2 add-to-favorite" style="background-color: #dc483c !important;"><i
                                            class="bi bi-heart"></i></button>
                            </form>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>


</body>

</html>