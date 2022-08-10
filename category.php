<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/categorystyle.css?version8">
<?php include("includes/meniu.php");?>
<!-- Inceput sectiune vehicule-->
<section class="vehicule" id="vehicule">

        <h1 class="heading"> <span>Categorii </span>disponibile</h1>
        

       
</section>

<body>
<header>
  
        <div class="container">
                <div class="input-filter">
                    <input type="text" name="" id="filter" class="filter" placeholder="Introdu categoria" onkeyup="searchCategory()">
                </div>
       


        <div class="card-lists" id="card-lists">
                <div class="row">

                <?php
                      $db = mysqli_connect("localhost", "root", "", "cardealer");  
                      $result = mysqli_query($db, "SELECT * FROM category WHERE status ='1'");
                      while($data = mysqli_fetch_array($result))
                        {
                ?>
                  <a href="masini.php?id_category=<?= $data['id_category']; ?>" style="text-decoration:none!important">
                        <div class="card">
                          
                        <img src="admin/image/category/<?php echo $data['image']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['name']; ?></h5>
                            </div>
                        </div>

                       <?php } ?>
                </div>

                
        </div>

        </div>

</header>



</body>

<?php include("includes/footer.php");?>
<script src="js/scriptCategory.js"></script>
   