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
            <div class="card">
                    <div class="card-header">
                        <h4> Editare utilizator:
                        <a href="users-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body">

                    <?php
                            if(isset($_GET['id_user']))
                            {
                                $user_id = $_GET['id_user'];
                                $users = "SELECT * FROM users WHERE id_user='$user_id'";
                                $users_run = mysqli_query($con, $users);

                                if(mysqli_num_rows($users_run) > 0)
                                {   foreach($users_run as $user)
                                        {
                                             ?>

                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?=$user['id_user'];?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Nume</label>
                                    <input type="text" name="firstName" value="<?php echo $user['firstName'];?>" class="form-control">
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Prenume</label>
                                    <input type="text" name="lastName" value="<?php echo $user['lastName'];?>" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="<?php echo $user['email'];?>" class="form-control">
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Adresa</label>
                                    <input type="text" name="adress" value="<?php echo $user['adress'];?>" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Parola</label>
                                    <input type="password" name="password" value="<?php echo $user['password'];?>" class="form-control">
                                </div>


                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Repeta parola</label>
                                    <input type="password" name="passwordConfirm" value="<?php echo $user['password'];?>" class="form-control">
                                </div>
                            </div>


                           

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Varsta</label>
                                    <input type="text" name="age"  value="<?php echo $user['age'];?>" class="form-control">
                                </div>
                           
                                <div class="col-md-6 mb-6">
                                    <label for="">Telefon</label>
                                    <input type="text" name="phone" value="0<?php echo $user['phone'];?>"  class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Verificat</label>
                                    <select name="verified" required class="form-control">
                                        <option value="">--Cont verificat--</option>
                                        <option value="1" <?php echo $user['verified'] == '1' ? 'selected':''?> >Da</option>
                                        <option value="0" <?php echo $user['verified'] == '0' ? 'selected':''?> >Nu</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Cont blocat</label>
                                    <input type="checkbox" name="blocked" <?=$user['blocked'] == 'Da' ? 'checked':''?> >
                                </div>
                                <div class="row">
                                     <div class="col-md-6 mb-3">
                                          <label for="">Imagine profil pentru utilizatorul <?=$user['firstName'];?> <?=$user['lastName'];?> </label>
                                          <input type="hidden" name="old_image" value="<?= $user['image'];?>">
                                          <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" class="form-control">
                                      </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <button type="submit" name="update_user" class="btn btn-primary">Actualizare utilizator</button>
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