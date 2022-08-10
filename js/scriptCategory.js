// Functia de filtrare de pe pagina category
function searchCategory() {
    // DOM
    const input = document.getElementById('filter').value.toUpperCase();
  
    const cardContainer = document.getElementById('card-lists');
    console.log(cardContainer);
  
    const cards = cardContainer.getElementsByClassName('card');
    console.log(cards);
  
    for(let i=0; i < cards.length; i++){
        let title = cards[i].querySelector(".card-body h5.card-title");
        console.log(title);
        // Daca e > -1 inseamna ca corespunde valorii cautate
        if(title.innerText.toUpperCase().indexOf(input) > -1) {
                cards[i].style.display = "";
        }else{
            cards[i].style.display = "none";
        }
    }
  
  }
  



  