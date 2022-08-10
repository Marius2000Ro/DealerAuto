<?PHP
include("includes/meniu.php");

$output = NULL;


if(isset($_POST['submit'])) {
        // conectare la baza de date
         $mysqli = NEW MySQLi ('localhost' , 'root' , '' , 'cardealer');

        $firstName = $mysqli->real_escape_string($_POST['firstName']);
        $lastName = $mysqli->real_escape_string($_POST['lastName']);
        $email = $mysqli->real_escape_string($_POST['email']);
        
        

        $query2=$mysqli->query("SELECT * FROM users WHERE email = '$email'");

        if(empty($firstName) OR empty($lastName) OR empty($email) ){
                $output = "Te rog completeaza toate campurile.";
        }
        if($query2->num_rows != 0 ){
            
            $row = $query2->fetch_assoc();
            $password = $row['password'];
            $firstNameUser = $row['firstName'];
            $lastNameUser = $row['lastName'];
            $emailUser = $row['email'];
        }
               if($firstName == $firstNameUser AND $lastName == $lastNameUser AND $email == $emailUser){
                                // Trimitere email parola 
                                $to = $email;
                                $subject = "Parola noua";
                                $message = "$firstName $lastName, ai solicitat parola contului $email pe site-ul wwww.dealerauto.ro, parola ta este '$password'. In caz ca nu ai solicitat tu parola contului, te rugam sa ignori acest mesaj.";
                                $headers = "From: filipkights@yahoo.com";

                                mail($to,$subject,$message,$headers);
                                
                                $output = "Un mail a fost trimis la adresa $email cu parola dumneavoastra!";
               }else{ $output = "Datele introduse nu corespund";}
                                
                        
                        
        
        


}



      


?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <title>Pagina</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/loginstyle.css?version7">
</head>

<?php if($output){ ?>
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong><?= $output ?></strong> 
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
            <h2>Recuperare parola</h2>
            <div class="login-form">
                <form method="POST">
                    <div class="form-item">
                        
                        <input type="TEXT" name ="firstName" required placeholder="Nume"/>
						
                    </div>
					<div class="form-item">
                        
                        <input type="TEXT" name ="lastName" required placeholder="Prenume"/>
						
                    </div>
				
					
					<div class="form-item">
                        
                        <input type="TEXT" name ="email" required placeholder="Email"/>
						
                    </div>
					
                    
                    <div class="form-btns">

                       <input type="SUBMIT" name="submit" value="Recupereaza parola" required />
                     


                    </div>
                </form>
             
			
            </div>
        </div>
    </div>
   


</body>

</html>
