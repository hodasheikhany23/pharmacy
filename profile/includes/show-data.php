<?php
session_start();
$link = new mysqli("localhost", "root", "", "pharmacy_db");
require_once "../../time/jdf.php";
function dateFormat($value){
    $value=jdate('d F Y',$value);
    return $value;
}
$result_factor = $link->query("SELECT * FROM factor WHERE fac_user_id = '" . $_SESSION["user_id"] ."'");
$c = 0;
while ($row_factor = $result_factor->fetch_assoc()) {
    $c++;
    echo '<div class="card mb-5 p-4 border-0" style="border-radius: 24px;">';
    echo '<div class="mytext-bold p-2">مشخصات فاکتور </div>';
    echo '<div class="card rounded-3 border-1 mb-5" style="border-color: rgba(95,137,222,0.29);">
                                              <div class="table-responsive rounded-3">';
    echo ' <table class="table align-middle mb-0">';
    echo '<thead class="table-light">
                                    <tr>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;"> ردیف</th>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">شماره سفارش</th>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">تاریخ</th>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">قیمت (تومان)</th>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">تخفیف (تومان)</th>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">قیمت نهایی (تومان)</th>
                                        <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>';
    echo '<tr>';
    echo '<td>' . $c . '</td>';
    echo '<td>' . $row_factor['fac_id'] . '</td>';
    echo '<td>' .$row_factor['fac_date'] . '</td>';
    echo '<td class="text-danger fw-bold"><del>' . number_format($row_factor['fac_price']) . '</del></td>';
    echo '<td class="text-warning fw-bold">' . number_format($row_factor['fac_benefit']) . '</td>';
    echo '<td class="text-success fw-bold">' . number_format($row_factor['fac_finalPrice']) . '</td>';
    switch ($row_factor['fac_payment_status']) {
        case '3':
            $status = '<span class="badge bg-warning p-2">ناتمام</span>';
            break;
        case '2':
            $status = '<span class="badge bg-danger p-2">ناموفق</span>';
            break;
        case '1':
            $status = '<span class="badge bg-success p-2">موفق</span>';
            break;
    }
    echo '<td>' . $status . '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '<div class="mytext-bold p-2">جزئیات فاکتور </div>';
    echo '<div class="card rounded-3 mb-5 border-1" style="border-color:rgba(95,137,222,0.29); ">
                                              <div class="table-responsive rounded-3">';
    echo '<table class="table align-middle table-striped">';
    echo '<thead class="table-light">';
    echo '<tr>
                                                <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">ردیف </th>
                                                <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">نام محصول</th>
                                                <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">قیمت (تومان)</th>
                                                <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">تخفیف (درصد)</th>
                                                <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">قیمت نهایی (تومان)</th>
                                                <th scope="col" style="background-color: rgba(95,137,222,0.31) !important;">تعداد</th>
                                              </tr>';
    $count = 0;
    $result_factor_detail = $link->query("SELECT * FROM factor_detail WHERE facde_factor_id = " . $row_factor["fac_id"]);
    while ($row_detail = $result_factor_detail->fetch_assoc()) {
        $count++;
        $result_drog = $link->query("SELECT * FROM drogs where drg_id = " . $row_detail["facde_drog_id"]);
        if ($result_drog->num_rows > 0) {
            $row_drog = $result_drog->fetch_assoc();
        }
        $result_off = $link->query("SELECT * FROM off where off_category_id = '" . $row_drog['drg_category_id'] . "'");
        if ($result_off->num_rows > 0) {
            $row_off = $result_off->fetch_assoc();
            $vl = $row_off['off_value'];
        } else {
            $vl = 0;
        }
        $price = $row_drog['drg_price'] * $vl / 100;
        echo '<tr>';
        echo '<td>' . $count . '</td>';
        echo '<td>' . $row_drog['drg_name'] . '</td>';
        echo '<td>' . number_format($row_drog['drg_price']) . '</td>';
        echo '<td class="fw-bold">' . $vl . '%</td>';
        echo '<td class="text-success fw-bold">' . number_format($row_drog['drg_price'] - $price) . '</td>';
        echo '<td class="fw-bold">' . $row_detail['facde_count'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

}
