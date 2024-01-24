    <main style="flex-flow:column;">
<?php
#guwno zamiania inputu na ticki
#$number = "01:20:000";
$number = $_POST['czas'];
$minutestosec = intval($number[0].$number[1]) * 60;
$seconds = intval($number[3].$number[4]);
$milisecondstosec = intval($number[6].$number[7].$number[8]);

$dodac = $milisecondstosec + $seconds + $minutestosec;
function secondstotick($sec){
    $tick = $sec * 64;
    echo round($tick) . "<br/>";
}
secondstotick($dodac);


#echo $formatted_number * 64;
        ?>
    </main>
</html>