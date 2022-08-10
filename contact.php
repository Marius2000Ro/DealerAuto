

<?php 
include("includes/meniu.php");
// Mesajul afisat
$responses = [];
// Daca apasam pe  butonul de contact
if (isset($_POST['email'], $_POST['subject'], $_POST['name'], $_POST['msg'])) {
	// Validam adresa de email
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$responses[] = 'Emailul nu este valid!';
	}
	// Verificam sa fie toate completate
	if (empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['name']) || empty($_POST['msg'])) {
		$responses[] = 'Te rog completeaza toate campurile!';
	} 
	// Daca nu sunt erori
	if (!$responses) {
		$to      = 'frentmarius1@gmail.com';
		// Adresa de la care trimitem email
    $email= $_POST['email'];
    $mesaj = $_POST['msg'];
    $subiect = $_POST['subject'];
    $nume = $_POST['name'];
		$from = '$email';
		// Subiect mail
		$subject = $_POST['subject'];
		// Mesaj mail
		$message = "$nume cu adresa de email '$email' a trimis un mesaj cu subiectul '$subiect' si mesajul '$mesaj'";
        
		// Mail header
        $headers = "From: filipkights@yahoo.com";
		// Trimitere email
		if (mail($to, $subject, $message, $headers)) {
			// Success
			$responses[] = 'Mesaj trimis cu succes!';		
		} else {
			// Eroare
			$responses[] = 'Mesajul nu a putut fi trimis!';
		}
	}
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="css/contactstyle.css?version8">

<div class="bg-info contact4 overflow-hiddedn position-relative">
  <!-- Row  -->
  <div class="row no-gutters">
    <div class="container">
      <div class="col-lg-6 contact-box mb-4 mb-md-0">
        <div class="">
        <form class="contactform" method="post" action="">
          <h1 class="title font-weight-light text-white mt-2">Contacteaza firma noastra</h1>
          <form class="mt-3">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group mt-2">
                  <input class="form-control text-black" type="text" name="subject"  placeholder="Subiect" required>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mt-2">
                  <input class="form-control text-black" type="text" name="name" placeholder="Numele tau" required>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mt-2">
                  <input class="form-control text-black" type="email" name="email"  placeholder="Adresa de email" required>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group mt-2">
                  <textarea class="form-control text-black" rows="7"  name="msg" placeholder="Mesaj" required></textarea>
                </div>
              </div>
              <div class="col-lg-12 d-flex align-items-center mt-2">
                <button type="submit" class="btn btn-success h3 btn-lg btn-block"><span> Trimite</span></button>
              </div>
                <span class="ml-5 text-white align-self-center h3">0773791451<i class="fa fa-phone"></i></span>
              </div>
              <?php if ($responses): ?>
                <h1 class="title font-weight-light text-danger mt-2 h1 fs-1"><?php echo implode('<br>', $responses); ?></h1>
           <?php  endif; ?>
</form>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6 right-image p-r-0 mt-10">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2788.8096550183154!2d25.594685982509613!3d45.654644135151564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b35b84ac6b39ed%3A0x83783b4a4244f90f!2sUniversitatea%20Transilvania!5e0!3m2!1sro!2sro!4v1645807134960!5m2!1sro!2sro"
        width="100%" height="538" frameborder="0" style="border:0" allowfullscreen data-aos="fade-left" data-aos-duration="3000"></iframe>
    </div>
  </div>
</div>



<?php 
include("includes/footer.php");
?>