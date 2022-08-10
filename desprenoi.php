<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
        <title>Pagina</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="css/style.css?version5">
        <link rel="stylesheet" href="css/masinistyle.css?version8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php include("includes/meniu.php");?>


<body>


<section class="top-featured-image">
	
	
    <div class="top-featured-image-bg" style="background: url('image/about-header.jpg') center no-repeat;background-size:cover;background-color:#fff; min-height:500px; ">
        <div class="container the-page-title">
        	<div class="row">
	            <div class="col-md-6 white-content single-page-title">
	                <h3 class="page-subtitle"><strong>MariusDealerAuto. De 20 de ani lângă tine!</strong></h3>
	            </div>
	        </div>
        </div>
    </div>
</section>


<section class="aboutus">
        <div class="about-section">
            <h1>DESPRE NOI</h1>
            <p>Deja un distribuitor cu traditie, <b>MariusDealer</b> si-a dezvoltat de-a lungul timpului produsele sale.
             Astazi, vanzarea de autoturisme second-hand este doar o mica parte din ceea ce facem. 
             Deja cu o activitate de mult timp, avem in portofoliu foarte multe marci importante.
             Acestea vorbesc despre incredere, calitate, profesionalism si adaptare la ceea ce are nevoie fiecare client.
             Cel mai important este profesionalismul.</p>
             <p>Suntem aici pentru tine. Mai buni in fiecare zi!</p>
             <p>In tot ceea ce facem, ne gandim ca suntem oameni printre oameni. Ne-am propus ca, în mod firesc si natural,
                  sa confirmam asteptarile celor care au nevoie de noi. Zi de zi.</p>
            <p><h1>Ce facem la <strong>MariusDealerAuto?</strong></h1></p>
                <ul>
                     <li><h3>Buy-back si vanzare auto de ocazie prin divizia noatra</h3></li>
                     <li><h3>Masini second-hand la cel mai bun pret</h3></li>
                     <li><h3>Reduceri ocazionale</h3></li>
                     <li><h3>Posibilitatea de a rezerva un autoturism</h3></li>
                     <li><h3>Sansa de a testa vehiculele pe perioada rezervarii</h3></li>
                     <li><h3>Toate masinile noastre detin un istoric certificat de RAR</h3></li>
                 </ul> 
        </div>

      
        <section class="vehicule" id="vehicule">
        <h1 class="heading"> <span>Membrii </span>staff</h1></br>
</section>
        
<div class="row cars-container">
    <?php
$db = mysqli_connect("localhost", "root", "", "cardealer");


$result = mysqli_query($db, "SELECT * FROM admin");
$result2 = mysqli_query($db, "SELECT * FROM category");

while($data = mysqli_fetch_array($result) AND $data2 = mysqli_fetch_array($result2))
{
   ?>
   
   <div class="cars col-sm-4">
        <div class="card">
            <div class="imaginedatabase"><img src="admin/image/adminimage/<?php echo $data['image']; ?>"width="200" height="200"> </div>
            <h3 class="model"><i class="fas fa-portrait"></i><?php $role= $data['role']; if($role == '1'){echo "Administrator";}elseif($role == '2'){echo "Angajat";}?> </h3>
            <h3 class="model"><i class="fas fa-user"></i><?php echo $data['firstName']; ?> <?php echo $data['lastName']; ?></h3>
            
        </div>
        </a>
</div>

    <?php
}
?>
  
</div>

        
    </section>
    <section class="bg-img-title-subtitle" style="background: url('image/about-principii.jpg') center no-repeat;background-size:cover;" >
			        	<div class="container">
							<div class="row">
								<div class="col-md-6"></div>
								<div class="col-md-6 padding-percent">		 
						        		<strong> Principiile noastre  </strong>
						        		<p> </p><p style="text-align: left;">Integritate<br>
                                                Excelență<br>
                                                Angajament<br>
                                                Grijă față de ceilalți<br>
                                                Muncă în echipă</p>
                                        <p></p> 
						        </div>
					        </div>
					    </div> 
		</section>



</body>





<!-- Inceput sectiune footer-->

<?php include("includes/footer.php"); ?>
    <!-- Sfarsit sectiune footer-->