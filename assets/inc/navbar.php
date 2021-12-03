<div class="container-fluid p-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <button class="navbar-toggler" 
                          type="button" 
                          data-bs-toggle="collapse" 
                          data-bs-target="#navbarNavDropdown" 
                          aria-controls="navbarNavDropdown" 
                          aria-expanded="false" 
                          aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="product.php">FEATURES</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="about-us.php">ABOUT US</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="navbar-nav">
                    <form class="product-search d-flex" action="" method="GET">
                      <input class="form-input" type="text" placeholder="Search.." value="<?=isset($_GET['name']) ? $_GET['name'] : ""?>" name="name" aria-label="Search">
                      <button class="btn-submit" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                        
                    <form id="add-to-cart-form" action="cart.php?action=add" method="POST">
                      <li class="nav-item border rounded-circle mx-2 cart-icon">
                      <button><i class="fas fa-shopping-cart"></i></button>
                    </form> 
                </div>
              </nav>
        </div>