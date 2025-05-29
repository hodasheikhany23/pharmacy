<body>
<?php
require_once("includes/header.php");
$errors = [];
if(!isset($_SESSION["username"])){
    $errors['login'] = "لطفا ابتدا وارد سایت شوید";
}
else{
    $result_factor = $link->query("SELECT * FROM factor WHERE fac_user_id = '".$_SESSION['user_id']."'");
    if($result_factor->num_rows == 0){
        $errors['empty'] = "هیچ محصولی در سبد خرید نیست";
    }
    else{
        $result_pay = $link->query("SELECT * FROM factor WHERE fac_payment_status = '3' and fac_user_id = '".$_SESSION['user_id']."'");
        if($result_pay->num_rows > 0){
            $row_factor = $result_pay->fetch_assoc();
            $result_detail = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_factor['fac_id']."'");
        }
        else{
            $errors['empty'] = "هیچ محصولی در سبد خرید نیست";
        }
    }
?>
    <div class="breadcrumb-area" style="background-color: transparent !important;" data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="d-flex px-5 py-2 justify-content-center">
                <?php
                if(isset($errors['login'])){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['login'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
                }
                if(isset($errors['empty'])){
                    echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-3"></i>
                            ' .$errors['empty'].'
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
                            $benef =0;
                            $benefit = 0;
                            if(isset($errors['empty'])){
                                echo $errors['empty'];
                            }
                            else{
                                if($result_detail->num_rows > 0){
                                    while ($row_detail = $result_detail->fetch_assoc()){
                                        $sum+=1;
                                        echo'<div id="product-'.$row_detail['facde_id'].'" class="d-flex align-items-center justify-content-between style="padding-bottom: 1em; margin-bottom: 2em; border-bottom: 1px solid rgba(128, 128, 128, 0.325);">';
                                        echo'<div class="col-lg-3">';
                                        $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '".$row_detail['facde_drog_id']."'");                                      if($result_drog->num_rows > 0){
                                            $row_drog = $result_drog->fetch_assoc();
                                        }
                                        $result_off = $link ->query("SELECT * FROM off where off_category_id = '".$row_drog['drg_category_id']."'");
                                        if($result_off -> num_rows > 0){
                                            $row_off = $result_off -> fetch_assoc();
                                            $vl = $row_off['off_value'];
                                        }
                                        else{
                                            $vl = 0;
                                        }
                                        $benef = $row_drog['drg_price'] * $vl/100;
                                        $benefit = $benefit+$benef;
                                        echo'<img src="uploads/'.$row_drog['drg_image'].'" alt="..." style="width: 50%;">';
                                        echo'</div>';
                                        echo'<div class="col-lg-2">'.$row_drog['drg_name'].'</div>';
                                        echo '<div class="col-lg-2" id="price-'.$row_detail['facde_id'].'" data-price="'.$row_drog['drg_price'].'" data-benefit-per-unit="'.$benef.'">'.number_format($row_drog['drg_price']).'</div>';
                                        $price += $row_drog['drg_price'];
                                        echo '<div class="d-none" id="hiddenPrice-'.$row_detail['facde_id'].'">11</div>';
                                        echo '<div class="d-none" id="hiddenBenefit-'.$row_detail['facde_id'].'">11</div>';
                                        echo '<div class="d-none" id="hiddenFinal-'.$row_detail['facde_id'].'">11</div>';
                                        echo '<div class="product-item col-lg-3" data-detail-id="'.$row_detail['facde_id'].'">  
                                                <div class="input-group d-flex align-items-center justify-content-center cart-increment radius20">  
                                                    <button type="button" class="btn p-3" onclick="changeQuantity('.$row_detail['facde_id'].', '.$row_drog['drg_available'].', -1)">  
                                                        <i class="bi bi-dash"></i>  
                                                    </button>  
                                                    <input type="text" name="quantity" class="input-cart form-control input-number text-center p-0 m-0"   
                                                           id="qty-'.$row_detail['facde_id'].'" value="'.$row_detail['facde_count'].'" readonly>  
                                                    <button type="button" class="quantity-right-plus btn p-3" onclick="changeQuantity('.$row_detail['facde_id'].', '.$row_drog['drg_available'].', +1)">  
                                                        <i class="bi bi-plus"></i>  
                                                    </button>  
                                                </div>  
                                            </div>
                                       <div class="col-leg-3">
                                    <button class="btn btn-danger" type="button" id="remove-btn" onclick="remove('.$row_detail['facde_id'].',1)" style="border: none; cursor: pointer; font-size: 1.3rem; color: whitesmoke;" title="حذف محصول">  
                                        <i class="bi bi-trash3"></i>  
                                    </button> 
                                    </div>';
                                        echo'</div>';
                                    }
                            }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 order-xl-1 pt-3 order-1 mb-5">
                <div class="card side-category p-4 mb-5" style="border-radius: 24px;">
                    <?php
                    $total_price = $price - $benefit;
                    ?>
                    <ul class="list-unstyled" id="price-detail" data-price="<?php echo $price; ?>" data-benfit="<?php echo number_format((int)$benefit); ?>" data-total="<?php echo (int)$total_price; ?>">
                        <li class="p-3 bg-title-sidebar">قیمت کالا ها (<?php echo $sum; ?> عدد):
                            <div class="d-flex align-items-center justify-content-center" id="total-price"><?php echo number_format($price); ?></div>
                        </li>
                        <li class="p-3">سود شما از خرید:
                            <div class="d-flex align-items-center justify-content-center" id="benefit-price"><?php echo number_format((int)$benefit); ?></div>
                        </li>
                        <li class="p-3 bg-title-sidebar">قیمت نهایی (<?php echo $sum; ?>):
                            <div class="d-flex align-items-center justify-content-center" id="final-price"><?php echo number_format((int)$total_price); ?></div>
                        </li>
                        <?php
                        if(!isset($errors['empty'])) {
                            $resultFactorUpdate = $link->query("UPDATE factor SET fac_price = '" . $price . "', fac_finalPrice= '" . $total_price . "', fac_benefit='" . $benefit . "' WHERE fac_id = '" . $row_factor['fac_id'] . "'");
                            if ($link->affected_rows != 1) {
                                echo $link->error;
                            }
                        }
                        ?>
                    </ul>
                    <li style="padding: 1em;">
                        <?php
                        if(isset($errors['empty'])){
                            echo $errors['empty'];
                        }
                        else{
                            echo " هزینه این سفارش هنوز پرداخـت نشده و در صورت اتمــام موجــودی
                        کالا ها از سبد خرید شما حدف خواهند شد.";
                        }
                        ?>

                    </li>
                    <div class="d-grid gap-2 d-none d-md-flex ">
                        <?php
                        if(!isset($errors['empty'])){
                            echo '  <a class="button btn btn-primary bg-success btn-success" href="index.php?pg=payment"> <i
                                        class="bi bi-check-lg"></i> <span style="margin-left: 2px;">| </span>ثبت خرید و پرداخـت
                            </a>';
                        }
                        ?>
                        <a class="button btn btn-outline-primary" href="index.php"> <i class="bi bi-arrow-bar-right"></i><span
                                    style="margin-left: 2px;"></span> بازگشت </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
        function remove(detailId) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/update_cart_quantity.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            const productElement = document.getElementById('product-' + detailId);
                            if (productElement) {
                                productElement.remove();
                            }
                            alert('محصول با موفقیت حذف شد.');
                        } else {
                            alert('خطا: ' + response.message);
                        }
                    } else {
                        alert('خطا در ارتباط با سرور');
                    }
                }
            };
            xhr.send('remove_id=' + encodeURIComponent(detailId));
        }
        function changeQuantity(detailId,count, delta) {
            let input = document.getElementById('qty-' + detailId);
            let currentQty = parseInt(input.value);
            let newQty = currentQty + delta;

            if (newQty < 1) {
                alert('تعداد نمی‌تواند کمتر از 1 باشد');
                return;
            }
            if (newQty > count) {
                alert('تعداد درخواستی شما بیشتر از تعداد موجود در انبار است');
                return;
            }
            let productDataDiv = document.getElementById('price-' + detailId);
            let unitPrice = parseFloat(productDataDiv.getAttribute('data-price'));
            let benefitPerUnit = parseFloat(productDataDiv.getAttribute('data-benefit-per-unit'));
            let totalPrice = unitPrice * newQty;
            let totalBenefit = benefitPerUnit * newQty;
            let finalPrice = totalPrice - totalBenefit;

            let old_totalPrice = parseFloat(document.getElementById('total-price').textContent);
            let old_benefitPrice = parseFloat(document.getElementById('benefit-price').textContent);
            let old_finalPrice = parseFloat(document.getElementById('final-price').textContent);
            let new_totalPrice,new_benefit, new_finalPrice;
            if(delta === (-1)){
                new_totalPrice = old_totalPrice - unitPrice;
                new_benefit = old_benefitPrice - benefitPerUnit;
                new_finalPrice = new_totalPrice - new_benefit;
            }
            if(delta === 1){
                new_totalPrice = old_totalPrice + unitPrice;
                new_benefit = old_benefitPrice + benefitPerUnit;
                new_finalPrice = new_totalPrice - new_benefit;
            }

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'includes/update_cart_quantity.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            input.value = newQty;
                            document.getElementById('total-price').innerText = new_totalPrice;
                            document.getElementById('benefit-price').innerText = new_benefit;
                            document.getElementById('final-price').innerText = new_finalPrice;
                        }
                        else {
                            alert('خطا: ' + response.message);
                        }
                    } else {
                        alert('خطا در ارتباط با سرور');
                    }
                }
            };

            xhr.send('detail_id=' + encodeURIComponent(detailId) +
                '&quantity=' + encodeURIComponent(newQty) +
                '&total_price=' + encodeURIComponent(new_totalPrice) +
                '&benefit=' + encodeURIComponent(new_benefit) +
                '&final_price=' + encodeURIComponent(new_finalPrice)
            );
        }
    </script>
    <?php
}
?>
</body>

