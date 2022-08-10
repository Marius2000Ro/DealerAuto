<?php
session_start();
include('includes/header.php');
include('autentificare.php');
include('includes/sidebar.php');
include('message.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Panou de control - Administrator</h1>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Panou principal</li>
    </ol>
    <div class="row">
    <h1> Utilizatori </h1>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4"> 
                                    <div class="card-body">Numar utilizatori
                                        <?php
                                         $query1 = ("SELECT * FROM users");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                       
                               
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Conturi verificate
                                    <?php
                                         $query1 = ("SELECT * FROM users WHERE verified='1'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Conturi blocate
                                    <?php
                                         $query1 = ("SELECT * FROM users WHERE blocked='Da'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Utilizatori peste 18 ani
                                    <?php
                                         $query1 = ("SELECT * FROM users WHERE age >='18'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Utilizatori noi astazi
                                    <?php
                                        $astazi = date("Y-m-d");
                                         $query1 = ("SELECT * FROM users WHERE created >='$astazi'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Utilizatorii noi luna aceasta
                                    <?php
                                        $luna = date("Y-m-1");
                                         $query1 = ("SELECT * FROM users WHERE created >='$luna'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Utilizatorii noi anul aceasta
                                    <?php
                                        $an = date("Y-1-1");
                                        $anSfarsit = date("Y-12-31");
                                         $query1 = ("SELECT * FROM users WHERE created >='$an' AND created <='$anSfarsit'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="users-view.php">Vezi utilizatori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                         
                            <h1> Personal </h1>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Numar membrii staff
                                    <?php
                                         $query1 = ("SELECT * FROM admin ");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="administratori-view.php">Vezi administratori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Administratori
                                    <?php
                                         $query1 = ("SELECT * FROM admin WHERE role='2'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="administratori-view.php">Vezi administratori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Angajati
                                    <?php
                                         $query1 = ("SELECT * FROM admin WHERE role='1' ");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="administratori-view.php">Vezi administratori</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <h1> Vehicule </h1>


                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4"> 
                                    <div class="card-body">Numar vehicule
                                        <?php
                                         $query1 = ("SELECT * FROM cars");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                       
                               
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Vehicule disponibile
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE status='Disponibil'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule disponibile</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Vehicule vandute
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE status='Vandut'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view-vandut.php">Vezi vehicule vandute</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Vehicule rezervate
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE status ='Rezervat'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view-reserved.php">Vezi vehicule rezervate</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Vehicule sterse
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE status ='sters'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-deleted.php">Vezi vehicule sterse</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Vehicule cu pretul mai mic de 5000€
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE price <'5000'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Vehicule cu pretul mai mare de 5000€
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE price >'5000'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body">Vehicule cu anul 2015+
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE year >='2015'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Vehicule adaugate astazi
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE created_at >='$astazi'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Vehicule adaugate luna aceasta
                                    <?php
                                        $luna = date("Y-m-1");
                                         $query1 = ("SELECT * FROM cars WHERE created_at >='$luna'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Vehicule adaugate anul acesta
                                    <?php
                                             $an = date("Y-1-1");
                                            $anSfarsit = date("Y-12-31");
                                         $query1 = ("SELECT * FROM cars WHERE created_at >='$an' AND created_at <='$anSfarsit'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Vehicule inmatriculate
                                    <?php
                                         $query1 = ("SELECT * FROM cars WHERE certified = 'Da'");
                                         $query1_run = mysqli_query($con, $query1);
                                         if($total = mysqli_num_rows($query1_run)){
                                            echo '<h4 class="mb-0"> '.$total.' </h4>';
                                         }else{ 
                                           echo '<h4 class="mb-0">Nicio inregistrare</h4>';
                                         }  ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vehicle-view.php">Vezi vehicule</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>


                            <h1> Rezervari </h1>


<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4"> 
        <div class="card-body">Numar rezervari
            <?php
             $query1 = ("SELECT * FROM reservations");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
           
   
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Rezervari platite
        <?php
             $query1 = ("SELECT * FROM reservations WHERE status='Platit'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Rezervari neplatite
        <?php
             $query1 = ("SELECT * FROM reservations WHERE status='Neplatit'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body">Vehicule rezervate
        <?php
             $query1 = ("SELECT * FROM cars WHERE status ='Rezervat'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="vehicle-view-reserved.php">Vezi vehicule rezervate</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-4">
        <div class="card-body">Rezervari astazi
        <?php
             $astazi = date("Y/m/d");
             $query1 = ("SELECT * FROM reservations WHERE data_efectuare_rezervare >='$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">Rezervari luna aceasta
        <?php
             $query1 = ("SELECT * FROM reservations WHERE data_efectuare_rezervare >='$luna'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">Rezervari anul acesta
        <?php
             $query1 = ("SELECT * FROM reservations WHERE data_efectuare_rezervare >='$an' AND data_efectuare_rezervare<'$anSfarsit'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">Rezervari de o zi
        <?php
             $query1 = ("SELECT * FROM reservations WHERE days ='1'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Rezervari in derulare
        <?php
             $query1 = ("SELECT * FROM reservations WHERE data_inceput_rezervare >='$astazi' AND data_sfarsit_rezervare <= '$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-4">
        <div class="card-body">Rezervari mai mari de 150 lei
        <?php
            $luna = date("Y-m-1");
             $query1 = ("SELECT * FROM reservations WHERE price >'150'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Rezervari sfarsite
        <?php
             $query1 = ("SELECT * FROM reservations WHERE data_sfarsit_rezervare <'$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Rezervari neincepute
        <?php
             $query1 = ("SELECT * FROM reservations WHERE data_inceput_rezervare > '$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="rezervari-view.php">Vezi rezervari</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>







<h1> Achizitii </h1>


<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4"> 
        <div class="card-body">Numar achizitii
            <?php
             $query1 = ("SELECT * FROM purchase");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
           
   
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Achizitii platite
        <?php
             $query1 = ("SELECT * FROM purchase WHERE status='Platit'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Achizitii neplatite
        <?php
             $query1 = ("SELECT * FROM purchase WHERE status='Neplatit'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-warning text-white mb-4">
        <div class="card-body">Vehicule vandute
        <?php
             $query1 = ("SELECT * FROM cars WHERE status ='Vandut'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="vehicle-view-vandut.php">Vezi vehicule vandute</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-4">
        <div class="card-body">Achizitii astazi
        <?php
             $astazi = date("Y/m/d");
             $query1 = ("SELECT * FROM purchase WHERE data_efectuare_achizitie >='$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">Achizitii luna aceasta
        <?php
             $query1 = ("SELECT * FROM purchase WHERE data_efectuare_achizitie >='$luna'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">Achizitii anul acesta
        <?php
             $query1 = ("SELECT * FROM purchase WHERE data_efectuare_achizitie >='$an' AND data_efectuare_achizitie<'$anSfarsit'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-4">
        <div class="card-body">Achizitii mai mici de 5000€
        <?php
             $query1 = ("SELECT * FROM purchase WHERE price <'5000'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Achizitii intre 5000€ si 10000€
        <?php
             $query1 = ("SELECT * FROM purchase WHERE price >='5000' AND price<='10000'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Achizitii mai mari de 10000€
        <?php
             $query1 = ("SELECT * FROM purchase WHERE price > '10000'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="achizitii-view.php">Vezi achizitii</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<h1> Istoric vehicule </h1>


<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4"> 
        <div class="card-body">Numar vehicule cu istoric
            <?php
             $query1 = ("SELECT DISTINCT id_car FROM istoric");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
           
   
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Numar total inregistrari
        <?php
             $query1 = ("SELECT * FROM istoric ");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6">
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">Vehicule cu accident 
        <?php
             $query1 = ("SELECT DISTINCT id_car FROM istoric WHERE tip_operatie='Accident'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">Numar revizii efectuate
        <?php
             $query1 = ("SELECT * FROM istoric WHERE tip_operatie ='Revizie'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">Numar vehicule reparate
        <?php
             $query1 = ("SELECT DISTINCT id_car FROM istoric WHERE tip_operatie ='Reparatie'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-success text-white mb-4">
        <div class="card-body">Vehicule adaugate astazi in service
        <?php
             $query1 = ("SELECT DISTINCT id_car FROM istoric WHERE data_intrare_service ='$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-4">
        <div class="card-body">Vehicule adaugate luna aceasta in service
        <?php
            $luna = date("Y-m-1");
             $query1 = ("SELECT DISTINCT id_car FROM istoric WHERE data_intrare_service >='$luna'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Operatii mai mari de 1000 Lei
        <?php
             $query1 = ("SELECT * FROM istoric WHERE pret_total>='1000'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-4">
        <div class="card-body">Operatii mai mari de 5000 Lei
        <?php
             $query1 = ("SELECT * FROM istoric WHERE pret_total>='5000'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6">
    <div class="card bg-danger text-white mb-4">
        <div class="card-body">Vehicule iesite din service astazi
        <?php
             $query1 = ("SELECT * FROM istoric WHERE data_iesire_service ='$astazi'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-dark text-white mb-4">
        <div class="card-body">Vehicule fara accident
        <?php
             $query1 = ("SELECT DISTINCT id_car FROM istoric WHERE tip_operatie !='Accident'");
             $query1_run = mysqli_query($con, $query1);
             if($total = mysqli_num_rows($query1_run)){
                echo '<h4 class="mb-0"> '.$total.' </h4>';
             }else{ 
               echo '<h4 class="mb-0">Nicio inregistrare</h4>';
             }  ?>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-between">
        <a class="small text-white stretched-link" href="istoric.php">Vezi istoric vehicule</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
        </div>
    </div>
</div>
                        </div>
                    
                      
                        
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>