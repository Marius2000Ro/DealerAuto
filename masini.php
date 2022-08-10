
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/masinistyle.css?version16">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php 
include("includes/meniu.php");
include('admin/config/dbcon.php');
include('includes/message.php'); 
if(isset($_SESSION["id_achizitie"])){unset($_SESSION["id_achizitie"]);}
if(isset($_SESSION["id_rezervare"])){unset($_SESSION["id_rezervare"]);}

?>




<!-- Inceput sectiune vehicule-->
<section class="vehicule" id="vehicule">

        <h1 class="heading"> <span>Masinile </span>noastre</h1>
   
       
<form autocomplete="off" action="" method="GET">
        <div class="row">
                <div class="col-xs-6 ">
                    <h3>Introdu numele masinii</h3>
                    <input id="myInput" type="text" name="nume" value="<?php if(isset($_GET['nume'])){echo $_GET['nume'];} ?>" class="form-control" required placeholder="Nume vehicul"> 

                </div>

                <div class="col-xs-6">
                    <h3>Pretul minim</h3>
                    <input type="number" name="pret_min" value="<?php if(isset($_GET['pret_min'])){echo $_GET['pret_min'];}else{echo "0";} ?>" class="form-control" required>

                </div>

                <div class="col-xs-6">
                    <h3>Pretul maxim</h3>
                    <input type="number" name="pret_max" value="<?php if(isset($_GET['pret_max'])){echo $_GET['pret_max'];}else{echo "999999";} ?>" class="form-control"required>

                </div>

                <div class="col-xs-4">
                    <button type="submit" class="btnFiltreaza">Cauta</button>

                </div>


        </div>
        </form>
        <?php if(isset($_GET['nume']) && isset($_GET['pret_min']) && isset($_GET['pret_max'])){ ?>
            
                        <input type="submit" class="btn btn-primary px-4"value="Afiseaza toate masinile" 
    onclick="window.location='masini.php';" /> 
                        <?php } ?>
                      
</section>
      

<!-- Sfarsit sectiune vehicule-->

<body>
<?php
if(ISSET($_GET['id_category'])){
    $category_id = $_GET['id_category'];
    $query = $con->query("SELECT * FROM category WHERE id_category = '$category_id'");
    $row = $query->fetch_assoc();
 
?>
    <h1>Categoria <?= $row['name']; ?> </h1>s
    <?php  }
    // Schimbam statusul in disponibil daca astazi nu este nicio rezervare
    date_default_timezone_set('Europe/Bucharest');
    $today = date('Y-m-d');
    //Selectam masinile care sunt rezervate astazi
    $querySelectReserved = "SELECT cars.id_car AS id_car, reservations.data_sfarsit_rezervare AS data_sfarsit_rezervare FROM cars INNER JOIN reservations ON cars.id_car = reservations.id_car  WHERE reservations.id_car = cars.id_car AND reservations.status = 'Platit' 
    AND (reservations.data_inceput_rezervare <='$today' AND reservations.data_sfarsit_rezervare >= '$today' )";
    $query_run = mysqli_query($con, $querySelectReserved);
    // Facem toate masinile disonibile
    $queryUpdateDisponibil = "UPDATE cars SET status='Disponibil' WHERE status !='sters' AND status !='Vandut'";
    $query_run3 = mysqli_query($con, $queryUpdateDisponibil);
    if(mysqli_num_rows($query_run) > 0){
while($data = mysqli_fetch_array($query_run))
{
    $id_car = $data['id_car'];
    // Masinile rezervate astazi le facem rezervate
    $queryUpdateRezervat = "UPDATE cars SET status='Rezervat' WHERE id_car = '$id_car' AND status !='Vandut' AND status !='sters'";
    $query_run2 = mysqli_query($con, $queryUpdateRezervat);


}
 
    }
?>

<script>
 // Adaugam intr-un array toate modelele din baza de date
  var countries = [
<?php
      $result = mysqli_query($con, "SELECT DISTINCT model FROM cars");
  
  if(mysqli_num_rows($result) > 0){
  while($data = mysqli_fetch_array($result))  
  {  
    $model = $data["model"];
    echo "'$model',";
  }
}
    ?>
    ];
</script>
<!-- // Scriptul pentru search model -->
<script src="js/scriptSearchModel.js?version7"></script>


<div class="row cars-container">

    <?php

if(ISSET($_GET['id_category'])){
    $category_id = $_GET['id_category'];
    $result = mysqli_query($con, "SELECT * FROM cars WHERE status !='sters' AND status !='Vandut' AND category_id='$category_id'");
}else{if(isset($_GET['nume']) && isset($_GET['pret_min']) && isset($_GET['pret_max'])){
    $nume = $_GET['nume'];
    $pret_min = $_GET['pret_min'];
    $pret_max = $_GET['pret_max'];
    $result = mysqli_query($con, "SELECT * FROM cars WHERE status !='sters' AND status !='Vandut' AND model LIKE '%$nume%' AND price>='$pret_min' AND price <='$pret_max'");
}else{
    $result = mysqli_query($con, "SELECT * FROM cars WHERE status !='sters' AND status !='Vandut'");
}
}
if(mysqli_num_rows($result) > 0){
while($data = mysqli_fetch_array($result))
{  
   ?> 
   <div class="cars col-sm-3">
     
       <a href="modelspecific.php?id=<?= $data['id_car']; ?>" style="text-decoration:none!important">
        <div class="card">
            <div class="imaginedatabase"><img src="admin/image/car/<?php echo $data['image']; ?>"width="200" height="200"> </div>
            
            <h2 class="model"><i class="fas fa-car"></i> <?php echo $data['model']; ?></h2>
            <p class="price"><i class="fas fa-euro-sign"></i> Pret: <?php echo $data['price']; ?>$</p>
            <p><i class="fa fa-calendar" aria-hidden="true"></i> An: <?php echo $data['year']; ?></p>
            <p> <i class="fas fa-tachometer-alt"></i> Kilometraj: <?php echo $data['km']; ?></p>
            <p> Motor: <?php echo $data['engine']; ?></p>
            <p> <i class='fas fa-gas-pump'></i> Combustibil: <?php echo $data['fuel_type']; ?></p>
            <p class="descriere"><?php if($data['status'] == 'Rezervat'){echo "Rezervat";}elseif($data['status'] == 'Disponibil'){echo "Disponibil astazi";} ?></p>
            <?php
            if(isset($_SESSION["loggedin"]) AND !$_SESSION["administrator"]){
                $id_user = $_SESSION['id'];
                $id_car=  $data['id_car'];
                $queryWish =("SELECT id_wishlist FROM wishlist WHERE id_car='$id_car' AND id_user='$id_user'");
                $query_run2 = mysqli_query($con, $queryWish);
                if(mysqli_num_rows($query_run2)==0){
            ?>
            <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
            <input type="hidden" name="from" value="masini">
            <button type="submit" name="wishlist_add" class="btnsuccess">Adauga la favorite</button>
            </form>
            <?php }else{ ?>
                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
                    <input type="hidden" name="from" value="masini">
                    <button type="submit" name="wishlist_delete" class="btnwarning">Sterge de la favorite</button>
                    </form>

           <?php }} ?>
        </div>
        </a>
</div>
    <?php
}
}else{ ?> <h1> Niciun autovehicul gasit. </h1> <?php }
?>

</div>
</body>
<?php include ("includes/footer.php"); ?>
<!-- Coloreaza cu verde daca e diponibila masina si rosu daca nu e disponibila -->
<script src="js/script.js?version12"></script>
    <script>
        $(document).ready(function() {
            $(".descriere").each(function(){
                if($(this).text().toLowerCase() == "disponibil astazi".toLowerCase()){
                    $(this).addClass("descriere-verde");
                }else{
                    $(this).addClass("descriere-rosie");
                }
            });
        })
    </script>
    
</html>





