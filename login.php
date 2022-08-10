
<!DOCTYPE html>
<html lang="en">

<head>
        <link rel="stylesheet" href="css/loginstyle.css?version9">

</head>
<?php
include('admin/config/dbcon.php');
include("includes/meniu.php");


$error = NULL;
$output = NULL;
// Daca suntem deja conectati ne duce pe meniul principal
if(isset($_SESSION['loggedin'])){
    header('Location: index.php');
}
// Logare /////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['submit'])){
    //Conectare la baza de date
    // $mysqli = NEW MySQLi ('localhost' , 'root' , '' , 'webdesign');
    // Preluare date din form
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);
    
   
    // Criptare parola
    // $p = md5($password);
    
    // Querry la baza de date
    $resultSet = $con->query("SELECT * FROM users WHERE email='$email' AND password = '$password' LIMIT 1");
    $resultSetAdmin = $con->query("SELECT * FROM admin WHERE email_admin='$email' AND password_admin = '$password' LIMIT 1");

    if($resultSetAdmin->num_rows != 0 ){
        //Logare ca admin
        $row = $resultSetAdmin->fetch_assoc();
        $role_as = $row['role'];
        $id = $row['id_admin'];
        $user_id = $row['id_admin'];
        $user_name = $row['email_admin'];
        $_SESSION['auth_role'] = "$role_as";
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['auth_user']= ['user_id' =>$user_id, 'user_name'=>$user_name,];
        $_SESSION['user'] = 'administrator';
        $_SESSION['id'] = "$id";
        $_SESSION['administrator'] = TRUE;
        header('Location: admin/index.php');
    }else
    if($resultSet->num_rows != 0 ){
        // Logare
        $row = $resultSet->fetch_assoc();
        $verified = $row['verified'];
        $id = $row['id_user'];
        $_SESSION['id'] = "$id";
        $date = $row['created'];
        $date = strtotime($date);
        $date = date('d M Y',$date); 
        $emailsent = $row['email'];
        $lastName = $row['lastName'];
        $blocked = $row['blocked'];
        $status = $row['status'];
        if($verified == 1){ 
            //Continuare proces logare
            if($blocked == 'Da'){$error = "Contul este blocat!";}elseif($status=='sters'){$error = "Contul a fost sters!";}else{
            $_SESSION['administrator'] = FALSE;
            $_SESSION['loggedin'] = TRUE;   
            $_SESSION['user'] = $lastName;
            echo "Bine ai venit, " . $_SESSION['user'] . " - <a href='logout.php'>Deconectare</a>";
            header('Location: index.php');

      }  }else{
            $error = "Acest cont nu este inca verificat. Un email a fost trimis la adresa de email $emailsent la data: $date";
        }

    }else{
        // Date invalide
        $error = "Emailul sau parola introduse sunt incorecte!";
    }
}

if(!isset($_SESSION['loggedin'])){
    // Afisare bine ai venit si afisare login form

    
}else{
    //Afisare bine ai venit *utilizator*  + logout
    
}





 if(isset($_GET['success'])){
    $error = "Contul tau a fost verificat cu succes!";
} 

?>





<?php if($error){ ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?= $error ?></strong> 
</div>
<?php }?>
<body>
<video id="background-video" autoplay loop muted poster="image/videologinregister.mp4">
  <source src="image/videologinregister.mp4" type="video/mp4">
</video>

    <div class="body-content">

        <div class="container">
            <div class="logo">
                <img src="image/account-image.png " alt="Company Logo" srcset="">
            </div>
            <h2>Logare utilizator</h2>
            <div class="login-form">
                <form method="POST" action="">
                    <div class="form-item">
                        
                        <input type="TEXT" name="email" required placeholder="Email"/>
                    </div>
                    <div class="form-item">
                       
                      <input type="PASSWORD" name="password" required placeholder="Parola">
                    </div>
                    <div class="remember-box">
                        <a href="recuperareparola.php">Ai uitat parola?</a>

                    </div>
                    <div class="form-btns">

                        <input type="SUBMIT" name="submit" value="Logare" required/></td>
                        <div class="options">
                            <a href="register.php">Inregistrare</a>
                        </div>


                    </div>
                </form>
              
				 
            </div>
        </div>
    </div>
    
    <!-- <img src="image/login2.png" center  style="width:30%" class="center"> -->
