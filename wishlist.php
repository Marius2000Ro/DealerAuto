<?php
session_start();
if(!isset($_SESSION['loggedin'])){ 
    header('Location: login.php');
    }
session_abort();
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/masinistyle.css?version13">
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
        <h1 class="heading"> <span>Masini </span>favorite</h1>                 
</section>
      

<!-- Sfarsit sectiune vehicule-->

<body>


<div class="row cars-container">

    <?php
    // SELECTAM DIN WISHLIST FAVROITELE PENTRU FIECARE USER SI DETALIILE MASINILOR
     $id_user = $_SESSION['id'];
    $result = mysqli_query($con, "SELECT cars.model AS model,cars.price AS price, cars.year AS year, cars.km AS km, cars.engine AS engine, cars.fuel_type AS fuel_type, cars.status AS status, cars.image AS image,cars.id_car AS id_car,
    wishlist.* FROM cars, wishlist WHERE wishlist.id_user = '$id_user' AND wishlist.id_car = cars.id_car AND cars.status !='sters' AND cars.status !='Vandut'");

if(mysqli_num_rows($result) > 0){
while($data = mysqli_fetch_array($result))
{  
   ?> 
   <div class="cars col-sm-3">
     
       <a href="modelspecific.php?id=<?= $data['id_car']; ?>" style="text-decoration:none!important">
        <div class="card">
            <h2>Adaugat la data: <strong><?php $data_adaugare=$data['data_adaugare'];  $data_adaugare = date("d-m-Y H:i", strtotime($data_adaugare)); echo $data_adaugare;?></strong></h2>
            <div class="imaginedatabase"><img src="admin/image/car/<?php echo $data['image']; ?>"width="200" height="200"> </div>
            
            <h2 class="model"><i class="fas fa-car"></i> <?php echo $data['model']; ?></h2>
            <p class="price"><i class="fas fa-euro-sign"></i> Pret: <?php echo $data['price']; ?>$</p>
            <p><i class="fa fa-calendar" aria-hidden="true"></i> An: <?php echo $data['year']; ?></p>
            <p> <i class="fas fa-tachometer-alt"></i> Kilometraj: <?php echo $data['km']; ?></p>
            <p> Motor: <?php echo $data['engine']; ?></p>
            <p> <i class='fas fa-gas-pump'></i> Combustibil: <?php echo $data['fuel_type']; ?></p>
            <p class="descriere"><?php if($data['status'] == 'Rezervat'){echo "Rezervat";}elseif($data['status'] == 'Disponibil'){echo "Disponibil astazi";} ?></p>
            <?php
            if(isset($_SESSION["loggedin"])){
                // Daca suntem logati afisam masinile favorite
                $id_user = $_SESSION['id'];
                $id_car=  $data['id_car'];
                $queryWish =("SELECT id_wishlist FROM wishlist WHERE id_car='$id_car' AND id_user='$id_user'");
                $query_run2 = mysqli_query($con, $queryWish);
                if(mysqli_num_rows($query_run2)==0){
            ?>
            <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
            <button type="submit" name="wishlist_add" class="btnsuccess">Adauga la favorite</button>
            </form>
            <?php }else{ ?>
                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
                    <input type="hidden" name="from" value="wishlist">
                    <button type="submit" name="wishlist_delete" class="btnwarning">Sterge de la favorite</button>
                    </form>

           <?php }} ?>
        </div>
        </a>
</div>
    <?php
}
}else{ ?> <h1> Niciun vehicul adaugat la favorite. </h1> <?php }
?>

</div>
</body>
<?php include ("includes/footer.php"); ?>
<!-- Coloreaza cu verde daca e diponibila masina si rosu daca nu e disponibila -->
<script src="js/script.js?version5"></script>
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