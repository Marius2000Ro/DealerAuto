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
         <li class="breadcrumb-item">Utilizatori</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
            <?php  include('message.php'); ?>
            <div class="card">
                    <div class="card-header">
                        <h4> Utilizatori inregistrati:
                        
                        <a href="users-deleted.php" class="btn btn-danger float-none">Vezi utilizatori stersi</a>
                        <?php if($_SESSION['auth_role'] != "1"){ ?>
                        <a href="users-add.php" class="btn btn-primary float-end">Adauga utilizator</a>
                        <?php } ?>

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
                                    <th>Varsta</th>
                                    <th>Telefon</th>
                                    <th>Data inregistrarii</th>
                                    <th>Verificat</th>
                                    <th>Cont blocat</th>
                                   <?php if($_SESSION['auth_role'] != "1"){ ?>
                                    <th>Edit</th>
                                    <?php } ?>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM users WHERE status != 'sters'";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    foreach( $query_run as $row)
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_user'];?></td>
                                                  <td><img src="image/userimage/<?= $row['image'];?>" width="175px" height="150px"/>  </td>
                                                  <td><?= $row['firstName'];?></td>
                                                  <td><?= $row['lastName'];?></td>
                                                  <td><?= $row['email'];?></td>
                                                  <td><?= $row['adress'];?></td>
                                                  <td><?= $row['age'];?></td>
                                                  <td>0<?= $row['phone'];?></td>
                                                  <td><?= $row['created'];?></td>
                                                  <td><?= $row['verified'];?></td>
                                                  <td><?= $row['blocked'];?></td>
                                                  <td><a href="users-edit.php?id_user=<?= $row['id_user'];?>" class="btn btn-success">Editare</td>
                                                  <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                  <td>
                                                        <form action="actiuneButoane.php" method="POST">
                                                        <button type="submit" name="user_delete" value="<?= $row['id_user'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest utilizator?');">Stergere</button></td>
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