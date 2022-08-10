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
         <li class="breadcrumb-item">Categorii</li>
    </ol>
    <div class="row">

        <div class="col-md-12">

                    <?php include('message.php'); ?>

            <div class="card">
                    <div class="card-header">
                        <h4> Editeaza categorie:
                        <a href="category-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id']))
                        {
                            $category_id = $_GET['id'];
                            $category_edit= ("SELECT * FROM category WHERE id_category='$category_id'");
                            $category_run = mysqli_query($con, $category_edit);

                            if(mysqli_num_rows($category_run) >0 )
                            {
                                    $row = mysqli_fetch_array($category_run);
                                        ?>
                        <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                                
                                    <input type="hidden" name="id" value="<?= $row['id_category'];?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Nume categorie</label>
                                    <input type="text" name="name" value="<?= $row['name']; ?>" required class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine</label>
                                    <input type="hidden" name="old_image" value="<?= $row['image'];?>">
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" value="<?= $row['image']; ?>"  class="form-control">
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="">--Afisare categorie--</option>
                                        <option value="1" <?php echo $row['status'] == '1' ? 'selected':''?> >Da</option>
                                        <option value="0" <?php echo $row['status'] == '0' ? 'selected':''?> >Nu</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="category_edit" class="btn btn-primary">Actualizare categorie</button>
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