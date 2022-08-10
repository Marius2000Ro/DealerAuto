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
         <li class="breadcrumb-item">Vehicule</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

                    <?php include('message.php'); ?>

            <div class="card">
                    <div class="card-header">
                        <h4> Adauga vehicul:
                        <a href="vehicle-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">

                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Model</label>
                                    <input type="text" name="model" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Categorie</label>
                                    <!-- <input type="text" name="category_id" required class="form-control"> -->
                                    <?php 
                                        $category = ("SELECT * FROM category WHERE status='1'");
                                        $category_run = mysqli_query($con, $category);

                                        if(mysqli_num_rows($category_run)>0){
                                            ?>
                                                <select name="category_id" class="form control" required>
                                                   <option value="">--Alege categoria--</option>
                                                   <?php
                                                          foreach($category_run as $row){
                                                              ?>
                                                                <option value="<?= $row['id_category']?>"><?= $row['name'] ?> </option>
                                                             <?php
                                                             }
                                                   ?>
                                                </select>
                                            <?php

                                        }else{
                                            ?>
                                                <h5>Nicio categorie disponibila</h5>
                                            <?php
                                        }
                                    ?>
                                    
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">An</label>
                                    <input type="text" name="year" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Numar kilometri</label>
                                    <input type="text" name="km" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Pret actual</label>
                                    <input type="text" name="price" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Pret vechi</label>
                                    <input type="text" name="lastPrice" required class="form-control">
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="">Motor</label>
                                    <input type="text" name="engine" required class="form-control">
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="">Combustibil</label>
                                    <input type="text" name="fuel_type" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Culoare</label>
                                    <input type="text" name="color" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Tara provenienta</label>
                                    <input type="text" name="fromCountry" required class="form-control">
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Inmatriculat</label>
                                    <select name="certified" required class="form-control">
                                        <option value="">--Masina inmatriculata--</option>
                                        <option value="Da"> Da</option>
                                        <option value="Nu"> Nu</option>
                                    </select>
                                </div>

                              
                            
                                <div class="col-md-12  mb-3">
                                    <label for="">Descriere</label>
                                    <textarea name="describeCar" id="summernote" required class="form-control" rows="5"></textarea>
                                </div>
                            



                                <div class="col-md-12 mb-3">
                                    <label for="">Imagine principala</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" required class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine 2</label>
                                    <input type="file"  accept="image/jpg, image/jpeg, image/png" name="image2" required class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine 3</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image3" required class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine 4</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image4" required class="form-control">
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine 5 </label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image5" required class="form-control">
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine 6</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image6" required class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine 7</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image7" required class="form-control">
                                </div>
                            </div>


                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="">--Status vehicul--</option>
                                        <option value="Disponibil"> Disponibil</option>
                                        <option value="Rezervat"> Rezervat</option>
                                        <option value="Vandut"> Vandut</option>
                                    </select>
                                </div>


                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="vehicle_add" class="btn btn-primary">Adauga vehicul</button>
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