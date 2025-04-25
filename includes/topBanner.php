<?php
    $link = new mysqli("localhost", "root", "", "pharmacy_db");
    $resultPage = $link -> query("SELECT * FROM pages WHERE pg_menu_id = '".$_GET['md']."'");
    if ($resultPage ->num_rows > 0) {
        $rowPage = $resultPage -> fetch_assoc();
    }
    $resultPageDe = $link -> query("SELECT * FROM page_detail where pgde_page_id = '".$rowPage['pg_id']."'");
    if($resultPageDe -> num_rows != 0){
        $row = $resultPageDe -> fetch_assoc();
    }
    if($rowPage['pg_status']==2){
    require_once "work.php";
    }
    else{
?>
    <title> <?php
        echo $row['pgde_title'];
    ?></title>
    <style>
        .top_banner{
            width: 1280px !important;
            height: 200px !important;
            border-radius: 12px ;
        }
        h1 {
            color: #3C7BBF;
        }
        .about-card {
            max-width: 1000px;
            border: none;
            border-radius: 10px;
            margin-top: 20px;
        }
        .img-fluid {
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .about-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .about-text {
            flex: 1;
            padding-left: 20px;
        }
    </style>
<body>

<div class="container text-right">
    <div>
        <img src="uploads/<?php echo $row['pgde_image'];?>" class="mt-4 top_banner" alt="Image" style="width: 500px; border-radius: 12px">
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="about-card mb-5">
                <div class="about-container">
                    <div class="about-text">
                        <div class="section-title" style="margin-top: 0 !important;">
                            <p><?php
                                if($row)
                                echo $row['pgde_title'];
                                ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <p class="mb-5 p-5">
                <?php
                echo $row['pgde_content'];
                ?>
            </p>
        </div>
    </div>

</div>
<?php
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>