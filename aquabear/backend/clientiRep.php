<?php

require_once "connessione.php";

$codice = $_GET['codice'] ?? '';
$cod_fisc = $_GET['codice_fiscale'] ?? '';
$rag_soc = $_GET['ragione_sociale'] ?? '';
$indirizzo = $_GET['indirizzo'] ?? '';
$citta = $_GET['citta'] ?? '';

$query  = "SELECT * FROM CLIENTI WHERE 1=1";
$params = [];
$types  = "";

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
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result  = $stmt->get_result();
$clienti = [];
while ($row = $result->fetch_assoc()) {
    $clienti[] = $row;
}