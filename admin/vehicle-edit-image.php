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
            <div class="card">
                    <div class="card-header">
                        <h4> Editare imagini vehicul:
                        <a href="vehicle-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-4 mb-3">
                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                                    
                                
                            <?php
                            if(isset($_GET['id']))
                            {
                                $id = $_GET['id'];
                                $cars = ("SELECT * FROM cars WHERE id_car='$id'");
                                $cars_run = mysqli_query($con, $cars);

                                if(mysqli_num_rows($cars_run) > 0)
                                {   foreach($cars_run as $row)
                                        {
                                             ?>


                        <input type="hidden" name="old_image" value="<?= $row['image'];?>">
                        <input type="hidden" name="old_image2" value="<?= $row['image2'];?>">
                        <input type="hidden" name="old_image3" value="<?= $row['image3'];?>">
                        <input type="hidden" name="old_image4" value="<?= $row['image4'];?>">
                        <input type="hidden" name="old_image5" value="<?= $row['image5'];?>">
                        <input type="hidden" name="old_image6" value="<?= $row['image6'];?>">
                        <input type="hidden" name="old_image7" value="<?= $row['image7'];?>">
                        <input type="hidden" name="id_car" value="<?=$row['id_car'];?>">
                        <input type="hidden" name="status" value="<?=$row['status'];?>">
                            <p class="text-center fs-3 fw-bold text-info">Model: <?= $row['model']?></p>
                                            
                            <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine principala </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" class="form-control">
                                      </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine 2 </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image2" class="form-control">
                                      </div>
                                </div>


                                <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine 3 </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image3" class="form-control">
                                      </div>
                                </div>


                                <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine 4 </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image4" class="form-control">
                                      </div>
                                </div>


                                <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine 5 </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image5" class="form-control">
                                      </div>
                                </div>


                                <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine 6 </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image6" class="form-control">
                                      </div>
                                </div>


                                <div class="row">
                                     <div class="col-md-12 mb-3">
                                          <label for="">Imagine 7 </label>
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image7" class="form-control">
                                      </div>
                                </div>


                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="vehicle_edit_imagini" class="btn btn-primary">Editeaza imagini vehicul</button>
                                 </div>
                          </div>

                        </form>
                        <?php
                                         }
                                }else{
                                    ?>
                                    <h4> Nicio inregistrare gasita</h4>
                                    <?php
                                }
                            }
                            ?>

                    <div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>