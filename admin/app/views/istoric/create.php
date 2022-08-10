
<link href="../css/styles.css" rel="stylesheet" />

<?php
session_start();
include('includes/header.php');
include('autentificare.php');
include('includes/sidebar.php');
?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Panou de control - Administrator</h1>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Dashboard</li>
         <li class="breadcrumb-item">Istoric</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

                    <?php include('message.php'); ?>

            <div class="card">
                    <div class="card-header">
                        <h4> Adauga istoric:
                        <a href="../istoric" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">

                    <form action='' method='post'>
                            <div class="row">     
                                <div class="col-md-4 mb-3">
                                    <label for="">Alege vehicul:</label>
                                    <!-- <input type="text" name="category_id" required class="form-control"> -->
                                    <?php 
                                        $cars = ("SELECT * FROM cars WHERE status !='sters'");
                                        $cars_run = mysqli_query($con, $cars);
                                        // Alege vehicul disponibil
                                        if(mysqli_num_rows($cars_run)>0){
                                            ?>
                                                <select name="id_car" class="form control" required>
                                                   <option value="">--Alege vehicul--</option>
                                                   <?php
                                                          foreach($cars_run as $row){
                                                              ?>
                                                                <option value="<?= $row['id_car']?>">ID:<?= $row['id_car']?> <?= $row['model'] ?> </option>
                                                             <?php
                                                             }
                                                   ?>
                                                </select>
                                            <?php

                                        }else{
                                            ?>
                                                <h5>Niciun vehicul disponibil</h5>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                      
                           
                               
                                <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="">Data intrare service</label>
                                    <input type="date" name="data_intrare_service" required class="form-control">
                                </div>
                           
                                <div class="col-md-2 mb-3">
                                    <label for="">Data iesire service</label>
                                    <input type="date" name="data_iesire_service" required class="form-control">
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="">Pret manopera</label>
                                    <input type="number" name="pret_manopera" required class="form-control">
                                </div>
                           
                                <div class="col-md-2 mb-3">
                                    <label for="">Pret piese</label>
                                    <input type="number" name="pret_piese" required class="form-control">
                                </div>
                                <!-- <div class="col-md-2 mb-3">
                                    <label for="">Pret total</label>
                                    <input type="number" name="pret_total" required class="form-control">
                                </div> -->
                              
                            
                            </div>


                                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Tip operatie</label>
                                    <select name="tip_operatie" required class="form-control">
                                        <option value="">--Alege operatia--</option>
                                        <option value="Revizie"> Revizie</option>
                                        <option value="Reparatie"> Reparatie</option>  
                                        <option value="Accident"> Accident</option>  
                                    </select>
                                </div>

                                <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="">Kilometri</label>
                                    <input type="number" name="km" required class="form-control">
                                </div>
                           
                                <div class="col-md-12  mb-3">
                                    <label for="">Descriere</label>
                                    <textarea name="descriere" required class="form-control" rows="5"></textarea>
                                </div>
                              
                            
                            </div>
                                
                                <div class="col-md-12 mb-3">
                                    <input type="submit" name="action" class="btn btn-primary" value='Adauga istoric'></button>
                                 </div>
                            </div>
                        </form>






                    <div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>