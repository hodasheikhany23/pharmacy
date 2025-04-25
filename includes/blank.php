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
<div class="container">
    <div class="text">
        <div class="section-title" style="margin-top: 0 !important;">
            <p><?php
                echo $row['pgde_title'];
                ?></p>
        </div>
        <p class="w-75">
            <?php
            echo $row['pgde_content'];
            ?>
        </p>
    </div>
</div>
<?php

}
?>