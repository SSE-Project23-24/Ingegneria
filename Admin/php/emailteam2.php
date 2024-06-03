<?php

$conn = mysqli_connect("localhost", "root", "", "civicsense") or die("Connessione non riuscita");

$id = isset($_POST['id']) ? $_POST['id'] : null;
$team = isset($_POST['team']) ? $_POST['team'] : null;

if ($id && $team !== null) {

    $stmt = $conn->prepare("SELECT email_t FROM team WHERE codice = ?");
    $stmt->bind_param("s", $team);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $email_t = htmlspecialchars($row['email_t'], ENT_QUOTES, 'UTF-8');
        echo('<a href="mailto:' . $email_t . '"><center> Clicca qui per mandare un avviso al team. </center></a>');
    }
}
?>
