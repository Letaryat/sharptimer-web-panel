var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
var form = document.querySelector('.skin-update');
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");

  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
       //console.log(s[i].form);
        var currentform = this.parentElement.parentElement;
        console.log(currentform.parentNode);
        console.log(currentform.parentNode.id);
        h.click();
        currentform.parentNode.submit();
        //form.submit();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }

}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect); 


/* tabs */

const pistols = [ "1","2","3","4","30","32","36","61","63","64"]
const rifles = ["7","8","10","13","16","60","39"]
const smg = [ "26","17","33","34","19","23","24"]
const shotguns = ["27","35","29","25", "14", "28"]
const snipers = ["9","11","38","40"]
const knifes = ["500","503","505","506","507","508","509","512","514","515","516","517","518","519","520","521","522","523","525","526"]


var weapongroup = document.querySelectorAll(".weapon-selector");
var skins = document.querySelectorAll(".card");
function showgroup(evt, weapons){
  var selected, x;
  if(weapons === "pistols"){
    selected = pistols;
  }
  if(weapons === "rifles"){
    selected = rifles;
  }
  if(weapons === "smg"){
    selected = smg;
  }
  if(weapons === "shotguns"){
    selected = shotguns;
  }
  if(weapons === "snipers"){
    selected = snipers;
  }
  if(weapons === "knifes"){
    selected = knifes;
  }

  for(x = 0; x < weapongroup.length; x++){
    weapongroup[x].className = weapongroup[x].className.replace(" active", "");
  }
  evt.currentTarget.className += " active";
  //console.log(skins.length);
  //console.log(skins[2].getAttribute('data-weaponid'));
  for(x = 0; x <= skins.length; x++){
    if(selected.includes(skins[x].getAttribute('data-weaponid'))){
      skins[x].style.display = "flex";
    }else{
      skins[x].style.display = "none";
    }
    if(selected === knifes){
      if(selected.includes(skins[x].getAttribute('data-weaponid'))){
        skins[x].setAttribute("id", 'rarity_ancient_weapon');
      }
    }
}


localStorage.setItem('grupa', selected);

}

