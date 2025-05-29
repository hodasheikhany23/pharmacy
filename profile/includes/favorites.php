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
?>
<div class="col-md-9 border-0">
    <div class="card m-3 p-4 border-0" style="border-radius: 24px; background-color: transparent !important;">
        <div class="item">

            <div class="container my-4 ">
                <div class="section-title" style="margin-top: 0 !important; padding: 0 !important;">
                    <p style="margin-top: 0 !important;"> لیست علاقه مندی ها </p>
                </div>
                <div id="resultsContainer">
                    <div id="massage" class="alert d-none alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                        <div class="px-5">
                            <i class="bi bi-exclamation-triangle"></i>
                            محصول از علاقه مندی ها حذف شد!
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                    </div>
                    <div class="card mb-5 p-4 border-0" style="border-radius: 24px; background-color: transparent !important;">
                        <div class="rounded-3 border-0 mb-5 d-flex flex-wrap">
                            <?php
                            while($row = $result->fetch_assoc()){
                                $result_drog = $link->query("SELECT * FROM drogs WHERE drg_id = '".$row['fav_drog_id']."'");
                                while ($row_drog = $result_drog->fetch_assoc()) {
                                    $result_cat = $link->query("SELECT * FROM category WHERE cat_id = '" . $row_drog['drg_category_id'] . "'");
                                    $row_cat = $result_cat->fetch_assoc();
                                    $result_submenu = $link->query("SELECT * FROM sub_menu WHERE subm_id = '".$row_cat['cat_subm_id']."'");
                                    $row_sub = $result_submenu->fetch_assoc();
                                    $name = $row_drog['drg_name'];
                                    $drg_image = $row_drog['drg_image'];
                                    $drg_price = number_format($row_drog['drg_price']);
                                    $drg_rank = $row_drog['drg_rank'];
                                    echo '<div id="product-'.$row_drog['drg_id'].'" class="col-3 gap-1 product-card shop-card border-0">';
                                    echo '<div class="card carousel-card d-flex align-content-center justify-content-center">';
                                    echo '<img class="card-img-top" style="background-color:white !important; width:74% !important;margin: 0 auto !important;" src="uploads/'.$drg_image.'" alt="Card image cap">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">'.$name.'</h5>';
                                    echo '<div class="d-flex flex-row justify-content-center mt-2 mb-2 gap-1 p-2">';
                                    for($i=1;$i<=$drg_rank;$i++) {
                                        echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important;"></i>';
                                    }
                                    for($i=1;$i<=5-$drg_rank;$i++) {
                                        echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;"></i>';
                                    }
                                    echo '</div>';
                                    echo '<p class="card-text"><span style="font-size: 14px;">قیمت: </span>'.$drg_price.'<span style="font-size: 12px !important; color: #0f6848">تومان</span></p>';
                                    echo '
                                        <a title="مشاهده محصول" class="btn button button2 btn-primary" href="index.php?md='. $row_menu['menu_id'] .'&pd='.$row_sub['subm_id'].'&p='.$row_drog['drg_id'].'">
                                        <i class="bi bi-eye"></i></a>
                                        <button title="حذف" class="btn button button2 btn-primary add-to-favorite" onclick="remove('.$row_drog['drg_id'].',1)">
                                            <i class="bi bi-trash3"></i></button> ';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                            ?>
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
<script>
    function remove(detailId) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'profile/includes/remove_favorites.php', true);
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
                        const messsage = document.getElementById('massage');
                        messsage.classList.remove('d-none');
                    }
                    else {
                        alert('خطا: ' + response.message);
                    }
                } else {
                    alert('خطا در ارتباط با سرور');
                }
            }
        };
        xhr.send('remove_id=' + encodeURIComponent(detailId));
    }
</script>
