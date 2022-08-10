<?php
session_start();
if(isset($_SESSION['loggedin'] )){ 
    if(isset($_SESSION['administrator'] )){
 echo "admin logat";
 echo "<a href='logout.php'>Deconectare</a>";
}
}else{
    echo "Nu sunteti admin!";
}
?>
