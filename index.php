<?php 
include('admin/config/dbcon.php');
include("includes/meniu.php");
 ?>

<link rel="stylesheet" href="css/style.css?version=3">
<!-- Inceput sectiune acasa-->

<section class="acasa" id="acasa"> 

    <h1 class="acasa-parallax" data-speed="-2"> Cautăți masina visurilor tale</h1>
   <a href="masini.php"> <img class="acasa-parallax" data-speed="5" src="image/acasa-img.png" alt=""> </a>
    <a href="masini.php" class="btn acasa-parallax" data-speed="7" >Exploreaza masinile</a>


</section>


<!-- Inceput sectiune categorii disponibile-->


<!-- Sfarsit sectiune categorii vehicule-->


<!-- Inceput sectiune icoane-->
<section class="icoane-container">
    <div class="icoane">
        <i class="fas fa-home"></i>
        <div class="content">
             <h3> Top Dealer Auto</h3>
             <p>Masini second-hand</p>
        </div>

    </div>



    <div class="icoane">
        <i class="fas fa-car"></i>
        <div class="content">
             <h3>  
                            <?php
                                         $query1 = ("SELECT * FROM cars WHERE status='Vandut'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?>
                 </h3>
             <p>Masini vandute</p>
        </div>

    </div>


    <div class="icoane">
        <i class="far fa-calendar-alt"></i>
        <div class="content">
             <h3>  
                            <?php
                                         $query1 = ("SELECT * FROM cars WHERE status='Rezervat'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?>
                 </h3>
             <p>Masini rezervate astazi</p>
        </div>

    </div>

    <div class="icoane">
        <i class="fas fa-users"></i>
        <div class="content">
             <h3> <?php
                                         $query1 = ("SELECT * FROM users");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?> </h3>
             <p>Clienti satisfacuti</p>
        </div>

    </div>

    <div class="icoane">
        <i class="fas fa-car"></i>
        <div class="content">
             <h3> <?php
                                         $query1 = ("SELECT * FROM cars WHERE status='Disponibil'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?> </h3>
             <p>Masini disponibile</p>
        </div>
    
    </div>

    <div class="icoane">
        <i class="fas fa-car"></i>
        <div class="content">
             <h3> <?php
                                         $query1 = ("SELECT * FROM category ");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?> </h3>
             <p>Categorii</p>
        </div>
    
    </div>
    
    <div class="icoane">
        <i class="fas fa-tools"></i>
        <div class="content">
             <h3> 3 </h3>
             <p>Ani garantie</p>
        </div>
    
    </div>

    <div class="icoane">
        <i class="fas fa-address-book"></i>
        <div class="content">
             <h3>  <?php
                                         $query1 = ("SELECT * FROM admin");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?> </h3>
             <p>Membrii staff</p>
        </div>
    
    </div>


    <div class="icoane">
        <i class="fas fa-desktop"></i>
        <div class="content">
             <h3> <?php
                                         $query1 = ("SELECT * FROM users");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo $total;
                                         }else{ 
                                           echo "0";
                                         }  ?> </h3>
             <p>Clienti inregistrati</p>
        </div>
    
    </div>

    <div class="icoane">
        <i class="fas fa-download"></i>
        <div class="content">
             <h3> 4000+ </h3>
             <p>Imagini incarcate</p>
        </div>
    
    </div>

</section>
<!-- Sfarsit sectiune icoane-->





<!-- // Afisam top 3 cele mai cautate masini in functie de wishlist -->
<section class="acasa" id="acasa"> 

    <h1 class="acasa-parallax" data-speed="-2"> Masinile cele mai cautate</h1> 
    <div class="services-container">
            <?php  
            // SELECTAM MASINILE CU CELE MAI MULTE APARITII IN LISTA DE FAVORITE ALE UTILIZATORILOR
            $querySelectTop3 = ("SELECT COUNT(*) AS total, wishlist.id_car AS id_car, cars.model AS model, cars.price AS price, cars.year AS year, cars.image AS image 
                                FROM wishlist INNER JOIN cars ON cars.id_car=wishlist.id_car WHERE cars.status !='sters' AND cars.status !='Vandut'GROUP BY wishlist.id_car ORDER BY total DESC LIMIT 3");
            $query_run = mysqli_query($con, $querySelectTop3);
            if(mysqli_num_rows($query_run) > 0)
            {
              while($data = mysqli_fetch_array($query_run))
              {
                $id = $data["id_car"];
                $model = $data["model"];
                $price = $data["price"];
                $year = $data["year"];
                $image = $data["image"];
                    ?>
                      <div class="box">
                        <div class="box-img">
                          <img src="admin/image/car/<?= $image;?>" alt="" style="">
                        </div>
                        <p><?= $year; ?></p>
                        <h4><i class='fas fa-car'></i><?= $model ?></h4>
                        <h2><?= $price; ?> € | 100 lei <span>rezervarea pe zi</span></h2>
                        <a href="modelspecific.php?id=<?=$id;?>" class="btn-car">Detalii</a>
                      </div>
                    <?php
                
              }
            }else{
              echo "<h2>Momentan nu exista masini favorite!</h2>";
            }
            ?> 
    </div>


</section>




<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 5</div>
  <img src="image/showroom1.jpg" style="width:100%">
  <div class="text">Showroom</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 5</div>
  <img src="image/showroom2.jpg" style="width:100%">
  <div class="text">Showroom</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 5</div>
  <img src="image/showroom3.jpg" style="width:100%">
  <div class="text">Showroom</div>
</div>
<div class="mySlides fade">
  <div class="numbertext">4 / 5</div>
  <img src="image/showroom4.jpg" style="width:100%">
  <div class="text">Showroom</div>
</div>
<div class="mySlides fade">
  <div class="numbertext">5 / 5</div>
  <img src="image/showroom5.jpg" style="width:100%">
  <div class="text">Showroom</div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>



<!-- Footer --> 
<?php 
include("includes/footer.php");
?>




<!-- js link-->
   <script src="js/script.js?version5"></script>

