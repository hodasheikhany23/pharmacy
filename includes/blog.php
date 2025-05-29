<div class="container">
    <div class="row d-flex justify-content-center align-items-center align-content-start">
        <div class="section-title" style="margin-top: 0 !important;">
            <p>مقالات </p>
        </div>
        <div class="col-md-12">
            <div id="resultsContainer" class="row" style="padding: 2em; display: flex; justify-content: center;">
                <?php
                $limit = 6;
                $pg = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
                $offset = ($pg - 1) * $limit;
                $totalResult = $link->query("SELECT COUNT(*) AS total FROM blog");
                $totalRow = $totalResult->fetch_assoc();
                $total = $totalRow['total'];
                $totalPages = ceil($total / $limit);

                $result_blog = $link->query("SELECT * FROM blog WHERE blg_status = '1' LIMIT $limit OFFSET $offset ");
                while ($row_blog = $result_blog->fetch_assoc()) {

                ?>
                <div class="col-md-4 mb-2">
                    <div class="card carousel-card blog-card mb-5">
                        <a href="index.php?md=47&blog=<?php echo $row_blog['blg_id'] ?>">
                            <img src="<?php echo $row_blog['blg_cover'] ?>" class="blog-card-img-top" alt="<?php echo $row_blog['blg_title'] ?>">
                        <div class="card-body blog-card-body">
                        <div class="blog-info">
                            <ul>
                                <li class="blog-date">
                                    <a href="#"><i class="bi bi-calendar"></i> <?php echo $row_blog['blg_date'] ?></a>
                                </li>
                                <li class="blog-tags">
                                    <a href="#"><i class="bi bi-tags"></i> <?php echo $row_blog['blg_tag'] ?></a>
                                </li>
                            </ul>
                        </div>
                        <p class="blog-card-title"><?php echo $row_blog['blg_title'] ?></p>
                        <?php
                        $para = [];
                        $result_p = $link->query("SELECT * FROM blog_detail WHERE blgde_blog_id = '".$row_blog['blg_id']."' and blgde_paragraph != 'null' order by blgde_id limit 1");
                        if ($result_p->num_rows > 0) {
                            $row_p = $result_p->fetch_assoc();
                            echo '<p class="blog-card-text">'.substr($row_p['blgde_paragraph'], 0, 150) .'...</p>';
                        }


                        ?>
                        </a>
                        <div class="product-ratting d-flex flex-row justify-content-between">
                            <ul>
                                <?php
                                $drg_rank = $row_blog['blg_rank'];
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
                            <a class="view-more-btn blog-view-more-btn" href="index.php?md=47&blog=<?php echo $row_blog['blg_id'] ?>">بیشتر <i class="bi bi-arrow-left"></i></a>
                        </div>
                    </div>
                    </div>
                </div>

                    <?php
                    }
                    ?>
                <div class="d-flex justify-content-center align-items-center align-content-start mb-5 pb-5">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                            $currentPage = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
                            if($currentPage >= 1 && $currentPage < $totalPages){
                                $nextPage = $currentPage + 1;
                            }
                            else{
                                $nextPage = 1;
                            }
                            if($currentPage < $totalPages && $currentPage > 1){
                                $prevPage = $currentPage - 1;
                            }
                            else{
                                $prevPage = 1;
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?md=47&pg=<?php echo $prevPage; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for($i = 1; $i <= $totalPages; $i++) {
                                echo ' <li class="page-item"><a class="page-link" href="index.php?md=47&pg='.$i.'">'.$i.'</a></li>';
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link" href="index.php?md=47&pg=<?php echo $nextPage; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>

    </div>

</div>