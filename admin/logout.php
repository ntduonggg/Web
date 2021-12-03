<?php 
    session_start();
    include 'header.php';
    unset($_SESSION['current_user']);
        ?>
        <div class="small-container login-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="notify left-menu">
                        <h3>Đăng xuất tài khoản thành công</h3>
                        <a href="./index.php">Đăng nhập lại</a>
                    </div>
                </div>
            </div>
        </div>

<?php include '../assets/inc/footer.php'; ?>