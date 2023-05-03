<?php
// Resume existing login session
session_start();
// Set page name
$page_name = "Product";
// Include the external files
include "inc/header.php";
include "inc/database.php";
// Connect to database
connect();
?>


    <?php // Retrieve the product ID from the URL query string
if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    $product_data = mysqli_fetch_assoc($result);

    $images = [];
    array_push($images, $product_data["enlarged_main_image"], $product_data["main_image"]);
} ?>

<!-- Div containing main product image and product information and product options, with an add to cart button in sub divs -->

<form method="post">
    <div id="product_info">
        <!-- Sub div containing main product image -->
        <div id="product_img_col">
        <!-- Product 3a_enlarged reference: https://store.kelseaballerini.com/product/X9CMKB08/dateback-balloon-hoodie?cp=104894_105151-->
        <img id="displayed_img" src="<?php echo $images[0]; ?>" alt="Light grey hoodie with yellow and blue text, and yellow butterflies" onclick="switchImage()">
        </div>
        <!-- Sub div containing product information, options and an add to cart button-->
        <div id="product_info_col">

        <input type="hidden" name="product_id" value="<?php echo $product_data["product_id"]; ?>">
        <input type="hidden" name="product_name" value="<?php echo $product_data["product_name"]; ?>">
        <input type="hidden" name="product_image" value="<?php echo $product_data["main_image"]; ?>">

        <h2 id="product_name" name="product_name"><?php echo $product_data["product_name"]; ?></h2>

        <?php if ($product_data["product_id"] < 51)
{ ?>
                <h2 id="product_price"><?php echo "£" . $product_data["product_price"]; ?></h2>
        <?php
}
else
{ ?>
                <h2 id="product_price"><?php echo "From £" . $product_data["product_price"]; ?></h2>
                <?php
} ?>
        <!-- Dropdown option select for products such as T-shirts to choose sizes -->
        <div id="option_div">
        <label id="option">Option</label>
        <select id="option_select" name="option_select">

        <?php
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

for ($i = 0;$i < mysqli_num_rows($result);$i++) {
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_assoc($result);
    if ($product_id < 51) {
        if ($row["category"] != "CD" && $row["category"] != "Vinyl") {
            if ($row["category"] == "Select Option") {
                echo '<option value="" disabled selected>' . $row["category"] . "</option>";
            }
            else {
                echo "<option value= " . $row["category"] . ">" . $row["category"] . "</option>";
            }
        }
    } 
    else {
        if ($row["category"] == "Select Option" || $row["category"] == "CD" || $row["category"] == "Vinyl") {
            if ($row["category"] == "Select Option") {
                echo '<option value="" disabled selected>' . $row["category"] . "</option>";
            }
            else {
                echo "<option value= " . $row["category"] . ">" . $row["category"] . "</option>";
            }
        }
    }
}

?>
        </select>
        </div>
        <!-- Stepper input to choose a quanitity for a product -->
        <div class="quantity_div">
        <label class="quantity">Quantity</label>
        <input class="quantity_step" type="number" min="1" max="10" step="1" placeholder="Select Quantity" name="quantity_step">
        </div>
        <!-- Button adding a product to shopping cart once clicked -->

        <button type="submit" id="buy_button" name="buy_button">Add to Cart</button>

        <?php if (isset($_POST["buy_button"])) {

        // gets all information about product for appending to cart
        $product_category = $_POST["option_select"];
        $product_quantity = $_POST["quantity_step"];
        $product_name = $_POST["product_name"];
        $product_image = $_POST["product_image"];

        // selects at the product categroy, to insert specifically
        $sql = "SELECT * FROM products WHERE product_category = '$product_category'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        // requires customer to choose options
        if ($product_category == "")
        {
            echo "<p class='php_echo_message'>Please select a valid product option</p>";
        }
        elseif ($product_quantity <= 0)
        {
            echo "<p class='php_echo_message'>Please select a valid product quantity</p>";
        }
        else
        {
            // adds product to cart
            for ($i = 0;$i < mysqli_num_rows($result);$i++)
            {
                mysqli_data_seek($result, $i);
                $row = mysqli_fetch_assoc($result);
                
                // identifies valid name
                if (strcmp($row["product_name"], $product_name) == 0)
                {
                    // identifies valid category 
                    if (strcmp($row["product_category"], $product_category) == 0)
                    {
                        if (!empty($product_quantity))
                        {
                            // Escape fields to prevent SQL injection
                            $product_id = mysqli_real_escape_string($conn, $row["product_id"]);
                            $product_price = mysqli_real_escape_string($conn, $row["product_price"]);
                            $product_category = mysqli_real_escape_string($conn, $product_category);
                            $product_quantity = mysqli_real_escape_string($conn, $product_quantity);
                            $product_image = mysqli_real_escape_string($conn, $product_image);

                            if (isset($_SESSION["user_id"]))
                            {
                                $user_id = $_SESSION["user_id"];

                                $sql = "SELECT * FROM user_cart WHERE product_id = ? AND user_id = ?";
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_bind_param($stmt, "ii", $product_id, $user_id);
                                mysqli_stmt_execute($stmt);
                                $check_result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($check_result) > 0)
                                {
                                    // If the product already exists in the cart, update the product_quantity
                                    $row = mysqli_fetch_assoc($check_result);
                                    $new_quantity = $row["product_quantity"] + $product_quantity;
                                    $sql = "UPDATE user_cart SET product_quantity = ? WHERE product_id = ? AND user_id = ?";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, "iii", $new_quantity, $product_id, $user_id);
                                    mysqli_stmt_execute($stmt);
                                }
                                else
                                {   
                                    // or insert a new product to cart
                                    $sql = "INSERT INTO user_cart (product_id, user_id, product_name, product_price, product_category, product_quantity, product_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, "iisdsis", $product_id, $user_id, $product_name, $product_price, $product_category, $product_quantity, $product_image);
                                    mysqli_stmt_execute($stmt);
                                                                    }
                            }
                            // same procedure for guest 
                            else
                            {
                                $sql = "SELECT * FROM guest_cart WHERE product_id = ?";
                                $stmt = mysqli_prepare($conn, $sql);
                                mysqli_stmt_bind_param($stmt, "i", $product_id);
                                mysqli_stmt_execute($stmt);
                                $check_result = mysqli_stmt_get_result($stmt);
                                

                                if (mysqli_num_rows($check_result) > 0)
                                {
                                    // If the product already exists in the cart, update the product_quantity
                                    $row = mysqli_fetch_assoc($check_result);
                                    $new_quantity = $row["product_quantity"] + $product_quantity;
                                    $sql = "UPDATE guest_cart SET product_quantity = ? WHERE product_id = ?";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, "ii", $new_quantity, $product_id);
                                    mysqli_stmt_execute($stmt);
                                    
                                }
                                else
                                {
                                    $sql = "INSERT INTO guest_cart (product_id, product_name, product_price, product_category, product_quantity, product_image) VALUES (?, ?, ?, ?, ?, ?)";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_bind_param($stmt, "isdsis", $product_id, $product_name, $product_price, $product_category, $product_quantity, $product_image);
                                    mysqli_stmt_execute($stmt);
                                }
                            }
                            $result = mysqli_query($conn, $sql);
                            echo "<p class='php_echo_message'>Product added to cart!</p>";
                        }
                    }
                }
            }
        }
    } 
    ?>
    </div>
    </div>
</form>

    <!-- Div containing further product information for the customer -->
    <div class = "product_details">
        <!-- Title for product information -->
        <h4>Product Information</h4>
        <!-- Paragraph for product information -->
        <p><?php echo $product_data["product_description"]; ?></p>
    </div>
    
    <!-- Div for review information, with a form to submit a review -->
    <div class = "review_header">
        <!-- Title indicating a section for reviews -->
        <h4>Reviews</h4>
        <!-- Paragraph with text about reviews section-->
        <?php if (isset($_SESSION["user_id"]))
{
    echo "<p>Heres some information about reviews</p>";
}
else
{
    echo "<p>Please log in or create an account to submit a review</p>";
} ?>
    </div>

    <!-- Div for opening a form to submit a review-->
    <div id="review_popup">
        
        <?php if (isset($_SESSION["user_id"]))
{ ?>
        <form id="review_container" method="post" name="review_form">
            <input type="hidden" name="product_name" value="<?php echo $product_data["product_name"]; ?>">
            <!-- Input field for reviewer name and message -->
            <textarea id="form_review_message" placeholder="Review" name="review"></textarea>
            <!-- Button to submit the review or to close the pop up-->
            <button type="submit" id="form_submit">Submit</button>
        </form>
        <?php
} ?>
        <?php if (isset($_POST["review"]) && isset($_POST["product_name"]))
{
    // Retrieve form data
    $name = $_SESSION["firstname"] . " " . $_SESSION["lastname"];
    $review_message = htmlspecialchars($_POST["review"], ENT_QUOTES, "UTF-8");
    $current_date = date("Y-m-d");
    $product_name = $_POST["product_name"];

    if (empty($review_message))
    {
        echo "<p class=php_echo_message>Please enter your name and a short review</p>";
    }
    else
    {
        // Sanitize user input
        $product_name = mysqli_real_escape_string($conn, $product_name);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $review_message = filter_var($review_message, FILTER_SANITIZE_STRING);

        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO reviews (product_name, name, date, review) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $product_name, $name, $current_date, $review_message);
        if ($stmt->execute())
        {
            echo "<p class=php_echo_message>Review has been submitted</p>";
        }
        else
        {
            echo "Error: " . mysqli_error($conn);
        }

        // Sanitize user input before displaying on page
        $product_name = htmlspecialchars($product_name, ENT_QUOTES, "UTF-8");
        $name = htmlspecialchars($name, ENT_QUOTES, "UTF-8");
        $review_message = htmlspecialchars($review_message, ENT_QUOTES, "UTF-8");
    }
} ?>
    
    </div>

    <!-- Div for product reviews from customers -->
    <div class = "product_review">

        <!-- Div for reviewer information, including their name and date -->
        <?php
// prepared statement to obtain reviews
$name = $product_data["product_name"];
$stmt = $conn->prepare("SELECT * FROM reviews WHERE product_name = ?");
$stmt->bind_param("s", $name);
$name = mysqli_real_escape_string($conn, $name);
$stmt->execute();
$reviews = $stmt->get_result();

// returns message if table is empty
if (mysqli_num_rows($reviews) == 0)
{
    echo '<p class="php_echo_message">This product has no reviews.</p>';
}

while ($row = mysqli_fetch_assoc($reviews))
{ ?>

<div class="review_info">
    <p class="review_name"><b><?php echo htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8"); ?></b></p>
    <p class="review_date"><b><?php echo htmlspecialchars($row["date"], ENT_QUOTES, "UTF-8"); ?></b></p>
</div>

<p class="review_text"><?php echo htmlspecialchars($row["review"], ENT_QUOTES, "UTF-8"); ?></p>

<?php
}
?>

    </div>
<?php // Now we start PHP again to include the footer
include "inc/footer.php";
?>
