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

      $products = mysqli_query($con, "SELECT * FROM `producttbl` ORDER BY `proid` DESC  LIMIT 6");
?>
      <div class="container-fluid p-0">
        <div class="site-slider">
          <div class="slider-one">
            <div>
              <img src="./assets/img/slider1.PNG" class="img-fluid" alt="Banner1">
            </div>
            <div>
              <img src="./assets/img/slider2.PNG" class="img-fluid" alt="Banner2">
            </div>
            <div>
              <img src="./assets/img/slider3.PNG" class="img-fluid" alt="Banner3">
            </div>
          </div>
          <div class="slider-btn">
            <span class="prev position-top"><i class="fas fa-chevron-left"></i></span>
            <span class="next position-top right-0"><i class="fas fa-chevron-right"></i></span>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <h2 class="title">Shop by Category</h2>
        <div class="site-slider-two px-md-4">
          <div class="row slider-two text-center">
            <div class="col-md-2 product pt-md-4 pt-4">
              <img src="./assets/img/product1.png" alt="Product 1">
              <span class="border site-btn btn-span">The Pocket Bag</span>
            </div>
            <div class="col-md-2 product pt-md-4 pt-4">
              <img src="./assets/img/product2.png" alt="Product 2">
              <span class="border site-btn btn-span">The Title Bag</span>
            </div>
            <div class="col-md-2 product pt-md-4 pt-4">
              <img src="./assets/img/product3.png" alt="Product 3">
              <span class="border site-btn btn-span">Lola Bag</span>
            </div>  
            <div class="col-md-2 product pt-md-4 pt-4">
              <img src="./assets/img/product4.png" alt="Product 4">
              <span class="border site-btn btn-span">The TB Bag</span>
            </div>
          </div>
          <div class="slider-btn">
            <span class="prev position-top"
            ><i class="fas fa-chevron-left fa-2x text-secondary"></i
            ></span>
            <span class="next position-top right-0"
            ><i class="fas fa-chevron-right fa-2x text-secondary"></i
            ></span>
          </div>
        </div>
      </div>

    <div class="small-container">
      <h2 class="title">Latest Products</h2>
      <div class="row">
            <?php 
              while ($row = mysqli_fetch_array($products)) {
              ?>
                <div class="col-4">
                  <div class="figure">
                    <a href="detail.php?id=<?= $row['proid']?>">
                      <img src="<?= $row['img']?>" height='300px'>
                      <img src="<?= $row['second_img']?>" class="img-hover" height='300px'>
                      <h4><?= $row['proname']?></h4>
                      <div class="rating">
                      <?php for ($i = 1; $i<=$row['rate']; $i++) {?>
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

<?php include 'assets/inc/footer.php'; ?>

    