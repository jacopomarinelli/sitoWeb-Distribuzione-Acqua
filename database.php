<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$username = "aquabear";
$password = "";
$database = "my_aquabear";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}


$codice = $_GET['codice'] ?? '';
$cod_fisc = $_GET['codice_fiscale'] ?? '';
$rag_soc = $_GET['ragione_sociale'] ?? '';
$indirizzo = $_GET['indirizzo'] ?? '';
$citta = $_GET['citta'] ?? '';

$query = "SELECT * FROM CLIENTI";
$params = [];
$types = "";

if ($codice !== '') {
    $query .= " AND codice = ?";
    $params[] = $codice;
    $types .= "s";
}

if ($cod_fisc !== '') {
    $query .= " AND codice_fiscale LIKE ?";
    $params[] = "%$cod_fisc%";
    $types .= "s";
}

if ($rag_soc !== '') {
    $query .= " AND ragione_sociale LIKE ?";
    $params[] = "%$rag_soc%";
    $types .= "s";
}

if ($indirizzo !== '') {
    $query .= " AND indirizzo LIKE ?";
    $params[] = "%$indirizzo%";
    $types .= "s";
}

if ($citta !== '') {
    $query .= " AND citta LIKE ?";
    $params[] = "%$citta%";
    $types .= "s";
}

$stmt = $conn->prepare($query);

$stmt->execute();
$result = $stmt->get_result();

// --- SOLUZIONE DEL PROBLEMA ---
// Inizializziamo $clienti come array vuoto. 
// In questo modo, anche se il database fosse vuoto, il foreach alla linea 46 non genererà errori.
$clienti = [];

// Popoliamo l'array con i record della tabella CLIENTI
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $clienti[] = $row; 
    }
}
// ------------------------------

?>