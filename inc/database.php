<?php
// Database credentials
$db_host = "localhost"; 
$db_user = "mt21942"; 
$db_pass = "bqjy4NKFatHDt"; 
$db_name = "ce154_" . $db_user; 

// Function connecting to the database
function connect(){
    global $db_host, $db_user, $db_pass, $db_name, $conn;
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Checking if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $conn;
}

// Checking if the cart has already been truncated in this session
if (!isset($_SESSION['cart_truncated']) && basename($_SERVER['PHP_SELF']) === 'index.php') {
    // Truncate the guest_cart table at the start of each new session on the index.php page
    $conn = connect();
    $sql = "TRUNCATE TABLE guest_cart";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
    } else {
        // Display an error message if the query failed
        echo "Error truncating guest_cart table: " . mysqli_error($conn) . "<br>";
    }

    // Sets the flag, indicate that the cart has been truncated
    $_SESSION['cart_truncated'] = true;
}

// Sets the current page to the current PHP script filename
$_SESSION['current_page'] = basename($_SERVER['PHP_SELF']);

// Function to get all products from the database, with prepared statementr
function getProducts($conn) {
    $sql = "SELECT * FROM products";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return array("result" => $result, "row" => $row);
}
?>

