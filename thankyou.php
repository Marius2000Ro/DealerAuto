<?php include("includes/meniu.php");?>

</head>

<div class="thank-you">
  <body style="background-color:powderblue;">

  <h1>Iti multumim pentru inregistrare. Am trimis un email la adresa dumnevoastra un mesaj cu linkul de confirmare!</h1>
  <img src="image/cerc.png" alt="cerc" style="width:25%;">
  <div class="imglogin">
    <a href="login.php"><img class="loginbuton" src="image/login.png" alt="cerc" style="width:15%;"></a>
  </div>
</body>
</div>


<style>
  
img {
  display: block;
  margin-left: auto;
  margin-right: auto;

}
.imglogin:active{
  display: grid;
    grid-template-columns: repeat(auto-fit, minmax(50rem, 1fr));
    gap:1.5rem;
    padding-top: 5rem;
    padding-bottom: 5rem;
}

.imglogin:hover {
  display: grid;
    grid-template-columns: repeat(auto-fit, minmax(50rem, 1fr));
    gap:1.5rem;
    padding-top: 5rem;
    padding-bottom: 5rem;
  
}
.thank-you{
margin-top:100px;
}
</style>
<?php include("includes/footer.php");?>
</html>



