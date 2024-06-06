<?php
	$config = file_get_contents(__DIR__ . '/../config.json');

    $config_data = json_decode($config, true);

    $db_host = $config_data['db_host'];
    $db_user = $config_data['db_user'];
    $db_password = $config_data['db_password'];
    $db_name = $config_data['db_name'];

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

	$upload_path = 'jpeg/';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$original_filename = basename($_FILES['image']['name']);
		$sanitized_filename = preg_replace("/[^a-zA-Z0-9\._-]/", "", $original_filename);
		$file_path = $upload_path . $sanitized_filename;
		$img_name = $sanitized_filename;
		$email = $_POST['email'];
		$tipo = $_POST['tipo'];
		if ($tipo == "Segnalazione di area verde") {
			$tipo = 1;
		} else if ($tipo == "Rifiuti e pulizia stradale") {
			$tipo = 2;
		} else if ($tipo == "Strade e marciapiedi") {
			$tipo = 3;
		} else if ($tipo == "Segnaletica e semafori") {
			$tipo = 4;
		} else if ($tipo == "Illuminazione pubblica") {
			$tipo = 5;
		}
		$via = $_POST['via'];
		$descrizione = $_POST['descrizione'];
		$lat = $_POST['latitudine'];
		$lat = floatval($lat);
		$lng = $_POST['longitudine'];
		$lng = floatval($lng);

		try {
			if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
				$stmt = $conn->prepare("INSERT INTO `segnalazioni`(`datainv`, `orainv`, `via`, `descrizione`, `foto`, `email`, `tipo`, `latitudine`, `longitudine`) 
				VALUES (CURRENT_DATE, CURRENT_TIME, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bind_param("ssssiff", $via, $descrizione, $img_name, $email, $tipo, $lat, $lng);
				$stmt->execute();
				$result = $stmt->get_result();
				if ($result) {
					echo "Inserimento dei dati completato";
				} else {
					echo "Errore nell'inserimento dei dati";
				}
			} else {
				echo "Errore nel caricamento del file";
			}
		} catch (Exception $e) {
			echo "Eccezione catturata: " . $e->getMessage();
		}
		$conn->close();
	}
?>