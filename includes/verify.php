<?php
$link = new mysqli("localhost", "root", "", "pharmacy_db");
if ($link===false) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
}

$link->query("set names utf8");if(empty($_GET['Authority']) || empty($_GET['Status'])) {
    die("پارامترهای پرداخت نامعتبر است");
}

$authority = $_GET['Authority'];
$status = $_GET['Status'];

if ($status == 'OK') {
    $data = [
        'merchant_id' => '9c12975a-beee-4b02-bcec-03557fe7dd7a',
        'authority' => $authority,
        'amount' => (int)$_SESSION["total_price"],
        'metadata' => [
            'factor_id' => $_SESSION['factor_id'] ?? null
        ]
    ];

    // ارسال درخواست وریفای
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json'
        ],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 30
    ]);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if($err) {
        die("خطا در ارتباط با درگاه: " . $err);
    }

    $result = json_decode($response, true);
    if(!$result || !isset($result['data'])) {
        die("پاسخ نامعتبر از درگاه پرداخت");
    }

    if ($result['data']['code'] == 100) {

        $update = $link->query("UPDATE factor SET fac_payment_status = '1',fac_finalPrice='".$_SESSION['total_price']."' WHERE fac_id = '".$_SESSION['factor_id']."'");

        echo ' <div class="container mt-3 mb-5 pb-5">
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color:#062e20 !important;" role="alert">
                  <div class="px-5">
                   <i class="fa fa-check-circle"></i>
        خرید شما با موفقیت انجام شد!
                  </div>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                </div>
        <div class="d-flex justify-content-center">
            <div class="card d-flex flex-column text-center p-5 w-50 border-0" style="height: fit-content">
                <div class="card-title" style="background-color: darkgreen; padding: 1rem 3rem; border-radius: 8px; color: white; ">
                    خرید شما با موفقیت انجام شد
                </div>
                <div class="rounded d-flex flex-column justify-content-center text-center align-content-center mt-3 p-5" style="background-color: var(--color-main); color: whitesmoke;">
                    از اعتماد شما سپاسگزاریم
                    <div class="card-link mt-5">
                        <a class="button btn btn-outline-primary" href="index.php"> <i class="bi bi-house"></i> <span
                                    style="margin-left: 2px;">|</span> بازگشت به صفحه اصلی  </a>
                    </div>
                </div>
            </div>
        </div>
    </div>';

        // پاک کردن session پس از پرداخت موفق
        unset($_SESSION['total_price']);
        unset($_SESSION['factor_id']);

    }
    else {
        echo '<div class="container mt-3 mb-5 pb-5">
    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color:#6a1a21 !important;" role="alert">
        <div class="px-5">
            <i class="fa fa-times-circle"></i>
        پرداخت شما ناموفق بود!
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card d-flex flex-column text-center p-5 w-50 border-0" style="height: fit-content">
            <div class="card-title" style="background-color: #dc3545; padding: 1rem 3rem; border-radius: 8px; color: white;">
            پرداخت انجام نشد
        </div>
            <div class="rounded d-flex flex-column justify-content-center text-center align-content-center mt-3 p-5" style="background-color: #f8d7da; color: #721c24;">
            متأسفیم! پرداخت شما با مشکل مواجه شد.
                <div class="card-link mt-5">
                    <a class="button btn btn-outline-danger" href="index.php">
                        <i class="bi bi-house"></i> <span style="margin-left: 2px;">|</span> بازگشت به صفحه اصلی
        </a>
                </div>
            </div>
        </div>
    </div>
</div>';
    }
} else {
    $update = $link->query("UPDATE factor SET fac_payment_status = '2',fac_finalPrice='".$_SESSION['total_price']."' WHERE fac_id = '".$_SESSION['factor_id']."'");

    echo '<div class="container mt-3 mb-5 pb-5">
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color:#5a4a1f !important;" role="alert">
        <div class="px-5">
            <i class="fa fa-exclamation-circle"></i>
    پرداخت شما لغو شد!
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
    </div>
    <div class="d-flex justify-content-center">
        <div class="card d-flex flex-column text-center p-5 w-50 border-0" style="height: fit-content">
            <div class="card-title" style="background-color: #ffc107; padding: 1rem 3rem; border-radius: 8px; color: #000;">
        پرداخت لغو شد
    </div>
            <div class="rounded d-flex flex-column justify-content-center text-center align-content-center mt-3 p-5" style="background-color: #fff3cd; color: #856404;">
        شما پرداخت را لغو کردید یا زمان آن به پایان رسید.
                <div class="card-link mt-5">
                    <a class="button btn btn-outline-warning" href="index.php">
                        <i class="bi bi-house"></i> <span style="margin-left: 2px;">|</span> بازگشت به صفحه اصلی
    </a>
                </div>
            </div>
        </div>
    </div>
</div>';
}

?>