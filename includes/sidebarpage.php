<?php
$resultPage = $link->query("SELECT * FROM pages WHERE pg_menu_id = '" . $_GET['md'] . "'");
if ($resultPage->num_rows > 0) {
    $rowPage = $resultPage->fetch_assoc();
}
$resultPageDe = $link->query("SELECT * FROM page_detail where pgde_page_id = '" . $rowPage['pg_id'] . "'");
if ($resultPageDe->num_rows != 0) {
    $row = $resultPageDe->fetch_assoc();
}
if($rowPage['pg_status'] == "2"){
    require_once "work.php";
}
else{
?>
<section class="page-body">
    <div class="container">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-md-3 sidebar mb-5 pb-5">
                    <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">محصولات دارای امتیاز برتر</h4>
                            <ul>
                                <?php
                                $select_drogs= $link->query("SELECT * FROM drogs order by drg_rank desc limit 3");
                                while ($row_drogs = $select_drogs->fetch_assoc()) {
                                    ?>
                                    <li>
                                        <div class="top-rated-product-item clearfix">
                                            <div class="top-rated-product-img">
                                                <?php
                                                echo '<a href="product-details.html">
                                                    <img style="width: 70px !important; height: 70px !important;" src="uploads/'.$row_drogs['drg_image'].'" alt="#">
                                                    </a>';
                                                ?>
                                            </div>
                                            <div class="top-rated-product-info">
                                                <div class="product-ratting">
                                                    <ul>
                                                        <?php
                                                        $drg_rank = $row_drogs['drg_rank'];
                                                        for($i=1;$i<=$drg_rank;$i++) {
                                                            echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important; font-size: 12px;"></i>';
                                                            if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                                                echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);font-size: 12px;"></i>';
                                                            }
                                                        }
                                                        for($i=1;$i<=5-$drg_rank;$i++) {
                                                            echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;font-size: 12px;"></i>';
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <h6><a href="product-details.html"><?php echo $row_drogs['drg_name'];?></a></h6>
                                                <div class="product-price">
                                                    <?php
                                                    $result_off = $link ->query("SELECT * FROM off where off_category_id = '".$row_drogs['drg_category_id']."'");
                                                    if($result_off -> num_rows > 0){
                                                        $row_off = $result_off -> fetch_assoc();
                                                        $vl = $row_off['off_value'];
                                                    }
                                                    else{
                                                        $vl = 0;
                                                    }
                                                    $off = $row_drogs['drg_price'] * $vl / 100;
                                                    $price = $row_drogs['drg_price']-$off;
                                                    echo '<del>'.number_format($row_drogs['drg_price']).'</del>';
                                                    echo '<span>'.number_format($price).'</span>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-md-9 mt-4">
                    <div class="breadcrumb-area text-left bg-overlay-white-30 bg-image ">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="breadcrumb-inner">
                                        <div class="breadcrumb-list">
                                            <ul>
                                                <li> <?php
                                                    echo $row['pgde_title'];
                                                    ?>  </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 py-4 pb-5 mb-5">
                        <p>
                            <?php
                            echo $row['pgde_content'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
}
?>
