<?php
session_start();
session_destroy();

echo "Ai fost deconectat cu succes.";
header('Location: index.php');



?>