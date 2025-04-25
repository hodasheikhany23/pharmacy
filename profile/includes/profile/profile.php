<?php
if(!isset($_SESSION['username'])){
    die("Please <a href='includes/login.php'>login</a> to access this page");
}
defined('site') or die('Acces denied');
?>
<div class="container">
    <div class="section-title">
        <h4 class="mb-4"> مشخصات  <span style="color: var(--color-main)"><?php echo $_SESSION['username']; ?></span><br> <span style="color: var(--color-main) ; font-size: 16px"><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></span></h4>
        <a href="index.php?page=dashboard" class="button btn btn-primary">
            <i class="fa-solid fa-gauge"></i>
            <span style="margin-left: 2px;">| </span> داشبورد
        </a>
    </div>
    <div class="form-container">
        <form method="post" action="">
            <div class="mb-4">
                <label for="username" class="form-label">نام کاربری</label>
                <input name="username" type="text" class="form-control" id="username" disabled value="<?php echo $_SESSION['username']; ?>">
            </div>
            <div class="mb-4">
                <label for="name" class="form-label">نام </label>
                <input name="name" type="text" class="form-control" id="name" disabled value="<?php echo $_SESSION['fname']; ?>">
            </div>

            <div class="mb-4">
                <label for="lname" class="form-label">نام خانوادگی </label>
                <input name="lname" type="text" class="form-control" id="lname" disabled value="<?php echo $_SESSION['lname']; ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">شماره تلفن</label>
                <input name="phone" type="tel" class="form-control" id="phone" disabled value="<?php echo $_SESSION['phone']; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">آدرس</label>
                <textarea name="address" class="form-control" id="address" rows="3" disabled><?php if (isset($_SESSION['address'])) {echo trim($_SESSION['address']);} ?></textarea>
            </div>
        </form>
    </div>


</div>

