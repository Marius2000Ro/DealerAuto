<?php 
session_start(); 
include("includes/message.php");
include("admin/config/dbcon.php");
if(isset($_SESSION["id_achizitie"])){unset($_SESSION["id_achizitie"]);}
if(isset($_SESSION["id_rezervare"])){unset($_SESSION["id_rezervare"]);}

// Pe aceasta pagina au acces doar cei logati
if(isset($_SESSION["id"]))
{
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pagina plati</title>
    
        <link href="admin/css/styles.css" rel="stylesheet" />     
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

  
    </head>

<?php
// verificare daca data inceput rezervare nu este in trecut, daca este in trecut data rezervarii va fi data de astazi
if(isset($_POST['date_start'])){
    $inceputRezervare = $_POST['date_start'];
    date_default_timezone_set('Europe/Bucharest');
    $currentDate = date('Y-m-d', time());
    $astazi = date('d-m-Y', time());
    if($inceputRezervare < $currentDate){
        $_SESSION['message']= "Data aleasa de dumneavoastra a trecut deja. Rezervarea va incepe de astazi, <strong>$astazi</strong>!";
    $inceputRezervare = $currentDate;
    }

}

// Daca numarul de zile pentru care se face rezervarea este < 1, atunci nr zile = 1
if(isset($_POST['days'])){
    $days = $_POST['days'];
    if($days < 1 )
    {
      
        $_SESSION['message2']= "Numarul de zile '$days' pentru care se doreste rezervarea masinii este mai mic ca 1, rezervarea a fost setata pentru o zi!";
        $days = 1;
    }
    
    
}









// Daca se rezerva o masina
if(isset($_POST['rezervare'])){
    // $sfarsitRezervare = $inceputRezervare + $days - 1 pentru ca ziua initiala se considera rezervata ;
    $sfarsitRezervare = date('Y-m-d', strtotime($inceputRezervare . '+ '.$days.'days'. '-'. '1 days'));
    // Verificam daca data aleasa este disponibila
    $id_car =  $_POST['id_car'];
    $querySelect = "SELECT * FROM reservations WHERE ((data_inceput_rezervare <='$inceputRezervare' OR data_inceput_rezervare <= '$sfarsitRezervare') AND  (data_sfarsit_rezervare >='$sfarsitRezervare' OR data_sfarsit_rezervare>='$inceputRezervare'))  AND id_car = '$id_car' AND status='Platit'";
    $query_runSelect = mysqli_query($con, $querySelect);
    
    $gasit = 0;
    // Daca gaseste o inregistrare deja la data aleasa ne duce pe pagina anterioara
    if(mysqli_num_rows($query_runSelect) > 0){
        // daca gasim gasit devine 1
        $gasit = 1;
        $_SESSION['message']= "Exista deja o rezervare intre <strong>$inceputRezervare</strong> si <strong>$sfarsitRezervare</strong>!";
        header("Location: modelspecific.php?id=".$id_car."&error");
    }
    // daca gasit este diferit de 1, facem rezervarea
    if($gasit != 1){
    $id_user = $_SESSION['id'];
    $id_car =  $_POST['id_car'];
    $status = "Neplatit";
    // inmultim cu 100 ca sa afiseze pretul corect pe stripe 
    $price = $days * 100;
    $priceStripe = $days * 100 * 100;
    $query = ("INSERT INTO reservations(id_user,id_car,data_inceput_rezervare,data_sfarsit_rezervare,status,price,days) VALUES ('$id_user','$id_car','$inceputRezervare','$sfarsitRezervare','$status','$price','$days')");

    $query_run = mysqli_query($con, $query);
    date_default_timezone_set('Europe/Bucharest');
    $dataCurenta = date('Y-m-d H:i:s', time());
    
    $query2 = ("SELECT id_rezervare FROM reservations WHERE id_user='$id_user' AND id_car='$id_car' AND data_inceput_rezervare='$inceputRezervare' AND data_sfarsit_rezervare='$sfarsitRezervare' AND status='$status' AND price='$price' AND data_efectuare_rezervare='$dataCurenta'");

    $query_run2 = mysqli_query($con, $query2);
    if ($query_run2->num_rows > 0) {
        while($row = $query_run2->fetch_assoc()) {
           $id_rezervare= $row["id_rezervare"];
          
          }
          $_SESSION['id_rezervare'] = "$id_rezervare";
    }
   
    ?>     
    
    <?php   
$query = ("SELECT * FROM cars WHERE id_car='$id_car' ");
$query2 = ("SELECT * FROM users WHERE id_user='$id_user' ");

$query_run = mysqli_query($con, $query);
if ($query_run->num_rows > 0) {
    while($row = $query_run->fetch_assoc()) {
       $image= $row["image"];
       $model= $row["model"];
       $engine= $row["engine"];
       $fuel_type= $row["fuel_type"];
       $km= $row["km"];
       $color= $row["color"];
       $priceCar= $row["price"];
      }   
}

$query_run2 = mysqli_query($con, $query2);
if ($query_run2->num_rows > 0) {
    while($row2 = $query_run2->fetch_assoc()) {
       $firstName= $row2["firstName"];
       $lastName= $row2["lastName"];
       $email= $row2["email"];
       $age= $row2["age"];
       $phone= $row2["phone"];
      }   
}
?>     

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/checkoutstyle.css?version8">

<!--For Page-->
<div class="bg">
    <!--For Row containing all card-->
    <div class="row mainRow">
        <!--Card 1-->
        <div class="col-sm-8">
            <div class="card card-cascade wider shadow p-3 mb-5 ">
                <!--Card image-->
                <div class="view view-cascade overlay text-center"> <img class="card-img-top" src="admin/image/car/<?= $image ?>" alt=""> <a>
                        <div class="mask rgba-white-slight"></div>
                    </a> </div>
                <!--Product Description-->
                <div class="desc">
                    <!-- 1st Row for title-->
                    <div class="row subRow">
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Model</p>
                            <p class="row2"><?= $model ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Km</p>
                            <p class="row2"><?= $km ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Motor</p>
                            <p class="row2"><?= $engine ?></p>
                        </div>
                    </div> <!-- 2nd Row for title-->
                    <div class="row subRow">
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Combustibil</p>
                            <p class="row2"><?= $fuel_type ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Culoare</p>
                            <p class="row2"><?= $color ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Pret</p>
                            <p class="row2 text-success"><?= $priceCar ?>€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Card 2-->
        <div class="col-sm-4">
            <div class="card card-cascade card-ecommerce wider shadow p-3 mb-5 ">
                
                <!--Card Body-->
                <div class="card-body card-body-cascade">
                     <!-- Buton cancel rezervare -->
                 <form action="actiuneButoane.php" method="POST" class="text-center">
                 <button type="submit" name="cancel-reservation" value="<?= $id_rezervare ?>" class="btn btn-danger">Anuleaza rezervare</button>
                    </form>
                    <!--Card Description-->
                    <div class="card2decs">
                        <p class="heading1"><strong><?= $model ?></strong></p>
                        <p class="quantity">Inceput rezervare<span class="float-right text1"><?php  $inceputRezervare = date("d-m-Y", strtotime($inceputRezervare));echo "$inceputRezervare";?></span></p>
                        <p class="subtotal">Sfarsit rezervare<span class="float-right text1"><?php  $sfarsitRezervare = date("d-m-Y", strtotime($sfarsitRezervare)); echo "$sfarsitRezervare";?></span></p>
                        <p class="shipping">Numar zile rezervare<span class="float-right text1"><?= $days?></span></p>
                        <p class="promocode">Pret rezervare pe zi<span class="float-right text1">100 Lei</span></p>
                        <p class="total"><strong>Total</strong><span class="float-right totalText1"><span class="totalText2"><?= $price?> Lei</span></span></p>
                    </div>
                    <div class="payment">
                        <p class="heading2"><strong>Detalii plata</strong></p>
                        <p class="cardAndExpire">Nume complet<span class="float-right">Varsta</span></p>
                        <p class="cardAndExpireValue"><?= $firstName ?> <?= $lastName ?><span class="float-right"><?= $age ?> ani</span></p>
                        <p class="nameAndcvc" style="margin-bottom:-10px;">Email<span class="float-right">Telefon</span></p>
                        <p class="nameAndcvcValue"><?= $email ?><span class="float-right">0<?= $phone ?></span></p>

                              <!-- Plata cu platforma stripe -->
                <form action="confirmation.php?id_rezervare=<?=$id_rezervare?>" method="POST" id="finalForm" class="text-center ">
                        <script src="//checkout.stripe.com/v2/checkout.js" class="stripe-button"
                            data-key="pk_test_51KS6hlG9xVZzyAjOtfNO6rrxVWxtsewwhfv53YrEvhIezTHeYwJpdG7IIe53dUU9iIl9cZdkmD7F8ZuoaDZM4ABn006S66ilK9"
                            data-amount="<?= $priceStripe ?>" data-currency="ron" data-name="Marius Dealer Auto"
                            data-description="Plateste si finalizeaza rezervarea" data-locale="auto" data-label="REZERVA">
                        </script>
                </form>
                <!-- Sfarsit plata cu platforma stripe -->
                    </div>
               
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



    <?php
}
}















// Daca se achitioneaza o masina
if(isset($_POST['achizitie'])){
    $id_user = $_SESSION['id'];
    $id_car =  $_POST['id_car'];
    $price =  $_POST['price'];
    $status = "Neplatit";
    // inmultim cu 100 ca sa afiseze pretul corect pe stripe si convertim din euro in lei
    $priceStripe = $price * 100;
    $query = ("INSERT INTO purchase(id_user,id_car,status,price) VALUES ('$id_user','$id_car','$status','$price')");

    $query_run = mysqli_query($con, $query);
    date_default_timezone_set('Europe/Bucharest');
    $dataCurenta = date('Y-m-d H:i:s', time());
    
    $query2 = ("SELECT id_achizitie FROM purchase WHERE id_user='$id_user' AND id_car='$id_car' AND status='$status' AND price='$price' AND data_efectuare_achizitie='$dataCurenta'");

    $query_run2 = mysqli_query($con, $query2);
    if ($query_run2->num_rows > 0) {
        while($row = $query_run2->fetch_assoc()) {
           $id_achizitie= $row["id_achizitie"];
          }
          $_SESSION['id_achizitie'] = "$id_achizitie";
    }
   
    ?>     

<?php   
$query = ("SELECT * FROM cars WHERE id_car='$id_car' ");
$query2 = ("SELECT * FROM users WHERE id_user='$id_user' ");

$query_run = mysqli_query($con, $query);
if ($query_run->num_rows > 0) {
    while($row = $query_run->fetch_assoc()) {
       $image= $row["image"];
       $model= $row["model"];
       $engine= $row["engine"];
       $fuel_type= $row["fuel_type"];
       $km= $row["km"];
       $color= $row["color"];
       $price= $row["price"];
      }   
}

$query_run2 = mysqli_query($con, $query2);
if ($query_run2->num_rows > 0) {
    while($row2 = $query_run2->fetch_assoc()) {
       $firstName= $row2["firstName"];
       $lastName= $row2["lastName"];
       $email= $row2["email"];
       $age= $row2["age"];
       $phone= $row2["phone"];
      }   
}
?>     

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/checkoutstyle.css?version5">

<!--For Page-->
<div class="bg">
    <!--For Row containing all card-->
    <div class="row mainRow">
        <!--Card 1-->
        <div class="col-sm-8">
            <div class="card card-cascade wider shadow p-3 mb-5 ">
                <!--Card image-->
                <div class="view view-cascade overlay text-center"> <img class="card-img-top" src="admin/image/car/<?= $image ?>" alt=""> <a>
                        <div class="mask rgba-white-slight"></div>
                    </a> </div>
                <!--Product Description-->
                <div class="desc">
                    <!-- 1st Row for title-->
                    <div class="row subRow">
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Model</p>
                            <p class="row2"><?= $model ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Km</p>
                            <p class="row2"><?= $km ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Motor</p>
                            <p class="row2"><?= $engine ?></p>
                        </div>
                    </div> <!-- 2nd Row for title-->
                    <div class="row subRow">
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Combustibil</p>
                            <p class="row2"><?= $fuel_type ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Culoare</p>
                            <p class="row2"><?= $color ?></p>
                        </div>
                        <!--Column for Data-->
                        <div class="col">
                            <p class="text-muted row1">Pret</p>
                            <p class="row2 text-success"><?= $price ?>€</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Card 2-->
        <div class="col-sm-4">
            <div class="card card-cascade card-ecommerce wider shadow p-3 mb-5 ">
                <!--Card Body-->
                <div class="card-body card-body-cascade">
                    <!-- Buton cancel achizitie -->
                    <form action="actiuneButoane.php" method="POST" class="text-center">
                 <button type="submit" name="cancel-purchase" value="<?= $id_achizitie ?>" class="btn btn-danger">Anuleaza achizitie</button>
                    </form>
                    <!--Card Description-->
                    <div class="card2decs">
                        <p class="heading1"><strong><?= $model ?></strong></p>
                        <p class="quantity">Data achizitie<span class="float-right text1"><?php $dataCurenta = date("d-m-Y H:i:s", strtotime($dataCurenta)); echo"$dataCurenta";?></span></p>
                        <p class="promocode">Pret<span class="float-right text1"><?= $price ?> €</span></p>
                        <p class="total"><strong>Total</strong><span class="float-right totalText1"><span class="totalText2"><?= $price ?> €</span></span></p>
                    </div>
                    <div class="payment">
                        <p class="heading2"><strong>Detalii plata</strong></p>
                        <p class="cardAndExpire">Nume complet<span class="float-right">Varsta</span></p>
                        <p class="cardAndExpireValue"><?= $firstName ?> <?= $lastName ?><span class="float-right"><?= $age ?> ani</span></p>
                        <p class="nameAndcvc" style="margin-bottom:-10px;">Email<span class="float-right">Telefon</span></p>
                        <p class="nameAndcvcValue"><?= $email ?><span class="float-right">0<?= $phone ?></span></p>

                          <!-- Plata cu platforma stripe pentru achizitie in euro -->
                    <form action="confirmation.php?id_achizitie=<?=$id_achizitie?>" method="POST" id="finalForm" class="text-center">
                         <script src="//checkout.stripe.com/v2/checkout.js" class="stripe-button"
                               data-key="pk_test_51KS6hlG9xVZzyAjOtfNO6rrxVWxtsewwhfv53YrEvhIezTHeYwJpdG7IIe53dUU9iIl9cZdkmD7F8ZuoaDZM4ABn006S66ilK9"
                               data-amount="<?= $priceStripe ?>" data-currency="eur" data-name="Marius Dealer Auto"
                               data-description="Plateste si finalizeaza achizitia" data-locale="auto" data-label="Achiztioneaza">
                         </script>
                    </form>
                    <!-- Sfarsit plata cu platforma stripe -->
                    
                    </div>
               
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>




<?php
}

}else{
    header('Location: login.php');
}
?>













<body>


</body>
</html>





