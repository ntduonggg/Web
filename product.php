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

      $orderCondition = "";
      $param = "";
      $paramSort = "";

      $search = isset($_GET['name']) ? $_GET['name'] : "";
      if ($search) {
        $param = "name=".$search."&";
        $paramSort = "name=".$search."&";
        $where = "WHERE `proname` LIKE '%" . $search . "%'";
      }

      $orderField = isset($_GET['field']) ? $_GET['field'] : "";
      $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
      if (!empty($orderField) && !empty($orderSort)) {
        $orderCondition = "ORDER BY `producttbl`.`".$orderField."` ".$orderSort;
        $param = "field=".$orderField."&sort=".$orderSort."&";
      }

      $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:6;
      $current_page = !empty($_GET['page'])?$_GET['page']:1;
      $offset = ($current_page - 1) * $item_per_page;

      if ($search) {
        $products = mysqli_query($con, "SELECT * FROM `producttbl` WHERE `proname` LIKE '%" . $search . "%' ".$orderCondition."LIMIT " . $item_per_page . " OFFSET " . $offset);
        $totalRecords = mysqli_query($con, "SELECT * FROM `producttbl` WHERE `proname` LIKE '%" . $search . "%'");
      } else {
        $products = mysqli_query($con, "SELECT * FROM `producttbl`".$orderCondition."  LIMIT " . $item_per_page . " OFFSET " . $offset);
        $totalRecords = mysqli_query($con, "SELECT * FROM `producttbl`");
        }
      $totalRecords = $totalRecords->num_rows;
      $totalPages = ceil($totalRecords / $item_per_page);
?>

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
      
        <div class="row row-2">
          <h2 id="title-select">All Products</h2>
          <select id="sort-box" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">)
            <option value="?<?=$paramSort?>field=proid&sort=">Default</option>
            <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?> value="?<?=$paramSort?>field=proprice&sort=desc">Sort by price high</option>
            <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?> value="?<?=$paramSort?>field=proprice&sort=asc">Sort by price low</option>
            <option <?php if (isset($_GET['sort']) && $_GET['sort'] == "DESC") { ?> selected <?php } ?> value="?<?=$paramSort?>field=rate&sort=DESC">Sort by rating</option>
          </select>
        </div>

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

        <div class="row">
          <div class="page-btn">
          <?php
              if ($current_page > 3) {
                  $first_page = 1;
                  ?>
                  <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
                  <?php
              }
              if ($current_page > 1) {
                  $prev_page = $current_page - 1;
                  ?>
                  <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>">Prev</a>
              <?php }
              ?>
              <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                  <?php if ($num != $current_page) { ?>
                      <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                          <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                      <?php } ?>
                  <?php } else { ?>
                      <strong class="current-page page-item"><?= $num ?></strong>
                  <?php } ?>
              <?php } ?>
              <?php
              if ($current_page < $totalPages - 1) {
                  $next_page = $current_page + 1;
                  ?>
                  <a class="page-item" href="?<?=$param?>per_page=<?= $item_per_page ?>&page=<?= $next_page ?>">Next</a>
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

<?php include 'assets/inc/footer.php'; ?>