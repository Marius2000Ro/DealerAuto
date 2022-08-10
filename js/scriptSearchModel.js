
function autocomplete(inp, arr) {
  var currentFocus;
  /*executa functia cand este ceva scris in input*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*inchide tot ce este deja deschis*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      /*pentru fiecare item din array*/
      for (i = 0; i < arr.length; i++) {
        /*verificam daca itemul incepe cu aceeasi litera din array:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          /*literele care se potrivesc le fac bold:*/
          b.innerHTML = "<mark>" + arr[i].substr(0,val.length) +"</mark>";
          b.innerHTML += arr[i].substr(val.length);
          /*insereaza un input field care va tine  arrayul curent pentru  valoarea itemulului:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*cand cineva apasa pe valoarea la item se executa functia*/
          b.addEventListener("click", function(e) {
              /*insereaza valoarea in campul input*/
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  
 
 
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
