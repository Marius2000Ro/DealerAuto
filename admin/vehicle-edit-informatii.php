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
                        <h4> Editare informatii vehicul:
                        <a href="vehicle-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-4 mb-3">
                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                                    <label for="">Categorie</label>
                                    <!-- <input type="text" name="category_id" required class="form-control"> -->
                                    <?php 
                                          $id = $_GET['id'];
                                        $category = ("SELECT * FROM category WHERE status='1'");
                                        $category2 = ("SELECT cars.*, category.name AS cname FROM cars, category  WHERE cars.category_id = category.id_category AND cars.id_car='$id'");
                                        $category_run = mysqli_query($con, $category);
                                        $category_run2 = mysqli_query($con, $category2);
                                        if(mysqli_num_rows($category_run)>0){
                                            ?>
                                                <select name="category_id" class="form control" >
                                                   <option value=""> <?php 
                                                    foreach($category_run2 as $row2)
                                                    {echo $row2['cname'];
                                                    }
                                                    ?></option>
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

                                            
                                
                            

                       
                        <input type="hidden" name="id_car" value="<?=$row['id_car'];?>">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Model</label>
                                    <input type="text" name="model" value="<?=$row['model'];?>"  required class="form-control">
                                </div>
                           
                                <!-- <div class="col-md-4 mb-3">
                                    <label for="">Categorie id</label>
                                    <input type="text" name="category_id" value="<?=$row['category_id'];?>" required class="form-control">
                                </div> -->

                                
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">An</label>
                                    <input type="text" name="year" value="<?=$row['year'];?>" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Numar kilometri</label>
                                    <input type="text" name="km" value="<?=$row['km'];?>" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Pret actual</label>
                                    <input type="text" name="price" value="<?=$row['price'];?>€" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Pret vechi</label>
                                    <input type="text" name="lastPrice" value="<?=$row['lastPrice'];?>€" required class="form-control">
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="">Motor</label>
                                    <input type="text" name="engine" value="<?=$row['engine'];?>" required class="form-control">
                                </div>
                            
                                <div class="col-md-4 mb-3">
                                    <label for="">Combustibil</label>
                                    <input type="text" name="fuel_type" value="<?=$row['fuel_type'];?>" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Culoare</label>
                                    <input type="text" name="color" value="<?=$row['color'];?>" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Tara provenienta</label>
                                    <input type="text" name="fromCountry" value="<?=$row['fromCountry'];?>" required class="form-control">
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Inmatriculat</label>
                                    <select name="certified" required class="form-control">
                                        <option value="">--Masina inmatriculata--</option>
                                        <option value="Da" <?php echo $row['certified'] == 'Da' ? 'selected':''?> >Da</option>
                                        <option value="Nu" <?php echo $row['certified'] == 'Nu' ? 'selected':''?> >Nu</option>
                                    </select>
                                </div>

                              
                            
                                <div class="col-md-12  mb-3">
                                    <label for="">Descriere</label>
                                    <textarea name="describeCar" id="summernote" required class="form-control" rows="5"><?=$row['describeCar'];?></textarea>
                                </div>

                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="">--Status vehicul--</option>
                                        <option value="Disponibil" <?php echo $row['status'] == 'Disponibil' ? 'selected':''?>> Disponibil</option>
                                        <option value="Rezervat" <?php echo $row['status'] == 'Rezervat' ? 'selected':''?>> Rezervat</option>
                                        <option value="Vandut" <?php echo $row['status'] == 'Vandut' ? 'selected':''?>> Vandut</option>
                                        
                                    </select>
                                </div>


                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="vehicle_edit_informatii" class="btn btn-primary">Editeaza vehicul</button>
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