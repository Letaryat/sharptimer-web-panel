# sharptimer-web-panel
Web panel for SharpTimer - CounterStrikeSharp plugin. [LIVE DEMO](https://movement.pierdolnik.eu/)<br />
[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/H2H8TK0L9)
![preview](https://i.imgur.com/4cnkHz6.png)

## Requirements
- PHP 7.4+,
- [SharpTimer by deafps](https://github.com/DEAFPS/SharpTimer) with mysql enabled,

## Instalation
- Throw files into your hosting,
- Configure config.php file with database credentials,
```
$host = "";
$user = "";
$pass = "";
$db = "";
```
- Configure config.php to your liking,
- Configure admins.php by adding your steamID64,
- Remove (they are pointless for now, only for testing) all unnecessary modules,

## Additional informations:
- You can change color palette in views/assets/css/colors.css file,
```
:root{
    --background: #0C0D13;
    --secondary: #101219;
    --striperow:#101219;
    --stripe-hover:#6389e82f;
    --hover: #6389E8;
    --border-col:#0F111B;
    --fontcolor: #e3e3e3;
    --borderradius: 10px;
}
```
- You can turn on / off server list,
- You can add / remove servers in $serverq variable:
```
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
    ),
    3 => array(
        'host' => '169.150.246.129',
        'port' => '26440',
        'fakename' => '',
        'fakeip' => ''
    ),
    4 => array(
        'host' => '135.148.164.30',
        'port' => '27015',
        'fakename' => '',
        'fakeip' => ''
    )
);
```
.
