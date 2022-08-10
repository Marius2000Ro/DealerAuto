<?PHP
include("includes/meniu.php");
$output = NULL;

// Daca suntem deja conectati ne duce pe meniul principal
if(isset($_SESSION['loggedin'])){
    header('Location: index.php');
}
// cand apasam submit se trimit datele la baza de date
if(isset($_POST['submit'])) {
        // conectare la baza de date
        //  $mysqli = NEW MySQLi ('localhost' , 'root' , '' , 'webdesign');
            include('admin/config/dbcon.php');

        $firstName = $con->real_escape_string($_POST['firstName']);
        $lastName = $con->real_escape_string($_POST['lastName']);
        $age = $con->real_escape_string($_POST['age']);
        $adress = $con->real_escape_string($_POST['adress']);
        $phone = $con->real_escape_string($_POST['phone']);
        $email = $con->real_escape_string($_POST['email']);
        $password = $con->real_escape_string($_POST['password']);
        $rpassword = $con->real_escape_string($_POST['rpassword']);

        $query = $con->query("SELECT * FROM users WHERE email = '$email'");
        $query2 = $con->query("SELECT * FROM admin WHERE email_admin = '$email'");
        // sabloane verificare parola
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        
   // Generare Vkey
   $vkey = md5(time() .$email);
   
   

        if(empty($firstName) OR empty($lastName) OR empty($age) OR empty($adress) OR empty($email) OR empty($password) OR   empty($rpassword)  ){
                $output = "Te rog completeaza toate campurile.";
        }elseif($query->num_rows !=0){
                $output = "Acest email este deja folosit.";
        }elseif($query2->num_rows !=0){
                $output = "Acest email este deja folosit.";
        }elseif(filter_var($email, FILTER_VALIDATE_EMAIL) != TRUE ){
                $output = "Acest email nu este valid.";
        }elseif($rpassword != $password){
                $output = "Parolele introduse nu corespund.";
             
        }elseif(strlen($password) < 6 ){
                $output = "Parola ta este mai mica de 6 caractere. Introdu o parola care sa contina cel putin un numar, cel putin o litera mare si cel putin o litera mica.";
        }elseif( $uppercase != TRUE){
                $output = "Parola ta nu contine minim o litera mare. Introdu o parola care sa contina cel putin un numar, cel putin o litera mare si cel putin o litera mica.";
        }elseif( $lowercase != TRUE){
                $output = "Parola ta nu contine minim o litera mica. Introdu o parola care sa contina cel putin un numar, cel putin o litera mare si cel putin o litera mica.";
        }elseif( $number != TRUE){
                $output = "Parola ta nu contine minim un numar. Introdu o parola care sa contina cel putin un numar, cel putin o litera mare si cel putin o litera mica.";
        }else{  
                 //Criptare parola
          //      $password = md5 ($password);
                // inserare
                $insert = $con->query("INSERT INTO users(firstName, lastName, age, adress, email, password, vkey, phone) VALUES ('$firstName', '$lastName', '$age', '$adress', '$email', '$password', '$vkey','$phone')");
                        if($insert != TRUE){
                                $output="Exista o problema. <br />";
                                $output .= $con->error;
                        }else{
                                $output = "Ai fost inregistrat cu succes!";
                                // Trimitere email confirmare 
                                $to = $email;
                                $subject = "Verificare email";
                                $message = "http://localhost/LicentaFrentMariusGeorgian/verify.php?vkey=$vkey   Apasa pe link pentru a confirma inregistrarea contului";
                                $headers = "From: filipkights@yahoo.com";

                                mail($to,$subject,$message,$headers);
                                
                                header('location:thankyou.php');

                                
                        }
                        
        }
        


}



      


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/registerstyle.css?version8">
        


<body>
<?php if($output){ ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?= $output ?></strong> 
</div>
<?php } ?>
<video id="background-video" autoplay loop muted poster="image/videologinregister.mp4">
  <source src="image/videologinregister.mp4" type="video/mp4">
</video>
    <div class="body-content">

        <div class="container">
            <div class="logo">
                <img src="image/account-image.png " alt="Company Logo" srcset="">
            </div>
            <h2>Inregistrare utilizator</h2>
            <div class="login-form">
                <form method="POST">
                    <div class="form-item">
                        
                        <input type="TEXT" name ="firstName" required placeholder="Nume"/>
						
                    </div>
					<div class="form-item">
                        
                        <input type="TEXT" name ="lastName" required placeholder="Prenume"/>
						
                    </div>
					<div class="form-item">
                        
                        <input type="number" name ="age" required placeholder="Varsta"/>
						
                    </div>
					<div class="form-item">
                        
                        <input type="TEXT" name ="adress"" required placeholder="Adresa"/>
						
                    </div>
					
                    <div class="form-item">
                        
                        <input type="number" name ="phone" required placeholder="Numar telefon"/>
						
                    </div>
                    <div class="form-item">
                        
                        <input type="TEXT" name ="email" required placeholder="Email"/>
						
                    </div>
                    <div class="form">
                            <div class="form-element">
					<div class="form-item">
                        
                                          <input type="PASSWORD" id="password-field" name ="password" required placeholder="Parola"/>
					
                                        </div>
                                        <div class="toggle-password">
                                                <i class="fa fa-eye"></i>
                                                <i class="fa fa-eye-slash"></i>
                                        </div>

                                        <div class="password-policies">
                                                <div class="policy-length">
                                                        Lungime de minim 6 caractere
                                                </div>

                                                <div class="policy-number">
                                                        Contine minim un numar
                                                </div>

                                                <div class="policy-lowercase">
                                                        Contine minim o litera mica
                                                </div>

                                                <div class="policy-uppercase">
                                                        Contine minim o litera mare
                                                </div>
                                        </div>

                             </div>
                    </div>
                    
                    <div class="form">
                            <div class="form-element">
					<div class="form-item">
                        
                                          <input type="PASSWORD" id="rpassword-field" name ="rpassword" required placeholder="Repeta parola"/>
					
                                        </div>
                                        <div class="toggle-rpassword">
                                                <i class="fa fa-eye"></i>
                                                <i class="fa fa-eye-slash"></i>
                                        </div>
                             </div>
                    </div>
                    
                    
                    <div class="form-btns">

                       <input type="SUBMIT" name="submit" value="Inregistrare" required />
                     


                    </div>
                </form>
			
            </div>
        </div>
    </div>
   


</body>

</html>


<script src="js/register.js"></script>