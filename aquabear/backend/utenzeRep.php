<?php

require_once "connessione.php";

$codice = $_GET['codice'] ?? '';
$cod_fisc = $_GET['cod_fis'] ?? '';
$indirizzo = $_GET['indirizzo'] ?? '';
$citta = $_GET['citta'] ?? '';
$stato = $_GET['stato'] ?? '';
$apertura = $_GET['data_ap'] ?? '';
$chiusura = $_GET['data_ch'] ?? '';

$query  = "SELECT * FROM UTENZE";
$params = [];
$types  = "";

if ($codice !== '') {
    $query .= " AND codice = ?";
    $params[] = $codice;
    $types .= "s";
}

if ($cod_fisc !== '') {
    $query .= " AND cod_fisc LIKE ?";
    $params[] = "%$cod_fisc%";
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
$utenze = [];
while ($row = $result->fetch_assoc()) {
    $utenze[] = $row;
}