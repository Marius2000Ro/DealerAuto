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
         <li class="breadcrumb-item">Rezervari</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

                    <?php include('message.php'); ?>

            <div class="card">
                    <div class="card-header">
                        <h4> Adauga rezervare:
                        <a href="rezervari-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">

                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                            <div class="row">     
                                <div class="col-md-4 mb-3">
                                    <label for="">Alege vehicul:</label>
                                    <!-- <input type="text" name="category_id" required class="form-control"> -->
                                    <?php 
                                        $cars = ("SELECT * FROM cars WHERE status='Disponibil'");
                                        $users = ("SELECT * FROM users WHERE verified='1' AND blocked='Nu'");
                                        $cars_run = mysqli_query($con, $cars);
                                        $users_run = mysqli_query($con, $users);
                                        // Alege vehicul disponibil
                                        if(mysqli_num_rows($cars_run)>0){
                                            ?>
                                                <select name="id_car" class="form control" required>
                                                   <option value="">--Alege vehicul disponibil--</option>
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
                                        <div class="col-md-4 mb-3">
                                        <label for="">Alege utilizator:</label>
                                        <?php
                                        if(mysqli_num_rows($users_run)>0){
                                            ?>
                                                <select name="id_user" class="form control" required>
                                                   <option value="">--Alege utilizator disponibil--</option>
                                                   <?php
                                                          foreach($users_run as $row){
                                                              ?>
                                                                <option value="<?= $row['id_user']?>">ID:<?= $row['id_user'] ?> <?= $row['firstName'] ?> <?= $row['lastName'] ?> </option>
                                                             <?php
                                                             }
                                                   ?>
                                                </select>
                                            <?php

                                        }else{
                                            ?>
                                                <h5>Niciun utilizator disponibil</h5>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                           
                               
                                <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="">Data inceput rezervare</label>
                                    <input type="date" name="data_inceput" required class="form-control">
                                </div>
                           
                                <div class="col-md-2 mb-3">
                                    <label for="">Numar zile rezervare</label>
                                    <input type="number" name="zile" required class="form-control">
                                </div>
                            
                            </div>


                                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Status plata</label>
                                    <select name="status" required class="form-control">
                                        <option value="">--Alege status plata--</option>
                                        <option value="Platit"> Platit</option>
                                        <option value="Neplatit"> Neplatit</option>  
                                    </select>
                                </div>


                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="rezervare_add" class="btn btn-primary">Adauga rezervare</button>
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