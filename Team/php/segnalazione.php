<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

if (isset($_SESSION['idT'])) {
    $upload_path = '../Admin/img/';
    $team = isset($_POST['team']) ? $_POST['team'] : null;

    $stmt = $conn->prepare("SELECT * FROM segnalazioni WHERE stato <> 'Risolto' AND team = ?");
    $stmt->bind_param("i", $_SESSION['idT']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $datainv = htmlspecialchars($row['datainv'], ENT_QUOTES, 'UTF-8');
        $orainv = htmlspecialchars($row['orainv'], ENT_QUOTES, 'UTF-8');
        $via = htmlspecialchars($row['via'], ENT_QUOTES, 'UTF-8');
        $descrizione = htmlspecialchars($row['descrizione'], ENT_QUOTES, 'UTF-8');
        $foto = htmlspecialchars($row['foto'], ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($row['tipo'], ENT_QUOTES, 'UTF-8');
        $stato = htmlspecialchars($row['stato'], ENT_QUOTES, 'UTF-8');
        $gravita = htmlspecialchars($row['gravita'], ENT_QUOTES, 'UTF-8');

        echo "
        <tr>
            <td>$id <br></td>
            <td>$datainv <br></td> 
            <td>$orainv <br></td>
            <td>$via <br></td>
            <td>$descrizione <br></td>
            <td><img width='200px' height='200px' src='$upload_path$foto'><br></td>
            <td>$tipo <br></td>
            <td>$stato <br></td>
            <td>$gravita <br></td>
        </tr>";
    }
}
?>
