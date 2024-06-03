<?php
session_start();

require ('phpmailer/class.phpmailer.php');
include('phpmailer/class.smtp.php');
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

if (isset($_POST['id']) && isset($_POST['stato'])) {
    $idS = $_POST['id'];
    $stato = $_POST['stato'];

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
                    $mail->Username   = "civicsense18@gmail.com";
                    $mail->Password   = "c1v1csense2019";
                    $mail->AddAddress($_SESSION['email']);
                    $mail->SetFrom("civicsense18@gmail.com");
                    $mail->Subject = 'Nuova Segnalazione';
                    $mail->Body = "Salve team {$row['team']}, ci è arrivata una nuova segnalazione e vi affido il compito di risoverla";
                    $mail->Send();
                    echo "Message Sent OK";
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
                    $mail->Username   = $_SESSION['email'];
                    $mail->Password   = $_SESSION['pass'];
                    $mail->AddAddress('civicsense18@gmail.com'); // ente
                    $mail->AddAddress($row['email']); // utente
                    $mail->SetFrom($_SESSION['email']);
                    $mail->Subject = "Segnalazione risolta";
                    $mail->Body = "Il problema presente in {$row['via']} è stata risolta";
                    $mail->Send();
                    echo "Message Sent OK";
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
