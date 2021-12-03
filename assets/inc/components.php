<?php
    function component($proName,$proPrice,$proImg,$proImghover,$proLink){
        $element="
        <div class=\"col-4\">
            <div class=\"figure\">
                <a href=\"$proLink\">
                  <img src=\"$proImg\" height='300px'>
                  <img src=\"$proImghover\" class=\"img-hover\" height='300px'>
                <h4>$proName</h4>
                <div class=\"rating\">
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-star\"></i>
                  <i class=\"fas fa-star\"></i>
                </div>
                <p>$$proPrice</p>
                </a>
            </div>
        </div>";
        echo $element;
    }