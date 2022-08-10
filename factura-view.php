<?php
session_start();
include("includes/message.php");
include("admin/config/dbcon.php");









// Pentru a vedea factura daca este o achizitie
if(isset($_GET["id_achizitie"])){
    $id_get = $_GET["id_achizitie"];
    $id_achizitie = $_POST['id_achizitie'];
    $id_car = $_POST['id_car'];
    $status = $_POST['status'];
    // Daca id-ul din get cu id-ul din POST sunt egale atunci aratam factura (sa nu poate modifica utilizatorul si sa vada alta factura), altfel daca 
    // daca utilizatorul modifica ceva, il redirectionam pe pagina de profil
    if($id_get ==  $id_achizitie){
  
$id_user = $_SESSION['id'];

 // selectam toate datele de la rezervarea curenta
 $query2 = ("SELECT * FROM purchase WHERE id_user='$id_user' AND id_achizitie='$id_achizitie' ");   
    
 $query_run2 = mysqli_query($con, $query2);

if ($query_run2->num_rows > 0) {
    while($row = $query_run2->fetch_assoc()) {
       $id_car= $row["id_car"];
       $data_efectuare_achizitie = $row["data_efectuare_achizitie"];
       $data_efectuare_achizitie = date("d-m-Y H:s", strtotime($data_efectuare_achizitie));
       $price= $row["price"];

      }
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



<?php   
// Design achizitie
include("includes/message.php");
include("admin/config/dbcon.php");
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
       $pricecar= $row["price"];
       $year= $row["year"];
      }   
}

$query_run2 = mysqli_query($con, $query2);
if ($query_run2->num_rows > 0) {
    while($row2 = $query_run2->fetch_assoc()) {
       $firstName= $row2["firstName"];
       $lastName= $row2["lastName"];
       $email= $row2["email"];
       $adress= $row2["adress"];
       $phone= $row2["phone"];

      }   
}
?>

<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Factura achizitie &gt;&gt; <strong>ID: <?= $id_achizitie; ?></strong></p>
          <a class="btn btn-danger" href="achizitiiprofil.php" role="button">Inapoi</a>
          
        </div>
      </div>
      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
            <p class="pt-2 fw-bold h2">Marius Dealer Auto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Catre: <span style="color:#8f8061 ;"><?= $firstName?> <?= $lastName?></span></li>
              <li class="text-muted"><?= $email?></li>
              <li class="text-muted"><?= $adress?></li>
              <li class="text-muted"><i class="fas fa-phone"></i>0<?= $phone?></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Factura achizitie</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                  class="fw-bold">ID:</span>#<?= $id_achizitie; ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                  class="fw-bold">Data: </span><?= $data_efectuare_achizitie; ?></li>
                  <?php 
                  //daca statusul este platit
                  if($status == 'Platit'){
                  ?>
              <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                  class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                  Platit</span></li>
                  <?php }else{?>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                  Neplatit</span></li>

                    <?php }?>
            </ul>
          </div>
        </div>
        <div class="row my-2 mx-1 justify-content-center">
          <div class="col-md-2 mb-4 mb-md-0">
            <div class="
                        bg-image
                        ripple
                        rounded-5
                        mb-4
                        overflow-hidden
                        d-block
                        " data-ripple-color="light">
              <img src="admin/image/car/<?= $image; ?>" class="w-100"
                height="100px" alt="Imagine masina" />
              <a href="#!">
                <div class="hover-overlay">
                  <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-4 mb-md-0">
            <p class="fw-bold"><?= $model; ?></p>
            <p class="mb-1">
              <span class="text-muted me-2">Culoare:</span><span><?= $color?></span>
            </p>
            <p>
              <span class="text-muted me-2">An:</span><span><?= $year?></span>
            </p>
           
          </div>
          <div class="col-md-3 mb-4 mb-md-0">
          <p>
              <span class="text-muted me-2">Km:</span><span><?= $km?></span>
            </p>
            <p>
              <span class="text-muted me-2">Motor:</span><span><?= $engine?></span>
            </p>
            <p>
              <span class="text-muted me-2">Combustibil:</span><span><?= $fuel_type?></span>
            </p>
          </div>
          <div class="col-md-3 mb-4 mb-md-0">
            <h5 class="mb-2">
              <span class="align-middle">Pret masina: <?= $pricecar?>€</span>
            </h5>
            
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-8">
              <?php if($status == 'Platit'){?>
            <p class="ms-3">Masina <strong><?= $model; ?></strong> a fost achizitionata de catre dumneavoastra in data <strong><?= $data_efectuare_achizitie; ?></strong> cu pretul de <strong><?= $price?>€</strong>. </p>
                <?php }else{ ?>
                    <p class="ms-3">Masina <strong><?= $model; ?></strong> nu a fost platita. </p>
                    <?php  } ?>
        </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
            
            <p class="text-black float-start"><span class="text-black me-3"> Total platit:</span><span
            <?php if($status == 'Platit'){?>
                style="font-size: 25px;"><?= $price;?> €</span></p>
                <?php }else{ ?>
                style="font-size: 25px;">0 €</span></p>
                    <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      




<?php  }else{ header('Location: achizitiiprofil.php');}
}










// Afisare factura daca avem rezervare
if(isset($_GET["id_rezervare"])){
    $id_get = $_GET["id_rezervare"];
    $id_rezervare = $_POST["id_rezervare"];
    // Daca id-ul din get cu id-ul din POST sunt egale atunci afisam factura de la rezervare  (sa nu poate modifica utilizatorul si sa vada alta rezervare), altfel daca 
    // daca utilizatorul modifica ceva, il redirectional pe pagina de rezervariprofil
    if($id_get ==  $id_rezervare){
        
    $id_user = $_SESSION['id'];
    
     // selectam toate datele de la rezervarea curenta
     $query2 = ("SELECT * FROM reservations WHERE id_user='$id_user' AND id_rezervare='$id_rezervare' ");              

     $query_run2 = mysqli_query($con, $query2);
   
    
    if ($query_run2->num_rows > 0) {
        while($row = $query_run2->fetch_assoc()) {
           $id_car= $row["id_car"];
           $data_efectuare_rezervare= $row["data_efectuare_rezervare"];
           $data_efectuare_rezervare = date("d-m-Y H:s", strtotime($data_efectuare_rezervare));
           $data_inceput_rezervare= $row["data_inceput_rezervare"];
           $data_sfarsit_rezervare= $row["data_sfarsit_rezervare"];
           $price= $row["price"];
           $status=$row["status"];
           $days=$row["days"];
    
          }
    }
   

    ?> 
    
    
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



<?php   
// Design pagina pentru rezervare
include("includes/message.php");
include("admin/config/dbcon.php");
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
       $pricecar= $row["price"];
       $year= $row["year"];
      }   
}

$query_run2 = mysqli_query($con, $query2);
if ($query_run2->num_rows > 0) {
    while($row2 = $query_run2->fetch_assoc()) {
       $firstName= $row2["firstName"];
       $lastName= $row2["lastName"];
       $email= $row2["email"];
       $adress= $row2["adress"];
       $phone= $row2["phone"];

      }   
}
?>

<div class="card">
  <div class="card-body">
    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Factura rezervare &gt;&gt; <strong>ID: <?= $id_rezervare; ?></strong></p>
          <a class="btn btn-danger" href="rezervariprofil.php" role="button">Inapoi</a>
        </div>
      </div>
      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <i class="far fa-building fa-4x ms-0" style="color:#8f8061 ;"></i>
            <p class="pt-2 fw-bold h2">Marius Dealer Auto</p>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Catre: <span style="color:#8f8061 ;"><?= $firstName?> <?= $lastName?></span></li>
              <li class="text-muted"><?= $email?></li>
              <li class="text-muted"><?= $adress?></li>
              <li class="text-muted">0<?= $phone?> <i class="fas fa-phone"></i></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted">Factura rezervare</p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                  class="fw-bold">ID:</span>#<?= $id_rezervare; ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061 ;"></i> <span
                  class="fw-bold">Data: </span><?= $data_efectuare_rezervare; ?></li>
                  <?php 
                  //daca statusul este platit
                  if($status == 'Platit'){
                  ?>
              <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                  class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                 Platit</span></li>
                  <?php }else{?>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#8f8061;"></i> <span
                    class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                 Neplatit</span></li>

                    <?php }?>
            </ul>
          </div>
        </div>
        <div class="row my-2 mx-1 justify-content-center">
          <div class="col-md-2 mb-4 mb-md-0">
            <div class="
                        bg-image
                        ripple
                        rounded-5
                        mb-4
                        overflow-hidden
                        d-block
                        " data-ripple-color="light">
              <img src="admin/image/car/<?= $image; ?>" class="w-100"
                height="100px" alt="Imagine masina" />
              <a href="#!">
                <div class="hover-overlay">
                  <div class="mask" style="background-color: hsla(0, 0%, 98.4%, 0.2)"></div>
                </div>
              </a>
            </div>
          </div>
          <div class="col-md-3 mb-4 mb-md-0">
            <p class="fw-bold"><?= $model; ?></p>
            <p class="mb-1">
              <span class="text-muted me-2">Culoare:</span><span><?= $color?></span>
            </p>
            <p>
              <span class="text-muted me-2">An:</span><span><?= $year?></span>
            </p>
           
          </div>
          <div class="col-md-3 mb-4 mb-md-0">
          <p>
              <span class="text-muted me-2">Km:</span><span><?= $km?></span>
            </p>
            <p>
              <span class="text-muted me-2">Motor:</span><span><?= $engine?></span>
            </p>
            <p>
              <span class="text-muted me-2">Combustibil:</span><span><?= $fuel_type?></span>
            </p>
          </div>
          <div class="col-md-3 mb-4 mb-md-0">
            <h5 class="mb-2">
              <span class="align-middle">Pret masina: <?= $pricecar?>€</span>
            </h5>
            
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xl-8">
              <?php if($status == 'Platit'){?>
            <p class="ms-3">Masina <strong><?= $model;?></strong> este rezervata din data <strong><?= $data_inceput_rezervare;?></strong> pana in data <strong><?= $data_sfarsit_rezervare?></strong> ( <?= $days;?> zile ) de catre dumneavoastra.</p>
         <?php }else{?>
            <p class="ms-3">Rezervarea pentru masina <strong><?= $model;?></strong> nu a fost platita. </p>
            <?php } ?>
        </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
            
            <p class="text-black float-start"><span class="text-black me-3"> Total platit:</span><span
            <?php if($status == 'Platit'){?>
                style="font-size: 25px;"><strong><?= $price;?> Lei</strong></span></p>
                <?php }else{?>
                    style="font-size: 25px;"><strong>0 Lei</strong></span></p>
                    <?php 
                }
                        ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      

    
    
    
    <?php
    
}else{header('Location: rezervariprofil.php');}
}


    ?>