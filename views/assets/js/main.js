var dropdowns = document.getElementsByClassName('dropdown');
var mappeno = document.querySelector(".mappeno");

      //scroll down:
        window.onscroll = function(){BoxShadows()};
        function BoxShadows(){
            var leaderboard = document.querySelector(".leaderboard");
            if(leaderboard === null){
                return;
            }
            var leaderboardinfo = leaderboard.getBoundingClientRect();
            var infocontainer = document.querySelector(".info");
            if(infocontainer != null){
                if(leaderboardinfo.top < -1){
                    infocontainer.classList.add("boxshadows");
                }else{
                    infocontainer.classList.remove("boxshadows");
                }
            }
        }
        //Toggle mobile menu

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
            //window.scrollTo(0, 0);
            //document.getElementById("top").scrollIntoView();
            var selector = document.getElementsByClassName('selector');
            for(i = 0; i < selector.length; i++){
                selector[i].className = selector[i].className.replace(" active", "");
            }
            e.currentTarget.className += " active";
            //console.log(e);
        }
    

        function DropDownClick(event){
            event.currentTarget.classList.toggle('active');
            Array.from(dropdowns).forEach(el =>{
                if(el !== event.currentTarget){
                    el.classList.remove('active');
                }
            })
        }

        window.onclick = function(e){
            if(!e.target.matches('.dropbtn')){
                Array.from(dropdowns).forEach(el =>{
                    el.classList.remove('active');
                })
            }
        }
