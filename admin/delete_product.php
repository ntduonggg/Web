<?php
session_start();
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="main-content">
        <h1>Xóa sản phẩm</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect/connect_db.php';
                $result = mysqli_query($con, "DELETE FROM `producttbl` WHERE `proid` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa sản phẩm.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div class="notify" class="box-content">
                        <h2>Thông báo</h2>
                        <h4><?= $error ?></h4>
                        <a href="./product.php">Danh sách sản phẩm</a>
                    </div>
        <?php } else { ?>
                    <div class="notify" class="box-content">
                        <h2>Xóa sản phẩm thành công</h2>
                        <a href="./product.php">Danh sách sản phẩm</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
php include '../assets/inc/footer.php';
?>