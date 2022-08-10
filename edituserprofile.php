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
<link rel="stylesheet" href="css/edituserprofile.css?version8">


<body>
    <?php 
    $id_user= $_SESSION['id'];
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
                                <img src="admin/image/userimage/<?= $row['image'];?>" alt=""/>
                                <?php  } ?>
                            <div class="file btn btn-lg btn-primary">
                                Imagine de profil
                               
                    
                            </div>
                            
                            <input type="hidden" name="user_id" value="<?=$row['id_user'];?>">
                            
                        </div>
                    </div>
                         </form>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h3>
                                        <?= $row['firstName'];?> <?= $row['lastName'];?>
                                        <a href="profil.php" class="btn btn-danger float-end ml-">Inapoi</a>
                                    </h3>
                                    <h4>
                                        <?php 
                                        if($_SESSION['administrator']){echo "Administrator";}else{echo "Utilizator";}?>
                                    </h4>

                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?= $row['id_user'];?>">
                                 <div class="row">
                                     <div class="col-md-6 mb-3">
                                        <label for="">Nume</label>
                                        <input type="text" name="firstName" value="<?php echo $row['firstName'];?>" class="form-control">
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="">Prenume</label>
                                        <input type="text" name="lastName" value="<?php echo $row['lastName'];?>" class="form-control">
                                      </div>

                                      <div class="col-md-6 mb-3">
                                        <label for="">Parola noua</label>
                                        <input type="password" name="password" value="<?php echo $row['password'];?>" class="form-control">
                                      </div>

                                      <div class="col-md-6 mb-3">
                                        <label for="">Repeta parola</label>
                                        <input type="password" name="passwordConfirm" value="<?php echo $row['password'];?>" class="form-control">
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="">Varsta</label>
                                        <input type="text" name="age" value="<?php echo $row['age'];?>" class="form-control">
                                      </div>


                                      <div class="col-md-6 mb-3">
                                        <label for="">Adresa</label>
                                        <input type="text" name="adress" value="<?php echo $row['adress'];?>" class="form-control">
                                      </div>
                                      <div class="col-md-6 mb-3">
                                        <label for="">Numar telefon</label>
                                        <input type="text" name="phone" value="0<?php echo $row['phone'];?>" class="form-control">
                                      </div>
                                      <div class="col-md-6 mb-3">
                                    <button type="submit" name="edituserprofile" class="btn btn-primary">Actualizare datele</button>
                                 </div>


                                        
                                    </div>
                            
                        </div>
                    </div>
                    
                </div>
               
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            
                            
                                
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

</body>





<?php 
include("includes/footer.php");  

?>