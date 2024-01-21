    <main>
    <?php 
    #get filenames from specific folder
    foreach(glob('./controllers/*.*') as $filename){
        echo $filename;
    }
    ?>
    </main>
</html>