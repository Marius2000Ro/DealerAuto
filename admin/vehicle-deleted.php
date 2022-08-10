<?php
session_start();
include('includes/header.php');
include('autentificare.php');
include('includes/sidebar.php');
?>

<div class="container-fluid">
    <h3 class="mt-4">Panou de control - Administrator</h1>
    <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item active">Dashboard</li>
         <li class="breadcrumb-item">Administratori</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
        <?php  include('message.php'); ?>
            <div class="card">
                    <div class="card-header">
                        <h4> Vizualizare vehicule:
                        <a href="#vehicule"  class="btn btn-info">Vezi imagini vehicule</a>
                        <a href="vehicle-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body " style="margin-left:-10px;">
                    <p class="text-center fs-3 fw-bold text-info">Descriere vehicule</p>
                    <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categorie</th>
                                    <th>Model</th>
                                    <th>An</th>
                                    <th>Km</th>
                                    <th>Pret actual</th>
                                    <th>Pret vechi</th>
                                    <th>Motor</th>
                                    <th>Combustibil</th>
                                    <th>Culoare</th>
                                    <th>Tara de provenienta</th>
                                    <th>Inmatriculat</th>
                                    <th>Descriere</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <?php if($_SESSION['auth_role'] != "1"){ ?>
                                    <th>Delete</th>
                                    <?php } ?>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php
                                // $query = "SELECT * FROM cars WHERE status != 'sters' ";
                                $query = "SELECT cars.*, category.name AS cname FROM cars, category  WHERE cars.category_id = category.id_category  AND cars.status = 'sters' ";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    foreach( $query_run as $row)
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_car'];?></td>
                                                  <td><?= $row['cname'];?></td>
                                                  <td><?= $row['model'];?></td>
                                                  <td><?= $row['year'];?></td>
                                                  <td><?= $row['km'];?></td>
                                                  <td><?= $row['price'];?>€</td>
                                                  <td><?= $row['lastPrice'];?>€</td>
                                                  <td><?= $row['engine'];?></td>
                                                  <td><?= $row['fuel_type'];?></td>
                                                  <td><?= $row['color'];?></td>
                                                  <td><?= $row['fromCountry'];?></td>
                                                  <td><?= $row['certified'];?></td>
                                                  <td><?= $row['describeCar'];?></td>
                                                  <td><?= $row['status'];?></td>
                                       
                                                
                                                 
                                                  <td><form action="actiuneButoane.php" method="POST">
                                                          <button type="submit" name="car_reda_inapoi" value="<?= $row['id_car'];?>" class="btn btn-success">Anuleaza stergerea</button>
                                                          
                                                         </form></td>
                                                         <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                     <td>
                                                         <form action="actiuneButoane.php" method="POST">
                                                          <button type="submit" name="car_delete_definitiv" value="<?= $row['id_car'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest vehicul definitiv?');">Sterge definitiv</button>

                                                         </form>
                                                    </td>
                                                    <?php } ?>
                                                 </tr>


                                                 
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="10">Nicio inregistrare gasita.</td>
                                        </tr>

                                    <?PHP
                                }
                                ?>
                            
                            </tbody>
                           
                        </table>
                        <p id="vehicule" class="text-center fs-3 fw-bold text-info mt-5" >Imagini vehicule</p>
                        <table class="table table-bordered mr-1">
                            
                        <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Model</th>
                                    <th>Imagine principala</th>
                                    <th>Imagine2</th>
                                    <th>Imagine3</th>
                                    <th>Imagine4</th>
                                    <th>Imagine5</th>
                                    <th>Imagine6</th>
                                    <th>Imagine7</th>
                                    <th>Ultima modificare</th>
                                    <th>Editare</th>
                                    <?php if($_SESSION['auth_role'] != "1"){ ?>
                                    <th>Stergere</th>
                                    <?php } ?>
                                </tr>
                                
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM cars WHERE status='sters'";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    foreach( $query_run as $row)
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_car'];?></td>
                                        
                                                  <td><?= $row['model'];?></td>
                                                 
                                                  <td><img src="image/car/<?= $row['image'];?>" width="125px" height="100px"/>  </td>
                                                  <td><img src="image/car/<?= $row['image2'];?>" width="125px" height="100px"/>  </td>
                                                  <td><img src="image/car/<?= $row['image3'];?>" width="125px" height="100px"/>  </td>
                                                  <td><img src="image/car/<?= $row['image4'];?>" width="125px" height="100px"/>  </td>
                                                  <td><img src="image/car/<?= $row['image5'];?>" width="125px" height="100px"/>  </td>
                                                  <td><img src="image/car/<?= $row['image6'];?>" width="125px" height="100px"/>  </td>
                                                  <td><img src="image/car/<?= $row['image7'];?>" width="125px" height="100px"/>  </td>
                                                  <td><?= $row['created_at'];?></td>
                                                 
                                                  <td><a href="vehicle-edit-image.php?id=<?= $row['id_car'];?>" class="btn btn-success">Editare</td>
                                                  <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                     <td>
                                                         <form action="actiuneButoane.php" method="POST">
                                                          <button type="submit" name="car_delete_definitiv" value="<?= $row['id_car'];?>" class="btn btn-danger">Sterge definitiv</button>
                                                         </form>
                                                    </td>
                                                    <?php } ?>
                                                 </tr>


                                                 
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                            <td colspan="10">Nicio inregistrare gasita.</td>
                                        </tr>

                                    <?PHP
                                }
                                ?>
                            
                            </tbody>
  
                            </table>
                            <a href="vehicle-view.php"> <i class="fas fa-arrow-up float-end "></i></a>
                            <a href="vehicle-view.php"> <i class="fas fa-arrow-up "></i></a>
                        
                            



</div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>

