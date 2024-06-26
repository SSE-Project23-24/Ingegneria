<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require 'Team/phpmailer/Exception.php';
require 'Team/phpmailer/PHPMailer.php';
require 'Team/phpmailer/SMTP.php';
$config = file_get_contents(__DIR__ . '/../config.json');

$config_data = json_decode($config, true);

$db_host = $config_data['db_host'];
$db_user = $config_data['db_user'];
$db_password = $config_data['db_password'];
$db_name = $config_data['db_name'];

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connessione non riuscita: " . $conn->connect_error);
}

echo "Connessione riuscita";

if (isset($_POST['id'])&& isset($_POST['stato'])) {
	$idS = $_POST['id'];
	$stato = $_POST['stato'];
	$email=$_SESSION['email'];
	$pass=$_SESSION['pass'];
	
	// Preparare la query per selezionare le segnalazioni
	$stmt = $conn->prepare("SELECT * FROM segnalazioni WHERE id = ?");
	$stmt->bind_param("i", $idS);
	$stmt->execute();
    $result = $stmt->get_result();
	
	if($result){
		//da team a ente e utente
		$row = $result->fetch_assoc();
		if($row['stato']=="In attesa" && $stato=="In risoluzione"){ //confronta stato attuale e quello da modificare
			// Preparare la query per aggiornare una segnalazione
			$stmt = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
			$stmt->bind_param("si", $stato, $idS);
			$stmt->execute();
			$result1 = $stmt->get_result();
			if($result1){
				echo("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
				$mail = new PHPMailer(true);
	
				try {
				  $mail->SMTPAuth   = true;                  // sblocchi SMTP 
				  $mail->SMTPSecure = "ssl";                 // metti prefisso per il server
				  $mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
				  $mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
				  $mail->SMTPKeepAlive = true;
				  $mail->Mailer = "smtp";
				  $mail->Username   = "$email";      	// DOMINIO username
				  $mail->Password   = "$pass";        // DOMINIO password
				  $mail->AddAddress("civicsense2019@gmail.com");
				  $mail->AddAddress($row['email']);
				  $mail->SetFrom("$email");
				  $mail->Subject = 'Nuova Segnalazione';
				  $mail->Body = "La segnalazione è arrivata ed stiamo lavorando per risolverla"; //Messaggio da inviare
				  $mail->Send();
				  echo "Message Sent OK";
				  header("location: http://localhost/Ingegneria/Team/index.php");
				} catch (phpmailerException $e) {
					  echo $e->errorMessage(); //Errori da PHPMailer
				} catch (Exception $e) {
					  echo $e->getMessage(); //Errori da altrove
				}
			} 
		}
		//da team a ente e utente
		else if($row['stato']=="In risoluzione" && $stato=="Risolto"){
			// Preparare la query per aggiornare una segnalazione
			$stmt = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
			$stmt->bind_param("si", $stato, $idS);
			$stmt->execute();
			$result1 = $stmt->get_result();
			if($result1){
				echo("<br><b><br><p> <center> <font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
				$mail = new PHPMailer(true);
	
				try {
				  $mail->SMTPAuth   = true;                  // sblocchi SMTP 
				  $mail->SMTPSecure = "ssl";                 // metti prefisso per il server
				  $mail->Host       = "smtp.gmail.com";      // metti il tuo domino es(gmail) 
				  $mail->Port       = 465;   				// inserisci la porta smtp per il server DOMINIO
				  $mail->SMTPKeepAlive = true;
				  $mail->Mailer = "smtp";
				  $mail->Username   = "$email";      	// DOMINIO username
				  $mail->Password   = "$pass";        // DOMINIO password
				  $mail->AddAddress("civicsense2019@gmail.com");
				  $mail->AddAddress($row['email']);
				  $mail->SetFrom("$email");
				  $mail->Subject = "Segnalazione risolta";
				  $mail->Body = "Il problema presente in ".$row['via']." è stata risolta"; //Messaggio da inviare
				  $mail->Send();
				  header("location: http://localhost/Ingegneria/Team/index.php");
				} catch (phpmailerException $e) {
					  echo $e->errorMessage(); //Errori da PHPMailer
				} catch (Exception $e) {
					  echo $e->getMessage(); //Errori da altrove
				}
			
			
			
			} 
		}
		else{
			echo "Operazione non disponibile";
		}
	}
	mysqli_close($conn);
}

?>