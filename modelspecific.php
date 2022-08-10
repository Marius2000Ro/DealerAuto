<?php if (!isset($_GET['id'])){header('Location: masini.php');}
include('admin/config/dbcon.php');
   //Selectam masinile care sunt sterse  
   // Daca utilizatorul vrea sa acceseze o masina stearsa, il trimitem inapoi la masini
   $id_url = $_GET['id'];
   $querySelectSters = "SELECT * FROM cars WHERE id_car='$id_url'";
   $query_runSters = mysqli_query($con, $querySelectSters);
   if(mysqli_num_rows($query_runSters) > 0){
    while( $row = mysqli_fetch_array( $query_runSters))
    {  
      $status= $row['status'];
    if($status =='sters') { header('Location: masini.php'); }
    }
   }else{
    header('Location: masini.php');
   }

   

$idmasina = $_GET['id']; // Luam id-ul din url

$result = mysqli_query($con, "SELECT * FROM cars WHERE id_car = '$idmasina' ");

$data = mysqli_fetch_array($result) 

 ?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MARIUS DEALER AUTO</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/modelspecific.css?version24">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
</head>

<?php 
include("includes/meniu.php");
include('includes/message.php'); 



?>


</title>

<body>

  <div class="card-wrapper">
    <div class="card">


      <!-- Container pentru imaginile din galerie-->
      <div class="container">
        <?php $status= $data['status']; ?>
        <!-- Imaginile mari -->
        <div class="mySlides">
          <div class="numbertext">1 / 7</div>
          <img src="admin/image/car/<?php echo $data['image']; ?>" style="width:25%" height="50%">
        </div>

        <div class="mySlides">
          <div class="numbertext">2 / 7</div>
          <img src="admin/image/car/<?php echo $data['image2']; ?>" style="width:25%" height="50%">
        </div>

        <div class="mySlides">
          <div class="numbertext">3 / 7</div>
          <img src="admin/image/car/<?php echo $data['image3']; ?>" style="width:25%" height="50%">
        </div>

        <div class="mySlides">
          <div class="numbertext">4 / 7</div>
          <img src="admin/image/car/<?php echo $data['image4']; ?>" style="width:25%" height="50%">
        </div>

        <div class="mySlides">
          <div class="numbertext">5 / 7</div>
          <img src="admin/image/car/<?php echo $data['image5']; ?>" style="width:25%" height="50%">
        </div>

        <div class="mySlides">
          <div class="numbertext">6 / 7</div>
          <img src="admin/image/car/<?php echo $data['image6']; ?>" style="width:25%" height="50%">
        </div>
        <div class="mySlides">
          <div class="numbertext">7 / 7</div>
          <img src="admin/image/car/<?php echo $data['image7']; ?>" style="width:25%" height="50%">
        </div>

        <!-- Buton inainte si inapoi -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <!-- Imaginea text -->
        <div class="caption-container">
          <p id="caption"></p>
        </div>

        <!-- Imaginile mici de jos -->
        <div class="row">
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image']; ?>" style="width:100%" height="35%"
              onclick="currentSlide(1)" alt="Poza principala">
          </div>
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image2']; ?>" style="width:100%"
              height="25%" onclick="currentSlide(2)" alt="Poza2">
          </div>
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image3']; ?>" style="width:100%"
              height="25%" onclick="currentSlide(3)" alt="Poza3">
          </div>
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image4']; ?>" style="width:100%"
              height="25%" onclick="currentSlide(4)" alt="Poza4">
          </div>
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image5']; ?>" style="width:100%"
              height="25%" onclick="currentSlide(5)" alt="Poza5">
          </div>
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image6']; ?>" style="width:100%"
              height="25%" onclick="currentSlide(6)" alt="Poza6">
          </div>
          <div class="column">
            <img class="demo cursor" src="admin/image/car/<?php echo $data['image7']; ?>" style="width:100%"
              onclick="currentSlide(7)" alt="Poza7">
          </div>

        </div>
      </div>


      <!-- script pentru carusel -->
      <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        // Butoanele inainate si inapoi
        function plusSlides(n) {
          showSlides(slideIndex += n);
        }

        // Control imagini
        function currentSlide(n) {
          showSlides(slideIndex = n);
        }

        function showSlides(n) {
          var i;
          var slides = document.getElementsByClassName("mySlides");
          var dots = document.getElementsByClassName("demo");
          var captionText = document.getElementById("caption");
          if (n > slides.length) { slideIndex = 1 }
          if (n < 1) { slideIndex = slides.length }
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
          }
          for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
          }
          slides[slideIndex - 1].style.display = "block";
          dots[slideIndex - 1].className += " active";
          captionText.innerHTML = dots[slideIndex - 1].alt;
        }
      </script>


      <!-- Afisare informatii masina -->
      <div class="product-content">
        <?php 
      if(isset($_SESSION["loggedin"]) AND !$_SESSION['administrator']){
      $id_car=  $data['id_car'];
      $queryWish =("SELECT id_wishlist FROM wishlist WHERE id_car='$id_car' AND id_user='$id_user'");
       $query_run2 = mysqli_query($con, $queryWish);
      if(mysqli_num_rows($query_run2)==0){
        ?>
        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
          <input type="hidden" name="from" value="modelspecific">
          <button type="submit" name="wishlist_add" class="btnsuccess">Adauga la favorite</button>
        </form>
        <?php }else{ ?>
        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
          <input type="hidden" name="from" value="modelspecific">
          <button type="submit" name="wishlist_delete" class="btnwarning">Sterge de la favorite</button>
        </form>
        <?php
          } }?>
        <h2 class="product-title">
          <?PHP echo $data['model']; $model=$data['model']; ?>
        </h2>
        <a href="#" class="product-link">Cele mai bune oferte la masini</a>

        <div class="product-price">
          <p class="last-price">Pret vechi: <span>
              <?php echo $data['lastPrice'];?>€
            </span></p>
          <p class="new-price">Pret nou: <span>
              <?php echo $data['price'];  ?>€
            </span></p>
        </div>

        <div class="product-detail">
          <ul>
            <li>Motorizare: <span><b>
                  <?php echo $data['engine'];  ?>
                </b></span></li>
            <li>An fabricatie: <span><b>
                  <?php echo $data['year'];  ?>
                </b></span></li>
            <li>Combustibil: <span><b>
                  <?php echo $data['fuel_type'];  ?>
                </b></span></li>
            <li>Culoare: <span><b>
                  <?php echo $data['color'];  ?>
                </b></span></li>
            <li>Kilometraj: <span><b>
                  <?php echo $data['km'];  ?> KM
                </b></span></li>
            <li>Tara provenienta: <span><b>
                  <?php echo $data['fromCountry'];  ?>
                </b></span></li>
            <li>Inmatriculata: <span><b>
                  <?php echo $data['certified'];  ?>
                </b></span></li>
          </ul>
        </div>



        <!-- /////////////// BUTON VEZI ISTORIC VEHICUL ///////////// -->

        <?php   if (isset($_GET['id'])){$id_car =  $_GET['id']; 
        $query = "SELECT * FROM istoric WHERE id_car='$id_car' ORDER BY id_istoric asc";
        $query_run = mysqli_query($con, $query);
        ?>


        <a href="#modal" class="modal-trigger">Vezi istoric vehicul</a>

        <div class="modal" id="modal">
          <div class="modal__dialog">
            <section class="modal__content">
              <header class="modal__header">
                <h2 class="modal__title">Istoric pentru vehicul
                  <?php echo "$model";?>
                </h2>
                <a href="#" class="modal__close">&times;</a>
              </header>
              <div class="modal__body">
                <p class="modal__text">
                  <?php if(mysqli_num_rows($query_run)>0){ ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Data adaugare istoric</th>
                      <th scope="col">Data intrare service</th>
                      <th scope="col">Data iesire service</th>
                      <th scope="col">Pret manopera</th>
                      <th scope="col">Pret piese</th>
                      <th scope="col">Pret total</th>
                      <th scope="col">Tip operatie</th>
                      <th scope="col">Km vehicul</th>
                      <th scope="col">Descriere</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
      // Km pentry prima masina ca sa nu avem eroare
      $query2 = "SELECT * FROM istoric WHERE id_car='$id_car' ORDER BY id_istoric LIMIT 1 ";
      $query_run2 = mysqli_query($con, $query2);
      if(mysqli_num_rows($query_run)>0){ while( $row2 = mysqli_fetch_array( $query_run2)){$km1= $row2['km'];}}
      // Sfarsit Km pentry prima masina ca sa nu avem eroare
          while( $row = mysqli_fetch_array( $query_run))
          { 
            $id_istoric= $row['id_istoric'];
            $data_adaugare_istoric= $row['data_adaugare_istoric'];
            $data_adaugare_istoric = date("d-m-Y", strtotime($data_adaugare_istoric));
            $data_intrare_service= $row['data_intrare_service'];
            $data_intrare_service = date("d-m-Y", strtotime($data_intrare_service));
            $data_iesire_service= $row['data_iesire_service'];
            $data_iesire_service = date("d-m-Y", strtotime($data_iesire_service));
            $pret_manopera= $row['pret_manopera'];
            $pret_piese= $row['pret_piese'];
            $pret_total= $row['pret_total'];
            $tip_operatie= $row['tip_operatie'];
            $km= $row['km'];
            // folosim kmvechi pentru a verifica daca s-au modificat km masinii ( s-au dat inapoi)
           
            $descriere= $row['descriere'];
            ?>
                    <tr>
                      <td>
                        <?= $data_adaugare_istoric?>
                      </td>
                      <td>
                        <?= $data_intrare_service?>
                      </td>
                      <td>
                        <?= $data_iesire_service?>
                      </td>
                      <td>
                        <?= $pret_manopera?> lei
                      </td>
                      <td>
                        <?= $pret_piese?> lei
                      </td>
                      <td>
                        <?= $pret_total?> lei
                      </td>
                      <td>
                        <?php if($tip_operatie == 'Accident'){echo "<h2 style='background-color:red'>Accident</h2>";}elseif($tip_operatie == 'Revizie'){echo "<h2 style='background-color:green'>Revizie</h2>";}else{echo "<h2 style='background-color:yellow'>Reparatie</h2>";}?>
                      </td>
                      <td>
                        <?php if($km == $km1 ){echo "$km";}elseif($km > $kmvechi){echo "$km";}elseif($km < $kmvechi){echo "<h2 style='background:#fcca03'>Km dati inapoi!</h2><strong>$km</strong>";}else{echo "$km";}?>
                      </td>
                      <td>
                        <?= $descriere?>
                      </td>

                    </tr>

                    <?php $kmvechi=$km;} }else{echo "Vehiculul <strong>$model</strong> nu are niciun istoric disponibil!";} }?>


                </table>
                </p>
              </div>
            </section>
          </div>
        </div>



        <!-- /////////////// SFARSIT BUTON VEZI ISTORIC VEHICUL ///////////// -->


        <div class="purchase-info">


          <?php
        /////////////////////////////////// Calendar rezervari ///////////////

// Setam timpul din Romania
date_default_timezone_set('Europe/Bucharest');
$locale = array('ro.utf-8', 'ro_RO.UTF-8', 'ro_RO.utf-8', 'ro', 'ro_RO');

setlocale(LC_TIME, $locale);
// Pentru luna anterioara si luna urmatoare
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // Luna aceasta
    $ym = date('Y-m');
}

// Formatul la data
$timestamp = strtotime($ym . '-01');  // prima zi a lunii
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Astazi (Format: 2022-08-8)
$today = date('Y-m-d');

// Titlu (Format: August, 2022) + traducere luni in romana
$title = date('F, Y', $timestamp);
$luna =  date ("F", $timestamp);
$year =  date ("Y", $timestamp);
if($luna == "January") { $luna = "Ianuarie"; }
if($luna == "February") { $luna = "Februarie"; }
if($luna == "March") { $luna = "Martie"; }
if($luna == "April") { $luna = "Aprilie"; }
if($luna == "May") { $luna = "Mai"; }
if($luna == "June") { $luna = "Iunie"; }
if($luna == "July") { $luna = "Iulie"; }
if($luna == "August") { $luna = "August"; }
if($luna == "September") { $luna = "Septembrie"; }
if($luna == "October") { $luna = "Octombrie"; }
if($luna == "November") { $luna = "Noiembrie"; }
if($luna == "December") { $luna = "Decembrie"; }

// Cream linuri pentru luna trecuta/urmatoare
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));

// Numarul de zile dintr-o luna
$day_count = date('t', $timestamp);

// 1:Luni 2:Marti 3: Miercuri ... 7:Duminica
$str = date('N', $timestamp);

// Array pentru calendar
$weeks = [];
$week = '';

// Adaugam celule goale
$week .= str_repeat('<td></td>', $str - 1);

for ($day = 1; $day <= $day_count; $day++, $str++) {
    // Adauga 0 la zile daca sunt intre 1 si 9
if($day >= 1 AND $day <=9){  $date = $ym . '-' . '0'.$day;}else{ $date = $ym . '-' .$day;}
// Coloram in rosu zilele cu rezervare, alastru ziua de astazi si alb cele disponibile
if (isset($_GET['id'])){$id_car =  $_GET['id'];
    $query = "SELECT data_inceput_rezervare, data_sfarsit_rezervare FROM reservations WHERE data_inceput_rezervare<='$date' AND data_sfarsit_rezervare >='$date' AND id_car= '$id_car' AND status='Platit'";
    $query_run = mysqli_query($con, $query);
    if(mysqli_num_rows($query_run)>0){
        while( $row = mysqli_fetch_array( $query_run))
        {  
            $data_inceput_rezervare = $row['data_inceput_rezervare'];
            $data_sfarsit_rezervare = $row['data_sfarsit_rezervare'];
            $data_inceput = date("Y-m-d", strtotime($data_inceput_rezervare));
            $data_sfarsit = date("Y-m-d", strtotime($data_sfarsit_rezervare));
         
            if (($date >= $data_inceput) AND ($date <= $data_sfarsit)) {
                
                $week .= '<td class="reservation">';
                $gasit = "da";
                
        }
        
    }
    }elseif($date == $today){
        $week .= '<td class="today">Azi,</br> ';
    }else{
        $week .= '<td>';
    }

    
   

   


    $week .= $day . '</td>';

    // Duminica sau restul zilelor ale lunii
    if ($str % 7 == 0 || $day == $day_count) {

        // Ultima zi a lunii
        if ($day == $day_count && $str % 7 != 0) {
            // Adauga celulele goale
            $week .= str_repeat('<td></td>', 7 - $str % 7);
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        $week = '';
    }
}
}
?>

          <!-- // Linkuri style pentru calendar -->
          <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


          <div class="w3-container">

            <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Deschide
              calendarul rezervarilor</button>

            <div id="id01" class="w3-modal">
              <div class="w3-modal-content">
                <header class="w3-container w3-teal">
                  <span onclick="document.getElementById('id01').style.display='none'"
                    class="w3-button w3-display-topright">&times;</span>
                  <h2 style="margin-left:26rem;">Calendarul rezervarilor</h2>
                </header>

                <ul class="list-inline">
                  <li class="list-inline-item"><a href="?ym=<?= $prev; ?>&id=<?= $id_car; ?>" class="btn btn-link">&lt;
                      inapoi</a></li>
                  <li class="list-inline-item"><span class="title">
                      <?= $luna; ?>,
                      <?= $year; ?>
                    </span></li>
                  <li class="list-inline-item"><a href="?ym=<?= $next; ?>&id=<?= $id_car; ?>"
                      class="btn btn-link">inainte &gt;</a></li>
                </ul>
                <p class="text-right"><a href="modelspecific.php?id=<?= $id_car ?>">Astazi</a></p>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Lu</th>
                      <th>Ma</th>
                      <th>Mi</th>
                      <th>Jo</th>
                      <th>Vi</th>
                      <th>Sa</th>
                      <th>Du</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>




        <?php  // Daca mergem la luna anterioara/urmatoare calendarul ramane deschis
if (isset($_GET['ym'])) { ?>
        <script> document.getElementById('id01').style.display = 'block'</script>
        <?php }?>



        <!-- //////// SFARSIT CALENDAR ////// -->

        <?php  
        
          // Daca masina este disponibila afisam butonul rezerva si achitioneaza
          if($data['status'] == 'Disponibil'){ ?>


        <!-- // Butonul de rezervare -->
        <button class="open-button" onclick="openForm()">Rezerva masina</button>

        <div class="form-popup" id="myForm">
          <form action="checkout.php?id_car=<?= $data['id_car'];?>" class="form-container" method="POST">
            <?php
            if(isset($_SESSION['loggedin'])){ ?>
            <h1>Rezerva masina</h1>
            <input type="hidden" name="rezervare" value="rezervare">
            <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
            <label for="date"><b>Data inceput rezervare</b></label></br>
            <input type="date" placeholder="date_start" name="date_start" required></br>

            <label for="psw"><b>Cate zile doriti sa pastrati masina rezervata?</b> *Pret: 100 lei/zi*</label></br>
            <input type="number" placeholder="Zile" name="days" required>

            <button type="submit" class="btn">Rezerva masina</button></br>
            <?php }else{ ?>
            <button type="button" class="btn" onclick="window.location='login.php';">Logheaza-te pentru rezervari</button></br>
            <?php }?>
            <button type="button" class="btn cancel" onclick="closeForm()">Inchide</button>

          </form>


        </div>

        <script>
          function openForm() {
            document.getElementById("myForm").style.display = "block";
          }

          function closeForm() {
            document.getElementById("myForm").style.display = "none";
          }
        </script>

        <!-- // Afisam butonul de achitioneaza  -->
        <form action="checkout.php?id_car=<?= $data['id_car'];?>" class="form-container" method="POST">
          <?php if(isset($_SESSION['loggedin']) ){ ?>
          <input type="hidden" name="achizitie" value="achizitie">
          <input type="hidden" name="id_car" value="<?= $data['id_car'];?>">
          <input type="hidden" name="price" value="<?= $data['price'];?>">
          <button type="submit" class="btn">Achizitioneaza masina</button>
          <?php }else{ ?>
          <button type="button" class="btn" onclick="window.location='login.php';">Logheaza-te pentru achizitii
            masina</button>
          <?php }?>

        </form>


        <?php }elseif($status == 'Rezervat'){
            // Daca masina nu este disponibila ( este rezervata sau achitionata )
            //  afisam pana la ce data este masina rezervata
             $id_car= $data['id_car'];
             $querySelect = ("SELECT * FROM reservations WHERE status='Platit' AND id_car='$id_car'");
             $query_runSelect = mysqli_query($con, $querySelect);
             if ($query_runSelect->num_rows > 0) {
              while($row = $query_runSelect->fetch_assoc()) {
                $data_sfarsit_rezervare= $row["data_sfarsit_rezervare"];
    
               }
             }
             ?>
        <button type="button" class="btn">Masina este rezervata pana la data </br>
          <?= $data_sfarsit_rezervare ?>
        </button>
        <?php }else{
              // <!-- Daca masina este deja achizitionata -->
              $id_car= $data['id_car'];
             $querySelect = ("SELECT * FROM purchase WHERE status='Platit' AND id_car='$id_car'");
             $query_runSelect = mysqli_query($con, $querySelect);
             if ($query_runSelect->num_rows > 0) {
              while($row = $query_runSelect->fetch_assoc()) {
                $data_efectuare_achizitie= $row["data_efectuare_achizitie"];
    
               }
             }?>

        <button type="button" class="btn">Masina a fost vanduta in data </br>
          <?= $data_efectuare_achizitie ?>
        </button>
        <?php }?>

      </div>

    
    </div>
   
  </div>
 
  </div>





  <?php
//Afisare eroare daca data rezervarii este deja 
if (isset($_GET['error'])) {  
  
  ?>


  <div class="w3-container">
    <div id="id02" class="w3-modal">
      <div class="w3-modal-content">
        <header class="w3-container w3-teal eroare">
          <span onclick="document.getElementById('id02').style.display='none'"
            class="w3-button w3-display-topright">&times;</span>
          <h2>Eroare!</h2>
        </header>
        <div class="w3-container">
          <h2>Rezervarea nu a fost adaugata! Exista deja o rezervare in perioada aleasa de dumneavoastra.</h2>
          <h3>Verifica calendarul rezervarilor.</h3>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('id02').style.display = 'block';

  </script>

  <?php } ?>



  <div class="descriere"
    style="margin-top:200px; margin-left:373px; margin-right:372px; font-size: 250%;background-color:#D1CF98;">
    <h1>Descriere: </h1>
    <p class="modificareTextTabel">
      <?php echo $data['describeCar'];  ?>
    </p>
  </div>
  <div class="social-links">
    <p>Contacteaza-ne: </p>
    <a href="contact.php">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="contact.php">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="contact.php">
      <i class="fab fa-whatsapp"></i>
    </a>
  </div>







  <!-- ///////////////////////////////////////////// Sectiune comentarii  //////////////////////////// -->
  <!-- // Titlul la comentarii -->
  <div class="row d-flex justify-content-center mt-100 mb-100">
    <div class="col-lg-6">
      <div class="card-comment">
        <div class="card-comment-body text-center">
          <h1 class="card-comment-title">Comentarii pentru acest vehicul (
            <?php
                $id_car=$_GET['id'];
             $query1 = ("SELECT id_comentariu FROM comments WHERE id_car ='$id_car' AND status='Vizibil'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo "$total";
             }else{ 
               echo "0";
             }  ?> comentarii)
          </h1>
        </div>
      </div>
    </div>
  </div>



  <?php 
// Doar utilizatorii pot adauga comentarii, adminii nu, cei care nu sunt logati nu 
if(isset($_SESSION["administrator"]) AND $_SESSION['administrator'] != TRUE AND isset($_SESSION["loggedin"]))
{
        $id_user = $_SESSION['id'];
        // Selectam imaginea utilizatorului conectat pentru a o folosi la "adauga comentariu"
        $result = mysqli_query($con, "SELECT image FROM users WHERE id_user='$id_user'");
        if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_array($result))
        {
            $imagine_utilizator_conectat= $data['image'];
        }
        }
        ?>
  <div class="comment-widgets col-lg-6">
    <div class="card-add-comment">
      <div class="row">
        <div class="col-3"> <img src="admin/image/userimage/<?= $imagine_utilizator_conectat; ?>" width="70"
            class="rounded-circle mt-2">
        </div>
        <div class="col-9">
          <div class="comment-box ml-2">
            <!-- //Form pentru a adauga comentariu nou -->
            <form action="actiuneButoane.php" method="POST">
              <button type="submit" name="add_comment" class="btn-add">Adauga comentariul</button>
              <input type="hidden" name="id_car" value="<?php $id_car=$_GET['id']; echo " $id_car";?>">
              <input type="hidden" name="id_user" value="<?php echo " $id_user";?>">
              <div class="comment-area"> <textarea name="comentariu" class="form-control"
                  placeholder="Ce parere ai despre acest vehicul?" rows="5" required></textarea>
              </div>
            </form>
          </div>
      </div>
      </div>
    </div>
  </div>

  <?php } ?>




  <?php 
// Afisam toate comentariile cu detaliile specifice
        $id_car=$_GET['id'];
// Selectam toate datele din tabelul de comentarii, in functie de masina la care suntem 
        $result = mysqli_query($con, "SELECT users.image AS image,users.firstName AS firstName, users.lastName AS lastName, comments.comentariu AS comentariu, 
        comments.data_adaugare AS data_adaugare, comments.id_user AS id_user, comments.id_comentariu AS id_comentariu, comments.status AS status, comments.id_parinte_reply AS id_parinte_reply
        FROM cars, comments, users 
        WHERE comments.id_user = users.id_user AND comments.id_car = cars.id_car AND comments.id_car='$id_car' AND id_parinte_reply='0'  AND comments.status='Vizibil'
        ORDER BY comments.id_comentariu DESC");

if(mysqli_num_rows($result) > 0){
while($data = mysqli_fetch_array($result))
{ 
?>
  <div class="d-flex flex-row comment-row m-t-0 col-lg-6">
  <div class="col-3">
    <div class="p-2"><img src="admin/image/userimage/<?= $data['image']; ?>" alt="user" width="50"
        class="rounded-circle"></div>
</div>
    <div class="comment-text w-100">
      <h6 class="font-medium">
        <?php echo $data['firstName']; ?>
        <?php echo $data['lastName']; ?>
      </h6>
      <span class="m-b-15 d-block">
        <?php echo $data['comentariu']; ?>
      </span>

      <?php   
                    // Daca suntem logati putem raspunde la comentarii, doar utilizatorii pot raspunde la comentarii
                     if(isset($_SESSION["administrator"]) AND $_SESSION['administrator'] != TRUE AND isset($_SESSION["loggedin"])){   
                    ?>
      <!-- // Form pentru a raspunde la comentarii -->
      <form action="actiuneButoane.php" method="POST">
        <input type="hidden" name="id_comentariu"
          value="<?php  $id_comentariu_principal= $data['id_comentariu'];echo $id_comentariu_principal;?>">
        <button type="submit" name="reply_comment" class="btn-cyan">Raspunde</button>
        <input type="hidden" name="id_car" value="<?php echo $id_car;?>">
        <input type="hidden" name="id_user" value="<?php echo " $id_user";?>">
        <div class="comment-area"> <textarea name="comentariuReply" class="form-control"
            placeholder="Raspunde la comentariul '<?php echo $data['comentariu']; ?>'" rows="3" required></textarea>
        </div>
      </form>
      <?php } ?>

      <div class="comment-footer"> <span class="text-muted float-right">
          <?php $data_adaugare= $data['data_adaugare']; $data_adaugare = date("d-m-Y H:i:s", strtotime($data_adaugare)); echo "$data_adaugare";?><br>
        </span>

        <?php 
                        // Daca suntem logati ca admini putem sterge orice comentariu, utilizatorii pot sterge doar comentariilor lor
                         if(isset($_SESSION["loggedin"])){
                             $id_user = $_SESSION['id'];
                                 if($id_user == $data['id_user'] OR  $_SESSION['administrator'] == TRUE ){
                        ?>
        <!-- // Form pentru a sterge comentariul -->
        <form action="actiuneButoane.php" method="POST">
          <input type="hidden" name="id_comentariu" value="<?php echo $data['id_comentariu'];?>">
          <input type="hidden" name="id_car" value="<?php echo $id_car;?>">
          <button type="submit" name="delete_comment" class="btn-sm">Sterge comentariul</button>
        </form>
        <?php  } }?>
      </div>
    </div>

  </div>


  <!-- // Raspunsul la comentariile principale -->
  <?php 
            // Daca comentariul de mai sus este principal (cu raspunsuri adaugate), ii afisam toate raspunsurile
            if($data['id_parinte_reply'] == '0'){
                $reply_id = $data['id_parinte_reply'];
                $id_comentariu_principal = $data['id_comentariu'];
                $resultReply = mysqli_query($con, "SELECT users.image AS image,users.firstName AS firstName, users.lastName AS lastName,
                comments.comentariu AS comentariu, comments.data_adaugare AS data_adaugare, comments.id_user AS id_user, comments.id_comentariu AS id_comentariu, 
                comments.id_parinte_reply AS id_parinte_reply
                FROM cars, comments, users 
                WHERE comments.id_user = users.id_user AND comments.id_car = cars.id_car AND comments.id_car='$id_car' AND comments.id_parinte_reply ='$id_comentariu_principal' AND comments.status='Vizibil'
                ORDER BY comments.id_comentariu");
               // Daca comentariul are raspunsuri le afisam
               if(mysqli_num_rows($resultReply) > 0){
                    while($dataReply = mysqli_fetch_array($resultReply))
                    {  
            ?>
  <div class="reply-comment col-lg-6">
    <div class="d-flex flex-row comment-row m-t-0 col-lg-8">
    <div class="col-3">
      <div class="p-2"><img src="admin/image/userimage/<?= $dataReply['image']; ?>" alt="user" width="50"
          class="rounded-circle"></div>
    </div>
      <div class="comment-text w-100">
        <h6 class="font-medium">
          <?php echo $dataReply['firstName']; ?>
          <?php echo $dataReply['lastName']; ?> a raspuns la comentariu:
        </h6> <span class="m-b-15 d-block">
          <?php echo $dataReply['comentariu']; ?>
        </span>
        <div class="comment-footer"> <span class="text-muted float-right">
            <?php $data_adaugare= $dataReply['data_adaugare']; $data_adaugare = date("d-m-Y H:i:s", strtotime($data_adaugare)); echo "$data_adaugare";?>
          </span>
          <?php 
                                     // Daca suntem conectati, putem sterge propriile comentarii, adminii le pot sterge pe toate
                                        if(isset($_SESSION["loggedin"])){
                                          $id_user = $_SESSION['id'];
                                             if($id_user == $dataReply['id_user'] OR  $_SESSION['administrator'] == TRUE ){
                                     ?>
          <!-- // Form pentru a sterge raspunsurile la comentarii -->
          <form action="actiuneButoane.php" method="POST">
            <input type="hidden" name="id_comentariu" value="<?php echo $dataReply['id_comentariu'];?>">
            <input type="hidden" name="id_car" value="<?php echo $id_car;?>">
            <button type="submit" name="delete_comment" class="btn-sm">Sterge comentariul</button>
          </form>
          <?php } }?>
        </div>
      </div>
     </div>
    </div>
    <?php } } } ?>
    <!-- // Sfarsit raspuns la comentarii -->

  </div>
  <?php 
// Sfarsit while pentru afisare fiecare comentariu
}  } ?>
  </div>
  </div>
  </div>
  </div>
  <!-- /////////////////////////////////////////////// Sfarsit sectiune comentarii ///////////////////////////////////// -->



  <!-- Footer -->
  <?php 
include("includes/footer.php");
?>
  <!-- js link-->
  <script src="js/scriptslider.js?version5"></script>
</body>

</html>