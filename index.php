<?php
// start session with an empty basket 
session_set_cookie_params(0);
session_start();
// Set the variable for the page name
$page_name = "Home";
// import external files 
include('inc/header.php');
include('inc/database.php');
//connect to database 
connect();

// function in database.php to get all products 
$data = getProducts($conn);
$result = $data['result'];
$row = $data['row'];

// End the PHP so you can add HTML
?>
<!-- Add the page content below -->
    <!-- Hero image, stretching across the page, with overlapping text -->
    <!-- Hero image reference: https://www.redbookmag.com/life/news/a50373/exclusive-video-country-singer-kelsea-ballerini-on-tour-with-thomas-rhett/ -->
    <img id = "main_img" src="images\hero.jpg" alt="Landscape image of Kelsea Ballerini singing at a concert, with LED letters of her name behind her.">

    <!-- h1 text for titles on the homepage -->
    <h1 class="home_title_text">SHOP NEW ARRIVALS</h1>

    <!-- Div for a row of featured products, with three sub divs displaying three products-->
        
            <!-- product1.png: https://store.kelseaballerini.com/product/X9CTKB13/i-dont-wanna-go-to-the-club-tshirt -->
            <!-- product2.png: https://store.kelseaballerini.com/product/X9CTKB03/miss-me-more-tour-2019-tshirt -->
            <!-- product4.png: https://store.kelseaballerini.com/product/X9CTKB17/subject-to-change-tshirt -->
         
<div class = "products_grid">

    <?php 
        // for loop to obtain all products and information from getProducts() function 
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_assoc($result);
            // row represents each product 
            if ($row["product_id"] == 35 || $row["product_id"] == 39 || $row["product_id"] == 43) {
                echo '<div class="top">';
                // embedding aspects of the prodcut in echo statements 
                echo '<img class="product_img" src="' . $row["main_image"] . '" alt="Light grey hoodie with yellow and blue text, and yellow butterflies"">';
                echo '<h3 class="product_title">' . $row["product_name"] . '</h3>';
                echo '<h4 class="product_price">' . '£' . $row["product_price"] . '</h4>';
                echo '<a class="product_button" href="product.php?product_id=' . $row["product_id"] . '">Shop Now</a>';
                echo '</div>'; 
            }
        }
    ?>

</div>

    <!-- Button hyperlinking to the store page, to view all products -->
    <a id="all_products_button" href="shop.php">Shop All Products</a>


    <h1 class="home_title_text">TOUR DATES</h1>
    
    <!-- Div for tour dates with two sub divs acting as columns for tour locations and dates -->
    <div id = "tour_dates">

        <div id="locations_column">
            <p>Nashville</p>
            <p>Knoxville</p>
            <p>Jackson</p>
            <p>Chattanooga</p>
            <p>London</p>
            <p>Manchester</p>
        </div>

        <div id = "dates_column">
            <p>19 May 2023</p>
            <p>26 May 2023</p>
            <p>2 June 2023</p>
            <p>9 June 2023</p>
            <p>23 June 2023</p>
            <p>30 June 2023</p>
        </div>

    </div>
<?php
// include the footer by restarting PHP
include('inc/footer.php');
?>
