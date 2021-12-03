<?php 
    session_start();
    include 'assets/inc/sign-header.php'; 
    include 'connect/connect_db.php';
?> 
    <img src="./assets/img/sign-in.png" alt="" width=100% >
    <h1 class="page-banner-asset-title sign-in-banner">
        <span tabindex="0">Sign In</span>
    </h1>
<?php
    $error = false;
    if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $result = mysqli_query($con, "SELECT * FROM `customertbl` WHERE (`cemail` ='" . $_POST['email'] . "' AND `cpassword` = '" . $_POST['password'] . "')");
        if (!$result) {
            $error = mysqli_error($con);
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
        }
        mysqli_close($con);
        if ($error != false || $result->num_rows == 0) {?>
            <div class="small-container login-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="notify left-menu">
                            <h2>Notify</h2>
                            <h4><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h4>
                            <a href="./sign-in.php">Back</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php   exit;
        }?>
<?php } ?>
<?php if (empty($_SESSION['current_user'])) { ?>
    <div class="small-container login-container">
        <div class="row">
            <div class="col-md-6">
                <form class="login-form admin-sign-in" action="./sign-in.php" method="POST" autocomplete="off">
                    <div class="form-header">
                        <h1 class="sign-title">SIGN IN</h1>
                        <div class="form-description">Please enter your email and password below to access your account</div>
                    </div>
                    <div class="login-wrapper">
                        <label for="">Email</label><br>
                        <input type="text" class="brd-input" name="email"/><br>
                    </div>
                    <div class="login-wrapper">
                        <label for="">Password</label><br>
                        <input type="password" class="brd-input" name="password"/><br>
                    </div>
                    <div class="ma-submit-block">
                        <div class="ma-submit-btn">
                            <input id="sign-in-btn" class="js-cart-submit sign-in-btn" value="Sign in" type="Submit" aria-label="Sign in">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            ?>
            <div class="small-container login-container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="notify left-menu">
                            <h3>Xin chào <?= $currentUser['cname'] ?></h3><br/>
                            <a href="./index.php">Trang chủ</a><br/>
                            <a href="./logout.php">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
    <?php } ?>

<?php include 'assets/inc/footer.php'; ?>