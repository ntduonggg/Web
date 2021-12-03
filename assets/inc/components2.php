<?php
    function component2($proName,$proPrice,$proImg,$proImg1,$proImg2,$proImg3,$proImg4,$proDetail){
        $element="
          <div class=\"col-2\">
            <img src=\"$proImg\" width=\"100%\" id=\"ProductImg\">
                <div class=\"small-img-row\">
                    <div class=\"small-img-col\">
                        <img src=\"$proImg\" width=\"100%\" class=\"small-img\">
                    </div>
                    <div class=\"small-img-col\">
                        <img src=\"$proImg1\" width=\"100%\" class=\"small-img\">
                    </div>
                    <div class=\"small-img-col\">
                        <img src=\"$proImg2\" width=\"100%\" class=\"small-img\">
                    </div>
                    <div class=\"small-img-col\">
                        <img src=\"$proImg3\" width=\"100%\" class=\"small-img\">
                    </div>
                    <div class=\"small-img-col\">
                        <img src=\"$proImg4\" width=\"100%\" class=\"small-img\">
                    </div>
                </div>   
          </div>
        <div class=\"col-2\">
            <p>Home / Products</p>
                <h1>$proName</h1>
                <div class=\"rating\">
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-sta\"></i>
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-star\"></i>
                </div>
                <h4>$$proPrice</h4>
                <input type=\"number\" value=\"1\">
                <button class=\"btn-cart\">Add To Cart</button>
                <h3>Product Details </h3>
                <p>$proDetail</p>
    </div>";
        echo $element;
    }