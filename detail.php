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
      include 'assets/inc/navbar.php';
      include 'connect/connect_db.php';
      include 'connect/function.php';
      $productid = $_GET['id'];
      $result = mysqli_query($con, "SELECT * FROM `producttbl` WHERE `proid` = ".$productid);
      $result1 = mysqli_query($con, "SELECT * FROM `img_librarytbl` WHERE `proid` = ".$productid);
      $product = mysqli_fetch_assoc($result);
      $imgs = mysqli_fetch_assoc($result1);
      $products = mysqli_query($con, "SELECT * FROM `producttbl` ORDER BY `proid` ASC  LIMIT 3");
      $currentUser = $_SESSION['current_user'];
      ?>

<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img src="<?=$product['img']?>" width="100%" id="ProductImg">
                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="<?=$imgs['img']?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?=$imgs['img1']?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?=$imgs['img2']?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?=$imgs['img3']?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?=$imgs['img4']?>" width="100%" class="small-img">
                    </div>
                </div>   
          </div>
          <div class="col-2">
            <p>Home / Products</p>
                <h1><?=$product['proname']?></h1>
                <div class="rating">
                    <?php for ($i = 1; $i<=(int)$product['rate']; $i++) {?>
                        <i class="fas fa-star"></i>
                    <?php } 
                    if ($product['rate']>($i-1)) { ?>
                        <i class="fas fa-star-half"></i>
                    <?php } ?>
                    <i><?=$product['rate']?> </i>
                </div>
                <h4>$<?= number_format($product['proprice'],2,".",",")?></h4>
                <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                    <?php if ( $product['available'] == 0 ) { ?>
                        <h3 class="sold-out">Sold out</h3>
                    <?php }  else { ?> 
                        <h5>Available: <?=$product['available']?></h5>
                        <input type="number" class="amount" value="1" name="quantity[<?=$product['proid']?>]" min="1" max="<?=$product['available']?>" size="2" />
                        <input type="submit" class="btn-cart" value="Add To Cart" />
                    <?php } ?>
                </form>
                <h3>Product Details </h3>
                <p><?=$product['content']?></p>
          </div>
          
          <div class="col-lg-10 col-md-offset-3 comments-section">
			<?php if (!empty($_SESSION['current_user'])) {?>
				<form class="clearfix" action="#" method="POST" id="comment_form">
					<textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
					<button class="btn btn-primary btn-sm pull-right" id="submit_comment" name="submit_comment" value="Submit comment">Submit comment</button>
				</form>
			<?php } else { ?>
				<div class="well" style="margin-top: 20px;">
					<h4 class="text-center"><a href="./sign-in.php">Sign in</a> to post a comment</h4>
				</div>
			<?php } 
                include 'connect/connect_db.php';
                if (isset($_POST['submit_comment']) && ($_POST['submit_comment']=="Submit comment")) {
                    $comment_text = strip_tags($_POST['comment_text']);
                    $user_id = $currentUser['cid'];
                    $rs = mysqli_query($con, "INSERT INTO `commenttbl` (`userid`, `proid`, `body`, `created_at`, `updated_at`) VALUES ('$user_id', '$productid', '$comment_text', now(), null)");
                }  
                $result2 = mysqli_query($con, "SELECT * FROM `commenttbl` WHERE `proid` = ".$productid. " ORDER BY created_at DESC ");
                $cmts = mysqli_fetch_all($result2);
            ?>
			<h2><span id="comments_count"><?php echo count($cmts) ?></span> Comment(s)</h2>
			<hr>
			<div id="comments-wrapper">
			<?php if (isset($cmts)): ?>
				<?php foreach ($cmts as $comment): ?>
				<div class="comment clearfix">
					<img src="assets/img/profile.png" alt="" class="profile_pic">
					<div class="comment-details">
						<span class="comment-name"><?php echo getUsernameById($comment[1]) ?></span>
						<span class="comment-date"><?php echo date("F j, Y ", strtotime($comment[4])); ?></span>
						<p><?php echo $comment[3]; ?></p>
					</div>
				</div>
				<?php endforeach ?>
			<?php else: ?>
				<h2>Be the first to comment on this post</h2>
			<?php endif ?>
			</div>
		</div>
    </div>
</div>

<div class="container">
    <div class="row row-2">
        <h2 id="title-select">Related Products</h2>
    </div>
</div>

<div class="container">
    <div class="row">
        <?php 
            while ($row = mysqli_fetch_array($products)) {
            ?>
              <div class="col-4">
                <div class="figure">
                   <a href="detail.php?id=<?= $row['proid']?>">
                    <img src=<?= $row['img']?> height='300px'>
                    <img src=<?= $row['second_img']?> class="img-hover" height='300px'>
                    <h4><?= $row['proname']?></h4>
                    <div class="rating">
                    <?php for ($i = 1; $i<=(int)$row['rate']; $i++) {?>
                        <i class="fas fa-star"></i>
                    <?php } 
                    if ($row['rate']>($i-1)) { ?>
                        <i class="fas fa-star-half"></i>
                    <?php } ?>
                    <i><?=$row['rate']?> </i>
                </div>
                    <p>$<?=number_format($row['proprice'],2,".",",")?></p>
                  </a>
                </div>
              </div>
          <?php } ?>
        </div>
    </div>

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";

        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px";
            } else {
                MenuItems.style.maxHeight = "0px";
            }
        }
    </script>


    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");

        SmallImg[0].onclick = function() {
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function() {
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function() {
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function() {
            ProductImg.src = SmallImg[3].src; 
        }
        SmallImg[4].onclick = function() {
            ProductImg.src = SmallImg[4].src; 
        }
    </script>

<?php include 'assets/inc/footer.php'; ?>