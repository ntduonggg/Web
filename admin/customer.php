<?php 
    session_start();
    include 'header.php';
    include '../connect/connect_db.php';
    $config_name = "customer";
    $config_title = "khách hàng";
    if (!empty($_SESSION['current_user'])) {
    if(!empty($_GET['action']) && $_GET['action'] == 'search' && !empty($_POST)){
        $_SESSION[$config_name.'_filter'] = $_POST;
        header('Location: '.$config_name.'.php');exit;
    }
    if(!empty($_SESSION[$config_name.'_filter'])){
        $where = "";
        foreach ($_SESSION[$config_name.'_filter'] as $field => $value) {
            if(!empty($value)){
                switch ($field) {
                    case 'cname':
                    $where .= (!empty($where))? " AND "."`".$field."` LIKE '%".$value."%'" : "`".$field."` LIKE '%".$value."%'";
                    break;
                    default:
                    $where .= (!empty($where))? " AND "."`".$field."` = ".$value."": "`".$field."` = ".$value."";
                    break;
                }
            }
        }
        extract($_SESSION[$config_name.'_filter']);
    }
    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 6;
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
        $totalRecords = mysqli_query($con, "SELECT * FROM `customertbl` WHERE (".$where.")");
    }else{
        $totalRecords = mysqli_query($con, "SELECT * FROM `customertbl`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
        $customer = mysqli_query($con, "SELECT * FROM `customertbl` where (".$where.") ORDER BY `cid` LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
        $customer = mysqli_query($con, "SELECT * FROM `customertbl` ORDER BY `cid` LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
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
                <h1>Khách hàng</h1>
				<div class="buttons">
                    <a href="./edit_<?=$config_name?>.php">Thêm <?=$config_title?></a>
                </div>
                <div class="listing-search">
                    <form id="<?=$config_name?>-search-form" action="<?=$config_name?>.php?action=search" method="POST">
                        <fieldset>
                            <legend>Tìm kiếm <?=$config_title?>:</legend>
                            ID: <input type="text" name="cid" value="<?=!empty($id)?$id:""?>" />
                            Tên <?=$config_title?>: <input type="text" name="cname" value="<?=!empty($name)?$name:""?>" />
                            <input type="submit" class="" value="Tìm" />
                        </fieldset>
                    </form>
                </div>
                    <table class="customer-tbl">
                        <tr>
                            <th class="cus-number">ID</th>
                            <th class="cus-name">Tên</th>
                            <th class="cus-email">Email</th>
                            <th class="cus-password">Mật khẩu</th>
                            <th class="cus-phone">SĐT</th>
                            <th class="cus-address">Địa chỉ</th>
                            <th class="cus-total">Tích lũy</th>
                            <th class="created-time">Ngày tạo</th>
                            <th class="last-update">Cập nhật</th>
                            <th class="x-edit">Sửa</th>
                            <th class="x-delete">Xóa</th>
                        </tr>
                        <?php
                        if (!empty($customer)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($customer)) {
                                ?>
                                <tr>
                                    <td class="cus-number"><?= $row['cid']?></td>
                                    <td class="cus-name"><?= $row['cname'] ?></td>
                                    <th class="cus-email"><?= $row['cemail'] ?></th>
                                    <th class="cus-password"><?= $row['cpassword'] ?></th>
                                    <th class="cus-phone"><?= $row['cphone'] ?></th>
                                    <th class="cus-address"><?= $row['caddress'] ?></th>
                                    <th class="cus-total"><?= $row['total'] ?></th>
                                    <th class="created-time"><?= date('d/m/Y H:i', $row['created_time']) ?></th>
                                    <th class="last-update"><?= date('d/m/Y H:i', $row['last_update']) ?></th>
                                    <th class="x-edit"><a href="./edit_customer.php?id=<?= $row['cid'] ?>">Sửa</a></th>
                                    <td class="x-delete"><a href="./delete_customer.php?id=<?= $row['cid'] ?>">Xóa</a></td>
                                </tr>
                                <?php
                            }
                        }?>
                    </table>  
            </div>        
        </div>
    </div>
    <div class="row">
        <div class="page-btn">
            <?php if ($current_page > 3) {
                  $first_page = 1;
                  ?>
                  <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
                  <?php
              }
              if ($current_page > 1) {
                  $prev_page = $current_page - 1;
                  ?>
                  <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
              <?php }
              ?>
              <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                  <?php if ($num != $current_page) { ?>
                      <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                          <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                      <?php } ?>
                  <?php } else { ?>
                      <strong class="current-page page-item"><?= $num ?></strong>
                  <?php } ?>
              <?php } ?>
              <?php
              if ($current_page < $totalPages - 1) {
                  $next_page = $current_page + 1;
                  ?>
                  <a class="page-item" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
              <?php
              }
              if ($current_page < $totalPages - 3) {
                  $end_page = $totalPages;
                  ?>
                  <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
                  <?php
              }
              ?>
        </div>
    </div>   
</div> 
<?php }?>
<?php if (!empty($_SESSION['current_user'])) { ?>
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