<div class="container">
    <div class="section-title" style="margin-top: 0 !important; padding-top: 0 !important;">
        <p class="mb-4" style="font-size: 16px; margin-top: 24px !important; padding-top: 0 !important;">داشبورد</p>
        <a href="index.php?page=dashboard" class="button btn btn-primary">
            <i class="fa-solid fa-gauge"></i>
            <span style="margin-left: 2px;">| </span> داشبورد
        </a>
    </div>
    <div class="row gap-4 mb-4">
        <div class="col-sm dash-card dash-card-time py-3 px-4 d-flex justify-content-between" style="background-color: var(--color-7); align-items: center">
            <div class="d-flex">
                <div class="icon-box icon-box-time">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="title mr-3 mt-2" style="font-size: 16px">
                    آخرین بازدید
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold">
                    <?php
                    echo $_SESSION['time'];
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm dash-card dash-card-time py-3 px-4 d-flex justify-content-between" style="background-color: var(--secondary-color-2); align-items: center">
            <div class="d-flex align-content-center justify-content-center">
                <div class="icon-box icon-box-time" style="background-color: var(--secondary-color-1)">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="title mr-3 mt-2" style="font-size: 16px">
                    هم اکنون
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" id="clock">
                    00:00:00
                </div>
            </div>
        </div>
    </div>
    <div class="row gap-3">
        <div class="col-sm dash-card py-4 px-5 d-flex justify-content-between" style="background-color: var(--secondary-color-2); align-items: center">
            <div class="d-flex">
                <div class="icon-box" style="background-color: var(--secondary-color-1)">
                    <i class="bi bi-calendar3-event"></i>
                </div>
                <div class="title mr-3 mt-4" style="font-size: 16px">
                    فروش امروز
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" style="font-size: 32px">
                    5
                </div>
            </div>
        </div>
        <div class="col-sm dash-card py-4 px-5 d-flex justify-content-between" style="background-color: var(--secondary-color-4); align-items: center">
            <div class="d-flex">
                <div class="icon-box" style="background-color: var(--secondary-color-3)">
                    <i class="bi bi-calendar3-week"></i>
                </div>
                <div class="title mr-3 mt-4" style="font-size: 16px">
                    فروش هفته
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" style="font-size: 24px">
                    10
                </div>
            </div>
        </div>
        <div class="col-sm dash-card py-4 px-4 d-flex justify-content-between" style="background-color: var(--color-7); align-items: center">
            <div class="d-flex">
                <div class="icon-box" style="background-color: var(--color-main)">
                    <i class="bi bi-calendar3"></i>
                </div>
                <div class="title mr-3 mt-4" style="font-size: 16px">
                    فروش ماه
                </div>
            </div>
            <div class="dash-card-text d-flex flex-column p-2">
                <div class="content mt-2 mytext-bold" style="font-size: 24px">
                    20
                </div>
            </div>
        </div>

    </div>

    <div class="container mt-5" style="margin-top: 0 !important; padding-top: 0 !important;" >
        <div class="section-title" style="margin-top: 0 !important; padding-top: 0 !important;">
            <p style="margin-top: 24px !important; padding-top: 0 !important;">پرفروش ترین محصولات</p>
        </div>
        <table class="table table-bordered table-hover custom-table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">تصویر</th>
                <th scope="col">نام محصول</th>
                <th scope="col">شرکت تولیدکننده</th>
                <th scope="col">تعداد خریداری‌شده (هفته)</th>
                <th scope="col">تعداد خریداری‌شده (ماه)</th>
                <th scope="col">تعداد خریداری‌شده (سال)</th>
                <th scope="col">تعداد موجود در انبار</th>
                <th scope="col">قیمت</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td scope="row">1</td>
                <td><img src="img/p1" alt="محصول 1"></td>
                <td>نام محصول 1</td>
                <td>شرکت تولیدکننده 1</td>
                <td>50</td>
                <td>200</td>
                <td>2400</td>
                <td>30</td>
                <td>100,000 تومان</td>
            </tr>
            <tr>
                <td scope="row">2</td>
                <td><img src="img/p2" alt="محصول 2"></td>
                <td>نام محصول 2</td>
                <td>شرکت تولیدکننده 2</td>
                <td>30</td>
                <td>170</td>
                <td>2300</td>
                <td>20</td>
                <td>150,000 تومان</td>
            </tr>
            <tr>
                <td scope="row">3</td>
                <td><img src="img/p3" alt="محصول 3"></td>
                <td>نام محصول 3</td>
                <td>شرکت تولیدکننده 3</td>
                <td>30</td>
                <td>150</td>
                <td>1800</td>
                <td>50</td>
                <td>250,000 تومان</td>
            </tr>
            <tr>
                <td scope="row">4</td>
                <td><img src="img/p4" alt="محصول 4"></td>
                <td>نام محصول 4</td>
                <td>شرکت تولیدکننده 4</td>
                <td>40</td>
                <td>170</td>
                <td>1100</td>
                <td>40</td>
                <td>200,000 تومان</td>
            </tr>
            <tr>
                <td scope="row">5</td>
                <td><img src="img/p5" alt="محصول 5"></td>
                <td>نام محصول 5</td>
                <td>شرکت تولیدکننده 5</td>
                <td>30</td>
                <td>100</td>
                <td>1000</td>
                <td>10</td>
                <td>300,000 تومان</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="row d-flex justify-content-between mt-5 mb-5">
        <div class="col-6">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-bottom d-flex justify-content-between align-items-center p-4">
                    <h6 class="card-header-title"> مقالات پربازدید  </h6>
                    <a href="#" class="btn btn-link p-0 mb-0" style="color: var(--color-main) !important;">مشاهده همه</a>
                </div>

                <!-- Card body START -->
                <div class="card-body p-4">

                    <!-- Ticket item START -->
                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class=" w-50">
                                <img class=" w-75 rounded" src="img/blog-img1.jpg" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نام مقاله </a></h6>
                                <p class="mb-0">متن مقاله متن مقالع متن مقاله متن مقالهههههههه متن مقاله متن مقالع متن مقاله متن مقالهههههههه</p>
                                <span class="small" style="color: var(--color-main)">34 نظر مثبت</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class=" w-50">
                                <img class=" w-75 rounded" src="img/blog-img1.jpg" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نام مقاله </a></h6>
                                <p class="mb-0">متن مقاله متن مقالع متن مقاله متن مقالهههههههه متن مقاله متن مقالع متن مقاله متن مقالهههههههه</p>
                                <span class="small" style="color: var(--color-main)">34 نظر مثبت</span>
                            </div>
                        </div>
                    </div>
                    <hr><!-- Divider -->

                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class=" w-50">
                                <img class=" w-75 rounded" src="img/blog-img1.jpg" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نام مقاله </a></h6>
                                <p class="mb-0">متن مقاله متن مقالع متن مقاله متن مقالهههههههه متن مقاله متن مقالع متن مقاله متن مقالهههههههه</p>
                                <span class="small" style="color: var(--color-main)">34 نظر مثبت</span>
                            </div>
                        </div>
                    </div>
                    <hr><!-- Divider -->
                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class=" w-50">
                                <img class=" w-75 rounded" src="img/blog-img1.jpg" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نام مقاله </a></h6>
                                <p class="mb-0">متن مقاله متن مقالع متن مقاله متن مقالهههههههه متن مقاله متن مقالع متن مقاله متن مقالهههههههه</p>
                                <span class="small" style="color: var(--color-main)">34 نظر مثبت</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card body END -->
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-bottom d-flex justify-content-between align-items-center p-4">
                    <h6 class="card-header-title"> دیدگاه های اخیر</h6>
                    <a href="#" class="btn btn-link p-0 mb-0" style="color: var(--color-main) !important;">مشاهده همه</a>
                </div>

                <!-- Card body START -->
                <div class="card-body p-4">

                    <!-- Ticket item START -->
                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class="avatar w-25">
                                <img class="avatar-img rounded-circle w-75" src="img/user.png" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نیلوفر جلیلی</a></h6>
                                <p class="mb-0">این محصول عالی است این محصول عالی است این محصول عالی است</p>
                                <span class="small" style="color: var(--color-main)">8 ساعت قبل</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class="avatar w-25">
                                <img class="avatar-img rounded-circle w-75" src="img/user.png" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نیلوفر جلیلی</a></h6>
                                <p class="mb-0">این محصول عالی است این محصول عالی است این محصول عالی است</p>
                                <span class="small" style="color: var(--color-main)">8 ساعت قبل</span>
                            </div>
                        </div>
                    </div>
                    <hr><!-- Divider -->

                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class="avatar w-25">
                                <img class="avatar-img rounded-circle w-75" src="img/user.png" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نیلوفر جلیلی</a></h6>
                                <p class="mb-0">این محصول عالی است این محصول عالی است این محصول عالی است</p>
                                <span class="small" style="color: var(--color-main)">8 ساعت قبل</span>
                            </div>
                        </div>
                    </div>
                    <hr><!-- Divider -->
                    <div class="d-flex justify-content-between position-relative">
                        <div class="d-sm-flex">
                            <!-- Avatar -->
                            <div class="avatar w-25">
                                <img class="avatar-img rounded-circle w-75" src="img/user.png" alt="avatar">
                            </div>
                            <!-- Info -->
                            <div class="ms-0 mt-2">
                                <h6 class="mb-3 fw-normal"><a href="#" class="stretched-link">نیلوفر جلیلی</a></h6>
                                <p class="mb-0">این محصول عالی است این محصول عالی است این محصول عالی است</p>
                                <span class="small" style="color: var(--color-main)">8 ساعت قبل</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Card body END -->
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock(){
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('clock').textContent = timeString;
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>