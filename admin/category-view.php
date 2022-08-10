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
                   
                        <h4> Categorii
                        <a href="category-deleted.php" class="btn btn-primary  ">Vezi categorii sterse</a>
                        <a href="category-add.php" class="btn btn-primary float-end">Adauga categorie</a>
                        
                        </h4>
                        
                    </div>
                    <div class="card-body">

                                <div class="table-responsive">
                                        <table id="myDataTable" class="table table-bordered table-stripe">
                                                <thead>
                                                        <tr>
                                                                        <th>ID</th>
                                                                        <th>Nume categorie</th>
                                                                        <th>Status</th>
                                                                        <th>Imagine</th>
                                                                        <th>Editeaza</th>
                                                                        <th>Sterge</th>
                                                        </tr>

                                                </thead>
                                                <tbody>
                                                <?php  
                                                    $category= ("SELECT * from category WHERE status != '2'");

                                                       $category_run = mysqli_query($con, $category);

                                                          if(mysqli_num_rows($category_run)>0){
                                                                  foreach($category_run as $i){
                                                 ?>
                                                        <tr>
                                                            <td><?= $i['id_category']; ?></td>
                                                            <td><?= $i['name']; ?></td>
                                                            <td>
                                                                <?php  if($i['status'] == '0'){ echo 'Ascuns';}else{ echo 'Vizibil';} 
                                                                ?>
                                                            </td>
                                                            <td><img src="image/category/<?= $i['image'];?>" width="100px" height="60px"/>  </td>
                                                            <td><a href="category-edit.php?id=<?= $i['id_category']; ?>" class="btn btn-info">Editare</td>
                                                            <td>
                                                                <form action="actiuneButoane.php" method="POST">
                                                                    <button type="submit" name="category-delete" value="<?= $i['id_category']; ?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acestă categorie?');">Stergere</button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                        <?php

                                                                                                  }


                                                      }else{
                                                          ?>
                                                                    <tr>
                                                                       <td colspan="5">Nicio inregistrare gasita</td>
                                                                    </tr>
                                                         <?php
                                                       }
                            
                            
                                                      ?>
                                                </tbody>
                                        </table>


                                </div>








                    <div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>