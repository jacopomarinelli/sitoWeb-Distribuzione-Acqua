<?php

class FattureRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function cerca(array $filtri): array {
        $conditions = [];
        $params = [];


        if (!empty($filtri['numero_fattura'])) {
            $conditions[] = "NUMERO LIKE :numero_fattura";
            $params['numero_fattura'] = "%" . $filtri['numero_fattura'] . "%";
        }
        if (!empty($filtri['data_fattura'])) {
            $data = DateTime::createFromFormat('Y-m-d', $filtri['data_fattura']);
            $conditions[] = "DATA = :data";
            $params['data'] = $data ? $data->format('d/m/Y') : $filtri['data_fattura'];
        }
        if (!empty($filtri['imponibile'])) {
            $conditions[] = "IMPONIBILE = :imponibile";
            $params['imponibile'] = $filtri['imponibile'];
        }
        if (!empty($filtri['iva'])) {
            $conditions[] = "IVA LIKE :iva";
            $params['iva'] = "%" . $filtri['iva'] . "%";
        }
        if (!empty($filtri['totale'])) {
            $conditions[] = "TOTALE LIKE :totale";
            $params['totale'] = "%" . $filtri['totale'] . "%";
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        $stmt = $this->db->prepare("SELECT * FROM FATTURE $where");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function trovaPerId(string $codice): ?array {
        $stmt = $this->db->prepare("SELECT * FROM FATTURE WHERE NUMERO = :numero_fatture");
        $stmt->execute(['utenza' => $codice]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}