<?php
include('config/dbcon.php');


if($_SESSION['administrator'] == FALSE){
    // $_SESSION['message'] = "Logheaza-te pentru a avea acces la panoul principal!";
    // daca nu suntem logati ne trimite la logare
    if(!isset($_SESSION['loggedin'])){
        header('Location: ../login.php');
    }
    // daca  suntem logati ne trimite la pagina principala
     if(isset($_SESSION['loggedin'])){
    header('Location: ../index.php');
    
    }
    exit(0);
}


?>