<?php
    session_start();
    if (empty($_SESSION['current_user'])) 
    {
      include 'assets/inc/header.php';
    }
    else
    {
      include 'assets/inc/sign-header.php';
    }
    include 'connect/connect_db.php';
    $error1 = false;
    $success1= false;
    if (!empty($_GET['action'])) { 
        if  ($_GET['action'] == "submit") {
            if (isset($_POST['orderclick'])) {
                if (!empty($_POST['orderclick'])) {
                    if ($_POST['orderclick']) {
                        if (empty($_POST['payments'])) {
                            $error1 = "Please select payments";
                        }
                        if ($error1 == false) {
                            $order1 = mysqli_query($con, "SELECT * FROM `ordertbl` ORDER BY `orderid` DESC LIMIT 1");
                            $order1 = mysqli_fetch_array($order1);
                            $updatePayment = mysqli_query($con, "UPDATE `ordertbl` SET `payment`= ".$_POST['payments']." WHERE `orderid` = ".$order1['orderid']);
                            $success1 = "Order Successfully";
                        }
                    }
                }
            }
        }
    }?>

    <div class="small-container">
        <?php if (!empty($error1)) { ?> 
            <div class="notify">
                <?= $error1 ?>. <a href="javascript:history.back()">Back</a>
            </div>
        <?php } elseif (!empty($success1)) { ?>
            <div class="notify">
                <?= $success1 ?>. <a href="index.php">Continue shopping</a>
            </div>
        <?php } else { 
                $tmp = mysqli_query($con, "SELECT * FROM `ordertbl` ORDER BY `orderid` DESC LIMIT 1");
                $tmp = mysqli_fetch_array($tmp);
                $limit = mysqli_query($con, "SELECT COUNT(`id`) as x FROM `order_detailtbl` WHERE `orderid` = ".$tmp['orderid']);
                $limit =  mysqli_fetch_array($limit);
                $orders = mysqli_query($con, "SELECT `ordertbl`.`name`, `ordertbl`.`address`, `ordertbl`.`phone`, `ordertbl`.`note` , 
                                `order_detailtbl`.*, `producttbl`.`proname` as product_name FROM `ordertbl` 
                                INNER JOIN `order_detailtbl` ON `ordertbl`.`orderid` = `order_detailtbl`.`orderid`
                                INNER JOIN `producttbl` ON `producttbl`.`proid` = `order_detailtbl`.`proid` 
                                ORDER BY `orderid` DESC LIMIT " .$limit['x']);
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
                                foreach ($orders as $row1) {
                                    ?>
                                    <li>
                                        <span class="item-name"><?= $row1['product_name'] ?></span>
                                        <span class="item-quantity"> - SL: <?= $row1['quantity'] ?> sản phẩm</span>
                                    </li>
                                    <?php
                                    $totalMoney += ($row1['price'] * $row1['quantity']);
                                    $totalQuantity += $row1['quantity'];
                                }?>
                            </ul>
                            <hr/>
                            <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label> $<?= number_format($totalMoney, 2, ",", ".") ?>
                            <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <form id="payment-form" action="payment.php?action=submit" method="POST">
                        <div class="pays">
                            <h4>Phương thức thanh toán</h4>
                            <input type="radio" id="pay1" name="payments" value="1">
                            <label for="pay1"> <img src="assets/img/icon-payment.png" height="30px" alt=""> Thanh toán tiền mặt khi nhận hàng</label><br><br>   
                            <input type="radio" id="pay2" name="payments" value="2">
                            <label for="pay2"> <img src="assets/img/icon-payment1.png" height="30px" alt=""> Thanh toán bằng ví MOMO</label><br><br>
                            <input type="radio" id="pay3" name="payments" value="3">
                            <label for="pay3"> <img src="assets/img/icon-payment2.png" height="30px" alt=""> Thanh toán bằng ZaloPay</label><br><br>
                            <input type="radio" id="pay4" name="payments" value="4">
                            <label for="pay4"> <img src="assets/img/icon-payment3.png" height="30px" alt=""> Thẻ ATM nội địa/Internet Banking (Miễn phí thanh toán)</label><br>
                            <input type="submit" class="order-btn" name="orderclick" value="Order" />
                        </div>
                    </form>
                </div>
        <?php } ?>
<?php include 'assets/inc/footer.php'; ?>