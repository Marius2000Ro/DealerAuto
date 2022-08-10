<?php
include('admin/config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <title>Marius Dealer Auto</title>
        <link rel="shortcut icon" href="image/favicon.ico" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/style.css?version5">
</head>


<!-- inceput header section-->
<header class="header">

    <div id="menu-btn" class="fas fa-bars"></div>

    <a href="#" class="logo"> <span>Marius</span>DealerAuto </a>

 <nav class="navbar">
        <a href="index.php">Acasa</a>
        <a href="desprenoi.php">Despre noi</a>
        <a href="category.php">Categorii</a>
        <a href="masini.php">Masini</a>
        <?PHP 
        session_start();
        if(isset($_SESSION['loggedin'])){ 

          ?>  <a href="profil.php">Profil</a>
            <?PHP }  ?>
            
        
        <a href="contact.php">Contact</a>


        
    
       
</nav>

<!-- Afisare bine ai venit utilizator -->
<?php
if(isset($_SESSION['loggedin']) AND !$_SESSION['administrator']){ ?>
 <a href="wishlist.php"><i class="fa fa-heart" style="font-size:22px;color:red">(<?php
             $id_user = $_SESSION['id'];
             $query1 = ("SELECT id_car FROM wishlist WHERE id_user='$id_user'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo "$total";
             }else{ 
               echo "0";
             }  ?>)</i></a>
 <?php
}
if(!isset($_SESSION['loggedin'])){
    // Afisare bine ai venit si afisare login form
   echo "<h3>Bine ai venit, utilizatorule</h3>";
?>

<!-- buton login doar pentru utilizator-->
<div id="login-btn">
    
    <button class="btn"><a href="login.php">Logare</a></button>
    
    <i class="far fa-user"><a href="login.php">Login</a></i>
</div>
<div id="login-btn">
    
    <button class="btn"><a href="register.php">Inregistrare</a></button>
    
    <i class="far fa-user"><a href="register.php">Inregistrare</a></i>
</div>
<?php
}elseif($_SESSION['administrator']){
?> 
    <nav class="navbar">
        <a href="admin/index.php">Admin</a>
    </nav>
<div id="login-btn">
    <button class="btn"><a href="logout.php">Delogare</a></button>

    <i class="far fa-user"><a href="logout.php">Delogare</a></i>
</div> 
<?php
}else{
    //Afisare bine ai venit *utilizator*  + logout
    echo "<h2>Bine ai venit,  " . $_SESSION['user'] . "</h2>";
    ?>

<!-- buton logout doar pentru utilizator-->
<div id="login-btn">
    
    <button class="btn"><a href="logout.php">Delogare</a></button>
    
    <i class="far fa-user"><a href="logout.php">Delogare</a></i>
</div>

    <?php
}

?>



<!-- js link-->
<script src="js/script.js?version8"></script>


</header>
<!-- sfarsit header section-->


<style>



/*Tot meniul*/
.header{
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: fixed;
    top:0; left:0; right:0;
    padding:3rem 9%;
    z-index: 1000;
    background: #fff;
}

/*Numele companiei partea din final*/
.header .logo{
    font-size: 3.5rem;
    color:var(--black);
    font-weight: bold;
}
/*Numele companiei partea din fata*/
.header .logo span{
    color:var(--galben);
}
/*Meniul*/
.header .navbar a{
    margin:0 2rem;
    font-size: 2.5rem;
    color:var(--verde);
    
}
/*Meniul cand e mousul pe el*/
.header .navbar a:hover{
    color:red;
}
/*buton login*/
.header .btn{
    margin-top: 0;
}

.header #login-btn i{
    font-size: 2.5rem;
    color:var(--usor-colorat);
    cursor: pointer;
    display: none;
}

#menu-btn{
    font-size: 2.5rem;
    color:var(--usor-colorat);
    cursor: pointer;
    display: none;
}


/* Umbra la meniu cand derulam */
.header.active{
 box-shadow: var(--umbre);
 padding:1rem 9%;
}

/* Functionare interfata meniu pe 991px */
@media(max-width:1600px){

html{
    font-size: 55%;
}

.header{
    padding:2rem;
}

.header.active{
    padding:2rem;
}

section{
    padding:2rem;
}


}
/* Functionare interfata meniu pe 768px */
@media(max-width:949px){
#menu-btn{
    display: block;
}
/* Invartire buton meniu la apasare */
#menu-btn.fa-times{
    transform:rotate(180deg);
}

.header #login-btn .btn{
    display: none;
}

.header #login-btn i{
    display: block;
}

.header .navbar{
    position: absolute;
    top:99%; left:0; right:0;
    background: #fff;
    border-top: var(--usor-colorat);
    clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
}
/* Afisaj bara navigatie */
.header .navbar.active{
    clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
}

.header .navbar a{
    margin:2rem;
    display: block;
    font-size: 2rem;
}

}
.rosu{
  background: red;
}


/* Functionare interfata meniu pe 450 */
@media(max-width:450px){

html{
    font-size: 50%;
}

.heading{
    font-size: 3rem;
}

}




</style>

