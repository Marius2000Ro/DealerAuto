<?php
if($_SESSION['auth_role'] != "2"){
$_SESSION['message'] = "Nu sunteti autorizat ca administrator, nu aveti acces pe aceasta pagina!";
header("Location: index.php");
exit(0);
}


?>