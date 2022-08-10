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
<link rel="stylesheet" href="css/profilestyle.css?version6">



<body>
    
    <?php 
    $id_user= $_SESSION['id'];
    if($_SESSION['administrator'] == TRUE){
        $query = $con->query("SELECT * FROM admin WHERE id_admin = '$id_user'");
    }else{
     $query = $con->query("SELECT * FROM users WHERE id_user = '$id_user'");}
     $row = $query->fetch_assoc(); ?>
<div class="container emp-profile">
<?php
include('includes/message.php'); 
?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <h3>Fotografie de profil </h3>
                        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                            <?php if($_SESSION['administrator'] == TRUE){?>
                            <img src="admin/image/adminimage/<?= $row['image'];?>" alt=""/>
                            <?php }else{ ?>
                                <input type="hidden" name="old_image" value="<?= $row['image'];?>">
                                <?php if($row['image'] == 'default-image.jpg'){ ?>
                                    <img src="admin/image/defaultimage/<?= $row['image'];?>" alt=""/>
                                    <?php }else{ ?>
                                <img src="admin/image/userimage/<?= $row['image'];?>" alt=""/>
                                <?php  } }?>
                            <div class="file btn btn-lg btn-primary">
                                Alege alta fotografie
                                <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" required/>
                    
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
                                    <p class="proile-rating"><span>Astazi, <?php echo date("d-m-Y");?></span></p>
                                    <p class="proile-rating"><span><i class='fas fa-address-book' style='font-size:36px'></i></span></p>
                                    
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="profil.php" role="tab" aria-controls="home" aria-selected="true">Despre</a>
                                </li>
                                <?php if(isset($_SESSION["administrator"]) AND $_SESSION['administrator'] != TRUE){ ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="rezervariprofil.php" role="tab" aria-controls="profile" aria-selected="false">Rezervari</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="achizitiiprofil.php" role="tab" aria-controls="profile" aria-selected="false">Achizitii</a>
                                </li>
                                <?php } ?>
                            </ul>
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>LINK RETELE SOCIALE</p>
                            <a href=""><i class="fab fa-facebook-f"></i>Facebook</a><br/>
                            <a href=""><i class="fab fa-instagram"></i>Instagram</a><br/>
                            <a href=""><i class="fab fa-linkedin"></i>LinkedIn</a><br/>
                            <a href=""><i class="fab fa-snapchat"></i>Snapchat</a><br/>
                            <a href=""><i class="fab fa-twitch"></i>Twitch</a>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>ID utilizator</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php if($_SESSION['administrator'] == TRUE){echo $row['id_admin'];}else{echo $row['id_user'];} ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nume</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=$row['firstName']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Prenume</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=$row['lastName']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php if($_SESSION['administrator'] == TRUE){echo $row['email_admin'];}else{echo $row['email'];} ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Telefon</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>0<?=$row['phone']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <?php if($_SESSION['administrator'] == FALSE) {?>
                                                <label>Varsta</label>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <p><?=$row['age']; ?> ani</p>
                                            </div> <?php }else{ ?>
                                                <label>Rol</label>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <p><?php if($row['role'] == "1"){echo "Angajat";}else{echo "Administrator";} ?> </p><?php }?>
                                        </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label> Adresa</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=$row['adress']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Cont creat la data</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?=$row['created']; ?></p>
                                            </div>
                                        </div>
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