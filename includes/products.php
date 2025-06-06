
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
    if (!empty($cat_id)) {
        // تبدیل آرایه به رشته جدا شده با کاما
        $cat_ids_str = implode(',', $cat_id);
        // کوئری را اصلاح کنید
        $result_drog = $link->query("SELECT * FROM drogs WHERE drg_category_id IN ($cat_ids_str)");
        $row_drog = $result_drog->fetch_assoc();
    }
    $limit = 9;
    $pg = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
    $offset = ($pg - 1) * $limit;
    $totalResult = $link->query("SELECT COUNT(*) AS total FROM drogs");
    $totalRow = $totalResult->fetch_assoc();
    $total = $totalRow['total'];
    $result_pagination = $link->query("SELECT * FROM drogs WHERE drg_category_id IN (" . $cat_ids_str . ") LIMIT $limit OFFSET $offset ");
    $totalPages = ceil($total / $limit);

    $result_menu = $link -> query("SELECT * FROM menu");
    if($result_menu->num_rows > 0) {
        $row_menu = $result_menu -> fetch_assoc();
    }
?>

<section class="page-body">
    <div class="container">
        <?php
            if(isset($errors['username'])){
                echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                      <div class="px-5">
                       <i class="bi bi-exclamation-triangle" class="mr-5"></i>
                        ' .$errors['username'].'
                      </div>
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                    </div>';
            }
        if(isset($errors['err_add_fav'])){
            echo '<div class="alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-exclamation-triangle" class="mr-5"></i>
                            ' .$errors['err_add_fav'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        if(isset($errors['dup'])){
            echo '<div class="alert alert-info d-flex align-items-center alert-dismissible fade show py-3 px-5" style="color: #120051 !important;" role="alert">
                          <div class="px-5">
                           <i class="bi bi-info-circle" class="mr-5"></i>
                            ' .$errors['dup'].'
                          </div>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>';
        }
        ?>

        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-3 sidebar">
                    <aside class="sidebar-area blog-sidebar ltn__right-sidebar ">
                        <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
                            <h4 class="ltn__widget-title ltn__widget-title-border-2">دسته بندی ها</h4>
                            <ul>
                                <?php
                                $result_category= $link->query("SELECT * FROM category WHERE cat_subm_id = '".$_GET['pd']."'");
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
                                                echo '<a href="index.php?md=44&pd=33&p='.$row_drogs['drg_id'].'">
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
                                                <h6><a href="index.php?md=44&pd=33&p=<?php echo $row_drogs['drg_id'];?>"><?php echo $row_drogs['drg_name'];?></a></h6>
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
                    <div class="card border-0 header-search header-center" style="position: relative;">
                        <input class="search-input" id="search-box" placeholder="جست و جو">
                        <button class="search-button"><i class="bi bi-search"></i></button>
                        <div id="search-results" class="d-none d-flex flex-column" style="
                        padding: 1rem 1rem;
                        border-radius: 14px;
                        justify-content: right;
                        text-align: right;
                        max-height: 300px;
                        overflow-y: auto;
                        position: absolute;
                        background: white;
                        width: 450px;
                        border: 1px solid var(--color-main);
                        right: 0;
                        z-index: 999;
                        top: 43px;">
                        </div>
                    </div>
                    <div id="resultsContainer" class="row" style="padding: 2em; display: flex; justify-content: center;">
                        <div id="massage" class="d-none alert alert-danger d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #510000 !important;" role="alert">
                            <div class="px-5">
                                <i class="bi bi-exclamation-triangle"></i>
                                محصول به علاقه مندی ها اضافه شد!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>
                        <div id="success" class="d-none alert alert-success d-flex align-items-center alert-dismissible fade show py-3 px-3" style="color: #00400e !important;" role="alert">
                            <div class="px-5">
                                <i class="bi bi-check-all"></i>
                                محصول به علاقه مندی ها اضافه شد!
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: smaller"></button>
                        </div>
                        <?php
                        if(isset($_GET['cat'])) {
                            $result_pagination = $link->query("SELECT * FROM drogs WHERE drg_category_id = '" . $_GET['cat'] . "' LIMIT $limit OFFSET $offset ");
                        }
                        while ($row_pagination = $result_pagination->fetch_assoc()) {
                            $name = $row_pagination['drg_name'];
                            $id = $row_pagination['drg_id'];
                            $drg_image = $row_pagination['drg_image'];
                            $drg_price = number_format($row_pagination['drg_price']);
                            $drg_rank = $row_pagination['drg_rank'];
                            echo '<div class="col-3 gap-1 product-card shop-card border-0">';
                            echo '<a href="index.php?md='. $row_menu['menu_id'] .'&pd='.$row_submenu['subm_id'].'&p='.$id.'">';
                            echo '<div class="card carousel-card d-flex align-content-center justify-content-center">';
                            echo '<img class="card-img-top" style="background-color:white !important; width:74% !important;margin: 0 auto !important;" src="uploads/'.$drg_image.'" alt="Card image cap">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">'.$name.'</h5>';
                            echo '<div class="d-flex flex-row justify-content-center mt-2 mb-2 gap-1 p-2">';
                            for($i=1;$i<=$drg_rank;$i++) {
                                echo '<i class="bi bi-star-fill d-flex" style="color: goldenrod !important;"></i>';
                                if(($drg_rank - $i < 1) && ($drg_rank - $i > 0)) {
                                    echo '<i class="bi bi-star-half d-flex" style="color: goldenrod !important;transform: scaleX(-1);"></i>';
                                }
                            }
                            for($i=1;$i<=5-$drg_rank;$i++) {
                                echo '<i class="bi bi-star d-flex" style="color: goldenrod !important;"></i>';
                            }

                            echo '</div>';
                            echo '<p class="card-text"><span style="font-size: 14px;">قیمت: </span>'.$drg_price.'<span style="font-size: 12px !important; color: #0f6848">تومان</span></p>';
                            echo '</a>';
                            echo '<button onclick="add_shop('.$id.',1)" class="btn button button2 btn-primary add-for-shop"><i
                                            class="bi bi-bag-plus"></i></button>
                                    <button onclick="add_favorites('.$id.',1)" class="btn button button2 btn-primary add-to-favorite"><i
                                            class="bi bi-heart"></i></button>
                                    <a class="btn button button2 btn-primary view-product" href="index.php?md='. $row_menu['menu_id'] .'&pd='.$row_submenu['subm_id'].'&p='.$id.'"><i
                                            class="bi bi-eye"></i></a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
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
                                        <a class="page-link" href="index.php?md=44&pd=<?php echo$row_submenu['subm_id'];?>&pg=<?php echo $prevPage; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    for($i = 1; $i < $totalPages; $i++) {
                                        echo ' <li class="page-item"><a class="page-link" href="index.php?md=44&pd='.$row_submenu['subm_id'].'&pg='.$i.'">'.$i.'</a></li>';
                                    }
                                    ?>

                                    <li class="page-item">
                                        <a class="page-link" href="index.php?md=44&pd=<?php echo$row_submenu['subm_id'];?>pg=<?php echo $nextPage; ?>" aria-label="Next">
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
    </div>
   
   </section>
    <?php
        require_once "includes/footer.php";
    ?>
<script>
    function add_favorites(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/add_favorites.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const msg = document.getElementById('success');
                        msg.classList.remove('d-none');
                        msg.innerHTML = 'محصول به علاقه مندی ها اضافه شد.';
                    }
                    else {
                        const msg = document.getElementById('massage');
                        msg.classList.remove('d-none');
                        msg.innerHTML = response.message;
                    }
                }
                else {
                    alert('خطا در ارتباط با سرور');
                }
            }
        };
        xhr.send('id=' + encodeURIComponent(id));
    }
    function add_shop(id) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/add_shop.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        const msg = document.getElementById('success');
                        msg.classList.remove('d-none');
                        msg.innerHTML = 'محصول به سبد خرید اضافه شد.';
                    }
                    else {
                        const msg = document.getElementById('massage');
                        msg.classList.remove('d-none');
                        msg.innerHTML = response.message;
                        // alert('خطا: ' + response.message);
                    }
                } else {
                    alert('خطا در ارتباط با سرور');
                }
            }
        };
        xhr.send('id=' + encodeURIComponent(id));
    }
</script>
<script>
    const searchInput = document.getElementById('search-box');
    const resultsDiv = document.getElementById('search-results');

    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();
        if (query.length >= 2) {
            fetchResults(query);
        } else {
            resultsDiv.style.display = 'none';
        }
    });

    function fetchResults(query) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/search.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                showResults(data.pages);
            }
        };
        xhr.send('search=' + encodeURIComponent(query));
    }

    function showResults(items) {
        if (items.length === 0) {
            let results = document.getElementById('search-results');
            results.classList.remove('d-none');
            results.textContent = 'نتیجه‌ای پیدا نشد';
            return;
        }
        let html = 'نتایج:';
        items.forEach(item => {
            html += `<div style="padding: 10px; cursor:pointer;" onclick="selectItem('${item.drg_id}', '${item.drg_name}');"><i class="bi bi-search px-3"></i>${item.drg_name} - ${item.drg_company}</div>`;
        });
        resultsDiv.innerHTML = html;
        resultsDiv.style.display = 'block';
    }

    function selectItem(id, name) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/search_result.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);

                if (response.success) {
                    const md = encodeURIComponent(response.md);
                    const pd = encodeURIComponent(response.pd);
                    const p = encodeURIComponent(response.p);
                    location.replace(`index.php?md=${md}&pd=${pd}&p=${p}`);
                }
            }
        };
        xhr.send('id=' + encodeURIComponent(id));
    }
    function filterByCompanies() {
        const checkedBoxes = document.querySelectorAll('input[name="co[]"]:checked');
        const selectedCompanies = Array.from(checkedBoxes).map(cb => encodeURIComponent(cb.value));

        // مقدار pd را می‌گیریم و encode می‌کنیم
        const pd = encodeURIComponent(document.getElementById('pd').value);

        // ساخت رشته پارامترها
        let data = selectedCompanies.map(val => 'co[]=' + val).join('&');

        // اگر قبلاً داده‌ای داشتیم، جداشکن & اضافه کنیم
        if (data.length > 0) {
            data += '&';
        }

        data += 'pd=' + pd;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/filter_company.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('resultsContainer').innerHTML = xhr.responseText;
                } else {
                    console.error('خطا در درخواست:', xhr.status);
                }
            }
        };

        xhr.send(data);
    }
</script>