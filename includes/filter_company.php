<?php
session_start();
$link = new mysqli("localhost", "root", "", "pharmacy_db");

if (isset($_POST['co']) && is_array($_POST['co'])) {
    $companies = $_POST['co'];

    $in_list = "'" . implode("','", $companies) . "'";

    $query = "SELECT * FROM drogs WHERE drg_company IN ($in_list)";
    $result = mysqli_query($link, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
                $name = $row['drg_name'];
                $id = $row['drg_id'];
                $drg_image = $row['drg_image'];
                $drg_price = number_format($row['drg_price']);
                $drg_rank = $row['drg_rank'];
                echo '<div class="col-3 gap-1 product-card shop-card border-0 pb-5 mb-5">';
//                echo '<a href="index.php?md=' . $row_menu['menu_id'] . '&pd=' . $row_submenu['subm_id'] . '&p=' . $id . '">';
                echo '<div class="card carousel-card d-flex align-content-center justify-content-center">';
                echo '<img class="card-img-top" style="background-color:white !important; width:74% !important;margin: 0 auto !important;" src="uploads/' . $drg_image . '" alt="Card image cap">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $name . '</h5>';
                echo '<div class="d-flex flex-row justify-content-center mt-2 mb-2 gap-1 p-2">';
                for ($i = 1; $i <= $drg_rank; $i++) {
                    echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important;"></i>';
                    if (($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                        echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);"></i>';
                    }
                }
                for ($i = 1; $i <= 5 - $drg_rank; $i++) {
                    echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;"></i>';
                }

                echo '</div>';
                echo '<p class="card-text"><span style="font-size: 14px;">قیمت: </span>' . $drg_price . '<span style="font-size: 12px !important; color: #0f6848">تومان</span></p>';
                echo '</a>';
//                echo '<button onclick="add_shop(' . $id . ',1)" class="btn button button2 btn-primary add-for-shop"><i
//                                            class="bi bi-bag-plus"></i></button>
//                                    <button onclick="add_favorites(' . $id . ',1)" class="btn button button2 btn-primary add-to-favorite"><i
//                                            class="bi bi-heart"></i></button>
//                                    <a class="btn button button2 btn-primary view-product" href="index.php?md=' . $row_menu['menu_id'] . '&pd=' . $row_submenu['subm_id'] . '&p=' . $id . '"><i
//                                            class="bi bi-eye"></i></a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

        }
    }
}
?>