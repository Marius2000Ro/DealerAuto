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
         <li class="breadcrumb-item">Rezervari - Editare</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h4> Editare rezervare cu id '<?= $id = $_GET['id_rezervare']; ?>':
                        <a href="rezervari-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-4 mb-3">
                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                                   
                                    <?php 
                         
                            if(isset($_GET['id_rezervare']))
                            {
                                $id = $_GET['id_rezervare'];
                                $query = "SELECT cars.model AS model,cars.image AS image,cars.id_car AS id_car,users.email AS email, users.firstName AS firstName, users.lastName AS lastName, users.phone AS phone, 
                                        reservations.* FROM cars, reservations,users WHERE reservations.id_user = users.id_user AND reservations.id_car = cars.id_car AND reservations.id_rezervare = '$id'";
                                        $query_run = mysqli_query($con, $query);
            

                                if(mysqli_num_rows($query_run) > 0)
                                {  
                                    
                                    
                                    
                                    
                                    foreach($query_run as $row)
                                        {
                                             ?>

                          
                       
                        <input type="hidden" name="id_rezervare" value="<?=$row['id_rezervare'];?>">
                        <input type="hidden" name="id_car" value="<?=$row['id_car'];?>">
                        
                            <div class="row">
                            <div class="col-md-6 mb-3">
                                    <label for="">Nume client: <strong><?=$row['firstName'];?> <?=$row['lastName'];?></strong></label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">ID client: <strong><?=$row['id_user'];?></strong></label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Email: <strong><?=$row['email'];?> </strong></label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Telefon: <strong>0<?=$row['phone'];?> </strong></label>
                                </div>
                             
                                <div class="col-md-6 mb-3">
                                    <label for="">ID masina rezervata: <strong><?=$row['id_car'];?></strong></label>
                                </div>
                             <div class="col-md-6 mb-3">
                                    <label for="">Masina rezervata: <strong><?=$row['model'];?></strong></label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Numar zile rezervare: <strong><?=$row['days'];?></strong></label>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Pret rezervare: <strong><?=$row['price'];?> Lei</strong></label>
                                </div>
                             </div>

                                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Data inceput rezervare</label>
                                    <input type="date" name="data_inceput" value="<?=$row['data_inceput_rezervare'];?>"  required class="form-control">
                                </div>
                       
                                <div class="col-md-4 mb-3">
                                    <label for="">Data sfarsit rezervare</label>
                                    <input type="date" name="data_sfarsit" value="<?=$row['data_sfarsit_rezervare'];?>" required class="form-control">
                                </div>
                           
                               
                                       
                              
                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="">--Status plata--</option>
                                        <option value="Platit" <?php echo $row['status'] == 'Platit' ? 'selected':''?>> Platit</option>
                                        <option value="Neplatit" <?php echo $row['status'] == 'Neplatit' ? 'selected':''?>> Neplatit</option>
                                       
                                    </select>
                                </div>


                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="rezervari_edit" class="btn btn-primary">Editeaza rezervarea</button>
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