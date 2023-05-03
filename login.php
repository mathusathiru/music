<?php

// Include the library file that contains the database connection and custom functions
include "inc/database.php";

// Connect to the database
connect();

// Start the user session
session_start();

// Get the SESSION superglobal variable
$userkey = $_SESSION["user_id"];
$register_error = "";
$login_error = "";

// If we're logging out then clear the session the cookie
if ($_REQUEST["action"] == "logout") {
    session_destroy(); // Get rid of the session
    header("Location: login.php"); // Redirect to the index page
    exit(); // Stop doing anything else on this page
}

// If we're deleting a user and the user is logged in, then delete the user from the database
if (isset($_POST["delete_user"]) && isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];

    // Prepare the SQL statement to delete the user
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    // If the user was successfully deleted, destroy the session and redirect to the login page
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        session_destroy();
        echo '<script>window.location.href = "login.php";</script>';
        mysqli_stmt_close($stmt);
    }
}

// Check if user is not logged in
if ($userkey == "") {
    // Check if form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form is for user registration
        if ($_POST["form_name"] == "register") {
            // Check if all required fields are filled out
            if ($_POST["username_reg"] != "" && $_POST["password_reg"] != "" && $_POST["email_reg"] != "" && $_POST["firstname_reg"] != "" &&$_POST["lastname_reg"] != "") {
                // User is trying to register
                // Store form data in variables
                $username_reg = $_POST["username_reg"];
                $password_reg = md5($_POST["password_reg"]);
                $email_reg = $_POST["email_reg"];
                $firstname_reg = $_POST["firstname_reg"];
                $lastname_reg = $_POST["lastname_reg"];

                // Check if username already exists in database
                $query = "SELECT username FROM users WHERE username=?";
                $stmt = mysqli_prepare($conn, $query);
                mysqli_stmt_bind_param($stmt, "s", $username_reg);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // If username already exists, set error message
                if (mysqli_num_rows($result) > 0) {
                    $register_error = "Username already exists";
                }

				// If the password is too short, set the login_error variable to indicate an invalid password length
				elseif (strlen($_POST["password_reg"]) < 8) { 
					$register_error = "Invalid password length";
				}
				
                // If username does not exist, insert new user into database
                else {
                    $sql = "INSERT INTO users (username, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param( $stmt, "sssss", $username_reg, $password_reg, $email_reg, $firstname_reg, $lastname_reg);
                    mysqli_stmt_execute($stmt);
                }

                // Get the ID of the newly registered user from the database
                $user_id_new = mysqli_insert_id($conn);

                // Set the session variables for the new user
                $_SESSION["user_id"] = $user_id_new;
                $_SESSION["username"] = $username_reg;
                $_SESSION["email"] = $email_reg;
                $_SESSION["firstname"] = $firstname_reg;
                $_SESSION["lastname"] = $lastname_reg;

                // Set the user key to the new user ID
                $userkey = $user_id_new;

                // Set the user key to the user ID stored in the session
                $userkey = $_SESSION["user_id"];
            } elseif ( empty($_POST["username_reg"]) || empty($_POST["password_reg"]) || empty($_POST["email_reg"]) || empty($_POST["firstname_reg"]) ||empty($_POST["lastname_reg"])) {
                // If any of the required fields are empty, set the $register_error variable to a message asking the user to fill out all fields
                $register_error = "Please fill out all fields.";
            }
        } elseif ($_POST["form_name"] == "login") {
            // Check if the username and password fields are not empty
            if ($_POST["username"] != "" && $_POST["password"] != "") {
                // Store the values from the username and password fields in variables
                $username = $_POST["username"];
                $password = $_POST["password"];

                // Prepare a SQL statement to retrieve the user's information based on their username
                $sql =
                    "SELECT user_id, email, firstname, lastname, password FROM users WHERE username = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);

                // Get the result of the SQL query
                $result = mysqli_stmt_get_result($stmt);

                // If no rows are returned, set the login_error variable to indicate that the user was not found
                if (mysqli_num_rows($result) == 0) {
                    $login_error = "User not found";
                }

                // If the user is found and the password is valid, set the session variables to store the user's information
                else {
                    $password_match = false;

                    while ($row = mysqli_fetch_assoc($result)) {
                        // Check if the password entered by the user matches the password in the database (after hashing)
                        if ($row["password"] == md5($password)) {
                            // Set the session variables to store the user's information
                            $_SESSION["username"] = $username;
                            $_SESSION["user_id"] = $row["user_id"];
                            $_SESSION["email"] = $row["email"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row["lastname"];

                            // Set the password_match variable to true to indicate a successful login
                            $password_match = true;
                            break;
                        }
                    }

                    // If the password did not match, set the login_error variable to indicate an invalid password
                    if ($password_match == false) {
                        $login_error = "Invalid password.";
                    }

                    // Check if the user is already logged in
                    $userkey = "";
                    if (isset($_SESSION["user_id"])) {
                        // If so, store their user_id in the $userkey variable
                        $userkey = $_SESSION["user_id"];
                    }
                }
				
            } elseif (empty($_POST["username"])) {
				$login_error = "Please enter a valid username";
			}
			
			elseif (empty($_POST["password"])) {
				$login_error = "Please enter a valid password";
			}
        }
		
    }
}

// Add the HTML header
include "inc/header.php";

if ($userkey == "") {
    // Check if the user is not logged in

    // Display the "ACCOUNT" page title
    echo "<h1 class = 'page_title'>ACCOUNT</h1>";
    // Display the registration form
    ?>
	<div id = "user_forms">
		<form class = "register_form" action="#" method="post">
			<div id="register">
				<input type="hidden" name="form_name" value="register">
				<p class = "form_title">REGISTER</p>
				<p class = "login_prompt">Register here if you are a new user</p>
				<label>Username:</label><br>
				<input type="text" class="login_input" name="username_reg" value=""><br>
				<label>Password:</label><br>
				<input type="password" class="login_input" name="password_reg" value=""><br>
				<label>Email:</label><br>
				<input type="email" class="login_input" name="email_reg" value=""><br>
				<label>First Name:</label><br>
				<input type="text" class="login_input" name="firstname_reg" value=""><br>
				<label>Last Name:</label><br>
				<input type="text" class="login_input" name="lastname_reg" value=""><br>
			</div>
			<input class = "input_details" type="submit" value="Register">
			<p  class = "account_error"><?php echo $register_error; ?></p>
		</form>

		<form id = "login_form" action="#" method="post">
			<div id="login">
				<input type="hidden" name="form_name" value="login">
				<p class = "form_title">LOGIN</p>
				<p class = "login_prompt">Login here if you are a returning user</p>
				<label>Username:</label><br>
				<input type="text" class="login_input" name="username" value=""><br>
				<label >Password:</label><br>
				<input type="password" class="login_input" name="password" value=""><br>	
			</div>
			<input class = "input_details" type="submit" value="Login">
			<p class = "account_error"><?php echo $login_error; ?></p>	
		</form>
	</div>
<?php
}

// End of the check for logged in user
// If user is logged in, show welcome message and navigation options
else {
    echo "<h1 class = 'page_title'>WELCOME</h1>";

    echo "<div id='authorised_user'>";
    echo "<p id = 'welcome_message'>" .
        $_SESSION["firstname"] .
        ", you are now logged in.</p><br/>";

    // Add navigation options for the user
    echo "<a class ='input_details' href='shop.php'>Store</a>";
    echo "<a class ='input_details' href='basket.php'>Basket</a>";

    // Add a logout button to log the user out of their account
    echo "<form action='login.php' method='post'>";
    echo "<input type='hidden' name='action' value='logout'>";
    echo "<button type='submit' class = 'input_details'>Logout</button>";
    echo "</form>";

    // Add a delete account button for the user to delete their account
    echo "<form method='post'>";
    echo "<button class ='input_details' type='submit' name='delete_user'>Delete Account</button>";
    echo "</form>";

    echo "</div>";
}

// Close the connection to the database
mysqli_close($conn);

// Include the HTML footer
include "inc/footer.php";

?>