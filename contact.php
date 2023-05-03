<?php
session_start();
// Set the variable for the page name
$page_name = "Contact";
// Import external files 
include('inc/header.php');
include('inc/database.php');
// Connect to database 
connect();

?>

    <!-- Page title, informing the user that they are on the contact page -->
    <h1 class = "page_title">Contact</h1>

    <!-- Div holding contact information, including a map, email and phone number, and a review form -->
    <div id = "contact">
        <div id = "contact_col1">
            <!-- h2 heading and p paragraph text on map information, to locate the agency -->
            <h2 class = "contact_heading">meet us at our office</h2>
            <p>Chat to us at the Rising Stars Agency Office, if you wish to work with Kelsea Ballerini. 
                <br> We are located in London, and you can find our address in the map below.
                <br> Book an appointment by calling or emailing us so we can find a slot for you.</p>

            <!-- Source: Google Maps- https://www.google.com/maps/place/Nashville,+TN,+USA/@36.186314,-86.9253591,11z/data=!4m6!3m5!1s0x8864ec3213eb903d:0x7d3fb9d0a1e9daa0!8m2!3d36.1626638!4d-86.7816016!16zL20vMDVqYm4 -->
            <!-- Map with a pin to locate the agency -->
            <iframe id = "map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d412175.2897404753!2d-86.92673341392711!3d36.18797666753411!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8864ec3213eb903d%3A0x7d3fb9d0a1e9daa0!2sNashville%2C%20TN%2C%20USA!5e0!3m2!1sen!2suk!4v1677113791974!5m2!1sen!2suk"
            width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            
            <h2 class = "contact_heading">Fanmail</h2>

            <!-- Custom inputa depending on if the user is logged in or not --> 
            <?php 
            if (isset($_SESSION['user_id'])) {
                ?>
                    <form method="post">
                        <!-- Text area field for a customer message, has a scrollbar for user to scroll up and down of their message -->
                        <textarea id = "contact_message" placeholder="Message" name = "message"></textarea>
                        <!-- Button to submit form information -->
                        <button type = "submit" id = "form_button" name="contact_user_form">Submit</button>
                    </form>
                <?php

                    // Check if the form was submitted
if (isset($_POST['contact_user_form'])) {

    // Retrieve user's name, email, and message from session and form
    $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $message = $_POST["message"];

    // Check if message field is empty
    if(empty($message)){
        // Display error message if message field is empty
        echo "<p class=php_echo_message>Please enter a message</p>";
    } else {
        // Prepare SQL statement to insert data into database
        $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");

        // Bind values for name, email, and message to prepared statement
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute prepared statement to insert data into database
        $stmt->execute();

        // Display success message to user
        echo "<p class=php_echo_message>Your message has been submitted and we hope to reply to you soon</p>";
    }
}
                }
                else {
                ?>
<form method="post">
    <!-- Input fields for name and email -->
    <input id="contact_name" type="text" placeholder="Name" name="name"><br>
    <input id="contact_email" type="email" placeholder="Email" name="email"><br>
    <!-- Text area field for message with a scroll bar -->
    <textarea id="contact_message" placeholder="Message" name="message"></textarea>

    <!-- Button to submit the form -->
    <button type="submit" id="form_button" name="contact_guest_form">Submit</button>
</form>

<?php
// Check if the form was submitted
if (isset($_POST['contact_guest_form'])) {

    // Retrieve the name, email, and message from the form
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Check if any of the required fields are empty
    if (empty($name) || empty($email) || empty($message)) {
        // Display an error message if any of the required fields are empty
        echo "<p class=php_echo_message>Please enter your name, email address, and a message</p>";
    } else {
        // Insert the form data into the 'contact' table in the database
        $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
        mysqli_query($conn, $sql);

        // Display a success message to the user
        echo "<p class=php_echo_message>Your message has been submitted and we hope to reply to you soon</p>";
    }
}
                }
            ?>
        </div>

        <!-- Sub div including information to contact the artist, ideally for other professionals -->
        <div id = "contact_col2">
            <!-- h2 heading and p paragraph to indicate describe the contact methods to the visitor, and who
                    they would best apply to -->
            <h2 class = "contact_heading">get in touch</h2>
            <p>Feel free to drop us an email or phone us at Rising Stars to book a meeting, or for any enquries. 
                <br>
                Our calls are managed weekdays, nine till five. 
            </p>
            
            <!-- Icons with text, containing the email address and phone number of the agency for contact -->
            <div class = "contact_icon">
                <!-- Icon: "https://www.flaticon.com/free-icons/email" Email icons created by Freepik - Flaticon -->
                <img src = "images\email.png" alt="Image of a transparent envelope icon with a black outline">
                <p class = "icon_text">risingstarsagency@outlook.com</p>
            </div>

            <div class = "contact_icon">
                <!-- Icon: "https://www.flaticon.com/free-icons/phone" Phone icons created by Gregor Cresnar - Flaticon-->
                <img src = "images\telephone.png" alt="Image of a transparent telephone icon with a black outline">
                <p class = "icon_text">07846246329</p>          
            </div> 
        </div>

    </div>
<?php
// Start PHP again to include the footer
include('inc/footer.php');
?>
