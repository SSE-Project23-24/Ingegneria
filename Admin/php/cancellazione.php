<?php

$conn = mysqli_connect ("localhost", "root", "") or die ("Connessione non riuscita"); 

mysqli_select_db ("civicsense") or die ("DataBase non trovato"); 


$id = (isset($_POST['id'])) ? $_POST['id'] : null;
$stato = (isset($_POST['stato'])) ? $_POST['stato'] : null;


if ($id && $stato !== null) {

	// Preparare la query per aggiornare le segnalazioni
	$stmt = $conn->prepare("UPDATE segnalazioni SET stato = ? WHERE id = ?");
	$stmt->bind_param("si", $stato, $idS);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result){
		echo("<br><b><br><p> <center> <font color=black font face='Courier'> Inserimento avvenuto correttamente! Ricarica la pagina per aggiornare la tabella.</b></center></p><br><br> ");
	} 
}

?>
	