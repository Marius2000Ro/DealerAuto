var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.navbar');
// Functionare meniu 
menu.onclick = () =>{
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

// Bara de navigare sus-jos, sa ramana meniul activ mereu
window.onscroll = () =>{
    if(window.scrollY > 0){
        document.querySelector('.header').classList.add('active');
      }else{
        document.querySelector('.header').classList.remove('active');
      };
      
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    
}

// Tranzitie elemente de pe pagina acasa cand suntem cu mouseul pe ele
document.querySelector('.acasa').onmousemove = (e) =>{

  document.querySelectorAll('.acasa-parallax').forEach(elm =>{

    let speed = elm.getAttribute('data-speed');

    let x = (window.innerWidth - e.pageX * speed) / 90;
    let y = (window.innerHeight - e.pageY * speed) / 90;

    elm.style.transform = `translateX(${y}px) translateY(${x}px)`;

  });

};

// Se opreste tranzitia cand iesim cu mousul din zona acasa
document.querySelector('.acasa').onmouseleave = (e) =>{

  document.querySelectorAll('.acasa-parallax').forEach(elm =>{

    elm.style.transform = `translateX(0px) translateY(0px)`;

  });

};




