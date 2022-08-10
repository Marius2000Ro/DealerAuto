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
            <?php  include('message.php'); ?>
            <div class="card">
                    <div class="card-header">
                        <h4> Rezervari:

                        <a href="rezervari-add.php" class="btn btn-primary float-end">Adauga rezervare</a>

                        </h4>
                    </div>
                    <div class="card-body">

                        <table id="myDataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID rez</th>
                                    <th>ID client</th>
                                    <th>ID veh</th>
                                    <th>Nume vehicul rezervat</th>
                                   
                                    <th>Nume complet</th>
                                   
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Data efectuare rezervare</th>
                                    <th>Data inceput rezervare</th>
                                    <th>Data sfarsit rezervare</th>
                                    <th>Numar zile</th>
                                    <th>Pret</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <?php if($_SESSION['auth_role'] != "1"){ ?>
                                    <th>Delete</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_user = $_SESSION['id'];
                                $query = "SELECT cars.model AS model,cars.image AS image,cars.id_car AS id_car,users.email AS email, users.firstName AS firstName, users.lastName AS lastName, users.phone AS phone, 
                                reservations.* FROM cars, reservations,users WHERE reservations.id_user = users.id_user AND reservations.id_car = cars.id_car";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    while( $row = mysqli_fetch_array( $query_run))
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_rezervare'];?></td>
                                                  <td><?= $row['id_user'];?></td>
                                                  <td><?= $row['id_car'];?></td>
                                                  <td><?= $row['model'];?></td>
                                                  <td><?= $row['firstName'];?> <?= $row['lastName'];?></td>
                                                  <td><?= $row['email'];?></td>
                                                  <td>0<?= $row['phone'];?></td>
                                                  <td><?= $row['data_efectuare_rezervare'];?></td>
                                                  <td><?= $row['data_inceput_rezervare'];?></td>
                                                  <td><?= $row['data_sfarsit_rezervare'];?></td>
                                                  <td><?= $row['days'];?></td>
                                                  <td><?= $row['price'];?> Lei</td>
                                                  <td><?php if($row['status'] == 'Platit'){  ?>
                                                         <span class="badge bg-success text-black fw-bold">
                                                           Platit</span></li>
                                                         <?php }else{?>
                                                         <span class="badge bg-warning text-black fw-bold">
                                                         Neplatit</span></li>

                                                         <?php }?></td>
                                                  <td><a href="rezervari-edit.php?id_rezervare=<?= $row['id_rezervare'];?>" class="btn btn-success">Editare</td>
                                                  <?php if($_SESSION['auth_role'] != "1" AND $row['status'] != "Platit"){ ?>
                                                  <td>
                                                        <form action="actiuneButoane.php" method="POST">
                                                        <button type="submit" name="rezervari_delete" value="<?= $row['id_rezervare'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi această rezervare?');">Sterge</button></td>
                                                        </form>
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


                        </div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>