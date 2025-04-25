<?php
$result_category= $link->query("SELECT * FROM category");
?>
<div class="col-md-3 sidebar">
    <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
        <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">دسته بندی ها</h4>
            <ul>
                <?php
                while ($row_category = $result_category->fetch_assoc()) {
                    $_result_drogs= $link->query("SELECT  COUNT(*) AS total FROM drogs where drg_category_id='".$row_category['cat_id']."'");
                    $totalRow = $_result_drogs->fetch_assoc();
                    $total = $totalRow['total'];
                    echo '<li><a href="index.php?md='.$_GET['md'].'&pd='.$_GET['pd'].'&cat='.$row_category['cat_id'].'">'.$row_category['cat_name'].' <span>('.$total.')</span></a></li>';
                }
                ?>
            </ul>
        </div>
        <!-- Top Rated Product Widget -->
        <div class="widget ltn__top-rated-product-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border">محصولات دارای امتیاز برتر</h4>
            <ul>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">ماسک سه لایه</a></h6>
                            <div class="product-price">
                                <span>89،000تومان</span>
                                <del>100،000تومان</del>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">میکروسکوپ</a></h6>
                            <div class="product-price">
                                <span>1،210،000تومان</span>
                                <del>1،236،000تومان</del>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">ژل ضد عفونی کننده</a></h6>
                            <div class="product-price">
                                <span>56،000تومان</span>
                                <del>70،000تومان</del>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Menu Widget (Category) -->
        <!-- Search Widget -->
        <div class="widget ltn__search-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">جست و جو در بین محصولات</h4>
            <form action="#">
                <input type="text" name="search" placeholder="کلمه مورد نظر را جست و جو کنید...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </aside>
</div>
