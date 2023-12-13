# sharptimer-web-panel
Web panel for SharpTimer - CounterStrikeSharp plugin. [LIVE DEMO](https://movement.pierdolnik.eu/)
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

## Additional informations:
- You can change color palette in style.css file,
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
```

