<?php

$config2 = file_get_contents(__DIR__ . '/../config2.json');

$config2_data = json_decode($config2, true);

$pass = $config2_data['password'];

//Recupero dati
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email == "civicsense18@gmail.com") {
        if ($password == $pass) {
            echo 'Accesso consentito alla sezione riservata';
        } else {
            echo 'Accesso negato alla sezione riservata La password è errata!';
        }
    } else {
        $config = file_get_contents('config.json');

        $config_data = json_decode($config, true);

        $db_host = $config_data['db_host'];
        $db_user = $config_data['db_user'];
        $db_password = $config_data['db_password'];
        $db_name = $config_data['db_name'];

        $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$conn) {
            die("Connessione non riuscita: " . mysqli_connect_error());
        }

        echo "Connessione riuscita";

        $stmt = $conn->prepare("SELECT * FROM team WHERE email_t = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                if ($password != $row["password"] || $email != $row["email_t"]) {
                    //CODICE JAVASCRIPT
                    echo 'ATTENZIONE: La password o la email inserita non � corretta!';
                } else if ($password == $row["password"] || $email == $row["email_t"]) {
                    echo 'Accesso consentito area riservata (TEAM)';
                }

            }
        }
        mysqli_close($conn);
    }
} else {
    echo 'Non esistono;';
}


?>