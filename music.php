<?php
// Set the variable for the page name
$page_name = "Music";

// Include the header file
include "inc/header.php";

// End the PHP so you can add HTML
?>

<!-- Page title, informing the user that they are on the music page -->
<h1 class="page_title">Music</h1>

<!-- Div containing information for each music album, with an album image, title, tracks and streaming links -->
<div class="music_row">
    <div>
        <!-- Album image references: https://www.kelseaballerini.com/music -->
        <img class="music_img" src="images\album_1.jpg" alt="Image of the album Kelsea">
    </div>

    <!-- Sub div containing album title, name, tracks and streaming links -->
    <div class="music_col">
        <p>kelsea</p>
        <!-- Ordered list to show the order of songs in the album (attempted)-->
        <ol>
            <li>overshare</li>
            <li>club</li>
            <li>homecoming queen?</li>
            <li>the other girl (with Halsey)</li>
            <li>love me like a girl</li>
        </ol>
        <!-- Icon: https://www.flaticon.com/free-icon/spotify_5968959 -->
        <a href="https://open.spotify.com/album/11sr6VmBTa9Tkzwte11LDZ"><img src="images\spotify.png" alt="Spotify icon to listen to the album 'Kelsea'" onmouseover="onSpotify(this)" onmouseout="offSpotify(this)"></a>
        <!-- Icon: "https://www.flaticon.com/free-icons/music" Music icons created by Freepik - Flaticon-->
        <a href="https://music.apple.com/us/album/kelsea/1492761620"><img src="images\applemusic.png" alt="Apple Music icon to listen to the album 'Kelsea'" onmouseover="onApple(this)" onmouseout="offApple(this)"></a>
    </div>
</div>

<div class="music_row">
    <div>
        <!-- Album image references: https://www.kelseaballerini.com/music -->
        <img class="music_img" src="images\album_2.jpg" alt="Image of the album Subject to Change">
    </div>
    <div class="music_col">
        <p>subject to change</p>
        <ol>
            <li>subject to change</li>
            <li>the little things</li>
            <li>i can't help myself</li>
            <li>if you go down (i'm goin' down too)</li>
            <li>love is a cowboy</li>
        </ol>
        <!-- Icon: "https://www.flaticon.com/free-icons/music" Music icons created by Freepik - Flaticon-->

        
                <a href = "https://open.spotify.com/album/6twfTQ122kNcHAUXjFbe8a"><img src = "images\spotify.png" alt="Spotify icon to listen to the album 'Subject to Change'" onmouseover="onSpotify(this)" onmouseout="offSpotify(this)"></a>
                <!-- Icon: "https://www.flaticon.com/free-icons/music" Music icons created by Freepik - Flaticon-->
                <a href = "https://music.apple.com/gb/album/subject-to-change/1633771855"><img src = "images\applemusic.png" alt="Apple Music icon to listen to the album 'Subject to Change'" onmouseover="onApple(this)" onmouseout="offApple(this)"></a>
            </div>

          </div>

          <div class = "music_row">

            <div>
                <!-- Album image references: https://www.kelseaballerini.com/music -->
                <img class = "music_img" src="images/album_3.jpg" alt="Image of the album Rolling up the Welcome Mat">
            </div>

            <div class = "music_col">
                <p>rolling up the welcome mat</p>
                <ol>
                    <li>mountain with a view</li>
                    <li>just married</li>
                    <li>penthouse</li>
                    <li>interlude</li>
                    <li>blindsided</li>
                </ol>
                <!-- Icon: https://www.flaticon.com/free-icon/spotify_5968959 -->
                <a href = "https://open.spotify.com/album/7qxClQvz2eSkDB7CtFfPZH"><img src = "images\spotify.png" alt="Spotify icon to listen to the album 'Rolling up the Welcome Mat'" onmouseover="onSpotify(this)" onmouseout="offSpotify(this)"></a>
                <!-- Icon: "https://www.flaticon.com/free-icons/music" Music icons created by Freepik - Flaticon-->
                <a href = "https://music.apple.com/gb/album/rolling-up-the-welcome-mat-ep/1668471788"><img src = "images\applemusic.png" alt="Apple Music icon to listen to the album 'Rolling up the Welcome Mat'" onmouseover="onApple(this)" onmouseout="offApple(this)"></a>
            </div>

          </div>
<?php // Now we start PHP again to include the footer
include "inc/footer.php";
?>
