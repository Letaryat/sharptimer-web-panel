    <main style="flex-flow:column;">
    <form action="prawidlowedwa" method="post">
    <input class="testek" type="text" minlength="9" maxlength="9" placeholder="00:00:000" name="czas" required>
    <input type="submit">
    </form>

<?php
#guwno zamiania inputu na ticki
#$number = "1234567890";
$number = "0043156";
$formatted_number = "$number[0]$number[1]:$number[2]$number[3]:$number[4]$number[5]$number[6]";
$minutestosec = intval($number[0].$number[1]) * 60;
$seconds = intval($number[2].$number[3]);
$milisecondstosec = intval($number[4].$number[5].$number[6]) / 1000;
$dodac = $milisecondstosec + $seconds + $minutestosec;
echo "dodac: " . $dodac . "<br/>";
function secondstotick($sec){
    $tick = $sec * 64;
    echo round($tick) . "<br/>";
}

secondstotick($dodac);
var_dump($milisecondstosec, $seconds, $minutestosec);
#echo $formatted_number * 64;
        ?>

<script>
    $(document).ready(function(){
    $('.testek').mask('00:00:000');    
        
    })
</script>

<!-- 
<script>
    $('.testek').keyup(function() {
  var foo = $(this).val().split(":").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{0,2}', 'g')).join(":");
  }
  $(this).val(foo);
});
</script>
-->
    </main>
</html>