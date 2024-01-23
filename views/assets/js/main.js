        //scroll down:
        window.onscroll = function(){BoxShadows()};
        function BoxShadows(){
            let leaderboardinfo = document.querySelector(".leaderboard").getBoundingClientRect();
            if(leaderboardinfo.top < -1){
                document.querySelector(".info").classList.add("boxshadows");
            }else{
                document.querySelector(".info").classList.remove("boxshadows");
            }
        }
        //Toggle mobile menu
        var mappeno = document.querySelector(".mappeno");
        function toggleMaps(){
            mappeno.classList.toggle("invisible");
            document.querySelector(".togglemaps").classList.toggle("active")
        }
        //Toggle mobile menu
        function toggleMobile() {
            let hamburger = document.querySelector(".hamburger");
            document.body.classList.toggle("active");
            hamburger.classList.toggle("is-active");
        }
        //TABS - W3SCHOOLS:
        function openMode(e, modeName) {
            var i, content, tablink;
            content = document.getElementsByClassName("content");
            for (i = 0; i < content.length; i++) {
                content[i].style.display = "none";
            }
            tablink = document.getElementsByClassName("tablink");
            for (i = 0; i < tablink.length; i++) {
                tablink[i].className = tablink[i].className.replace(" active", "");
            }
            document.getElementById(modeName).style.display = "block";
            document.querySelector(".mappeno").style.display = "block";
            e.currentTarget.className += " active";

            if(mappeno.classList.contains("invisible")){
                mappeno.classList.remove("invisible");
                document.querySelector(".togglemaps").classList.remove("active");
            }
            else{
                
            }
        }

        function toggleActive(e){
            tablink = document.getElementsByClassName("tablink");
            for (i = 0; i < tablink.length; i++) {
                tablink[i].className = tablink[i].className.replace(" active", "");
            }
            e.currentTarget.className += " active";
        }

        function selectorActive(e){
            var selector = document.getElementsByClassName('selector');
            for(i = 0; i < selector.length; i++){
                selector[i].className = selector[i].className.replace(" active", "");
            }
            e.currentTarget.className += " active";
            console.log(e);
        }
    
        function DropDownClick(event){
            event.currentTarget.classList.toggle('active');
            console.log(event);
        /*
          let dropdown = document.getElementsByClassName('dropdown-content');
            if(document.body.classList.contains('active')){
                dropdown[0].classList.toggle('active');
            }else{
                dropdown[1].classList.toggle('active');

            }
        */
        }
/*
        window.addEventListener("resize", function(){
            if(window.innerWidth > 1024){
                document.body.classList.remove('active');
            }
        })

*/
