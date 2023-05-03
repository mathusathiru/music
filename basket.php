<?php
// start session for a logged in user 
session_start();

// Set the variable for the page name
$page_name = "Basket";

// import files 
include('inc/header.php');
include('inc/database.php');

// connect to the database
connect();
?>

    <!-- Page title, informing the user that they are on the basket page -->
    <h1 id = "basket_page_title">Cart</h1>
    
    <!-- Heading for the products in the basket -->
    <p id = "product_names"><b>Your Basket</b></p>
    
    <!-- Div for the cart products and total price-->
    <div id = "cart_info">

<?php
// Check if the delete button was clicked
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    // Delete the product from the user cart table in the database
    if (isset($_SESSION['user_id'])) {
        $sql = "DELETE FROM user_cart WHERE product_id=?";
    } else {
        // Delete the product from the guest cart table in the database
        $sql = "DELETE FROM guest_cart WHERE product_id=?";
    }
    // prepared statmenents to remove product 
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
}

// Query the cart table to get the current list of products

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // get all products of logged in users, then match with user ID to get individual with prepared statement 
    $sql = "SELECT * FROM user_cart WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
} else {
    // get all products of guest users, with prepared statement 
    $sql = "SELECT * FROM guest_cart";
    $stmt = mysqli_prepare($conn, $sql);
}
mysqli_stmt_execute($stmt);
$cart = mysqli_stmt_get_result($stmt);

// total number of products, check if cart is empty or not
$product_count = 0;

// setting total price to 0 before indexing through products 
$total = 0.00; 
?>

<div id="summary">
    <!-- get all products from user cart or guest cart !-->
    <?php while ($product = mysqli_fetch_assoc($cart)) { 

        // increment number of products and calculate total product price so far 
        $product_count += 1;
        $total += $product['product_price'] * $product['product_quantity'];;
        ?>

        <!-- div to display product details, for each product in cart -->
        <div class="summary_row">
            <div class="summary_col1">
                <img src=<?php echo $product['product_image']; ?> alt="Product Image">
            </div>
            <div class="summary_col2">
                <p><?php echo $product['product_name']; ?></p>
                <p>Option:     <?php echo $product['product_category']; ?></p>
                <p>Quantity: <?php echo $product['product_quantity']; ?></p>
            </div>
            <div class="summary_col3">
                <!-- form to sending post method to delete product from cart, deleting it from relevant cart table -->
                <form method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <button id="delete_button" type="submit" name="delete_product">
                        <img src="images/bin.png" alt="Delete Icon">
                    </button>
                </form>
                <!-- displays total price for each product if the user has bought more than one product --> 
                <p><?php echo '£' . $product['product_price'] * $product['product_quantity']; ?></p>
            </div>
        </div>
    <?php } 

    // message displayed if product is emty, personalised with firstname if user is logged in 
    if ($product_count == 0) {
        echo '<div id="empty_summary_row">';
        if (isset($_SESSION['user_id'])) {
            echo '<p>' . $_SESSION['firstname'] . ', your basket is empty</p>';
        } else {
            echo '<p> Your basket is empty</p>';
        }
        echo '<a href = "shop.php"><button>Go to Store</button></a>
        </div>';
    }
    ?>
</div>

        <!-- Div for total price and option to checkout -->

        <div id = "totals">

            <div id = "total_info">
                <!-- Placeholder "Total", to indicate the total price to the user -->
                <p><b>Total</b></p>
                <!-- Text for the total price -->
                <p><?php
                echo '£' . sprintf("%.2f", $total) ?></p>
            </div>

            <!-- Button to proceed to the checkout page -->
            <button>Checkout</button>

        </div>

    </div>

    <!-- Div for important product information, such as shipping and return policies -->
    <div id = "basket_information">

        <!-- Information section on purchases -->
        <div class = "info_section">
            <div class = "info_heading">
                <!-- Icon of credit card -->
                <!-- Icon: href="https://www.flaticon.com/free-icons/credit-card" Credit card icons created by Freepik - Flaticon -->
                <img src = "images\credit-card.png" alt="Image of a transparent credit card icon with a black outline">
                <!-- Heading for purchase information -->
                <h3>Returns and Refunds</h3>
            </div>

            <!-- Paragraph for purchase information -->
            <p>We have a 30 day policy for returns and refunds, and only products intact in original packaging can be returned. You can 
                cancel your order within 24 hours before shipping. 
                <br> For any questions, please get in touch with our team at customer.service@kelseaballerini.com so we can resolve your 
                matters. 
            </p>
        </div>

        <!-- Information section on shipping -->
        <div class = "info_section">
            <div class = "info_heading">
                <!-- Icon of box -->
                <!-- Icon: "https://www.flaticon.com/free-icons/box" Box icons created by Freepik - Flaticon -->
                <img src = "images\box.png" alt="Image of a transparent cardboard box icon with a black outline">
                <!-- Heading for shipping information -->
                <h3>Shipping</h3>
            </div>

            <!-- Paragraph for shipping information -->
            <p>We aim to ship your order within three working days. If you live in the United Kingdom you are eligible for free shipping 
                and we will be able to ship your order within seven days. If you live internationally, it may take up to 30 days for you 
                to recieve your order. 
                <br> For any questions, please get in touch with our team at customer.service@kelseaballerini.com so we can resolve your 
                matters. 
            </p>
        </div>
    </div>
<?php
// starting PHP to include the footer
include('inc/footer.php');
?>
