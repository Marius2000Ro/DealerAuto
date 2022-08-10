<?php 
include("includes/meniu.php"); 
include('admin/config/dbcon.php');
if(!isset($_SESSION['loggedin'])){
    header('Location: login.php');
    }

   

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/profilestyle.css?version12">




<body>
    <?php 
    $id_user= $_SESSION['id'];
    // Daca suntem conectati ca administrator, luam datele din tabelul administratorilor
    if($_SESSION['administrator'] == TRUE){
        $query = $con->query("SELECT * FROM admin WHERE id_admin = '$id_user'");
    }else{
     $query = $con->query("SELECT * FROM users WHERE id_user = '$id_user'");}
     $row = $query->fetch_assoc(); ?>
<div class="container emp-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <h3>Fotografie de profil </h3>
                        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                            <?php if($_SESSION['administrator'] == TRUE){?>
                            <img src="admin/image/adminimage/<?= $row['image'];?>" alt=""/>
                            <?php }else{ ?>
                                <input type="hidden" name="old_image" value="<?= $row['image'];?>">
                                <img src="admin/image/userimage/<?= $row['image'];?>" alt=""/>
                                <?php  } ?>
                            <div class="file btn btn-lg btn-primary">
                                Alege alta fotografie
                                <input type="file" name="image" required/>
                    
                            </div>
                            <input type="hidden" name="user_id" value="<?=$row['id_user'];?>">
                            <?php if($_SESSION['administrator'] == FALSE){ ?>
                            <button type="submit" name="update_fotografieuser" class="btn btn-primary btn-lg">Actualizeaza fotografia</button> 
                            <?php } ?>
                        </div>
                    </div>
                         </form>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h3>
                                       <strong> <?= $row['firstName'];?> <?= $row['lastName'];?></strong>
                                    </h3>
                                    <h4>
                                        <?php 
                                        if($_SESSION['administrator']){echo "Administrator";}else{echo "Utilizator";}?>
                                    </h4>
                                    <p class="proile-rating"> <span></span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
                                <li class="nav-item">
                                    <a class="nav-link " id="home-tab" data-toggle="tab" href="profil.php" role="tab" aria-controls="home" aria-selected="false">Despre</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="rezervariprofil.php" role="tab" aria-controls="profile" aria-selected="true">Rezervari</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="achizitiiprofil.php" role="tab" aria-controls="profile" aria-selected="false">Achizitii</a>
                                </li>
                            </ul>
    
                            <table class="table">
                            <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col"></th>
      <th scope="col">Masina</th>
      <th scope="col">Imagine</th>
      <th scope="col">Data efectuare</th>
      <th scope="col">Data inceput</th>
      <th scope="col">Data sfarsit</th>
      <th scope="col">Pret</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    
                            <?php
                                 $id_user = $_SESSION['id'];
                                // $query = "SELECT * FROM cars WHERE status != 'sters' ";
                                // Afisam datele rezervarilor
                                $query = "SELECT cars.model AS model,cars.image AS image,cars.id_car AS id_car, reservations.* FROM cars, reservations  WHERE reservations.id_user = '$id_user' AND reservations.id_car = cars.id_car";
                                $query2 = "SELECT cars.model AS model,cars.image AS image, reservations.* FROM cars, reservations  WHERE reservations.id_user = '$id_user' AND reservations.id_car = cars.id_car AND reservations.status='Platit'";
                                $query_run = mysqli_query($con, $query);
                                $query_run2 = mysqli_query($con, $query2);
                                $nr_rezervari = mysqli_num_rows($query_run);
                                $nr_rezervari_confirmate = mysqli_num_rows($query_run2);
                                if(mysqli_num_rows($query_run)>0){
                                    ?> <h4><strong>Numar rezervari: <?= $nr_rezervari ?></strong></h4>
                                     <?php if(mysqli_num_rows($query_run2)>0){  ?>  <h3><strong>Numar rezervari confirmate: <?= $nr_rezervari_confirmate ?></strong></h3> <?php }else{ echo "Numar rezervari confirmate: 0";}
                                    while( $row = mysqli_fetch_array( $query_run))
                                    {
                                        ?>
                                               <?php
                                               $id_rezervare =  $row['id_rezervare']; 
                                               $model= $row['model'];
                                               $image = $row['image'];
                                               $data_efectuare_rezervare = $row['data_efectuare_rezervare'];
                                               $data_efectuare_rezervare = date("d-m-Y H:s", strtotime($data_efectuare_rezervare));
                                               $data_inceput_rezervare = $row['data_inceput_rezervare']; 
                                               $data_inceput_rezervare = date("d-m-Y", strtotime($data_inceput_rezervare));
                                               $data_sfarsit_rezervare = $row['data_sfarsit_rezervare'];
                                               $data_sfarsit_rezervare = date("d-m-Y", strtotime($data_sfarsit_rezervare));
                                               $price = $row['price'];
                                               $status = $row['status'];?>
                                                  
                                
                                                  <tr>
                                                     <th scope="row"><?=$id_rezervare?></th>
                                                      <!-- // Form pentru a putea vedea fiecare factura -->
                                                   <td>  <form action="factura-view.php?id_rezervare=<?= $id_rezervare;?>" method="POST" enctype="multipart/form-data">
                                                              <input type="hidden" name="id_rezervare" value="<?= $id_rezervare;?>">  
                                                              <input type="hidden" name="id_car" value="<?= $id_car;?>"> 
                                                              <input type="hidden" name="status" value="<?= $status;?>"> 
                                                              <input type="submit"  class="btn btn-success" name="edit-profile-user" value="Vezi factura"/>
                                                          </form>
                                                         <!-- // Form pentru a sterge o achizitie neplatita -->
                                                         <?php if($status == 'Neplatit' ){?>
                                                                 <form action="actiuneButoane.php" method="POST">
                                                                        <button type="submit" name="user_delete_rezervare" value="<?= $id_rezervare?>" class="btn btn-danger">Sterge</button></td>
                                                                 </form>
                                                         <?php }?> 
                                                                </td>
                                                    <td><?= $model?></td> 
                                                    <td><img src="admin/image/car/<?= $row['image'];?>" width="100" height="80px"/></td>
                                                    <td><?=  $data_efectuare_rezervare?></td>
                                                    <td><?=  $data_inceput_rezervare?></td>
                                                    <td><?=  $data_sfarsit_rezervare?></td>
                                                    <td><?=  $price?> Lei</td>
                                                    <td><?=  $status?></td>
                                                   
                                                     </tr>
                                            
                                                 
                                                 
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
                    <div class="col-md-2">
                    <?php if($_SESSION['administrator'] == FALSE){ ?>
                        <form action="edituserprofile.php?id=<?=$row['id_user']?>" method="POST" enctype="multipart/form-data">
                        <input type="submit" href="editare-users.php?id_user=<?= $row['id_user'];?>" class="profile-edit-btn" name="edit-profile-user" value="Editeaza"/>
                        </form>
                    <?php } ?>
                    </div>
                </div>
               
            </form>           
        </div>

</body>



<?php 
include("includes/footer.php");  

?>