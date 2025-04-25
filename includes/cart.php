<body>
<?php
require_once("includes/header.php");
$errors = [];
if(!isset($_SESSION["username"])){
    echo "لطفا ابتدا وارد سایت شوید";
}
else{
    $result_factor = $link->query("SELECT * FROM factor WHERE fac_user_id = '".$_SESSION['user_id']."'");
    if($result_factor->num_rows == 0){
        $errors['empty'] = "هیچ محصولی در سبد خرید نیست";
    }
    else{
        $row_factor = $result_factor->fetch_assoc();
        $result_detail = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_factor['fac_id']."'");
    }
?>
    <div class="breadcrumb-area" style="background-color: transparent !important;" data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <div class="breadcrumb-list">
                            <ul style="color: rgb(13, 13, 13) !important;">
                                <li><a href="../index.php"><i class="bi bi-house"></i> خانه</a></li>
                                <li style="color: rgb(13, 13, 13) !important;"> > سبد خرید </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="container mb-5">
        <div class="row">
            <div class="col-xl-8 order-xl-0 order-0 mb-5">
                <div class="card m-3 p-4" style="border-radius: 24px;">
                    <div class="item">
                        <div class="">
                            <?php
                            $sum = 0;
                            $price = 0;
                            $off = 10;
                            if($result_detail->num_rows > 0){
                                while ($row_detail = $result_detail->fetch_assoc()){
                                    $sum+=1;
                                    echo'<div class="d-flex align-items-center justify-content-between" style="padding-bottom: 1em; margin-bottom: 2em; border-bottom: 1px solid rgba(128, 128, 128, 0.325);">';
                                    echo'<div class="col-lg-3">';
                                    $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '".$row_detail['facde_drog_id']."'");                                      if($result_drog->num_rows > 0){
                                        $row_drog = $result_drog->fetch_assoc();
                                    }
                                    echo'<img src="uploads/'.$row_drog['drg_image'].'" alt="..." style="width: 50%;">';
                                    echo'</div>';
                                    echo'<div class="col-lg-2">'.$row_drog['drg_name'].'</div>';
                                    echo '<div class="col-lg-2">'.$row_drog['drg_price'].'</div>';
                                    $price += $row_drog['drg_price'];
                                    echo ' <div class="col-lg-3">
                                    <div class="input-group d-flex align-items-center justify-content-center cart-increment radius20">    
                                        <button type="button" class="quantity-right-plus btn p-3" id="increase-btn">  
                                            <i class="bi bi-plus"></i>    
                                        </button>  
                                        <input type="text" id="quantity" name="quantity"  
                                            class="input-cart form-control input-number text-center p-0 m-0" value="1" min="1" max="100" readonly>  
                                        <button type="button" class="quantity-left-minus btn p-3" id="decrease-btn">  
                                            <i class="bi bi-dash"></i>  
                                        </button>            
                                    </div>  
                                </div>';
                                    echo '<div class="col-leg-3">
                                    <button class="btn btn-danger" type="button" id="remove-btn" style="border: none; cursor: pointer; font-size: 1.3rem; color: whitesmoke;" title="حذف محصول">  
                                        <i class="bi bi-trash3"></i>  
                                     </button> 
                                    </div>';
                                    echo'</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 order-xl-1 pt-3 order-1 mb-3">
                <div class="card side-category p-4 mb-3" style="border-radius: 24px;">
                    <ul class="list-unstyled">
                        <li class="p-3 bg-title-sidebar">قیمت کالا ها (<?php echo $sum; ?> عدد):
                            <div class="d-flex align-items-center justify-content-center">
                                <?php echo $price; ?> تومان
                            </div>
                        </li>
                        <li class="p-3">سود شما از خرید:
                            <div class="d-flex align-items-center justify-content-center">
                                <?php
                                $benefit = $price * 12/100;
                                echo (int)$benefit; ?>
                                تومان
                            </div>
                        </li>
                        <li class="p-3 bg-title-sidebar">قیمت نهایی (3 عدد):
                            <div class="d-flex align-items-center justify-content-center">
                                <?php $total_price = $price-$benefit;
                                echo (int)$total_price; ?>
                                 تومان
                            </div>
                        </li>
                    </ul>
                    <li style="padding: 1em;">
                        هزینه این سفارش هنوز پرداخـت نشده و در صورت اتمــام موجــودی
                        کالا ها از سبد خرید شما حدف خواهند شد.
                    </li>
                    <div class="d-grid gap-2 d-none d-md-flex ">
                            <a class="button btn btn-primary bg-success btn-success" href="index.php?pg=payment"> <i
                                        class="bi bi-check-lg"></i> <span style="margin-left: 2px;">| </span>ثبت خرید و پرداخـت
                            </a>
                        <a class="button btn btn-outline-primary" href="index.php"> <i class="bi bi-arrow-bar-right"></i><span
                                    style="margin-left: 2px;"></span> بازگشت </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        const quantityInput = document.getElementById('quantity');
        const increaseBtn = document.getElementById('increase-btn');
        const decreaseBtn = document.getElementById('decrease-btn');
        const removeBtn = document.getElementById('remove-btn');

        increaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < parseInt(quantityInput.max)) {
                quantityInput.value = currentValue + 1;
            }
        });

        decreaseBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > parseInt(quantityInput.min)) {
                quantityInput.value = currentValue - 1;
            }
        });

        removeBtn.addEventListener('click', () => {
            // برای حذف محصول از سبد خرید، بسته به روش شما ممکن است ایجکس یا رفرش صفحه لازم باشد
            // اینجا فقط مثال ساده پاک کردن مقدار و غیرفعال کردن کنترل‌ها
            quantityInput.value = 0;
            quantityInput.disabled = true;
            increaseBtn.disabled = true;
            decreaseBtn.disabled = true;
            removeBtn.disabled = true;
            alert('محصول از سبد خرید حذف شد.');
        });
    </script>
    <?php
}
?>
</body>

