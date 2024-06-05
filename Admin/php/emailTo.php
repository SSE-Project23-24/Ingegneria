<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require 'Admin/phpmailer/Exception.php';
require 'Admin/phpmailer/PHPMailer.php';
require 'Admin/phpmailer/SMTP.php';

$conn = new mysqli("localhost", "root", "", "civicsense");
if ($conn->connect_error) {
    die("Connessione non riuscita: " . $conn->connect_error);
}

if (isset($_POST['id']) && isset($_POST['stato'])) {
    $idS = $_POST['id'];
    $stato = $_POST['stato'];

    $stmt = $conn->prepare("SELECT * FROM segnalazioni WHERE id = ?");
    $stmt->bind_param("i", $idS);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['stato'] == "In attesa" && $stato == "In risoluzione") {
            $stmtUpdate = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
            $stmtUpdate->bind_param("si", $stato, $idS);
            $result1 = $stmtUpdate->execute();
            if ($result1) {
                echo("<br><b><br><p><center><font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br>");

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->Username = 'civicsense18@gmail.com';
                    $mail->Password = 'c1v1csense2019';
                    $mail->setFrom('civicsense18@gmail.com');
                    $mail->addAddress($_SESSION['email']);
                    $mail->Subject = 'Nuova Segnalazione';
                    $mail->Body = "Salve team {$row['team']}, ci è arrivata una nuova segnalazione e vi affido il compito di risolverla";
                    $mail->send();
                    echo "Messaggio inviato con successo.";
                } catch (Exception $e) {
                    echo "Errore nell'invio del messaggio: {$mail->ErrorInfo}";
                }
            }
        } elseif ($row['stato'] == "In risoluzione" && $stato == "Risolto") {
            $stmtUpdate = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
            $stmtUpdate->bind_param("si", $stato, $idS);
            $result1 = $stmtUpdate->execute();
            if ($result1) {
                echo("<br><b><br><p><center><font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br>");

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 465;
                    $mail->Username = $_SESSION['email'];
                    $mail->Password = $_SESSION['pass'];
                    $mail->setFrom($_SESSION['email']);
                    $mail->addAddress('civicsense18@gmail.com'); // ente
                    $mail->addAddress($row['email']); // utente
                    $mail->Subject = 'Segnalazione risolta';
                    $mail->Body = "Il problema presente in {$row['via']} è stato risolto";
                    $mail->send();
                    echo "Messaggio inviato con successo.";
                } catch (Exception $e) {
                    echo "Errore nell'invio del messaggio: {$mail->ErrorInfo}";
                }
            }
        } else {
            echo "Operazione non disponibile";
        }
    }
    $stmt->close();
    $conn->close();
}
?>
