<?php

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$cod = (isset($_POST['cod'])) ? $_POST['cod'] : null;

if (isset($_POST['submit2'])) {
    if ($cod == null) {
        echo ("<p><center><font color=black font face='Courier'> Compila tutti i campi.</center></p>");
    } else {
        // Preparare la query per selezionare il team
        $stmt = $conn->prepare("SELECT * FROM team WHERE codice = ?");
        $stmt->bind_param("s", $cod);
        $stmt->execute();
        $resultC = $stmt->get_result();

        if ($resultC) {
            $row = $resultC->fetch_assoc();
            if ($cod == $row['codice']) {
                // Preparare la query per eliminare il team
                $stmtDelete = $conn->prepare("DELETE FROM team WHERE codice = ?");
                $stmtDelete->bind_param("s", $cod);
                $result = $stmtDelete->execute();

                if ($result) {
                    echo ("<br><b><br><p><center><font color=black font face='Courier'> Aggiornamento avvenuto correttamente. Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br>");
                }
            } else {
                echo ("<p><center><font color=black font face='Courier'> Inserisci ID esistente.</center></p>");
            }
        }
    }
}

mysqli_close($conn);

?>
