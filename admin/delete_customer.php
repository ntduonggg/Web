<?php
session_start();
include 'header.php';
if (!empty($_SESSION['current_user'])) {
    ?>
    <div class="small-container">
        <h1>Xóa khách hàng</h1>
        <div id="content-box">
            <?php
            $error = false;
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                include '../connect/connect_db.php';
                $result = mysqli_query($con, "DELETE FROM `customertbl` WHERE `cid` = " . $_GET['id']);
                if (!$result) {
                    $error = "Không thể xóa khách hàng.";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div class="notify" class="container">
                        <h2>Thông báo</h2>
                        <h4><?= $error ?></h4>
                        <a href="./customer.php">Danh sách khách hàng</a>
                    </div>
            <?php } else { ?>
                    <div class="notify" class="box-content">
                        <h2>Xóa khách hàng thành công</h2>
                        <a href="./customer.php">Danh sách khách hàng</a>
                    </div>
                <?php } ?>
    <?php } ?>
        </div>
    </div>
    <?php
}
include '../assets/inc/footer.php';
?>