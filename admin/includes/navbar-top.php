<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Marius Dealer Auto</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <?php $admin_id= $_SESSION['id'] ?>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php 
                    include('config/dbcon.php');
                     $query = ("SELECT image FROM admin WHERE id_admin ='$admin_id'");
                     $query_run = mysqli_query($con, $query);
                     if(mysqli_num_rows($query_run)>0){
                        while( $row = mysqli_fetch_array( $query_run))
                        {  
                            $image = $row['image'];
                          
                        }
                        
                     }else{
                         $image = "Eroare";
                     }  ?>
                   
                    <img src="image/adminimage/<?= $image ?>" class="rounded-circle" alt="Img" width="40px"> <?= $_SESSION['auth_user']['user_name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="administratori-edit.php?id_admin=<?= $admin_id?>">Editeaza datele contului</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>