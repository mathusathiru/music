<!DOCTYPE html>
<html lang="en"> <!-- Defining language of webpage -->

<head>
    <meta charset="UTF-8"> <!-- 8 bit UTF for space efficiency -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Optimising the website for different screen widths-->

    <title>
        <?php
            if ($page_name == "Home") {
                echo 'Home';
            } elseif ($page_name == "Shop") {
                echo "Store";
            } elseif ($page_name == "Music") {
                echo "Music";
            } elseif ($page_name == "About") {
                echo "About";
            } elseif ($page_name == "Contact") {
                echo "Contact";
            } else {
                echo "Basket";
            }
        ?>
    </title> <!-- Page title for tab -->
    <link rel="stylesheet" href="css\index.css"> <!-- Stylesheet to index.css-->
    <script src = "inc/functions.js"></script> <!-- JavaScript for image hover effects -->

    <!-- Importing fonts Nandaka Western (headings), Cabin (main text) and Cabin Condensed (smaller fonts)-->
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/nandaka-western">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Condensed&display=swap" rel="stylesheet">   

</head>

<body>

    <!-- HEADER -->

    <!-- Thin paragraph banner at the top of the website, ideal for promoting sales or new music -->
    <p id="headline">
        <?php
        $date = strtotime("May 19, 2023 9:00 PM");
        $remaining = $date - time();

        $days_remaining = floor($remaining / 86400);
        echo "days until tour: $days_remaining";
        ?>
    </p>
    
    <!-- Div with sub divs for the main header, including navigation, cart, social media links and site logo-->
    <header>

        <!-- Div for website header logo -->
        <div class="header_logo">
            <!-- Nandaka Western text edited with cowboy image: "https://www.flaticon.com/free-icons/cowboy" Cowboy icons created by Smashicons - Flaticon -->
            <img id="logo_img" src="images\logo.png" alt="Kelsea Ballerini Logo: her name with an icon of a cowboy hat">           
        </div>

        <!-- Centrally placed div for navigation and social medias -->
        <div class="header_centre">

            <!-- Div for holding navigation to access main website pages-->
            <div class="navigation">

                <ul> <!-- Unordered list for holding navigation menu items -->
                    <li class="nav_item">
                        <?php
                            if ($page_name == "Home") {
                                echo '<a href="index.php" style="color: #A65134;">Home</a>';
                            } else {
                                echo '<a href="index.php">Home</a>';
                            }
                        ?>
                    </li>

                    <li class="nav_item">
                        <?php
                            if ($page_name == "Shop") {
                                echo '<a href="shop.php" style="color: #A65134;">Store</a>';
                            } else {
                                echo '<a href="shop.php">Store</a>';
                            }
                        ?>
                    </li>

                    <li class="nav_item">
                        <?php
                            if ($page_name == "Music") {
                                echo '<a href="music.php" style="color: #A65134;">Music</a>';
                            } else {
                                echo '<a href="music.php">Music</a>';
                            }
                        ?>
                    </li>

                    <li class="nav_item">
                        <?php
                            if ($page_name == "About") {
                                echo '<a href="about.php" style="color: #A65134;">About</a>';
                            } else {
                                echo '<a href="about.php">About</a>';
                            }
                        ?>
                    </li>

                    <li class="nav_item">
                        <?php
                            if ($page_name == "Contact") {
                                echo '<a href="contact.php" style="color: #A65134;">Contact</a>';
                            } else {
                                echo '<a href="contact.php">Contact</a>';
                            }
                        ?>
                    </li> <!-- Link to contact page-->
                </ul>
            </div>
            
            <!-- Div for holding social media and music streaming accounts of the artist-->
            <div class="header_socials">
                <ul>
                    <!-- Icon: "https://www.flaticon.com/free-icons/facebook" Facebook icons created by Freepik - Flaticon -->
                    <li class = "nav_item"><a href = "https://www.facebook.com/kelseaballerini/?locale=en_GB"><img src="images\facebook.png" alt="FaceBook logo for Kelsea Ballerini" onmouseover="onFaceBook(this)" onmouseout="offFaceBook(this)"></a></li>
                    <!-- Icon: "https://www.flaticon.com/free-icons/twitter" Twitter icons created by Dave Gandy - Flaticon -->
                    <li class = "nav_item"><a href = "https://twitter.com/KelseaBallerini?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><img src="images\twitter.png" alt = "Twitter logo for Kelsea Ballerini" onmouseover="onTwitter(this)" onmouseout="offTwitter(this)"></a></li>
                    <!-- Icon: "https://www.flaticon.com/free-icons/instagram" title="instagram icons">Instagram icons created by Freepik - Flaticon-->
                    <li class = "nav_item"><a href = "https://www.instagram.com/kelseaballerini/?hl=en"><img src="images\instagram.png" alt = "Instagram logo for Kelsea Ballerini" onmouseover="onInstagram(this)" onmouseout="offInstagram(this)"></a></li>
                    <!-- Icon: "https://www.flaticon.com/free-icons/tiktok" Tiktok icons created by Freepik - Flaticon -->
                    <li class = "nav_item"><a href = "https://www.tiktok.com/@kelseaballerini?lang=en"><img src="images\tiktok.png" alt = "TikTok logo for Kelsea Ballerini" onmouseover="onTikTok(this)" onmouseout="offTikTok(this)"></a></li> 
                    <!-- Icon: "https://www.flaticon.com/free-icons/spotify" Spotify icons created by Freepik - Flaticon -->
                    <li class = "nav_item"><a href = "https://open.spotify.com/artist/3RqBeV12Tt7A8xH3zBDDUF"><img src="images\spotify.png" alt="Spotify logo for Kelsea Ballerini" onmouseover="onSpotify(this)" onmouseout="offSpotify(this)"></a></li>
                    <!--  "https://www.flaticon.com/free-icons/music" Music icons created by Freepik - Flaticon-->
                    <li class = "nav_item"><a href = "https://music.apple.com/us/artist/kelsea-ballerini/382270241"><img src="images\applemusic.png" alt="Apple Music logo for Kelsea Ballerini" onmouseover="onApple(this)" onmouseout="offApple(this)"></a></li>
                </ul>
            </div>

        </div>

        <!-- This is the container for the user icon -->
        <div class="header_img">
            <?php
            // Set the default image source, alternate text and hyperlink for the user icon
            $userImgSrc = 'images/user.png';
            $userImgAlt = 'Black outline user icon';
            $userImgHref = 'login.php';

            // If the current page is the login page, update the image source and hyperlink for the user icon
            if (basename($_SERVER['PHP_SELF']) == 'login.php') {
                $userImgSrc = 'images/user_hover.png';
                $userImgHref = '#';
            }
            ?>
            <!-- Display the user icon with the updated source and hyperlink -->
            <a href="<?php echo $userImgHref; ?>">
                <img id="user_img" src="<?php echo $userImgSrc; ?>" alt="<?php echo $userImgAlt; ?>">
            </a>

            <!-- If the current page is not the login page, add a hover effect to the user icon -->
            <style>
                <?php if (basename($_SERVER['PHP_SELF']) != 'login.php') { ?>
                    #user_img:hover {
                        content: url('images/user_hover.png');
                    }
                <?php } ?>
            </style>
        </div>

        <!-- This is the container for the shopping cart icon -->
        <div class="header_img">
            <?php
            // Set the default image source, alternate text and hyperlink for the shopping cart icon
            $cartImgSrc = 'images/cart.png';
            $cartImgAlt = 'Black outline shopping trolley icon';
            $cartImgHref = 'basket.php';

            // If the current page is the shopping cart page, update the image source and hyperlink for the shopping cart icon
            if (basename($_SERVER['PHP_SELF']) == 'basket.php') {
                $cartImgSrc = 'images/cart_hover.png';
                $cartImgHref = '#';
            }
            ?>
            <!-- Display the shopping cart icon with the updated source and hyperlink -->
            <a href="<?php echo $cartImgHref; ?>">
                <img id="cart_img" src="<?php echo $cartImgSrc; ?>" alt="<?php echo $cartImgAlt; ?>">
            </a>

            <!-- If the current page is not the shopping cart page, add a hover effect to the shopping cart icon -->
            <style>
                <?php if (basename($_SERVER['PHP_SELF']) != 'basket.php') { ?>
                    #cart_img:hover {
                        content: url('images/cart_hover.png');
                    }
                <?php } ?>
            </style>
        </div>
    </header>