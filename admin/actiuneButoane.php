<?php
session_start();
include('autentificare.php');




// Editare utilizatori normali
if(isset($_POST['update_user'])){
    $id_user = $_POST['user_id'];
    $firstName = $con->real_escape_string($_POST['firstName']);
    $lastName = $con->real_escape_string($_POST['lastName']);
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);
    $passwordConfirm = $con->real_escape_string($_POST['passwordConfirm']);
    $adress = $con->real_escape_string($_POST['adress']);
    $age = $con->real_escape_string($_POST['age']);
    $phone = $con->real_escape_string($_POST['phone']);
    $verified = $con->real_escape_string($_POST['verified']);
    $blocked = $con->real_escape_string($_POST['blocked'] == true ? 'Da':'Nu');
    $image = $_FILES['image']['name'];
    $old_filename = $_POST['old_image'];
    // Redenumire imagine
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $random= time();
    $filename = 'user'.$random.'.'.$image_extension;
    if($password == $passwordConfirm ){
             // Inseram datele introduse
             if($image != NULL){
              $query = ("UPDATE users SET image='$filename', firstName='$firstName', lastName='$lastName', email='$email', password='$password', adress='$adress', age='$age', phone='$phone', verified='$verified', blocked='$blocked'
              WHERE id_user='$id_user' ");
             }else{

    $query = ("UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', password='$password', adress='$adress', age='$age', phone='$phone', verified='$verified', blocked='$blocked'
              WHERE id_user='$id_user' ");
             }
          
              $query_run = mysqli_query($con, $query);
              
              if($query_run)
              {  
                  if($image != $default){
                  if(file_exists('image/userimage/'.$old_filename)){
                      unlink("image/userimage/".$old_filename);
                  }
                  move_uploaded_file($_FILES['image']['tmp_name'], 'image/userimage/'.$filename);
                }
               
                $_SESSION['message']= "Modificarea pentru $firstName $lastName efectuata cu succes!";
                    header('Location: users-view.php');
                  exit(0);
              }
              else{echo "eroare";}
            
}else{
    //eroare parolele nu corespund
    $_SESSION['message']= "Parolele introduse nu corespund! Modificarea nu a fost efectuata.";
    header('Location: users-view.php');
    exit(0);
}
}




// Editare administratori

if(isset($_POST['update_admin'])){
    $id_admin = $_POST['admin_id']; 
    $firstName = $con->real_escape_string($_POST['firstName']);
    $lastName = $con->real_escape_string($_POST['lastName']);
    $email_admin = $con->real_escape_string($_POST['email_admin']);
    $password = $con->real_escape_string($_POST['password']);  
    $passwordConfirm= $con->real_escape_string($_POST['passwordConfirm']);
    $adress = $con->real_escape_string($_POST['adress']);
    $phone = $con->real_escape_string($_POST['phone']);
    $role = $con->real_escape_string($_POST['role']);
    $image = $_FILES['image']['name']; 
    $old_image= $_POST['old_image'];
    $random = time();
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = 'administrator'.$random.'.'.$image_extension;
    if($password == $passwordConfirm ){

                  // Inseram datele introduse
                  if($image != NULL){
    $queryUpdate = ("UPDATE admin SET image='$filename',firstName='$firstName', lastName='$lastName', email_admin='$email_admin', password_admin='$password', adress='$adress', phone='$phone', role='$role'
              WHERE id_admin='$id_admin' ");
                  }else{
                    $queryUpdate = ("UPDATE admin SET firstName='$firstName', lastName='$lastName', email_admin='$email_admin', password_admin='$password', adress='$adress', phone='$phone', role='$role'
              WHERE id_admin='$id_admin' ");
                  }
          $query_run = mysqli_query($con, $queryUpdate);
              
          if($query_run > '0')
              { if($image != NULL){
                
                if(file_exists('image/adminimage/'.$old_image)){
                    unlink("image/adminimage/".$old_image);
                }
                move_uploaded_file($_FILES['image']['tmp_name'], 'image/adminimage/'.$filename);  
              }
              // Daca angajatul isi modifica singur datele sa il duca pe pagina principala
              if($_SESSION['id'] == $id_admin AND $_SESSION['auth_role'] == "1" ){
                $_SESSION['message']= "Datele dumneavoastra au fost modificate cu succes!";
                header('Location: index.php');
              exit(0);
              }
                $_SESSION['message']= "Modificarea pentru $firstName $lastName efectuata cu succes!";
                    header('Location: administratori-view.php');
                  exit(0);
              }
              else{echo "eroare";}
            

}else{
    //eroare parolele nu corespund
    $_SESSION['message']= "Parolele introduse nu corespund! Modificarea nu a fost efectuata.";
    header('Location: administratori-view.php');
    exit(0);
}
}





    // Adaugare utilizator
if(isset($_POST['add_user'])){
    $firstName = $con->real_escape_string($_POST['firstName']);
    $lastName = $con->real_escape_string($_POST['lastName']);
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);
    $passwordConfirm = $con->real_escape_string($_POST['passwordConfirm']);
    $adress = $con->real_escape_string($_POST['adress']);
    $age = $con->real_escape_string($_POST['age']);
    $phone = $con->real_escape_string($_POST['phone']);
    $verified = $con->real_escape_string($_POST['verified']);
    $blocked = $con->real_escape_string($_POST['blocked'] == true ? 'Da':'Nu');
    $image = $_FILES['image']['name'];
    $random = time();
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = 'user'.$random.'.'.$image_extension;
    if($password == $passwordConfirm ){

                //Verificam daca exista deja emailul introdus in baza de date
                $select = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");
if(mysqli_num_rows($select)) {
               $_SESSION['message']= "Emailul $email este deja in baza de date. Incearca alt email!";
               header('Location: users-view.php');
               exit(0);
             }else{

             // Inseram datele introduse
        $query = ("INSERT INTO users(image,firstName,lastName,email,password,adress,age,phone,verified,blocked) VALUES ('$filename','$firstName','$lastName','$email','$password','$adress','$age','$phone','$verified','$blocked')");

        $query_run = mysqli_query($con, $query);
              
        if($query_run)
        {  move_uploaded_file($_FILES['image']['tmp_name'], 'image/userimage/'.$filename); 
           $_SESSION['message']= "Userul $firstName $lastName a fost adaugat cu succes!";
              header('Location: users-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou! Emailul este posibil sa fie deja folosit.";
              header('Location: users-view.php');
            exit(0);
        }
                    }
    }else{
        //eroare parolele nu corespund
        $_SESSION['message']= "Parolele introduse nu corespund! Modificarea nu a fost efectuata.";
        header('Location: users-view.php');
        exit(0);

}
}




// Adaugare admin/angajat
if(isset($_POST['add_admin'])){
    $firstName = $con->real_escape_string($_POST['firstName']);
    $lastName = $con->real_escape_string($_POST['lastName']);
    $email_admin = $con->real_escape_string($_POST['email_admin']);
    $password = $con->real_escape_string($_POST['password']);  
    $passwordConfirm= $con->real_escape_string($_POST['passwordConfirm']);
    $adress = $con->real_escape_string($_POST['adress']);
    $phone = $con->real_escape_string($_POST['phone']);
    $role = $con->real_escape_string($_POST['role']); 
    $image = $_FILES['image']['name'];
    $random = time();
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $filename = 'administrator'.$random.'.'.$image_extension;

    if($password == $passwordConfirm ){

        //Verificam daca exista deja emailul introdus in baza de date
        $queryVerificareEmail = ("SELECT COUNT(email_admin) FROM admin WHERE email_admin='$email_admin'");
             $query_run1 = mysqli_query($con, $queryVerificareEmail);
                  if($query_run1 = '0'){
                    $_SESSION['message']= "Emailul $email_admin este deja in baza de date. Incearca alt email!";
                    header('Location: administratori-view.php');
                    exit(0);
                  }else{
                  // Inseram datele introduse
        $query = ("INSERT INTO admin(firstName,lastName,email_admin,password_admin,adress,phone,role,image) VALUES ('$firstName','$lastName','$email_admin','$password','$adress','$phone','$role','$filename')");

        $query_run = mysqli_query($con, $query);
              
        if($query_run)
        {   move_uploaded_file($_FILES['image']['tmp_name'], 'image/adminimage/'.$filename);
            $_SESSION['message']= "$firstName $lastName a fost adaugat cu succes!";
              header('Location: administratori-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou! Este posibil sa fie deja folosit emailul";
              header('Location: administratori-view.php');
            exit(0);
        }
    }
    }else{
        //eroare parolele nu corespund
        $_SESSION['message']= "Parolele introduse nu corespund! Modificarea nu a fost efectuata.";
        header('Location: administratori-view.php');
        exit(0);

}


}





// Stergere user temporar
if(isset($_POST['user_delete'])){

  $user_id = $_POST['user_delete'];

  $query = "UPDATE users SET status='sters' WHERE  id_user='$user_id' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Utilizatorul a fost sters cu succes!";
              header('Location: users-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: users-view.php');
            exit(0);
        }


}

// Anuleaza stergerea pentru utilizator
if(isset($_POST['deleted-users-redo'])){

  $user_id = $_POST['id'];

  $query = "UPDATE users SET status='activ' WHERE  id_user='$user_id' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Stergerea pentru utilizatorul $user_id a fost anulata!";
              header('Location: users-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: users-view.php');
            exit(0);
        }


}



// Stergere utilizator definitiv
if(isset($_POST['user_delete_definitiv'])){

  $user_id = $_POST['user_delete_definitiv'];

  $query = "DELETE FROM users WHERE id_user='$user_id' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Utilizatorul a fost sters definitiv!";
              header('Location: deleted-users.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: deleted-users.php');
            exit(0);
        }


}




// Stergere administrator/angajat
if(isset($_POST['admin_delete'])){

  $admin_id = $_POST['admin_delete'];

  $query = "DELETE FROM admin WHERE id_admin='$admin_id' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Administratorul a fost sters cu succes!";
              header('Location: administratori-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: administratori-view.php');
            exit(0);
        }


}


// Stergere categorie definitiv
if(isset($_POST['category_delete_definitiv'])){

  $id_category = $_POST['category_delete_definitiv'];

  $query = "DELETE FROM category WHERE id_category='$id_category' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Categoria $id_category a fost stearsa definitiv!";
              header('Location: category-deleted.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: category-deleted.php');
            exit(0);
        }


}



// Adaugare categorie
if(isset($_POST['category_add'])){

  $name = $con->real_escape_string($_POST['name']);
  $image1 = $_FILES['image']['name'];
  $status= $_POST['status'];
  $random = time();
  $image_extension = pathinfo($image1, PATHINFO_EXTENSION);
  $filename = 'categorie'.$random.'.'.$image_extension;

  $query =("INSERT INTO category (name,image,status) VALUES ('$name', '$filename', '$status')");
      
  $query_run = mysqli_query($con, $query);
            
  if($query_run)
  {  move_uploaded_file($_FILES['image']['tmp_name'], 'image/category/'.$filename);
     $_SESSION['message']= "Categorie adaugata cu succes!";
        header('Location: category-view.php');
      exit(0);
  }else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: category-view.php');
      exit(0);
  }


}


// Editeaza categorie
if(isset($_POST['category_edit'])){
  $id = $_POST['id'];
  $name = $con->real_escape_string($_POST['name']);
  $image1 = $_FILES['image']['name'];
  $status= $_POST['status'];
  $image_extension = pathinfo($image1, PATHINFO_EXTENSION);
  $old_image = $_POST['old_image'];
  $random= time();
  $filename = $random.'categorie'.'.'.$image_extension;
          if($image1 != NULL)
          {
  $query = ("UPDATE category SET name='$name', image='$filename', status='$status' WHERE id_category='$id' ");
          }else{
   $query = ("UPDATE category SET name='$name', status='$status' WHERE id_category='$id' ");
          }
  $query_run = mysqli_query($con, $query);
  if($query_run)
  {  if($image1 != NULL){
    if(file_exists('image/category/'.$old_image)){
        unlink("image/category/".$old_image);
    }move_uploaded_file($_FILES['image']['tmp_name'], 'image/category/'.$filename);}
     $_SESSION['message']= "Categoria $name a fost editata cu succes!";
        header('Location: category-view.php');
      exit(0);
   
}else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: category-view.php');
      exit(0);
  }
  
}



// Sterge categorie
if(isset($_POST['category-delete'])){
  $category_id = $_POST['category-delete'];
  

  // status = 2  adica sters
  $query = ("UPDATE category SET status='2' WHERE id_category='$category_id' LIMIT 1");
  $query_run = mysqli_query($con, $query);
  if($query_run)
        {   $_SESSION['message']= "Categoria a fost stearsa cu succes!";
              header('Location: category-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: category-view.php');
            exit(0);
        }

}




// Adaugare vehicul
if(isset($_POST['vehicle_add'])){
  $model = $con->real_escape_string($_POST['model']);
  $category_id = $con->real_escape_string($_POST['category_id']);
  $year = $con->real_escape_string($_POST['year']);
  $km = $con->real_escape_string($_POST['km']);
  $price = $con->real_escape_string($_POST['price']);
  $lastPrice = $con->real_escape_string($_POST['lastPrice']);
  $engine = $con->real_escape_string($_POST['engine']);
  $fuel_type = $con->real_escape_string($_POST['fuel_type']);
  $color = $con->real_escape_string($_POST['color']);
  $fromCountry = $con->real_escape_string($_POST['fromCountry']);
  $certified = $con->real_escape_string($_POST['certified']);
  $describeCar = $_POST['describeCar'];
  $status = $con->real_escape_string($_POST['status']);

  $image = $_FILES['image']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];
  $image4 = $_FILES['image4']['name'];
  $image5 = $_FILES['image5']['name'];
  $image6 = $_FILES['image6']['name'];
  $image7 = $_FILES['image7']['name'];
  //Redenumire imagini
  $image_extension = pathinfo($image, PATHINFO_EXTENSION);
  $image_extension2 = pathinfo($image2, PATHINFO_EXTENSION);
  $image_extension3 = pathinfo($image3, PATHINFO_EXTENSION);
  $image_extension4 = pathinfo($image4, PATHINFO_EXTENSION);
  $image_extension5 = pathinfo($image5, PATHINFO_EXTENSION);
  $image_extension6 = pathinfo($image6, PATHINFO_EXTENSION);
  $image_extension7 = pathinfo($image7, PATHINFO_EXTENSION);
  $random= time();
  $filename = $random.'img1'.'.'.$image_extension;
  $filename2 = $random.'img2'.'.'.$image_extension2;
  $filename3 = $random.'img3'.'.'.$image_extension3;
  $filename4 = $random.'img4'.'.'.$image_extension4;
  $filename5 = $random.'img5'.'.'.$image_extension5;
  $filename6 = $random.'img6'.'.'.$image_extension6;
  $filename7 = $random.'img7'.'.'.$image_extension7;

  $query =("INSERT INTO cars (model,category_id,year,km,price,lastPrice,engine,fuel_type,color,fromCountry,certified,describeCar,status,image,image2,image3,image4,image5,image6,image7) VALUES 
                            ('$model', '$category_id', '$year', '$km', '$price', '$lastPrice', '$engine', '$fuel_type', '$color', '$fromCountry', '$certified', '$describeCar','$status','$filename','$filename2','$filename3','$filename4','$filename5','$filename6','$filename7')");
      
  $query_run = mysqli_query($con, $query);



  if($query_run)
  {  move_uploaded_file($_FILES['image']['tmp_name'], 'image/car/'.$filename);
    move_uploaded_file($_FILES['image2']['tmp_name'], 'image/car/'.$filename2);
    move_uploaded_file($_FILES['image3']['tmp_name'], 'image/car/'.$filename3);
    move_uploaded_file($_FILES['image4']['tmp_name'], 'image/car/'.$filename4);
    move_uploaded_file($_FILES['image5']['tmp_name'], 'image/car/'.$filename5);
    move_uploaded_file($_FILES['image6']['tmp_name'], 'image/car/'.$filename6);
    move_uploaded_file($_FILES['image7']['tmp_name'], 'image/car/'.$filename7);
     $_SESSION['message']= "Vehiculul $model a fost adaugat cu succes!";
     if($status == 'Rezervat'){
      header('Location: vehicle-view-reserved.php');
     }  
     if($status == 'Vandut'){
      header('Location: vehicle-view-vandut.php');
    }  
    if($status == 'Disponibil'){
      header('Location: vehicle-view.php');
    }  
     
      exit(0);
  }else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: vehicle-view.php');
      exit(0);
  }

}




// Editare informatii vehicule
if(isset($_POST['vehicle_edit_informatii'])){
  $id = $_POST['id_car']; 
  $model = $con->real_escape_string($_POST['model']);
  $category_id = $con->real_escape_string($_POST['category_id']);
  $year = $con->real_escape_string($_POST['year']);
  $km = $con->real_escape_string($_POST['km']);
  $price = $con->real_escape_string($_POST['price']);
  $lastPrice = $con->real_escape_string($_POST['lastPrice']);
  $engine = $con->real_escape_string($_POST['engine']);
  $fuel_type = $con->real_escape_string($_POST['fuel_type']);
  $color = $con->real_escape_string($_POST['color']);
  $fromCountry = $con->real_escape_string($_POST['fromCountry']);
  $certified = $con->real_escape_string($_POST['certified']);
  $describeCar = $_POST['describeCar'];
  $status = $con->real_escape_string($_POST['status']);
    if($category_id != NULL){
      $queryUpdate = ("UPDATE cars SET model='$model', category_id='$category_id', year='$year', km='$km', price='$price', lastPrice='$lastPrice', engine='$engine',
      fuel_type='$fuel_type', color='$color', fromCountry='$fromCountry', certified='$certified', describeCar='$describeCar', status='$status'
      WHERE id_car='$id' ");
    }else{
      $queryUpdate = ("UPDATE cars SET model='$model', year='$year', km='$km', price='$price', lastPrice='$lastPrice', engine='$engine',
      fuel_type='$fuel_type', color='$color', fromCountry='$fromCountry', certified='$certified', describeCar='$describeCar', status='$status'
      WHERE id_car='$id' ");
    }
      
                
        $query_run = mysqli_query($con, $queryUpdate);
            
        if($query_run > '0')
            { 
              $_SESSION['message']= "Modificarea pentru $model efectuata cu succes!";
              if($status == 'Rezervat'){
                header('Location: vehicle-view-reserved.php');
              }
              if($status == 'Disponibil'){
                header('Location: vehicle-view.php');
              }
              if($status == 'Vandut'){
                header('Location: vehicle-view-vandut.php');
              }
                  
                exit(0);
            }
            else{ $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: vehicle-view.php');
            exit(0);
          }
          


}


// Editare imagini vehicule
if(isset($_POST['vehicle_edit_imagini'])){
  $id = $_POST['id_car']; 
  $status = $_POST['status']; 
  $image = $_FILES['image']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];
  $image4 = $_FILES['image4']['name'];
  $image5 = $_FILES['image5']['name'];
  $image6 = $_FILES['image6']['name'];
  $image7 = $_FILES['image7']['name'];
  // Redenumire imagini
  $image_extension = pathinfo($image, PATHINFO_EXTENSION);
  $image_extension2 = pathinfo($image2, PATHINFO_EXTENSION);
  $image_extension3 = pathinfo($image3, PATHINFO_EXTENSION);
  $image_extension4 = pathinfo($image4, PATHINFO_EXTENSION);
  $image_extension5 = pathinfo($image5, PATHINFO_EXTENSION);
  $image_extension6 = pathinfo($image6, PATHINFO_EXTENSION);
  $image_extension7 = pathinfo($image7, PATHINFO_EXTENSION);
$old_image = $_POST['old_image'];
$old_image2 = $_POST['old_image2'];
$old_image3 = $_POST['old_image3'];
$old_image4 = $_POST['old_image4'];
$old_image5 = $_POST['old_image5'];
$old_image6 = $_POST['old_image6'];
$old_image7 = $_POST['old_image7'];
$random= time();
$filename = $random.'img1'.'.'.$image_extension;
$filename2 = $random.'img2'.'.'.$image_extension2;
$filename3 = $random.'img3'.'.'.$image_extension3;
$filename4 = $random.'img4'.'.'.$image_extension4;
$filename5 = $random.'img5'.'.'.$image_extension5;
$filename6 = $random.'img6'.'.'.$image_extension6;
$filename7 = $random.'img7'.'.'.$image_extension7;

  //Redenumire imagini
  

 
    if($image != NULL){
      $queryUpdate = ("UPDATE cars SET image='$filename' WHERE id_car='$id' ");
      $query_run1 = mysqli_query($con, $queryUpdate);
      if(file_exists('image/car/'.$old_image)){
        unlink("image/car/".$old_image);
      }
      move_uploaded_file($_FILES['image']['tmp_name'], 'image/car/'.$filename);
    }

    if($image2 != NULL){
      $queryUpdate2 = ("UPDATE cars SET image2='$filename2' WHERE id_car='$id' ");
      $query_run2 = mysqli_query($con, $queryUpdate2);
      if(file_exists('image/car/'.$old_image2)){
        unlink("image/car/".$old_image2);
      }
      move_uploaded_file($_FILES['image2']['tmp_name'], 'image/car/'.$filename2);
    }

    if($image3 != NULL){
      $queryUpdate3 = ("UPDATE cars SET image3='$filename3' WHERE id_car='$id' ");
      $query_run3 = mysqli_query($con, $queryUpdate3);
      if(file_exists('image/car/'.$old_image3)){
        unlink("image/car/".$old_image3);
      }
      move_uploaded_file($_FILES['image3']['tmp_name'], 'image/car/'.$filename3);
    }

    if($image4 != NULL){
      $queryUpdate4 = ("UPDATE cars SET image4='$filename4' WHERE id_car='$id' ");
      $query_run4 = mysqli_query($con, $queryUpdate4);
      if(file_exists('image/car/'.$old_image4)){
        unlink("image/car/".$old_image4);
      }
      move_uploaded_file($_FILES['image4']['tmp_name'], 'image/car/'.$filename4);
    }


    if($image5 != NULL){
      $queryUpdate5 = ("UPDATE cars SET image5='$filename5' WHERE id_car='$id' ");
      $query_run5 = mysqli_query($con, $queryUpdate5);
      if(file_exists('image/car/'.$old_image5)){
        unlink("image/car/".$old_image5);
      }
      move_uploaded_file($_FILES['image5']['tmp_name'], 'image/car/'.$filename5);
    }


    if($image6 != NULL){
      $queryUpdate6 = ("UPDATE cars SET image6='$filename6' WHERE id_car='$id' ");
      $query_run6 = mysqli_query($con, $queryUpdate6);
      if(file_exists('image/car/'.$old_image6)){
        unlink("image/car/".$old_image6);
      }
      move_uploaded_file($_FILES['image6']['tmp_name'], 'image/car/'.$filename6);
    }


    if($image7 != NULL){
      $queryUpdate7 = ("UPDATE cars SET image7='$filename7' WHERE id_car='$id' ");
      $query_run6 = mysqli_query($con, $queryUpdate7);
      if(file_exists('image/car/'.$old_image7)){
        unlink("image/car/".$old_image7);
      }
      move_uploaded_file($_FILES['image7']['tmp_name'], 'image/car/'.$filename7);
    }
              
              $_SESSION['message']= "Pozele pentru masina $id au fost modificate cu succes!";
              if($status == 'Rezervat'){
                header('Location: vehicle-view-reserved.php');
              }
              if($status == 'Disponibil'){
                header('Location: vehicle-view.php');
              }
              if($status == 'Vandut'){
                header('Location: vehicle-view-vandut.php');
              }
                  
                exit(0);
            
}




// Sterge masinile temporar
if(isset($_POST['car_delete_temporar'])){

  $id = $_POST['car_delete_temporar']; 

  $queryUpdate = ("UPDATE cars SET status='sters' WHERE id_car='$id' ");
  $query_run = mysqli_query($con, $queryUpdate);
  if($query_run > '0')
  { 
    $_SESSION['message']= "Masina a fost stearsa temporar!";
        header('Location: vehicle-view.php');
      exit(0);
  }
  else{ $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
    header('Location: vehicle-view.php');
  exit(0);
}

}


// Sterge masinile definitiv
if(isset($_POST['car_delete_definitiv'])){

  $id = $_POST['car_delete_definitiv']; 

  $queryUpdate = ("DELETE FROM cars WHERE id_car='$id' ");
  $query_run = mysqli_query($con, $queryUpdate);
  if($query_run > '0')
  { 
    $_SESSION['message']= "Masina $id a fost stearsa permanent!";
        header('Location: vehicle-deleted.php');
      exit(0);
  }
  else{ $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
    header('Location: vehicle-deleted.php');
  exit(0);
}

}


// Reda inapoi o masina stearsa temporar
if(isset($_POST['car_reda_inapoi'])){

  $id = $_POST['car_reda_inapoi']; 

  $queryUpdate = ("UPDATE cars SET status='Disponibil' WHERE id_car='$id' ");
  $query_run = mysqli_query($con, $queryUpdate);
  if($query_run > '0')
  { 
    $_SESSION['message']= "Masina $id a fost introdusa inapoi!";
        header('Location: vehicle-view.php');
      exit(0);
  }
  else{ $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
    header('Location: vehicle-view.php');
  exit(0);
}

}








// Editeaza rezervare
if(isset($_POST['rezervari_edit'])){
  $id_rezervare = $_POST['id_rezervare'];
  $id_car = $_POST['id_car'];
  $status= $_POST['status'];
  $inceput_rezervare = $_POST['data_inceput'];
  $sfarsit_rezervare = $_POST['data_sfarsit'];
  // adaugam o zi la data de sfarsit ca sa putem afla numarul de zile de rezervare (rezervarile sunt inclusiv ziua de inceput si de sfarsit)
  $sfarsit_rezervare_plus1zi = date('Y-m-d H:i:s', strtotime($sfarsit_rezervare . ' +1 day'));
  
  $date1 = new DateTime("$inceput_rezervare");
  $date2 = new DateTime("$sfarsit_rezervare_plus1zi");
  $interval = $date1->diff($date2);
  $interval->days;
  $days= $interval->days;
  $price = $days * 150;
          
  $query = ("UPDATE reservations SET data_inceput_rezervare='$inceput_rezervare', data_sfarsit_rezervare='$sfarsit_rezervare', price='$price',days='$days', status='$status' WHERE id_rezervare='$id_rezervare' ");
  if($status == 'Platit'){
  $query2 = ("UPDATE cars SET status='Rezervat' WHERE id_car='$id_car' ");
  }
  if($status == 'Neplatit'){
    $query2 = ("UPDATE cars SET status='Disponibil' WHERE id_car='$id_car' ");
    }
  $query_run = mysqli_query($con, $query);
  $query_run2 = mysqli_query($con, $query2);
  if($query_run)
  {  
     $_SESSION['message']= "Rezervarea $id_rezervare a fost editata cu succes!";
        header('Location: rezervari-view.php');
      exit(0);
   
}else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: rezervari-view.php');
      exit(0);
  }
  
}




// Editeaza achizitie
if(isset($_POST['achizitii_edit'])){
  $id_achizitie = $_POST['id_achizitie'];
  $id_car = $_POST['id_car'];
  $status= $_POST['status'];
     
  $query = ("UPDATE purchase SET  status='$status' WHERE id_achizitie='$id_achizitie' ");
  if($status == 'Platit'){
  $query2 = ("UPDATE cars SET status='Vandut' WHERE id_car='$id_car' ");
  }
  if($status == 'Neplatit'){
    $query2 = ("UPDATE cars SET status='Disponibil' WHERE id_car='$id_car' ");
    }
  $query_run = mysqli_query($con, $query);
  $query_run2 = mysqli_query($con, $query2);
  if($query_run)
  {  
     $_SESSION['message']= "Achizitia $id_achizitie a fost editata cu succes!";
        header('Location: achizitii-view.php');
      exit(0);
   
}else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: achizitii-view.php');
      exit(0);
  }
  
}





// Adaugare rezervare
if(isset($_POST['rezervare_add'])){

  $id_car = $_POST['id_car'];
  $id_user = $_POST['id_user'];
  $inceputRezervare = $_POST['data_inceput'];
  $zile= $_POST['zile'];
  $status = $_POST['status'];

  if($zile < 1 )
  {
      $zile = 1;
  }
$price = $zile * 150;
   // $sfarsitRezervare = $inceputRezervare + $zile - 1 pentru ca ziua initiala se considera rezervata ;
   $sfarsitRezervare = date('Y-m-d', strtotime($inceputRezervare . '+ '.$zile.'days'. '-'. '1 days'));
  $query =("INSERT INTO reservations (id_user,id_car,data_inceput_rezervare, data_sfarsit_rezervare, status, price,days) VALUES ('$id_user', '$id_car', '$inceputRezervare', '$sfarsitRezervare', '$status', '$price', '$zile')");
      if($status == 'Platit'){
        $queryUpdate = ("UPDATE cars SET  status='Rezervat' WHERE id_car='$id_car' ");
        $queryUpdate_run = mysqli_query($con, $queryUpdate);
      }
  $query_run = mysqli_query($con, $query);

            
  if($query_run)
  {  
     $_SESSION['message']= "Rezervare adaugata cu succes!";
        header('Location: rezervari-view.php');
      exit(0);
  }else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: rezervari-view.php');
      exit(0);
  }

}




// Adaugare achizitie
if(isset($_POST['achizitie_add'])){

  $id_car = $_POST['id_car'];
  $id_user = $_POST['id_user'];
  $status = $_POST['status'];
  $queryPrice = ("SELECT price FROM cars WHERE id_car = '$id_car'");
  $queryPrice_run = mysqli_query($con, $queryPrice);
  if(mysqli_num_rows($queryPrice_run)>0){
    foreach($queryPrice_run as $row){
      $price = $row['price'];
    }
  }
  $query =("INSERT INTO purchase (id_user,id_car, status, price) VALUES ('$id_user', '$id_car', '$status', '$price')");
      if($status == 'Platit'){
        $queryUpdate = ("UPDATE cars SET  status='Vandut' WHERE id_car='$id_car' ");
        $queryUpdate_run = mysqli_query($con, $queryUpdate);
      }
  $query_run = mysqli_query($con, $query);

            
  if($query_run)
  {  
     $_SESSION['message']= "Achizitie adaugata cu succes!";
        header('Location: achizitii-view.php');
      exit(0);
  }else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: achizitii-view.php');
      exit(0);
  }


}






// Stergere rezervare
if(isset($_POST['rezervari_delete'])){

  $id_rezervare = $_POST['rezervari_delete'];

  //Selectam statusul rezervarii pentru a putea modifica statusul masinii cand stergem o rezervare
  $queryStatus = "SELECT * FROM reservations WHERE id_rezervare='$id_rezervare'";
  $queryStatus_run = mysqli_query($con, $queryStatus);
  if(mysqli_num_rows($queryStatus_run)>0){
    foreach($queryStatus_run as $row){
      $status = $row['status'];
      $id_car = $row['id_car'];
    }
  }
// Daca rezervarea este platita si o stergem, masina va deveni disponibila
  if($status == 'Platit'){
    $queryUpdate = ("UPDATE cars SET  status='Disponibil' WHERE id_car='$id_car' ");
    $queryUpdate_run = mysqli_query($con, $queryUpdate);
  }

  $query = "DELETE FROM reservations WHERE id_rezervare='$id_rezervare' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Rezervarea '$id_rezervare' pentru masina cu ID '$id_car' a fost stearsa cu succes!";
              header('Location: rezervari-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: rezervari-view.php');
            exit(0);
        }


}





// Stergere achizitie
if(isset($_POST['achizitii_delete'])){

  $id_achizitie = $_POST['achizitii_delete'];

  //Selectam statusul rezervarii pentru a putea modifica statusul masinii cand stergem o rezervare
  $queryStatus = "SELECT * FROM purchase WHERE id_achizitie='$id_achizitie'";
  $queryStatus_run = mysqli_query($con, $queryStatus);
  if(mysqli_num_rows($queryStatus_run)>0){
    foreach($queryStatus_run as $row){
      $status = $row['status'];
      $id_car = $row['id_car'];
    }
  }
// Daca rezervarea este platita si o stergem, masina va deveni disponibila
  if($status == 'Platit'){
    $queryUpdate = ("UPDATE cars SET  status='Disponibil' WHERE id_car='$id_car' ");
    $queryUpdate_run = mysqli_query($con, $queryUpdate);
  }

  $query = "DELETE FROM purchase WHERE id_achizitie='$id_achizitie' ";

  $query_run = mysqli_query($con, $query);
            
        if($query_run)
        {   $_SESSION['message']= "Achizitia '$id_achizitie' pentru masina cu ID '$id_car' a fost stearsa cu succes!";
              header('Location: achizitii-view.php');
            exit(0);
        }else{
            $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
              header('Location: achizitii-view.php');
            exit(0);
        }


}





//Sterge masina de la favorite
if(isset($_POST['wishlist_delete'])){
  $id_wishlist = $_POST['wishlist_delete'];
  $query =("DELETE FROM wishlist WHERE id_wishlist='$id_wishlist'");
  $query_run = mysqli_query($con, $query);  
          if($query_run){
          $_SESSION['message']= "Masina a fost stearsa de la favorite cu succes!";
              header('Location: wishlist.php');
            exit(0);
        }

}



//Sterge comentariu
if(isset($_POST['comentariu_delete'])){
  $id_comentariu = $_POST['comentariu_delete'];
  $query =("DELETE FROM comments WHERE id_comentariu='$id_comentariu'");
  $query_run = mysqli_query($con, $query);  
          if($query_run){
          $_SESSION['message']= "Comentariul a fost sters cu succes!";
              header('Location: comentarii-view.php');
            exit(0);
        }else{
          $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
            header('Location: comentarii-view.php');
          exit(0);
      }

}




// Ascunde comentariu
if(isset($_POST['comentariu_ascunde'])){
  $id_comentariu = $_POST['comentariu_ascunde'];
    $query = ("UPDATE comments SET status='Ascuns' WHERE id_comentariu='$id_comentariu' ");
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {  
     $_SESSION['message']= "Comentariul $id_comentariu este acum ascuns!";
        header('Location: comentarii-view.php');
      exit(0);
   
}else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: comentarii-view.php');
      exit(0);
  }
  
}


// Arata comentariu
if(isset($_POST['comentariu_arata'])){
  $id_comentariu = $_POST['comentariu_arata'];
    $query = ("UPDATE comments SET status='Vizibil' WHERE id_comentariu='$id_comentariu' ");
  $query_run = mysqli_query($con, $query);

  if($query_run)
  {  
     $_SESSION['message']= "Comentariul $id_comentariu este acum afisat!";
        header('Location: comentarii-view.php');
      exit(0);
   
}else{
      $_SESSION['message']= "Ceva nu a functionat bine. Incearca din nou!";
        header('Location: comentarii-view.php');
      exit(0);
  }
  
}
?>