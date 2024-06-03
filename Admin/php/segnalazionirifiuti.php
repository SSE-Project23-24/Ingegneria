<?php
$conn = mysqli_connect ("localhost", "root", "","civicsense") or die ("Connessione non riuscita"); 




	$upload_path = 'img/';
  $quer = mysqli_query ($conn,"SELECT * FROM segnalazioni WHERE tipo = '2' ");
  



while ($row = mysqli_fetch_assoc($quer)) {
    $id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
    $datainv = htmlspecialchars($row['datainv'], ENT_QUOTES, 'UTF-8');
    $orainv = htmlspecialchars($row['orainv'], ENT_QUOTES, 'UTF-8');
    $via = htmlspecialchars($row['via'], ENT_QUOTES, 'UTF-8');
    $descrizione = htmlspecialchars($row['descrizione'], ENT_QUOTES, 'UTF-8');
    $foto = htmlspecialchars($row['foto'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
    $stato = htmlspecialchars($row['stato'], ENT_QUOTES, 'UTF-8');
    $team = htmlspecialchars($row['team'], ENT_QUOTES, 'UTF-8');
    $gravita = htmlspecialchars($row['gravita'], ENT_QUOTES, 'UTF-8');

    echo "
    <tr>
        <td>$id <br></td>
        <td>$datainv <br></td> 
        <td>$orainv <br></td>
        <td>$via <br></td>
        <td>$descrizione <br></td>
        <td><img width='200px' height='200px' src='$upload_path$foto'><br></td>
        <td>$email <br></td>
        <td>$stato <br></td>
        <td>$team <br></td>
        <td>$gravita <br></td>
    </tr>";
}
?>