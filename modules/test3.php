    <main style="flex-flow:column;">
        tick: <br/>
        <?php 
        $tick = "2762";
        function ticktoseconds($tick){
            $number = $tick / 64;
            return number_format((float)$number,3, ".", "");
        }
        echo ticktoseconds($tick);
        ?>
        <br/>
        <p style="margin-top:20px;"class="wynik">test</p>
        <input class="number" pattern="^([0-5]\d):([0-5]\d):([0-5]\d)$" type="number">


        <div>
            
        </div>


        <script>
            let input = document.querySelector('.number');
            let wynik = document.querySelector('.wynik');
            input.addEventListener('input', function(){
                let value = input.value / 64;

                wynik.innerHTML = value.toFixed(3);
            });
        </script>
    </main>
</html>