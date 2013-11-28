
 
 <?php
 header('Content-Type: text/html;charset=UTF-8');
if(isset($_POST['email'])) {
     
    // Skrive inn mail og tittel
    $email_to = "matlivkristiansand@gmail.com";
    $email_subject = "Matliv i Kristiansand";
     
     
    function died($error) {
        // Feilkode
        echo "Beklager, det er en feil i ditt skjema. <br />";
        echo "Se under for feil.<br /><br />";
        echo $error."<br /><br />";
        echo "Vennligst gå tilbake og fiks feil i skjema.<br /><br />";
		echo "<a href=kontakt.html>Klikk her for å komme tilbake.</a>";
        die();
    }
     
    // Validerer forventet eksisterende data
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('Beklager, det var en feil i skjema du sendte inn.');       
    }
     
    $first_name = $_POST['first_name']; // Påkrevd
    $last_name = $_POST['last_name']; // Påkrevd
    $email_from = $_POST['email']; // Påkrevd
    $telephone = $_POST['telephone']; // Ikke påkrevd
    $comments = $_POST['comments']; // påkrevd
     
    $error_message = "";
    $email_exp = '/^[A-Åa-å0-9._%-]+@[A-Åa-å0-9.-]+\.[A-Åa-å]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'E-post adresse er ugyldig.<br />';
  }
    $string_exp = "/^[A-Åa-å .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'Fornavn er ugyldig.<br />';
  }
	$string_exp = "/^[A-Åa-å .'-]+$/";
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'Etternavn er ugyldig.<br />';
  }
	$string_exp = "/^[0-9]+$/";
  if(strlen($telephone) < 8) {
    $error_message .= 'Telefonnummeret ditt er ugyldig, det krevest minst 8 siffer.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'Kommentaren din er ugyldig, du må ha mer enn 2 tegn.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Informasjon i skjema står under.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Fornavn: ".clean_string($first_name)."\n";
    $email_message .= "Etternavn: ".clean_string($last_name)."\n";
    $email_message .= "E-post: ".clean_string($email_from)."\n";
    $email_message .= "Telefon: ".clean_string($telephone)."\n";
    $email_message .= "Kommentar: ".clean_string($comments)."\n";
     
     
// Lage e-post tittel
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!--Etter fullført handling skal denne teksten komme opp på siden-->
 
Takk for at du brukte vårt kontaktskjema, vi kommer tilbake til deg så snart vi får tid.
 
<?php
}
?>
<br>
<br>
<a href="kontakt.html">Klikk her for å komme tilbake.</a>