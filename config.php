<?php
// Database connection:
$host = "";
$user = "";
$pass = "";
$db = "";
$conn = new mysqli($host, $user, $pass, $db);
if(!$conn){
    die("connection failed" . mysqli_connect_error());
}

// PAGE CONFIG:
#Page title:
$pagetitle = "SharpTimer Web Panel";

#Hyperlinks for navigation | If you don't need it you can just delete all the contents or variable.
$links = '
<li><a href="https://discord.com/invite/Rzf7fCzpnw"><i class="fa-brands fa-discord"></i></a></li>
<li><a href="https://steamcommunity.com/groups/pierdolnikeu"><i class="fa-brands fa-steam"></i></a></li>
';

#Default map for leaderboard which should load when joining a website
$defaultmap = "surf_ace";

// Map sections => true (on) or false (off)
#It's creates a map sections for each mode (kz, surf, bunnyhop) in map list. If it's turned off there won't be any sections.
#It works by looking for a maps that starts with kz_, surf_, bh_ prefix,
#so if map doesn't have it before its name it's gonna be showed in uncategorized category at the end of maplist
$mapdivision = true; 

#Which tab with map should be opened as a default - Only works if $mapdivision = true
#(can be surf, bh, kz, other)
$tabopened = "other";

// How many records should be displayed in leaderboard:
$limit = 100;

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
$serverlist = true;

#Server list:
#Fakename can be omitted or empty if you don't want it.
#IP has to be numeric not domain. If you prefer to display domain than real ip use 'fakeip'.
$serverq = array(
    0 => array(
        'type' => 'csgo',
        'host' => '51.83.172.143:23580',
        'fakename' => '',
        'fakeip' => ''
    ),
    1 => array(
        'type' => 'csgo',
        'host' => '51.83.172.143:23520',
        'fakename' => '',
        'fakeip' => ''
    ),
    2 => array(
        'type' => 'csgo',
        'host' => '127.0.0.1:27015',
        'fakename' => 'Dead example',
        'fakeip' => ''
    )
);


?>