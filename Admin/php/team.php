<?php
$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$sql = mysqli_query($conn, "SELECT * FROM team");

// output data of each row
while ($row = mysqli_fetch_assoc($sql)) {
    $codice = htmlspecialchars($row['codice'], ENT_QUOTES, 'UTF-8');
    $email_t = htmlspecialchars($row['email_t'], ENT_QUOTES, 'UTF-8');
    $nomi = htmlspecialchars($row['nomi'], ENT_QUOTES, 'UTF-8');

    echo "
    <tr>
        <td>$codice</td>
        <td>$email_t</td>
        <td>$nomi</td>
    </tr>";
}
?>