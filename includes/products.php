
<?php
    require_once "includes/connect.php";
    $result_submenu = $link->query("SELECT * FROM sub_menu WHERE subm_id = '" . $_GET['pd'] . "'");
    if ($result_submenu->num_rows > 0) {
        $row_submenu = $result_submenu->fetch_assoc();
    }
    $cat_id = [];
    $result_cat = $link->query("SELECT * FROM category WHERE cat_subm_id = '" . $_GET['pd'] . "'");
    if($result_cat->num_rows > 0) {
        while ($row_cat = $result_cat->fetch_assoc()) {
            $cat_id[] = $row_cat['cat_id'];
        }
    }
    if(!empty($cat_id)) {
        $cat_id_string = implode(",", $cat_id);
        $result_drog = $link->query("SELECT * FROM drogs WHERE drg_category_id IN (" . $cat_id_string . ")");
    }
    $limit = 9;
    $pg = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
    $offset = ($pg - 1) * $limit;
    $totalResult = $link->query("SELECT COUNT(*) AS total FROM drogs");
    $totalRow = $totalResult->fetch_assoc();
    $total = $totalRow['total'];
    $result_pagination = $link->query("SELECT * FROM drogs WHERE drg_category_id IN (" . $cat_id_string . ") LIMIT $limit OFFSET $offset ");
    $totalPages = ceil($total / $limit);

    $result_menu = $link -> query("SELECT * FROM menu");
    if($result_menu->num_rows > 0) {
        $row_menu = $result_menu -> fetch_assoc();
    }


?>

<section class="page-body">
    <div class="container">
        <div class="container-fluid">  
            <div class="row mt-4">
                <?php
                require_once "includes/sidebar.php";
                ?>
                <div class="col-md-9">  
                    <div class="breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="breadcrumb-inner">
                                        <div class="breadcrumb-list">
                                            <ul>
                                                <li> فروشگاه / محصولات   <?php echo $row_submenu['subm_name'];?>   </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding: 2em; display: flex; justify-content: center;">
                        <?php
                        if(isset($_GET['cat'])) {
                            $result_pagination = $link->query("SELECT * FROM drogs WHERE drg_category_id = '" . $_GET['cat'] . "' LIMIT $limit OFFSET $offset ");
                        }
                        while ($row_pagination = $result_pagination->fetch_assoc()) {
                            $name = $row_pagination['drg_name'];
                            $id = $row_pagination['drg_id'];
                            $drg_image = $row_pagination['drg_image'];
                            $drg_price = $row_pagination['drg_price'];
                            $drg_rank = $row_pagination['drg_rank'];
                            echo '<div class="col-3 gap-1 product-card shop-card border-0">';
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
                            echo '<a class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></a>
                                    <a class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></a>
                                    <a class="btn button button2 btn-primary view-product" href="index.php?md='. $row_menu['menu_id'] .'&pd='.$row_submenu['subm_id'].'&p='.$id.'"><i
                                            class="bi bi-eye"></i></a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                        <nav aria-label="Page navigation example" class="pangination">
                            <ul class="pagination">

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?php echo $i == $pg ? 'active' : ''; ?>">
                                        <a class="page-link" href="index.php?md=<?php echo $_GET['md']; ?>&pd=<?php echo $_GET['pd']; ?>&pg=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                            </ul>
                        </nav>
                    </div>
                
            </div> 
            
        </div>  
    
    </div>
   
   </section>
    <?php
        require_once "includes/footer.php";
    ?>