<?php
if(!isset($_SESSION['username']) || $_SESSION['is_admin'] != '1'){
    die("Please <a href='index.php?pg=login'>login</a> to access this page");
}
defined('site') or die('Acces denied');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['sliderImages'])) {
        $files = $_FILES['sliderImages'];

        $totalFiles = count($files['name']);

        for ($i = 0; $i < $totalFiles; $i++) {
            $fileTmpPath = $files['tmp_name'][$i];
            $fileName = $files['name'][$i];
            $fileSize = $files['size'][$i];
            $fileType = $files['type'][$i];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowed = array('jpg', 'png', 'jpeg', 'gif');
            if (!in_array($fileExt, $allowed)) {
                continue;
            }

            $upload_dir = 'slider_images/';
            $new_name = time() .$i. 'includes' . $fileExt;
            $dest_path = $upload_dir . $new_name;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $sql_insert = "INSERT INTO slider (slide_image) VALUES ('" . $dest_path . "')";
                $link->query($sql_insert);

            }
        }
    }
}
?>

<div class="container mt-5">
    <div class="section-title" style="margin-top: 24px !important; padding-top: 0 !important;">
        <h4 class="mb-4">   بارگذاری تصویر  </h4>
        <a href="index.php?pg=login&page=slider" class="button btn btn-primary">
            <i class="fa-solid fa-list"></i>
            <span style="margin-left: 2px;">| </span>   لیست تصاویر
        </a>
    </div>
    <div class="d-flex justify-content-center flex-column align-items-center">
        <div class="col-md-6 mb-4">
            <label for="number" class="form-label">تعداد اسلاید </label>
            <input type="number" class="form-control w-75" id="number" value="3" max="10" min="1" aria-describedby="number">
        </div>


        <div class="card rounded border-0 p-3 col-md-6">
            <form method="POST" enctype="multipart/form-data" id="slidesForm">
                <div id="dynamic-slides"></div>
                <button type="submit" class="btn btn-success mt-3">ثبت تصاویر</button>
            </form>
        </div>
    </div>


</div>

<script>
    const numberInput = document.getElementById('number');
    const dynamicDiv = document.getElementById('dynamic-slides');

    function createSlideInputs(count) {
        dynamicDiv.innerHTML = '';
        for (let i = 1; i <= count; i++) {
            const div = document.createElement('div');
            div.className = 'mb-3';

            const label = document.createElement('label');
            label.className = 'form-label me-3';
            label.setAttribute('for', 'sliderImage' + i);
            label.textContent = 'تصویر اسلایدر ' + i;

            const input = document.createElement('input');
            input.type = 'file';
            input.className='form-control'
            input.name = 'sliderImages[]';
            input.id = 'sliderImage' + i;
            input.accept = 'image/*';
            input.required = true;
            div.appendChild(label);
            div.appendChild(input);
            dynamicDiv.appendChild(div);
        }
    }

    createSlideInputs(parseInt(numberInput.value));

    numberInput.addEventListener('change', () => {
        let c = parseInt(numberInput.value);
        if (c > 10) c = 8;
        createSlideInputs(c);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.querySelector('select[name="category"]'); // سلکت دسته بندی بالا
        const drugSelect = document.querySelector('select[name="category"]'); // سلکت دارو پایین (حواست باشه نام‌ها رو تغییر بده چون هر دو "category" هستند)


        const drugSelectElement = document.querySelector('select[name="drug"]');

        categorySelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            Array.from(drugSelectElement.options).forEach(function(option) {
                const optionCategory = option.getAttribute('data-category');
                if (optionCategory === selectedCategory || selectedCategory === '') {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            });
            drugSelectElement.selectedIndex = 0;
        });
    });
</script>