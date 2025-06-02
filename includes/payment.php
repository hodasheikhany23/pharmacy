<?php
$errors = [];
if(!isset($_SESSION["username"])){
    $errors['login'] = "لطفا ابتدا وارد سایت شوید";
    exit();
}
else{
    $result_factor = $link->query("SELECT * FROM factor WHERE fac_user_id = '".$_SESSION['user_id']."' and fac_payment_status ='3'");
    if($result_factor->num_rows == 0){
        $errors['empty'] = "هیچ محصولی در سبد خرید نیست";
    }
    else{
        $row_factor = $result_factor->fetch_assoc();
        $result_detail = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_factor['fac_id']."'");
        $price = 0;
        $benef = 0;
        $benefit = 0;
        while($row_detail = $result_detail->fetch_assoc()){
            $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '" . $row_detail['facde_drog_id'] . "'");
            if ($result_drog->num_rows > 0) {
                $row_drog = $result_drog->fetch_assoc();
                $price += $row_drog['drg_price'];
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
        }
        $total_price = $price - $benefit;
        $_SESSION['total_price'] = (int)$total_price;
        $_SESSION['factor_id'] = $row_factor['fac_id'];
    }

    if(isset($_POST['submit']) && $_POST['payment_method'] == '1'){
        $merchant_id = "9c12975a-beee-4b02-bcec-03557fe7dd7a";
        $callback_url = "http://localhost:8080/pharmacy/index.php?pg=verify";
        $description = "پرداخت سفارش شماره " . $row_factor['fac_id'];
        $data = [
            'merchant_id' => $merchant_id,
            'currency' => "IRT",
            'amount' => (int)$total_price,
            'callback_url' => $callback_url,
            'description' => $description,
            'metadata' => [
                'mobile' => $_SESSION['phone'] ?? '',
                'email' => '',
            ]
        ];

        $ch = curl_init('https://sandbox.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if($err) {
            die("خطای cURL: " . $err);
        }


        $result = json_decode($response, true);
        if(json_last_error() !== JSON_ERROR_NONE) {
            die("خطا در تفسیر پاسخ JSON: " . json_last_error_msg());
        }
        if($err) {
            $errors['payment'] = "خطا در ارتباط با درگاه پرداخت: " . $err;
        }
        elseif(empty($result['data']['code'])) {
            $errors['payment'] = "پاسخ نامعتبر از درگاه پرداخت";
        }
        ob_end_clean();
        if($result['data']['code'] == 100) {
            $authority = $result['data']['authority'];
            echo '<script>window.location.href="https://sandbox.zarinpal.com/pg/StartPay/'.$result['data']['authority'].'";</script>';
            exit();

        }
        else {
           echo "خطا در ایجاد تراکنش: کد خطا " . $result['data']['code'];
        }
    }

    //        require_once "time/jdf.php";
//        $time = jdate("Y-m-d H:i:s");
//        $result_save = $link -> query("INSERT INTO payment (pay_date, pay_price, pay_paymethod_id,pay_paystatus_id,pay_factor_id) values ('".$time."','".$_POST['total_price']."','".$_POST['payment_method']."','1','".$row_factor['fac_id']."')");
//        if($link->errno==0){
//            $link -> query("UPDATE factor SET fac_payment_status = '1' WHERE fac_id = '".$row_factor['fac_id']."'");
//            $errors['ok'] = "خرید موفق";
//            $result_facde = $link -> query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_factor['fac_id']."'");
//            while($row_facde = $result_facde->fetch_assoc()){
//                $result_drog_sale = $link -> query("SELECT * FROM drogs WHERE drg_id = '".$row_facde['facde_drog_id']."'");
//                if($result_drog_sale->num_rows > 0){
//                    $row_drog_sale = $result_drog_sale->fetch_assoc();
//                    $count = $row_facde['facde_count'];
//                    $available = $row_drog_sale['drg_available'] - $count;
//                    if($available < 0){
//                        $available = 0;
//                    }
//                    $sale = $row_drog_sale['drg_sales'];
//                    $sale += $count;
//                    $link->query("UPDATE drogs SET drg_available = '$available', drg_sales = '$sale' WHERE drg_id = '".$row_drog_sale['drg_id']."'");
//                }
//            }
//            require_once "includes/thank.php";
//        }
//        else{
//            echo $link->error;
//        }
 //   }
?>
<body>
<div class="container">
    <div class="d-flex px-5 py-2 justify-content-center">
        <?php
        if(isset($errors['ok'])){
            echo '<div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #062e20 !important;" role="alert">
                          <div class="px-5">
                           <i class="fa fa-check-circle"></i>
                            ' .$errors['ok'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['empty'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="fa fa-exclamation-triangle"></i>
                            ' .$errors['empty'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>
    </div>
    <div class="row d-flex justify-content-between mt-5 " style="margin-bottom: 400px !important;">
        <div class="col-lg-7 mr-5" style="background-color: #f8f9fa; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); max-height: 600px; overflow-y: auto;">
            <h4 class="title-2" style="color: #343a40; margin-bottom: 20px;"> فاکتور</h4>
            <table class="table" style="width: 100%; border-collapse: collapse; color: #495057;">
                <tbody>
                <?php
                $sum = 0;
                $price = 0;
                $off = 10;
                $result_detail = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = '".$row_factor['fac_id']."'");
                if ($result_detail->num_rows > 0) {
                    while ($row_detail = $result_detail->fetch_assoc()) {
                        $sum += 1;
                        echo '<tr style="border-bottom: 1px solid #ced4da;">';
                        $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '" . $row_detail['facde_drog_id'] . "'");
                        if ($result_drog->num_rows > 0) {
                            $row_drog = $result_drog->fetch_assoc();
                        }
                        echo '<td style="padding: 12px;">' . $row_drog['drg_name'] . '</td>';
                        echo '<td style="padding: 12px;">' . number_format($row_drog['drg_price']) . '</td>';
//                        $price += $row_drog['drg_price'];
                        echo ' <div class="col-lg-3">';
                    }
                }
                ?>
                <tr style="border-bottom: 1px solid #ced4da; color: #6c757d;">
                    <td style="padding: 12px;">تخفیف</td>
                    <td style="padding: 12px;">
                        <?php
//                        $benefit = $price * 12/100;
                        echo number_format((int)$benefit); ?>
                        تومان
                    </td>
                </tr>
                <tr>
                    <td style="padding: 12px; font-weight: bold; color: #343a40;">مجموعه خرید</td>
                    <td style="padding: 12px; font-weight: bold; color: #28a745;">
<!--                        --><?php //$total_price = $price-$benefit;
                        echo number_format((int)$total_price); ?>
                        تومان
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="col-lg-4 mb-5" style="height: 450px;">
            <div class="ltn__checkout-payment-method mb-5" style="background-color: #f8f9fa; padding: 25px 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); max-width: 400px;">

                <h4 class="title-2" style="color: #343a40; margin-bottom: 25px; font-weight: 600;">روش پرداخت</h4>

                <form action="" method="post" style="max-width: 400px;">
                    <input type="hidden" name="total_price" value="<?php echo number_format((int)$total_price); ?>">
                    <div class="card" style="border: none; margin-bottom: 15px;">
                        <h5 class="ltn__card-title"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq-item-2-2"
                            aria-expanded="false"
                            style="cursor: pointer; padding: 15px 20px; border: 1px solid #ced4da; border-radius: 6px; display: flex; align-items: center; transition: background-color 0.3s ease;">

                            <input type="radio" name="payment_method" value="2" checked style="margin-left: 15px; width: 20px; height: 20px;">
                            <span style="color: #495057; font-weight: 500;">پرداخت نقدی هنگام تحویل</span>

                        </h5>
                        <div id="faq-item-2-2" class="collapse show" data-bs-parent="#checkout_accordion_1" style="padding: 12px 25px 10px 45px; color: #6c757d; font-size: 14px;">
                            پرداخت نقدی هنگام تحویل
                        </div>
                    </div>

                    <!-- گزینه پرداخت آنلاین -->
                    <div class="card" style="border: none;">
                        <h5 class="collapsed ltn__card-title"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq-item-2-3"
                            aria-expanded="false"
                            style="cursor: pointer; padding: 15px 20px; border: 1px solid #ced4da; border-radius: 6px; display: flex; align-items: center; transition: background-color 0.3s ease;">

                            <input type="radio" name="payment_method" value="1" style="margin-left: 15px; width: 20px; height: 20px;">
                            <span style="color: #495057; font-weight: 500;">درگاه پرداخت آنلاین</span>

                        </h5>
                        <div id="faq-item-2-3" class="collapse" data-bs-parent="#checkout_accordion_1" style="padding: 12px 25px 10px 45px; color: #6c757d; font-size: 14px;">
                            پرداخت از طریق کارت‌های بانکی عضو شتاب دارنده رمز پویا به وسیله درگاه پرداخت آنلاین
                        </div>
                    </div>

                    <div class="ltn__payment-note mt-30 mb-30" style="color: #6c757d; font-size: 13px; line-height: 1.5; padding: 0 5px;">
                        اطلاعات شخصی شما برای پردازش سفارش شما، پشتیبانی از تجربه شما و اهداف دیگر استفاده می‌شود.
                    </div>

                    <button class="btn button btn-primary mb-5" type="submit" name="submit"
                            style="width: 100%; background-color: #28a745; border: none; padding: 12px 0; font-weight: 600; border-radius: 7px; cursor: pointer; font-size: 16px;">
                        تایید و پرداخت
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
}
?>