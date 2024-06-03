<?php
session_start();

require ('phpmailer/class.phpmailer.php');
include('phpmailer/class.smtp.php');
$conn = new mysqli("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

if (isset($_POST['id']) && isset($_POST['stato'])) {
    $idS = $_POST['id'];
    $stato = $_POST['stato'];
    $email = $_SESSION['email'];
    $pass = $_SESSION['pass'];

    // Preparare la query per selezionare le segnalazioni
    $stmt = $conn->prepare("SELECT * FROM segnalazioni WHERE id = ?");
    $stmt->bind_param("i", $idS);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row['stato'] == "In attesa" && $stato == "In risoluzione") {
            // Preparare la query per aggiornare lo stato
            $stmtUpdate = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
            $stmtUpdate->bind_param("si", $stato, $idS);
            $result1 = $stmtUpdate->execute();
            if ($result1) {
                echo("<br><b><br><p><center><font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br>");
                $mail = new PHPMailer(true);

                try {
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = "ssl";
                    $mail->Host       = "smtp.gmail.com";
                    $mail->Port       = 465;
                    $mail->SMTPKeepAlive = true;
                    $mail->Mailer = "smtp";
                    $mail->Username   = "$email";
                    $mail->Password   = "$pass";
                    $mail->AddAddress("civicsense2019@gmail.com");
                    $mail->AddAddress($row['email']);
                    $mail->SetFrom("$email");
                    $mail->Subject = 'Nuova Segnalazione';
                    $mail->Body = "La segnalazione è arrivata ed stiamo lavorando per risolverla";
                    $mail->Send();
                    echo "Message Sent OK";
                    header("location: http://localhost/Ingegneria/Team/index.php");
                } catch (phpmailerException $e) {
                    echo $e->errorMessage();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        } elseif ($row['stato'] == "In risoluzione" && $stato == "Risolto") {
            // Preparare la query per aggiornare lo stato
            $stmtUpdate = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
            $stmtUpdate->bind_param("si", $stato, $idS);
            $result1 = $stmtUpdate->execute();
            if ($result1) {
                echo("<br><b><br><p><center><font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br>");
                $mail = new PHPMailer(true);

                try {
                    $mail->SMTPAuth   = true;
                    $mail->SMTPSecure = "ssl";
                    $mail->Host       = "smtp.gmail.com";
                    $mail->Port       = 465;
                    $mail->SMTPKeepAlive = true;
                    $mail->Mailer = "smtp";
                    $mail->Username   = "$email";
                    $mail->Password   = "$pass";
                    $mail->AddAddress("civicsense2019@gmail.com");
                    $mail->AddAddress($row['email']);
                    $mail->SetFrom("$email");
                    $mail->Subject = "Segnalazione risolta";
                    $mail->Body = "Il problema presente in ".$row['via']." è stata risolta";
                    $mail->Send();
                    header("location: http://localhost/Ingegneria/Team/index.php");
                } catch (phpmailerException $e) {
                    echo $e->errorMessage();
                } catch (Exception $e) {
                    echo $e->getMessage();
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
