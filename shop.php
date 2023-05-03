<?php
// Set the variable for the page name
$page_name = "Shop";
// include external files 
include "inc/header.php";
include "inc/database.php";
// connect to database 
connect();
// function to get all products 
$data = getProducts($conn);
$result = $data["result"];
$row = $data["row"];

// End the PHP so you can add HTML
?>
<!-- Add the page content below -->
      <!-- MAIN PAGE -->

      <!-- Page title, informing the user that they are on the contact page -->
      <h1 class = "page_title">Store</h1>
      
      <!-- Nine products displayed in a 3x2 grid, utilising the  style as on index.html -->
      <!-- Div for a row of featured products, with three sub divs displaying three products -->
      <div class = "products_grid">
         
        <!-- indexing through products from getProducts to load details on each product --->
        <?php for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_assoc($result);

            if (
                // selecting specific products to display 
                $row["product_id"] == 35 ||
                $row["product_id"] == 39 ||
                $row["product_id"] == 43
            ) {
                // row of three products, in one div 
                echo "<div>";
                echo '<img class="product_img" src="' .
                    $row["main_image"] .
                    '" alt="Light grey hoodie with yellow and blue text, and yellow butterflies"">';
                echo '<h3 class="product_title">' .
                    $row["product_name"] .
                    "</h3>";
                echo '<h4 class="product_price">' .
                    $row["product_price"] .
                    "</h4>";
                echo '<a class="product_button" href="product.php?product_id=' .
                    $row["product_id"] .
                    '">Shop Now</a>';
                echo "</div>";
            }
        } ?>
    
    </div>
    
    <div class = "products_grid">

        <?php for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_assoc($result);

            if (
                $row["product_id"] == 47 ||
                $row["product_id"] == 51 ||
                $row["product_id"] == 54
            ) {
                echo "<div>";
                echo '<img class="product_img" src="' .
                    $row["main_image"] .
                    '" alt="Light grey hoodie with yellow and blue text, and yellow butterflies"">';
                echo '<h3 class="product_title">' .
                    $row["product_name"] .
                    "</h3>";
                if ($row["product_id"] == 51 || $row["product_id"] == 54) {
                    echo '<h4 class="product_price">' .
                        "From " .
                        $row["product_price"] .
                        "</h4>";
                } else {
                    echo '<h4 class="product_price">' .
                        $row["product_price"] .
                        "</h4>";
                }
                echo '<a class="product_button" href="product.php?product_id=' .
                    $row["product_id"] .
                    '">Shop Now</a>';
                echo "</div>";
            }
        } ?>
         
            <!-- product4.png: https://store.kelseaballerini.com/product/X9CTKB17/subject-to-change-tshirt -->

            <!-- product5.png https://store.kelseaballerini.com/product/X9CDKB07/subject-to-change-cd?cp=104894_111906 -->

            <!-- product6.png https://store.kelseaballerini.com/product/X9CDKB04/kelsea-cd?cp=104894_107104 -->


    </div>
<?php // starting PHP again to include the footer
include "inc/footer.php";
?>
