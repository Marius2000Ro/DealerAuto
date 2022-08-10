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
                        <h4> Adaugare utilizator:
                        <a href="users-view.php" class="btn btn-danger float-end">Inapoi</a>
                        </h4>
                        
                    </div>
                    <div class="card-body">

                    <form action="actiuneButoane.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Nume</label>
                                    <input type="text" name="firstName"  class="form-control">
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Prenume</label>
                                    <input type="text" name="lastName"  class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                           
                                <div class="col-md-6 mb-3">
                                    <label for="">Adresa</label>
                                    <input type="text" name="adress"  class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Parola</label>
                                    <input type="password" name="password"  class="form-control">
                                </div>


                            
                                <div class="col-md-6 mb-3">
                                    <label for="">Repeta parola</label>
                                    <input type="password" name="passwordConfirm"  class="form-control">
                                </div>
                            </div>


                           

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Varsta</label>
                                    <input type="text" name="age"  class="form-control">
                                </div>
                           
                                <div class="col-md-6 mb-3">
                                    <label for="">Telefon</label>
                                    <input type="text" name="phone"  class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Verificat</label>
                                    <select name="verified" required class="form-control">
                                        <option value="">--Cont verificat--</option>
                                        <option value="1"> Da</option>
                                        <option value="0"> Nu</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Cont blocat</label>
                                    <input type="checkbox" name="blocked"  >
                                </div>
                                
                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Imagine user</label>
                                    <input type="file" accept="image/jpg, image/jpeg, image/png" name="image" required class="form-control">
                                </div>
                            </div>
                                
                                <div class="col-md-6 mb-3">
                                    <button type="submit" name="add_user" class="btn btn-primary">Adauga utilizator</button>
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