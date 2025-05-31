<?php
$errors = [];
if(!isset($_SESSION["user_id"])){
    $errors['login'] = "لطفا ابتدا وارد سایت شوید";
}
else{

?>
<div class="col-md-9 border-0">
            <div class="card m-3 p-4 border-0" style="border-radius: 24px; background-color: transparent !important;">
                <div class="item">
                    <div class="container my-4 ">
                        <div class="section-title" style="margin-top: 0 !important; padding: 0 !important;">
                            <p style="margin-top: 0 !important;">لیست سفارش ها </p>
                        </div>
                        <div class="container my-4">
                            <div class="row d-flex justify-content-center">
                                <div class="d-flex justify-content-center flex-row p-3 border-0">
                                    <div class="card border-0 flex-row rounded d-flex align-items-center p-2">
                                        <i class="bi bi-funnel fs-4 me-5" style="color: var(--color-main)"></i>
                                        <button onclick="orderdata('desc')" class="btn btn-outline-primary d-flex align-items-center px-2" style="width: 40px; height: 40px;">
                                            <i class="bi bi-sort-down-alt" style="font-size: 20px"></i>
                                        </button>
                                        <button onclick="orderdata('asc')" class="btn btn-outline-primary d-flex align-items-center justify-content-center px-1" style="width: 40px; height: 40px;">
                                            <i class="bi bi-sort-up-alt" style="font-size: 20px"></i>
                                        </button>
                                    </div>
                                    <div class="card border-0 flex-row rounded d-flex align-items-center p-2 ms-5">
                                        <i class="bi bi-funnel fs-4 me-3" style="color: var(--color-main)"></i>
                                        <div>
                                            <select class="form-select" id="paymentStatus" onchange="selectdata(this.value)">
                                                <option value="4" >همه وضعیت ها </option>
                                                <option value="1" id="successful" >موفق</option>
                                                <option value="3" id="pending">ناتمام</option>
                                                <option value="2" id="failed" >ناموفق</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="resultsContainer">

                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
}
?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        showdata();
    });

    function showdata() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'profile/includes/show-data.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('resultsContainer').innerHTML = xhr.responseText;
                } else {
                    console.error('خطا در درخواست:', xhr.status);
                }
            }
        };
        xhr.send();
    }
    function selectdata(st) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'profile/includes/select-data.php', true);
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
        xhr.send('st=' + encodeURIComponent(st));
    }
    function orderdata(order) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'profile/includes/order-data.php', true);
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

        xhr.send('order=' + encodeURIComponent(order));
    }
</script>