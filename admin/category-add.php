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
                        <h4> Adauga categorie:
                        <a href="category-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">

                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Nume categorie</label>
                                    <input type="text" name="name" required class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" required class="form-control">
                                </div>
                            </div>

                            

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                    <select name="status" required class="form-control">
                                        <option value="">--Afisare categorie--</option>
                                        <option value="1"> Da</option>
                                        <option value="0"> Nu</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="category_add" class="btn btn-primary">Adauga categorie</button>
                                 </div>
                            </div>
                        </form>






                    <div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>