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
         <li class="breadcrumb-item">Utilizatori sterse - restaurare</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

                    <?php include('message.php'); ?>

            <div class="card">
                    <div class="card-header">
                        <h4> Restaureaza utilizator:
                        <a href="users-deleted.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id_user']))
                        {
                            $user_id = $_GET['id_user'];
                            $user_edit= ("SELECT * FROM users WHERE id_user='$user_id' AND status='sters'");
                            $user_run = mysqli_query($con, $user_edit);

                            if(mysqli_num_rows($user_run) >0 )
                            {
                                    $row = mysqli_fetch_array($user_run);
                                        ?>
                        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                                
                                    <input type="hidden" name="id" value="<?= $row['id_user'];?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Esti sigur ca vrei sa restaurezi utilizatorul "<?=$row['email'];?>" ?</label>
                                    <select name="status" required class="form-control">
                                        
                                        <option value="1" <?php echo $row['status'] == '1' ? 'selected':''?> >Da</option>
                                        
                                    </select>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="deleted-users-redo" class="btn btn-success">Restaureaza utilizatorul</button>
                                    <a href="users-deleted.php" class="btn btn-danger ">Anuleaza</a>
                                 </div>
                            </div>
                        </form>
                                        <?php

                            }else
                            {
                                ?>
                                    <h4> Nicio inregistrare gasita </h4>
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