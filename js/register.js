
// Buton ascunde parola / buton arata parola
function _id(name){
        return document.getElementById(name);
}

function _class(name){
        return document.getElementsByClassName(name);
}
_class("toggle-password")[0].addEventListener("click", function(){
        _class("toggle-password")[0].classList.toggle("active");
        if(_id("password-field").getAttribute("type") == "password"){
                _id("password-field").setAttribute("type","text");
        }else{
                _id("password-field").setAttribute("type","password");
        }
})


// Buton ascunde repeta parola / buton arata repeta parola
function _id(name){
        return document.getElementById(name);
}

function _class(name){
        return document.getElementsByClassName(name);
}
_class("toggle-rpassword")[0].addEventListener("click", function(){
        _class("toggle-rpassword")[0].classList.toggle("active");
        if(_id("rpassword-field").getAttribute("type") == "password"){
                _id("rpassword-field").setAttribute("type","text");
        }else{
                _id("rpassword-field").setAttribute("type","password");
        }
})
 
 // Form afisare informatii despre parola
 _id("password-field").addEventListener("focus", function(){
         _class("password-policies")[0].classList.add("active");
 });
         _id("password-field").addEventListener("blur", function(){
         _class("password-policies")[0].classList.remove("active");
 });

 // Validare parola
 _id("password-field").addEventListener("keyup",function(){
         let password = _id("password-field").value;
     //minim o litera mare
         if(/[A-Z]/.test(password)){
               _class("policy-uppercase")[0].classList.add("active");  
               _class("policy-uppercase")[0].classList.add("verde"); 
         }else{
                _class("policy-uppercase")[0].classList.remove("active");  
                _class("policy-uppercase")[0].classList.remove("verde"); 
         }
          //minim o litera mica
          if(/[a-z]/.test(password)){
               _class("policy-lowercase")[0].classList.add("active");  
               _class("policy-lowercase")[0].classList.add("verde"); 
         }else{
                _class("policy-lowercase")[0].classList.remove("active");  
                _class("policy-lowercase")[0].classList.remove("verde"); 
         }
       // minim o cifra
       if(/[0-9]/.test(password)){
               _class("policy-number")[0].classList.add("active");  
               _class("policy-number")[0].classList.add("verde"); 
         }else{
                _class("policy-number")[0].classList.remove("active");  
                _class("policy-number")[0].classList.remove("verde"); 
         }
         // lungime minim de 6
       if(password.length>5){
               _class("policy-length")[0].classList.add("active");  
               _class("policy-length")[0].classList.add("verde"); 
         }else{
                _class("policy-length")[0].classList.remove("active");  
                _class("policy-length")[0].classList.remove("verde"); 
         }
 })

