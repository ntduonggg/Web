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
    include 'connect/connect_db.php';?>

<?php
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    $GLOBALS['changed_cart'] = false;
    $error = false;
    $success = false;
    if (isset($_GET['action'])) {
        function update_cart($con, $add = false) {
            if (!empty($_POST['quantity'])) {
                foreach ($_POST['quantity'] as $id => $quantity) {
                    if ($quantity == 0) {
                        unset($_SESSION["cart"][$id]);
                    } else {
                        if (!isset($_SESSION["cart"][$id])) {
                            $_SESSION["cart"][$id] = 0;
                        }
                        if ($add) {
                            $_SESSION["cart"][$id] += $quantity;
                        } else {
                            $_SESSION["cart"][$id] = $quantity;
                        }
                        $addProduct = mysqli_query($con, "SELECT `available` FROM `producttbl` WHERE `proid` = " . $id);
                        $addProduct = mysqli_fetch_assoc($addProduct);
                        if ($_SESSION["cart"][$id] > $addProduct['available']) {
                            $_SESSION["cart"][$id] = $addProduct['available'];
                            $GLOBALS['changed_cart'] = true;
                        }
                    }
                }
            }
        }

        switch ($_GET['action']) {
            case "add":
                update_cart($con, true);
                if ($GLOBALS['changed_cart'] == false) {
                }
                break;
            case "delete":
                if (isset($_GET['id'])) {
                    unset($_SESSION["cart"][$_GET['id']]);
                }
                break;
            case "submit":
                if (isset($_POST['update_click'])) {
                    update_cart($con);
                } elseif (!empty($_POST['order_click'])) { 
                    if  ($_POST['order_click']) {
                        if (empty($_POST['name'])) {
                            $error = "Please set receiver";
                        } elseif (empty($_POST['phone'])) {
                            $error = "Please set phone";
                        } elseif (empty($_POST['address'])) {
                            $error = "Please set adress";
                        } elseif (empty($_POST['quantity'])) {
                            $error = "Empty cart";
                        }
                        if ($error == false && !empty($_POST['quantity'])) {
                            $products = mysqli_query($con, "SELECT * FROM `producttbl` WHERE `proid` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                            $total = 0;
                            $orderProducts = array();
                            $updateString = "";
                            while ($row = mysqli_fetch_array($products)) {
                                $orderProducts[] = $row;
                                if ($_POST['quantity'][$row['proid']] > $row['available']) {
                                    $_POST['quantity'][$row['proid']] = $row['available'];
                                    $GLOBALS['changed_cart'] = true;
                                } else {
                                    $total += $row['proprice'] * $_POST['quantity'][$row['proid']];
                                    $updateString .= " WHEN proid = ".$row['proid']." THEN available - ".$_POST['quantity'][$row['proid']];
                                }
                            }
                            if ($GLOBALS['changed_cart'] == false) {
                                $updateQuantity = mysqli_query($con, "update `producttbl` set available = CASE".$updateString." END WHERE proid IN (".implode(",", array_keys($_POST['quantity'])).")");
                                $insertOrder = mysqli_query($con, "INSERT INTO `ordertbl` (`orderid`, `name`, `phone`, `address`, `note`, `total`, `created_time`, `last_updated`) VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $_POST['note'] . "', '" . $total . "', '" . time() . "', '" . time() . "');");
                                $orderID = $con->insert_id;
                                $insertString = "";
                                foreach ($orderProducts as $key => $product) {
                                    $insertString .= "(NULL, '" . $orderID . "', '" . $product['proid'] . "', '" . $_POST['quantity'][$product['proid']] . "', '" . $product['proprice'] . "', '" . time() . "', '" . time() . "')";
                                    if ($key != count($orderProducts) - 1) {
                                        $insertString .= ",";
                                    }
                                }
                                $insertOrder = mysqli_query($con, "INSERT INTO `order_detailtbl` (`id`, `orderid`, `proid`, `quantity`, `price`, `created_time`, `last_update`) VALUES " . $insertString . ";");
                                $success = "Order Successfully";
                                
                                unset($_SESSION['cart']);
                            }
                        }
                    }
                }
                break;
        }
    }
    if (!empty($_SESSION["cart"])) {
        $products = mysqli_query($con, "SELECT * FROM `producttbl` WHERE `proid` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
    }?>   
        
        <div class="small-container">
             <?php if (!empty($error)) {?> 
                <div class="notify">
                    <?= $error ?>. <a href="javascript:history.back()">Back</a>
                </div>
            <?php } elseif (!empty($success)) { ?>
                <div class="notify">
                    <?php header("Location: ./payment.php"); ?>
                </div>
                    <?php } else { ?> 
                <form id="cart-form" action="cart.php?action=submit" method="POST">
                        <div class="cart-pro">
                            <a href="product.php"><span>Continue shopping</span></a>
                        </div>  
                    <h1>Cart</h1>
                    <table>
                        <tr>
                            <th class="product-number">Num</th>
                            <th class="product-name">Name</th>
                            <th class="product-img">Image</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="total-money">Money</th>
                            <th class="product-delete">Delete</th>
                        </tr>
                        <?php
                        if (!empty($products)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($products)) {
                                ?>
                                <tr>
                                    <td class="product-number"><?= $num++; ?></td>
                                    <td class="product-name"><?= $row['proname'] ?></td>
                                    <td class="product-img"><img src="<?= $row['img'] ?>" /></td>
                                    <td class="product-price">$<?= number_format($row['proprice'], 2, ",", ".") ?></td>
                                    <td class="product-quantity"><input type="text" value="<?=  $_SESSION["cart"][$row['proid']] ?>" name="quantity[<?=$row['proid'] ?>]" /></td>
                                    <td class="total-money">$<?= number_format($row['proprice']  * $_SESSION["cart"][$row['proid']], 0, ",", ".") ?></td>
                                    <td class="product-delete"><a href="cart.php?action=delete&id=<?= $row['proid'] ?>">Delete</a></td>
                                </tr>
                                <?php
                                $total += $row['proprice']  * $_SESSION["cart"][$row['proid']];
                            }?>
                            <tr id="row-total">
                                <td class="product-number">&nbsp;</td>
                                <td class="product-name">Total</td>
                                <td class="product-img">&nbsp;</td>
                                <td class="product-price">&nbsp;</td>
                                <td class="product-quantity">&nbsp;</td>
                                <td class="total-money">$<?= number_format($total, 2, ",", ".") ?></td>
                                <td class="product-delete">Delete</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <div id="form-button">
                        <input type="submit" name="update_click" class="cart-pro" value="Update" />
                    </div>
                    <hr>
                    <div><label>Receiver: </label><input type="text" value="" name="name" /></div>
                    <div><label>Phone: </label><input type="text" value="" name="phone" /></div>
                    <div><label>Address: </label><input type="text" value="" name="address" /></div>
                    <div><label>Note: </label><textarea name="note" cols="50" rows="7" ></textarea></div>
                    <input type="submit" name="order_click" class="cart-pro" value="Order" />
                </form>
            <?php } ?>
        </div>
<?php include 'assets/inc/footer.php'; ?>