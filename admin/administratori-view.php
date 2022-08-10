<?php
session_start();
include('includes/header.php');
include('autentificare.php');
include('autentificareAdministrator.php');
include('includes/sidebar.php');
?>

<div class="container-fluid px-4">
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
                        <h4> Administratori:
                        <a href="administratori-add.php" class="btn btn-primary float-end">Adauga administrator/angajat</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table id="myDataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fotografie</th>
                                    <th>Nume</th>
                                    <th>Prenume</th>
                                    <th>Email</th>
                                    <th>Adresa</th>
                                    <th>Telefon</th>
                                    <th>Functie</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM admin";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    foreach( $query_run as $row)
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_admin'];?></td>
                                                  <td><img src="image/adminimage/<?= $row['image'];?>" width="175px" height="150px"/>  </td>
                                                  <td><?= $row['firstName'];?></td>
                                                  <td><?= $row['lastName'];?></td>
                                                  <td><?= $row['email_admin'];?></td>
                                                  <td><?= $row['adress'];?></td>
                                                  <td>0<?= $row['phone'];?></td>
                                                  <td>

                                                        <?php
                                                            if($row['role'] == '1'){
                                                                echo 'Angajat';
                                                            }elseif($row['role'] == '2'){
                                                                echo 'Administrator';
                                                            }
                                                        ?>

                                                  </td>
                                                  <td><a href="administratori-edit.php?id_admin=<?= $row['id_admin'];?>" class="btn btn-success">Editare</td>
                                                     <td>
                                                         <form action="actiuneButoane.php" method="POST">
                                                          <button type="submit" name="admin_delete" value="<?= $row['id_admin'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest cont?');">Stergere</button>
                                                         </form>
                                                    </td>
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