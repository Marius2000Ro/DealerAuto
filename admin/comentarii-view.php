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
         <li class="breadcrumb-item">Lista comentarii masini</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
            <?php  include('message.php'); ?>
            <div class="card">
                    <div class="card-header">
                        <h4> Lista comentarii masini:
                        </h4>
                    </div>
                    <div class="card-body">

                        <table id="myDataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID vehicul</th>
                                    <th>ID comentariu</th>
                                    <th>ID client</th>
                                    <th>Comentariul la care a raspuns</th>
                                    <th>Nume vehicul</th>
                                    <th>Imagine vehicul</th>
                                    <th>Nume utilizator</th>
                                    <th>Comentariu</th>
                                    <th>Data adaugare</th>
                                    <th>Status</th>
                                    <th>Editeaza</th>
                                    <?php if($_SESSION['auth_role'] != "1"){ ?>
                                    <th>Sterge</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_user = $_SESSION['id'];
                                $query = "SELECT cars.model AS model,cars.image AS image,cars.id_car AS id_car,users.id_user AS id_user, users.firstName AS firstName, users.lastName AS lastName,  
                                comments.id_comentariu AS id_comentariu, comments.data_adaugare AS data_adaugare, comments.id_parinte_reply AS id_parinte_reply,comments.status AS status, comments.comentariu AS comentariu FROM cars, comments,users WHERE comments.id_user = users.id_user AND comments.id_car = cars.id_car ORDER BY comments.id_car";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run)>0){
                                    while( $row = mysqli_fetch_array( $query_run))
                                    {
                                        ?>
                                                <tr> 
                                                  <td><?= $row['id_car'];?></td>
                                                  <td><?= $row['id_comentariu'];?></td>
                                                  <td><?= $row['id_user'];?></td>
                                                  <td><?= $row['id_parinte_reply'];?></td>
                                                  <td><?= $row['model'];?></td>
                                                  <td><img src="image/car/<?= $row['image'];?>" width="175px" height="100px"/>  </td>
                                                  <td><?= $row['firstName'];?> <?= $row['lastName'];?></td>  
                                                  <td><?= $row['comentariu'];?></td>   
                                                  <td><?= $row['data_adaugare'];?></td>       
                                                  <td><?= $row['status'];?></td>
                                                  <?php if($row['status'] == 'Vizibil'){?>
                                                    <td>
                                                    <form action="actiuneButoane.php" method="POST">
                                                        <button type="submit" name="comentariu_ascunde" value="<?= $row['id_comentariu'];?>" class="btn btn-primary">Ascunde comentariul</button></td>
                                                        </form>
                                                <?php }else{ ?>
                                                  <td>
                                                  <form action="actiuneButoane.php" method="POST">
                                                        <button type="submit" name="comentariu_arata" value="<?= $row['id_comentariu'];?>" class="btn btn-success">Arata comentariul</button></td>
                                                        </form>
                                                        <?php } ?>
                                                  <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                  <td>
                                                        <form action="actiuneButoane.php" method="POST">
                                                        <button type="submit" name="comentariu_delete" value="<?= $row['id_comentariu'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest comentariu?');">Sterge</button></td>
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