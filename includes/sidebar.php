<?php
$result_category= $link->query("SELECT * FROM category WHERE cat_subm_id = '".$_GET['pd']."'");
?>
<div class="col-md-3 sidebar">
    <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
        <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">دسته بندی ها</h4>
            <ul>
                <?php
                $cat = [];
                while ($row_category = $result_category->fetch_assoc()) {
                    $_result_drogs= $link->query("SELECT  COUNT(*) AS total FROM drogs where drg_category_id='".$row_category['cat_id']."'");
                    $totalRow = $_result_drogs->fetch_assoc();
                    $total = $totalRow['total'];
                    $cat[$row_category['cat_id']] = $row_category['cat_id'];
                    echo '<li><a href="index.php?md='.$_GET['md'].'&pd='.$_GET['pd'].'&cat='.$row_category['cat_id'].'">'.$row_category['cat_name'].' <span>('.$total.')</span></a></li>';
                }
                ?>
            </ul>
        </div>
        <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">شرکت سازنده</h4>
            <div class=" border-0 flex-row rounded d-flex align-items-center p-2">
                <div class="d-flex flex-column">
                    <input class="d-none" id="pd" value="<?php echo $_GET['pd']?>">
                    <input class="d-none" id="md" value="<?php echo $_GET['md']?>">
                    <?php
                    $cat_list = implode(',', $cat);
                    $result_company = $link->query("SELECT DISTINCT drg_company FROM drogs where drg_category_id IN ($cat_list)");
                    while ($row_company = $result_company->fetch_assoc()) {
                        echo '<div class="d-flex align-items-center flex-row p-2">';
                        echo '<input id="co" class="form-check-input m-2" type="checkbox" name="co[]" value="'.$row_company['drg_company'].'" onchange="filterByCompanies()" >';
                        echo '<label for="co" class="form-check-label">'.$row_company['drg_company'].'</label>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Top Rated Product Widget -->
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
<script>
    function filterByCompanies() {
        var pd = document.getElementById('pd').value;
        var md = document.getElementById('md').value;
        var checkboxes = document.querySelectorAll('input[name="co[]"]:checked');
        var selectedCompanies = [];
        checkboxes.forEach(function(checkbox) {
            selectedCompanies.push(checkbox.value);
        });
        var data = new URLSearchParams();
        selectedCompanies.forEach(function(value) {
            data.append('co[]', value);
            data.append('pd', value);
            data.append('md', value);
        });

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/filter_company.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('resultsContainer').innerHTML = xhr.responseText;
                } else {
                    console.error('خطا در درخواست:', xhr.status);
                }
            }
        };

        xhr.send(data.toString());
    }
</script>
