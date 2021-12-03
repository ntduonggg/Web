<?php 
    session_start();
    include 'header.php';
    include '../connect/connect_db.php';
    $error = null;
?>  

<div class="container-fluid product-container">
    <div class="row">
        <div class="col-lg-2">
            <div class="side-bar">
            <div class="left-menu">
                <div class="menu-heading">Admin Menu</div>
                    <div class="menu-items">
                    <a href="customer.php">Khách hàng</a>
                        <a href="product.php">Sản phẩm</a>
                        <a href="order.php">Hóa đơn</a>
                        <a href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-10">
            <div id="cart-form">
            <?php if (!empty($_SESSION['current_user'])) {?>
            <div class="main-content">
                <h1><?= !empty($_GET['id']) ? "Edit customer" : "Add customer" ?></h1>
                <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['email']) && !empty($_POST['email'])
                && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['phone']) && !empty($_POST['phone'])
                && isset($_POST['address']) && !empty($_POST['address'])) {
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên khách hàng";
                    } elseif (empty($_POST['email'])) {
                        $error = "Bạn phải nhập email khách hàng";
                    } elseif (empty($_POST['password'])) {
                        $error = "Bạn phải nhập mật khẩu khách hàng";
                    } elseif (empty($_POST['phone'])) {
                        $error = "Bạn phải nhập sđt khách hàng";
                    } elseif (empty($_POST['address'])) {
                        $error = "Bạn phải nhập địa chỉ khách hàng";
                    }
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) {
                            $result = mysqli_query($con, "UPDATE `customertbl` SET `cname` = '" . $_POST['name'] . "',`cemail` =  '" . $_POST['email'] . "', `cpassword` = '" . $_POST['password'] . "', `cphone` = '" . $_POST['phone'] . "', `caddress` = '" . $_POST['address'] . "', `last_update` = " . time() . " WHERE `cid` = " . $_GET['id']);
                        } else {
                            $result = mysqli_query($con,"INSERT INTO `customertbl`(`cid`, `cname`, `cemail`, `cpassword`, `cphone`, `caddress`, `total`, `created_time`, `last_update`) VALUES (NULL,'" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "','" . $_POST['phone'] . "', '" . $_POST['address'] . "', 0 ," . time() . ", " . time() . ");");
                        }
                            if (!$result) {
                                $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                            }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin khách hàng.";
                } ?>
                <div class = "small-container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "customer.php">Back to Customer</a>
                </div>
            <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($con, "SELECT * FROM `customertbl` WHERE `cid` = " . $_GET['id']);
                    $customer = $result->fetch_assoc();
                }?>
        <form id="editing-form" method="POST" action="<?= (!empty($customer)) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
            <input type="submit" title="Lưu thông tin" value="Lưu" />
            <div class="clear-both"></div>
            <div class="login-wrapper">
                <label>Tên khách hàng: </label>
                <input type="text" name="name" class="edit-input" value="<?= (!empty($customer) ? $customer['cname'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Email khách hàng: </label>
                <input type="text" name="email" class="edit-input" value="<?= (!empty($customer) ? $customer['cemail'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Mật khẩu: </label>
                <input type="text" name="password" class="edit-input" value="<?= (!empty($customer) ? $customer['cpassword'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Địa chỉ: </label>
                <input type="text" name="address" class="edit-input" value="<?= (!empty($customer) ? $customer['caddress'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>SĐT: </label>
                <input type="text" name="phone" class="edit-input" value="<?= (!empty($customer) ? $customer['cphone'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
        </form>
    </div>        
    </div>
</div>
</div> 
<?php }?>
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
<?php }?>
<?php include '../assets/inc/footer.php'; ?>
