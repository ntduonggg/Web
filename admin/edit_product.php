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
                <h1><?= !empty($_GET['id']) ? "Sửa sản phẩm" : "Thêm sản phẩm" ?></h1>
                <div id="content-box">
            <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) {
                if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['price']) && !empty($_POST['price'])
                && isset($_POST['available']) && !empty($_POST['available'])) {
                    if (empty($_POST['name'])) {
                        $error = "Bạn phải nhập tên sản phẩm";
                    } elseif (empty($_POST['price'])) {
                        $error = "Bạn phải nhập giá sản phẩm";
                    } elseif (!empty($_POST['price']) && is_numeric(str_replace('.', '', $_POST['price'])) == false) {
                        $error = "Giá nhập không hợp lệ";
                    } elseif (empty($_POST['available'])) {
                        $error = "Bạn phải nhập giá số lượng sản phẩm";
                    }
                    if (!isset($error)) {
                        if ($_GET['action'] == 'edit' && !empty($_GET['id'])) {
                            $result = mysqli_query($con, "UPDATE `producttbl` SET `proname` = '" . $_POST['name'] . "',`img` =  '" . $_POST['img'] . "', `second_img` = '". $_POST['img1'] . "', `proprice` = " . str_replace('.', '', $_POST['price']) . ", `available` = " . str_replace('.', '', $_POST['available']) . ", `content` = '" . $_POST['content'] . "', `last_update` = " . time() . " WHERE `proid` = " . $_GET['id']);
                            $result1 = mysqli_query($con, "UPDATE `img_librarytbl` SET `img` =  '" . $_POST['img'] . "', `img1` = '". $_POST['img1'] . "',  `img2` = '". $_POST['img2'] . "',  `img3` = '". $_POST['img3'] . "', `img4` = '". $_POST['img4']);
                        } else {
                            $result = mysqli_query($con, "INSERT INTO `producttbl` (`proid`, `proname`, `img`, `second_img`, `available`, `proprice`, `content`, `created_time`, `last_update`) VALUES (NULL, '" . $_POST['name'] . "','" . $_POST['img'] . "','" . $_POST['img1'] . "', " . str_replace('.', '', $_POST['available']) . ", " . str_replace('.', '', $_POST['price']) . ", '" . $_POST['content'] . "', " . time() . ", " . time() . ");");
                            $result1 = mysqli_query($con, "INSERT INTO `img_librarytbl` (`proid`, `img`, `img1`, `img2`, `img3`, `img4`) VALUES (NULL, '" . $_POST['img'] . "','" . $_POST['img1'] . "','" . $_POST['img2'] . "', '" . $_POST['img3'] . "','" . $_POST['img3']);
                        }
                            if (!$result && !$result1) {
                                $error = "Có lỗi xảy ra trong quá trình thực hiện.";
                            }
                    }
                } else {
                    $error = "Bạn chưa nhập thông tin sản phẩm.";
                } ?>
                <div class = "small-container">
                    <div class = "error"><?= isset($error) ? $error : "Cập nhật thành công" ?></div>
                    <a href = "product.php">Quay lại danh sách sản phẩm</a>
                </div>
            <?php
            } else {
                if (!empty($_GET['id'])) {
                    $result = mysqli_query($con, "SELECT * FROM `producttbl` WHERE `proid` = " . $_GET['id']);
                    $result1 = mysqli_query($con, "SELECT * FROM `img_librarytbl` WHERE `proid` = " . $_GET['id']);
                    $product = $result->fetch_assoc();
                    $products = $result1->fetch_assoc();
                }?>
        <form id="editing-form" method="POST" action="<?= (!empty($product)) ? "?action=edit&id=" . $_GET['id'] : "?action=add" ?>"  enctype="multipart/form-data">
            <input type="submit" title="Lưu sản phẩm" value="Lưu" />
            <div class="clear-both"></div>
            <div class="login-wrapper">
                <label>Tên sản phẩm: </label>
                <input type="text" name="name" class="edit-input" value="<?= (!empty($product) ? $product['proname'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Giá sản phẩm: </label>
                <input type="text" name="price" class="edit-input" value="<?= (!empty($product) ? number_format($product['proprice'], 0 , ",", ".") : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Tồn kho: </label>
                <input type="text" name="available" class="edit-input" value="<?= (!empty($product) ? number_format($product['available'], 0, ",", ".") : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Ảnh đại diện: </label>
                <input type="text" name="img" class="edit-input" value="<?= (!empty($product) ? $product['img'] : "") ?>" />
                <div class="clear-both"></div>
            </div>
            <div class="login-wrapper">
                <label>Thư viện ảnh: </label>
                <div class="right-wrap-field">
                    <label>Ảnh 1: </label>
                    <input type="text" name="img1" class="edit-input edit-img" value="<?= (!empty($products) ? $products['img1'] : "") ?>" />
                    <div class="clear-both"></div>
                    <label>Ảnh 2: </label>
                    <input type="text" name="img2" class="edit-input edit-img" value="<?= (!empty($products) ? $products['img2'] : "") ?>" />
                    <div class="clear-both"></div>
                    <label>Ảnh 3: </label>
                    <input type="text" name="img3" class="edit-input edit-img" value="<?= (!empty($products) ? $products['img3'] : "") ?>" />
                    <div class="clear-both"></div>
                    <label>Ảnh 4: </label>
                    <input type="text" name="img4" class="edit-input edit-img" value="<?= (!empty($products) ? $products['img4'] : "") ?>" />
                    <div class="clear-both"></div>
                </div>
                 <div class="login-wrapper">
                    <label>Nội dung: </label>
                    <textarea name="content" id="product-content"><?= (!empty($product) ? $product['content'] : "") ?></textarea>
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
