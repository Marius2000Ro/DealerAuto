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
                   
                        <h4> Categorii sterse
                       
                        <a href="category-view.php" class="btn btn-warning float-end">Inapoi</a>
                        
                        </h4>
                        
                    </div>
                    <div class="card-body">

                                <div class="table-responsive">
                                        <table id="myDataTable" class="table table-bordered table-stripe">
                                                <thead>
                                                        <tr>
                                                                        <th>ID</th>
                                                                        <th>Nume categorie</th>
                                                                    
                                                                        <th>Imagine</th>
                                                                        <th>Anuleaza stergerea</th>
                                                                        <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                                        <th>Sterge definitiv</th>
                                                                        <?php } ?>
                                                                       
                                                        </tr>

                                                </thead>
                                                <tbody>
                                                <?php  
                                                    $category= ("SELECT * from category WHERE status = '2'");

                                                       $category_run = mysqli_query($con, $category);

                                                          if(mysqli_num_rows($category_run)>0){
                                                                  foreach($category_run as $i){
                                                 ?>
                                                        <tr>
                                                            <td><?= $i['id_category']; ?></td>
                                                            <td><?= $i['name']; ?></td>
                                                           
                                                            <td><img src="image/category/<?= $i['image'];?>" width="100px" height="60px"/>  </td>
                                                            <td><a href="category-deleted-edit.php?id=<?= $i['id_category']; ?>" class="btn btn-success">Anuleaza stergerea</td>
                                                            <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                            <td>
                                                                    <form action="actiuneButoane.php" method="POST">
                                                                        <button type="submit" name="category_delete_definitiv" value="<?= $i['id_category'];?>" class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi această categorie definitiv?');">Stergere definitiv</button></td>
                                                                 </form>
                                                          </td>
                                                            <?php } ?>
                                                            
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