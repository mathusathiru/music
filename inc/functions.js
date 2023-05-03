// Hover on and off Facebook, changes the black and cream logo to a coloured version 

function onFaceBook(e){
    e.src = "images/facebook_hover.png"
}
function offFaceBook(e){
    e.src = "images/facebook.png"
}

// Hover on and off Twitter, changes the black and cream logo to a coloured version 

function onTwitter(e){
    e.src = "images/twitter_hover.png"
}
function offTwitter(e){
    e.src = "images/twitter.png"
}

// Hover on and off Instagram, changes the black and cream logo to a coloured version 

function onInstagram(e){
    e.src = "images/instagram_hover.png"
}
function offInstagram(e){
    e.src = "images/instagram.png"
}

// Hover on and off TikTok, changes the black and cream logo to a coloured version 

function onTikTok(e){
    e.src = "images/tiktok_hover.png"
}
function offTikTok(e){
    e.src = "images/tiktok.png"
}

// Hover on and off Spotify, changes the black and white cream logo to a coloured version 

function onSpotify(e){
    e.src = "images/spotify_hover.png"
}
function offSpotify(e){
    e.src = "images/spotify.png"
}

// Hover on and off Apple Music, changes the black and cream logo to a coloured version 

function onApple(e){
    e.src = "images/music_hover.png"
}
function offApple(e){
    e.src = "images/applemusic.png"
}

// Hover on and off cart, changes the black outline image to a coloured version 

var cartImgHover = document.getElementById("cart_img_hover");

if (cartImgHover) {
    cartImgHover.addEventListener("mouseover", function() {
        onCart(cartImgHover);
    });
    cartImgHover.addEventListener("mouseout", function() {
        offCart(cartImgHover);
    });
}
