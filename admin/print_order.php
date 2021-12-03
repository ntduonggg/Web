<?php
        session_start();
        include 'header.php';
        if (!empty($_SESSION['current_user'])) {
            include '../connect/connect_db.php';
            $orders = mysqli_query($con, "SELECT ordertbl.name, ordertbl.address, ordertbl.phone, ordertbl.note
                                        , order_detailtbl.*, producttbl.proname as product_name FROM ordertbl
                                        INNER JOIN order_detailtbl ON ordertbl.orderid = order_detailtbl.orderid
                                        INNER JOIN producttbl ON producttbl.proid = order_detailtbl.proid
                                        WHERE ordertbl.orderid = " . $_GET['id']);
            $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
        ?>
        <div class="small-container">
            <div class="order-print">
                <div id="order-detail">
                    <h1>Chi tiết đơn hàng</h1>
                    <label>Người nhận: </label><span> <?= $orders[0]['name'] ?></span><br/>
                    <label>Điện thoại: </label><span> <?= $orders[0]['phone'] ?></span><br/>
                    <label>Địa chỉ: </label><span> <?= $orders[0]['address'] ?></span><br/>
                    <hr/>
                    <h3>Danh sách sản phẩm</h3>
                    <ul>
                        <?php
                        $totalQuantity = 0;
                        $totalMoney = 0;
                        foreach ($orders as $row) {
                            ?>
                            <li>
                                <span class="item-name"><?= $row['product_name'] ?></span>
                                <span class="item-quantity"> - SL: <?= $row['quantity'] ?> sản phẩm</span>
                            </li>
                            <?php
                            $totalMoney += ($row['price'] * $row['quantity']);
                            $totalQuantity += $row['quantity'];
                        }
                        ?>
                    </ul>
                    <hr/>
                    <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> $<?= number_format($totalMoney, 2, ",", ".") ?> đ
                    <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>
                </div>
            </div>
        </div>
    <?php include '../assets/inc/footer.php'; ?>
<?php } else { ?>
    <div class="small-container login-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="notify left-menu">
                        Bạn chưa đăng nhập. Mời bạn quay lại đăng nhập quản trị <a href="index.php">tại đây</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>