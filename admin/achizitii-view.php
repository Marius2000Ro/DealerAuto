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
         <li class="breadcrumb-item">Achizitii</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
            <?php  include('message.php'); ?>
            <div class="card">
                    <div class="card-header">
                        <h4> Achizitii:
                        <?php if($_SESSION['auth_role'] != "1"){?>
                        <a href="achizitii-add.php" class="btn btn-primary float-end">Adauga achizitie</a>
                        <?php } ?>

                        </h4>
                    </div>
                    <div class="card-body">

                        <table id="myDataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID achizitie</th>
                                    <th>ID utilizator</th>
                                    <th>ID vehicul</th>
                                    <th>Nume vehicul achizitionat</th>
                                   
                                    <th>Nume complet</th>
                                   
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Data efectuare achizitie</th>
                                    <th>Pret</th>
                                    <th>Status</th>
                                    <?php if($_SESSION['auth_role'] != "1"){ ?>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_user = $_SESSION['id'];
                                $query = "SELECT cars.model AS model, cars.image AS image,cars.id_car AS id_car,users.email AS email, users.firstName AS firstName, users.lastName AS lastName, users.phone AS phone, 
                                purchase.* FROM cars, purchase,users WHERE purchase.id_user = users.id_user AND purchase.id_car = cars.id_car";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    while( $row = mysqli_fetch_array( $query_run))
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_achizitie'];?></td>
                                                  <td><?= $row['id_user'];?></td>
                                                  <td><?= $row['id_car'];?></td>
                                                  <td><?= $row['model'];?></td>
                                                  <td><?= $row['firstName'];?> <?= $row['lastName'];?></td>
                                                  <td><?= $row['email'];?></td>
                                                  <td>0<?= $row['phone'];?></td>
                                                  <td><?= $row['data_efectuare_achizitie'];?></td>
                                                  <td><?= $row['price'];?>€</td>
                                                  <td><?php if($row['status'] == 'Platit'){  ?>
                                                         <span class="badge bg-success text-black fw-bold">
                                                           Platit</span></li>
                                                         <?php }else{?>
                                                         <span class="badge bg-warning text-black fw-bold">
                                                         Neplatit</span></li>

                                                         <?php }?></td>
                                                         <?php if($_SESSION['auth_role'] != "1"){?>
                                                  <td><a href="achizitii-edit.php?id_achizitie=<?= $row['id_achizitie'];?>" class="btn btn-success">Editare</td>
                                                  <?php if($row['status'] == 'Neplatit'){  ?>
                                                  <td>
                                                 
                                                        <form action="actiuneButoane.php" method="POST">
                                                        <button type="submit" name="achizitii_delete" value="<?= $row['id_achizitie'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi această achiziție?');">Sterge</button></td>
                                                        </form>
                                                        <?php }}?>
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


                        </div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>