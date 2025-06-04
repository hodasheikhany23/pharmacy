<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پشتیبانی سایت</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: rgb(60, 123, 191);
            --primary-hover: rgb(45, 100, 160);
        }
        .btn-primary:hover {
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
        }

        .ticket-card {
            border-right: 4px solid;
            transition: all 0.3s;
            border-radius: 8px;
        }

        .ticket-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .status-pending {
            border-right-color: #ffc107;
        }

        .status-answered {
            border-right-color: #28a745;
        }


        .ticket-type {
            background-color: rgba(60, 123, 191, 0.1);
            color: var(--primary-color);
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['submit'])){
    $title = clean_data($_POST['title']);
    $content = clean_data($_POST['content']);
    $status = clean_data($_POST['status']);
    $result = $link->query("INSERT INTO support (s_title, s_content, s_status ,) VALUES ('$title', '$content', '$status')");
}
?>
<div class="container mt-5 mb-5 ">
    <div class="row mb-5 pb-5">
        <div class="col-lg-8 mx-auto mb-5">
            <!-- حالت نمایش لیست تیکت‌ها -->
            <div class="ticket-list">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        تیکت‌های شما
                    </h4>
                    <button class="btn btn-primary button">
                        <i class="fas fa-plus me-1"></i> تیکت جدید
                    </button>
                </div>

                <!-- تیکت نمونه 1 -->
                <div class="card ticket-card mb-3 status-pending">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">مشکل در پرداخت آنلاین</h5>
                            <span class="badge bg-warning">پاسخ داده نشده</span>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                                <span class="ticket-type me-3">
                                    <i class="fas fa-cogs me-1"></i>مشکل فنی
                                </span>
                            <small>
                                <i class="fas fa-clock me-1"></i>۱۴۰۲/۰۵/۲۰ - ۱۵:۳۰
                            </small>
                        </div>
                        <p class="card-text">سلام. هنگام پرداخت آنلاین با خطای «تراکنش ناموفق» مواجه می‌شوم. لطفاً راهنمایی کنید.</p>
                    </div>
                </div>

                <!-- تیکت نمونه 2 -->
                <div class="card ticket-card mb-3 status-answered">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title mb-0">پیشنهاد بهبود رابط کاربری</h5>
                            <span class="badge bg-success">پاسخ داده شده</span>
                        </div>
                        <div class="d-flex align-items-center text-muted mb-3">
                                <span class="ticket-type me-3">
                                    <i class="fas fa-lightbulb me-1"></i>انتقاد و پیشنهاد
                                </span>
                            <small>
                                <i class="fas fa-clock me-1"></i>۱۴۰۲/۰۵/۱۸ - ۱۰:۱۵
                            </small>
                        </div>
                        <p class="card-text">با سلام. پیشنهاد می‌کنم بخش جستجوی محصولات را بهبود دهید تا کاربران راحت‌تر بتوانند محصولات را پیدا کنند.</p>

                        <div class="alert alert-secondary mt-3 mb-0">
                            <strong class="d-block mb-2">
                                <i class="fas fa-reply me-1"></i>پاسخ پشتیبانی:
                            </strong>
                            با تشکر از پیشنهاد شما. این مورد در لیست بهبودهای نسخه بعدی قرار گرفت.
                        </div>
                    </div>
                </div>
            </div>

            <!-- حالت نمایش فرم جدید -->
            <div class="ticket-form d-none">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            ایجاد تیکت جدید
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="ticket_type" class="form-label">نوع تیکت</label>
                                <select name="type" class="form-select" id="ticket_type">
                                    <option selected disabled>-- انتخاب کنید --</option>
                                    <option value="1">انتقاد و پیشنهاد</option>
                                    <option value="2">مشکل فنی</option>
                                    <option value="3">پشتیبانی فروش</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ticket_title" class="form-label">عنوان تیکت</label>
                                <input type="text" name="title" class="form-control" id="ticket_title" placeholder="عنوان مشکل یا درخواست خود را وارد کنید">
                            </div>

                            <div class="mb-3">
                                <label for="ticket_message" class="form-label">متن پیام</label>
                                <textarea name="content" class="form-control" id="ticket_message" rows="5" placeholder="مشکل یا درخواست خود را به طور کامل شرح دهید"></textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-times me-1"></i> انصراف
                                </button>
                                <button name="submit" type="submit" class="btn btn-primary button">
                                    <i class="fas fa-paper-plane me-1"></i> ارسال تیکت
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('.btn-primary').click(function() {
            $('.ticket-list').addClass('d-none');
            $('.ticket-form').removeClass('d-none');
        });

        $('.btn-outline-secondary').click(function() {
            $('.ticket-form').addClass('d-none');
            $('.ticket-list').removeClass('d-none');
        });
    });
</script>
</body>
</html>