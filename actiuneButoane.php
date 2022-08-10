<?php
session_start();
include('admin/config/dbcon.php');

// Editare poza de profil de catre utilizator
if(isset($_POST['update_fotografieuser'])){
    $id_user = $_POST['user_id'];
    $image = $_FILES['image']['name'];
    $old_filename= $_POST['old_image'];
    // Redenumire imagine
    $random= time();
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = 'user'.$random.'.'.$image_extension;
             if($image != NULL){
              $query = ("UPDATE users SET image='$filename' WHERE id_user='$id_user' ");
             
          
              $query_run = mysqli_query($con, $query);
              
              if($query_run)
              { if($image != NULL){
                if(file_exists('admin/image/userimage/'.$old_filename)){
                    unlink("admin/image/userimage/".$old_filename);
                }
                 move_uploaded_file($_FILES['image']['tmp_name'], 'admin/image/userimage/'.$filename);}
                 $_SESSION['message']= "Fotografia de profil a fost actualizata cu succes!";
                header('Location: profil.php');
              }
              else{ 
                $_SESSION['message']= "Fotografia de profil nu a fost actualizata, incearca din nou!";
                header('Location: profil.php');}
            }
        }


        

// Editare informatii utilizator de catre utilizator
if(isset($_POST['edituserprofile'])){

    $id_user = $_POST['user_id'];
    $firstName = $con->real_escape_string($_POST['firstName']);
    $lastName = $con->real_escape_string($_POST['lastName']);
    $password = $con->real_escape_string($_POST['password']);
    $passwordConfirm = $con->real_escape_string($_POST['passwordConfirm']);
    $adress = $con->real_escape_string($_POST['adress']);
    $age = $con->real_escape_string($_POST['age']);
    $phone = $con->real_escape_string($_POST['phone']);

             if($password == $passwordConfirm){
              $query = ("UPDATE users SET firstName='$firstName', lastName='$lastName', password='$password', adress='$adress', age='$age', phone='$phone' WHERE id_user='$id_user' ");
             
          
              $query_run = mysqli_query($con, $query);
              
              if($query_run)
              { 
                $_SESSION['message']= "Modificarea datelor a fost efectuata cu succes!";
                header('Location: profil.php');
                

              }
              else{
                $_SESSION['message']= "Modificarea nu a fost efectuata. Incearca din nou!";
                header('Location: profil.php');}
            
            }else{ 
              $_SESSION['message']= "Parolele nu corespund. Datele nu au fost actualizate!";
              header('Location: profil.php');}
        }




// Stergere achizitie ( cancel achizitie )
if(isset($_POST['cancel-purchase'])){
  $id_achizitie = $_POST['cancel-purchase'];

  $query = "DELETE FROM purchase WHERE id_achizitie='$id_achizitie' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {  
              header('Location: masini.php');
            exit(0);
        }

}


// Stergere rezervare ( cancel rezervare )
if(isset($_POST['cancel-reservation'])){
  $id_rezervare = $_POST['cancel-reservation'];

  $query = "DELETE FROM reservations WHERE id_rezervare='$id_rezervare' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {  
              header('Location: masini.php');
            exit(0);
        }

}


// Stergere achizitie neplatita de catre utilizator 
if(isset($_POST['user_delete_achizitie'])){
  $id_achizitie = $_POST['user_delete_achizitie'];

  $query = "DELETE FROM purchase WHERE id_achizitie='$id_achizitie' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {  
              header('Location: achizitiiprofil.php');
            exit(0);
        }

}

// Stergere rezervare neplatita de catre utilizator 
if(isset($_POST['user_delete_rezervare'])){
  $id_rezervare = $_POST['user_delete_rezervare'];

  $query = "DELETE FROM reservations WHERE id_rezervare='$id_rezervare' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {  
              header('Location: rezervariprofil.php');
            exit(0);
        }

}


//Adauga masina la favorite
if(isset($_POST['wishlist_add'])){
  $id_car = $_POST['id_car'];
  $id_user = $_SESSION['id'];
  $from = $_POST['from'];
  $query =("INSERT INTO wishlist (id_car,id_user) VALUES ('$id_car','$id_user')");
   $query_run = mysqli_query($con, $query);  
      if($query_run){
        $_SESSION['message']= "Masina a fost adaugata la favorite cu succes!";
        if($from =='wishlist'){
            header('Location: wishlist.php');
        }elseif($from=='modelspecific'){
          header("Location: modelspecific.php?id=$id_car");
        }else{  header('Location: masini.php');}
          exit(0);
      }
      

}


//Sterge masina de la favorite
if(isset($_POST['wishlist_delete'])){
  $id_car = $_POST['id_car'];
  $id_user = $_SESSION['id'];
  $from = $_POST['from'];
  $query =("DELETE FROM wishlist WHERE id_car='$id_car' AND id_user='$id_user'");
  $query_run = mysqli_query($con, $query);  
          if($query_run){
          $_SESSION['message']= "Masina a fost stearsa de la favorite cu succes!";
          if($from =='wishlist'){
              header('Location: wishlist.php');
          }elseif($from=='modelspecific'){
            header("Location: modelspecific.php?id=$id_car");
          }else{  header('Location: masini.php');}
            exit(0);
        }

}


//Adauga comentariu
if(isset($_POST['add_comment'])){
  $id_car = $_POST['id_car'];
  $id_user = $_POST['id_user'];
  $comentariu = $con->real_escape_string($_POST['comentariu']);
   
  $query =("INSERT INTO comments (id_car,id_user,comentariu) VALUES ('$id_car','$id_user','$comentariu')");
   $query_run = mysqli_query($con, $query);  
          if($query_run){
          $_SESSION['message']= "Comentariul tau a fost adaugat cu succes!";
              header("Location: modelspecific.php?id=$id_car");
            exit(0);
        }
      

}




//Sterge comentariu
if(isset($_POST['delete_comment'])){
  $id_comentariu = $_POST['id_comentariu'];
  $id_car = $_POST['id_car'];
  $query =("DELETE FROM comments WHERE id_comentariu='$id_comentariu'"); 
  $query_run = mysqli_query($con, $query);  
  if($query_run){
  $_SESSION['message']= "Comentariul a fost sters cu succes!";
      header("Location: modelspecific.php?id=$id_car");
    exit(0);
}

}






//Raspunde la comentariu
if(isset($_POST['reply_comment'])){
  $id_comentariu = $_POST['id_comentariu'];
  $id_car = $_POST['id_car'];
  $id_user = $_POST['id_user'];
  $comentariu = $con->real_escape_string($_POST['comentariuReply']);

            //Inseram comentariul
           $queryInsertComentariu = ("INSERT INTO comments (id_car,id_user,comentariu,id_parinte_reply) VALUES ('$id_car','$id_user','$comentariu','$id_comentariu')");
           $query_runInsertComentariu = mysqli_query($con, $queryInsertComentariu);  
           if($query_runInsertComentariu){
            $_SESSION['message']= "Raspunsul la comentariu a fost adaugat cu succes!";
            header("Location: modelspecific.php?id=$id_car");
    
        
          }
    
        
      
          
      }
?>