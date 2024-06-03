<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$quer = mysqli_query($conn, "SELECT * FROM segnalazioni WHERE gravita IS NOT NULL AND team IS NULL");

if (mysqli_num_rows($quer) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($quer)) {
        $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
        $via = htmlspecialchars($row['via'], ENT_QUOTES, 'UTF-8');
        $gravita = htmlspecialchars($row['gravita'], ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($row['tipo'], ENT_QUOTES, 'UTF-8');

        echo "
        <tr>
            <td>$id <br></td>
            <td>$via <br></td> 
            <td>$gravita <br></td>
            <td>$tipo <br></td>
        </tr>";
    }
}
?>