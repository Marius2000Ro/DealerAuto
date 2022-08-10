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
         <li class="breadcrumb-item">Istoric - Editare</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <h4> Editare istoric cu id '<?= $data->id_istoric ?>' pentru masina '<?= $data->id_car?>':
                        <a href="../../istoric" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <div class="col-md-4 mb-3">
                    <form action='' method="POST">
                 
                        

                                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Data intrare service</label>
                                    <input type="date" name="data_intrare_service" value="<?= $data->data_intrare_service?>"  required class="form-control">
                                </div>
                       
                                <div class="col-md-4 mb-3">
                                    <label for="">Data iesire service</label>
                                    <input type="date" name="data_iesire_service" value="<?= $data->data_iesire_service?>" required class="form-control">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Pret manopera</label>
                                    <input type="number" name="pret_manopera" value="<?= $data->pret_manopera?>" required class="form-control">
                                </div>
                           
                                <div class="col-md-4 mb-3">
                                    <label for="">Pret piese</label>
                                    <input type="number" name="pret_piese" value="<?= $data->pret_piese?>" required class="form-control">
                                </div>
                                <!-- <div class="col-md-2 mb-3">
                                    <label for="">Pret total</label>
                                    <input type="number" name="pret_total" required class="form-control">
                                </div> -->
                              
                            
                            </div>


                                       
                              
                                <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="">Tip operatie</label>
                                    <select name="tip_operatie" required class="form-control">
                                        <option value="">--Tip operatie--</option>
                                        <option value="Revizie" <?php echo $data->tip_operatie == 'Revizie' ? 'selected':''?>> Revizie</option>
                                        <option value="Reparatie" <?php echo $data->tip_operatie == 'Reparatie' ? 'selected':''?>> Reparatie</option>
                                        <option value="Accident" <?php echo $data->tip_operatie == 'Accident' ? 'selected':''?>> Accident</option>
                                       
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="">Kilometri</label>
                                    <input type="number" name="km" value="<?= $data->km?>" required class="form-control">
                                </div>
                              </div>

                              <div class="col-md-12  mb-3">
                                    <label for="">Descriere</label>
                                    <textarea name="descriere" required class="form-control" rows="5"><?= $data->descriere?> </textarea>
                                </div>
                            
                            </div>
                                
                                <div class="col-md-12 mb-3">
                                    <input type="submit" name="action" class="btn btn-primary" value='Salveaza'>
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



