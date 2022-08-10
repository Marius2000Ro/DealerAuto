<?php
if(isset($_GET['vkey'])){
    // Procesul de verificare
    $vkey = $_GET['vkey'];

    $mysqli = NEW MySQLi ('localhost' , 'root' , '' , 'cardealer');

    $resultSet = $mysqli->query("SELECT verified, vkey FROM users WHERE verified = 0 AND vkey = '$vkey' ");
    

   if($resultSet->num_rows == 1){
        // validare email
       $update = $mysqli->query("UPDATE USERS SET verified = 1 WHERE vkey = '$vkey' ");
        if($update){
            $_SESSION['message']= "Contul tau a fost verificat. Te poti loga folosind acest cont";
            header('Location: login.php?success');
           
        }else{
            header('Location: login.php');
        }

   }else{
    header('Location: login.php');
    }


}else{
    header('Location: login.php');
}
?>



