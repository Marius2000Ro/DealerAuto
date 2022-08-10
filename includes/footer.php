<!-- Inceput sectiune footer-->


<section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Despre noi</h3>
                <p>Firma "MariusDealerAuto" se ocupa cu vanzarea de masini second-hand de peste 10 ani.</p>
                <p>Oferim posibilitatea de rezervare pentru o perioada limitata.</p>
                <p>Telefon: 0773791451<i class="fa fa-phone"></i></p>
            </div>
            <div class="box">
                <h3>Locația noastra</h3>
                <a href="#">Brasov</a>
                <p>Strada Colinei nr 36</p>
                <a href="contact.php">Vezi locatia pe harta</a>


                
            </div>
            <div class="box">
                <h3>Cuprins</h3>
                <a href="index.php">Acasă</a>
                <a href="desprenoi.php">Despre noi</a>
                <a href="masini.php">Masini</a>
                <a href="category.php">Categorii</a>
                <a href="contact.php">Contact</a>
                <?php if(isset($_SESSION['loggedin'])){ ?>  
                    <a href="profil.php">Profil</a>
                    <?PHP }else{?> 
                    <a href="login.php">Conectare</a>
                <?php }  ?>
            </div>
            <div class="box">
                <h3>Rețele de socializare</h3>
                <a href="#">Facebook</a>
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
                <a href="#">Linkedin</a>
            </div>
        </div>

    </section>
    <!-- Sfarsit sectiune footer-->