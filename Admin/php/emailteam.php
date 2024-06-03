<?php
require ('C:\xampp\htdocs\Ingegneria\Admin\phpmailer\class.phpmailer.php');
include('C:\xampp\htdocs\Ingegneria\Admin\phpmailer\class.smtp.php');
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$id = isset($_POST['id']) ? mysqli_real_escape_string($conn, $_POST['id']) : null;
$team = isset($_POST['team']) ? mysqli_real_escape_string($conn, $_POST['team']) : null;

if (isset($_POST['submit'])) {
    if ($id && $team !== null) {
        $stmt = $conn->prepare("SELECT * FROM segnalazioni WHERE gravita IS NOT NULL AND team IS NULL AND id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $resultC = $stmt->get_result();

        if ($resultC && $resultC->num_rows > 0) {
            $query = "UPDATE segnalazioni SET team = ?, stato = 'In attesa' WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $team, $id);
            $result = $stmt->execute();

            if ($result) {
                echo('<center><b>Aggiornamento avvenuto con successo.</b></center>');
                $mail = new PHPMailer();

                try {
                    $stmt = $conn->prepare("SELECT * FROM team WHERE codice = ?");
                    $stmt->bind_param("s", $team);
                    $stmt->execute();
                    $result1 = $stmt->get_result();

                    if ($result1 && $result1->num_rows > 0) {
                        $row = $result1->fetch_assoc();
                        $mail->SMTPAuth   = true;
                        $mail->SMTPSecure = "ssl";
                        $mail->Host       = "smtp.gmail.com";
                        $mail->Port       = 465;
                        $mail->SMTPKeepAlive = true;
                        $mail->Mailer = "smtp";
                        $mail->Username   = "civicsense2019@gmail.com";
                        $mail->Password   = "c1v1csense2019";
                        $mail->AddAddress($row["email_t"]);
                        $mail->SetFrom("civicsense2019@gmail.com");
                        $mail->Subject = 'Nuova Segnalazione';
                        $mail->Body = "Salve team $team, vi è stata incaricata una nuova segnalazione da risolvere."; //Messaggio da inviare
                        $mail->Send();
                        echo "<center><b>Messaggio inviato.</b></center>";
                    }
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Errori da PHPMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Errori da altrove
                }
            } else {
                echo "<center><b>Errore nell'aggiornamento del database.</b></center>";
            }
        } else {
            echo "<center><b>Inserisci un id esistente.</b></center>";
        }
    } else {
        echo "<center><b>Inserire tutti i campi.</b></center>";
    }
}
?>