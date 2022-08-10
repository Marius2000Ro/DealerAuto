<?php
session_start();
include('includes/header.php');
include('autentificare.php');
// Pentru a-si putea modifica angajatul datele sale
if($_GET['id_admin'] != $_SESSION['id']){
include('autentificareAdministrator.php');
}
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
            <div class="card">
                    <div class="card-header">
                        <h4> Editare administrator/angajat:
                        <?php if($_SESSION['auth_role'] != "1"){ ?>
                        <a href="administratori-view.php" class="btn btn-danger float-end">Inapoi</a>
                        <?php } ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        
                            <?php
                            if(isset($_GET['id_admin']))
                            {
                                $admin_id = $_GET['id_admin'];
                                $admins = "SELECT * FROM admin WHERE id_admin='$admin_id'";
                                $admins_run = mysqli_query($con, $admins);

                                if(mysqli_num_rows($admins_run) > 0)
                                {   foreach($admins_run as $admin)
                                        {
                                             ?>

                                            
                                
                            

                        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="admin_id" value="<?=$admin['id_admin'];?>">
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="">Nume</label>
                                    <input type="text" name="firstName" value="<?php echo $admin['firstName'];?>" class="form-control">
                                </div>
                            
                                <div class="col-md-5 mb-3">
                                    <label for="">Prenume</label>
                                    <input type="text" name="lastName" value="<?php echo $admin['lastName'];?>" class="form-control">
                                </div>
                            </div>
                           
                            <div class="row">
                            <?php if($_SESSION['auth_role'] == "1"){ ?>
                                <div class="col-md-5 mb-3">
                                    <label for="">Email</label></br>
                                    <label for=""><strong><?php echo $admin['email_admin'];?></strong></label>
                                    <input type="hidden" name="email_admin" value="<?php echo $admin['email_admin'];?>"  class="form-control">
                                </div>
                                <?php } ?>
                            <?php if($_SESSION['auth_role'] != "1"){ ?>
                                <div class="col-md-5 mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email_admin" value="<?php echo $admin['email_admin'];?>"  class="form-control">
                                </div>
                            <?php } ?>
                                <div class="col-md-5 mb-3">
                                    <label for="">Adresa</label>
                                    <input type="text" name="adress" value="<?php echo $admin['adress'];?>"  class="form-control">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="">Parola</label>
                                    <input type="password" name="password" value="<?php echo $admin['password_admin'];?>"  class="form-control">
                                </div>


                            
                                <div class="col-md-5 mb-3">
                                    <label for="">Repeta parola</label>
                                    <input type="password" name="passwordConfirm" value="<?php echo $admin['password_admin'];?>"  class="form-control">
                                </div>
                            </div>


                           


                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="">Telefon</label>
                                    <input type="text" name="phone" value="0<?php echo $admin['phone'];?>" class="form-control">
                                </div>
                            </div>
                            <?php if($_SESSION['auth_role'] != "1"){ ?>
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="">Functie</label>
                                    <select name="role" required class="form-control">
                                        <option value="">--Selecteaza functia--</option>
                                        <option value="1" <?php echo $admin['role'] == '1' ? 'selected':''?> >Angajat</option>
                                        <option value="2" <?php echo $admin['role'] == '2' ? 'selected':''?> >Administrator</option>
                                    </select>
                                </div>
                                <?php } ?>
                                <div class="row">
                                     <div class="col-md-6 mb-3">
                                          <label for="">Imagine profil pentru <?=$admin['firstName'];?> <?=$admin['lastName'];?> </label>
                                          <input type="hidden" name="old_image" value="<?= $admin['image'];?>">
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" class="form-control">
                                      </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="update_admin" class="btn btn-primary">Actualizare administrator</button>
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