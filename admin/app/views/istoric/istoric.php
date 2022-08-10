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
         <li class="breadcrumb-item">Istoric vehicule</li>
    </ol>
    <div class="row">

        <div class="col-md-12">
            <?php  include('message.php'); ?>
            <div class="card">
                    <div class="card-header">
                        <h4> Istoric vehicule:

                        <a href="istoric/create" class="btn btn-primary float-end">Adauga istoric</a>

                        </h4>
                    </div>
                    <div class="card-body">

                        <table id="myDataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>ID vehicul</th>
                                    <th>ID istoric</th>
                                    <th>Data adaugare istoric</th>
                                    <th>Data intrare service</th>
                                   
                                    <th>Data iesire service</th>
                                   
                                    <th>Pret manopera</th>
                                    <th>Pret piese</th>
                                    <th>Pret total</th>
                                    <th>Tip operatie</th>
                                    <th>Km</th>
                                    <th>Descriere</th>
                                    <?php if($_SESSION['auth_role'] != "1"){ ?>
                                        <th>Editeaza</th>
                                    <th>Sterge</th>
                                    <?php }?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                               foreach($data['items'] as $item){
                                    
                                        ?>
                                                <tr> 
                                                  
                                                  <td><?= $item->id_car ?></td>
                                                  <td><?= $item->id_istoric ?></td>
                                                  <td><?= $item->data_adaugare_istoric ?></td>
                                                  <td><?= $item->data_intrare_service ?></td>
                                                  <td><?= $item->data_iesire_service ?></td>
                                                  <td><?= $item->pret_manopera ?></td>
                                                  <td><?= $item->pret_piese ?></td>
                                                  <td><?= $item->pret_total ?></td>
                                                  <td><?= $item->tip_operatie ?></td>
                                                  <td><?= $item->km ?></td>
                                                  <td><?= $item->descriere ?></td>


                                                  <?php if($_SESSION['auth_role'] != "1"){ ?>
                                                  <td> <a href='istoric/edit/<?= $item->id_istoric?>'class="btn btn-success">Editare </a></td>
                                                  <td> <a href='istoric/delete/<?= $item->id_istoric?>'class="btn btn-danger" onclick="return confirm('Ești sigur că vrei să ștergi acest istoric?');">Sterge </a></td>
                                                  <?php } ?>
                                                 </tr>
                                        <?php
                                    
                                }
                            
                                ?>
                            
                            </tbody>
                        </table>


                        </div>
            </div>
          </div>
    </div>


    
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');

?>