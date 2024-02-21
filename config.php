<?php
// Database connection:
$host = "localhost";
$user = "root";
$pass = "";
$db = "db_test";
$conn = new mysqli($host, $user, $pass, $db);
if(!$conn){
    die("connection failed" . mysqli_connect_error());
}

// PAGE CONFIG:
#Page title:
$pagetitle = "SharpTimer Web Panel";

#Default map for leaderboard which should load when joining a website || Now it loads global points by default
$defaultmap = "surf_ace";

#Steam Web Api - It is needed to show player avatars on their profiles. It can be empty, then it will show default steam avatar.
$steamapikey = $steamauth['apikey'] = '';

// Map sections => true (on) or false (off)
#It's creates a map sections for each mode (kz, surf, bunnyhop) in map list. If it's turned off there won't be any sections.
#It works by looking for a maps that starts with kz_, surf_, bh_ prefix,
#so if map doesn't have it before its name it's gonna be showed in uncategorized category at the end of maplist
$mapdivision = true; 

#Which tab with map should be opened as a default - Only works if $mapdivision = true
#(can be surf, bh, kz, other)
$tabopened = "surf";

// How many records should be displayed in leaderboard:
//$limit = 100;

#Footer description:
$footerdesc = '
Litwo! Ojczyzno moja! ty jesteś jak zdrowie:
Ile cię trzeba cenić, ten tylko się dowie,
Kto cię stracił. Dziś piękność twą w całej ozdobie
Widzę i opisuję, bo tęsknię po tobie.
Panno święta, co Jasnej bronisz Częstochowy
I w Ostrej świecisz Bramie! Ty, co gród zamkowy
Nowogródzki ochraniasz z jego wiernym ludem!
Jak mnie dziecko do zdrowia powróciłaś cudem
(Gdy od płaczącej matki, pod Twoją opiekę
Ofiarowany, martwą podniosłem powiekę;
I zaraz mogłem pieszo, do Twych świątyń progu
Iść za wrócone życie podziękować Bogu),
';

// GameQ integration - Creates poorish serverlist at index page.
#GameQ (serverlist) true (on) or false (off)
$serverlist = false;

#Server list:
#Fakename can be omitted or empty if you don't want it.
#IP has to be numeric not domain. If you prefer to display domain than real ip use 'fakeip'.
$serverq = array(
    0 => array(
        'host' => '51.83.172.143',
        'port' => '23580',
        'fakename' => '',
        'fakeip' => ''
    ),
    1 => array(
        'host' => '51.83.172.143',
        'port' => '23520',
        'fakename' => '',
        'fakeip' => ''
    ),
    2 => array(
        'host' => '127.0.0.1',
        'port' => '27015',
        'fakename' => 'Dead example',
        'fakeip' => ''
    )
);

#Donate array for a shelf => If empty shelf won't appear.
$donatearray = array(
    0 => array(
        'url' => 'https://ko-fi.com/letaryat',
        'icon' => '<i class="fa-solid fa-mug-hot"></i>',
        'title' => 'Donate me via Ko-FI'
    ),
    1 => array(
        'url' => 'https://ko-fi.com/letaryat',
        'icon' => '<i class="fa-solid fa-heart"></i>',
        'title' => 'Another Example'
    )
);


?>