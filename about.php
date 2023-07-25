<?php

$page_name = "About";

// including page header
include "inc/header.php";

?>
    
        <!-- Page title, informing the user that they are on the about page -->
        <h1 class = "page_title">ABOUT</h1>
        
        <!-- Div containing image and information on the artist, arranged in a row, with the image on the left and 
                text on the right -->
        <div class = "about_row">

            <!-- Div containing image of the artist-->
            <div class = "about_col">
                <!-- headshot reference: https://www.pinterest.co.uk/pin/kelsea-ballerini-face--516295544765580905/-->
                <img src="images\headshot.png" alt="Headshot of Kelsea Ballerini">
            </div>

            <!-- Div with p paragraph with information about the music artist -->
            <!-- Source: https://en.wikipedia.org/wiki/Kelsea_Ballerini-->
            <div class = "about_col">
                <p>Kelsea Nicole Ballerini (born September 12, 1993) is an American country pop singer and songwriter. She began songwriting 
                    as a child and signed a contract with Black River Entertainment in 2014, releasing her debut studio album the following 
                    year, The First Time. Her second studio album, Unapologetically, followed in 2017.
                    <br>
                    <br>
                    Ballerini (an only child) was raised in Knoxville, Tennessee by her father, Ed and her mother, Carla. Ballerini 
                    started taking dance lessons at Premiere Dance Studio in Seymour, Tennessee when she was three and quit ten years later. 
                    She also sang in the church and school choirs. She wrote her first song at 12 for her mother and moved to 
                    Nashville, Tennessee, three years later. She attended Central High School in Knoxville, Tennessee; Centennial High 
                    School in Franklin, Tennessee; and then Lipscomb University for two years until she pursued a musical career.</p>
            </div>
        </div>

        <!-- Div containing image and information on the artist, arranged in a row, with the image on the right and 
        text on the left -->
        <div class = "about_row">
            <!-- Different div names to switch the image and text arrangement -->
            <div class = "about_col_switch">
                <!-- p paragraph with information about the music artist -->
                <!-- Source: https://www.kelseaballerini.com/about-->
                <p> She has logged five back-to-back Top 10 entries on the Billboard Top Country Albums chart, including the 
                    platinum-selling The First Time [2015], gold-selling Unapologetically [2017], gold-selling kelsea [2020], ballerini 
                    [2020], and SUBJECT TO CHANGE [2022]. With seven #1 singles and 31 certifications from the RIAA to date, her catalog 
                    boasts a string of essential smashes.
                    <br>
                    <br>
                    Among dozens of accolades thus far, she has garnered three GRAMMY® Award nominations, won two ACM Awards, picked 
                    up two CMA Awards, took home the iHeartRadio Music Awards honor for “Best New Artist,” and received multiple career 
                    nominations from the ACM Awards, American Music Awards, CMA Awards, CMT Awards, and People’s Choice Awards.
                    </p>
            </div>
            
            <div class = "about_col_switch">
                <!-- performing reference: https://tasteofcountry.com/kelsea-ballerini-hole-in-the-bottle-2020-acm-awards/ -->
                <img src="images\performing.jpg" alt="Image of Kelsea Ballerini in a red dress performing for a live audience">
            </div>
        </div>

        <!-- Div containing image and information on the artist, arranged in a row, with the image on the left and 
        text on the right -->
        <div class = "about_row">

            <div class = "about_col">
                <!-- recording reference: https://www.etonline.com/news/204678_kelsea_ballerini_on_voicing_her_first_animated_character_and_her_2017_grammys_red_carpet_vision -->
                <img src="images\recording.jpg" alt = "Image of Kelsea Ballerini recording in a studio">
            </div>

            <div class = "about_col">
                <p>Expanding her sphere of influence, she authored her first original book of poetry Feel Your Way Through, and Dolly Parton 
                    tapped her to star in the audiobook of Run, Rose, Run. In April 2022, Kelsea co-hosted the CMT Awards on CBS nationwide. 
                    <br>
                    <br>
                    On top of this, the multi-platinum country superstar was named the newest face of COVERGIRL. She has joined the brand in 
                    a multi-year partnership and is set to launch a cosmetic collaboration with the brand in 2023. She was inducted as a 
                    member of the famed Grand Ole Opry in 2019. At the time, she notably became the Opry’s youngest member in its nearly 
                    100-year history since being founded in 1925.</p>
            </div>
      </div>
<?php 
// include the footer by restarting php
include "inc/footer.php";
?>
