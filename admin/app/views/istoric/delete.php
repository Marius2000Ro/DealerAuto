<link href="../../css/styles.css" rel="stylesheet" />



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
         <li class="breadcrumb-item">Istoric - Stergere</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h4> Esti sigur ca vrei sa stergi istoricul '<?= $data->id_istoric ?>' pentru masina '<?= $data->id_car?>'?
                        <a href="../../istoric" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-4 mb-3">
                    <form action='' method="POST">
                 
                                <div class="row">
                              
                                
                                <div class="col-md-12 mb-3">
                                    <input type="submit" name="action" class="btn btn-danger" value='Da, sterge'>
                                 </div>
                          </div>

                        </form>
                        <a href="../../istoric" class="btn btn-success">Anuleaza</a>

                    <div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>
















<html>
  <head><title>Delete an item</title></head>
  <body>
    <h1>Delete an item</h1>
    <form action='' method='post'>
      <label>Name:<input type='text' name='name'
        value='<?= $data->id_istoric ?>' disabled />
        </label><br />
      <input type='submit' name='action' value='Delete' /> 
    </form>
    <a href='../../istoric'>Cancel</a>
  </body>
</html> 