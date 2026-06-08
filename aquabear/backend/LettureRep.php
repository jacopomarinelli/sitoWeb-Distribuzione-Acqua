<?php

class LettureRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function cerca(array $filtri): array {
        $conditions = [];
        $params = [];


        if (!empty($filtri['data'])) {
            $conditions[] = "DATA LIKE :data";
            $params['data'] = "%" . $filtri['data'] . "%";
        }
        if (!empty($filtri['fattura'])) {
            $conditions[] = "FATTURA LIKE :fattura";
            $params['fattura'] = "%" . $filtri['fattura'] . "%";
        }
        if (!empty($filtri['numero'])) {
            $conditions[] = "NUMERO = :numero";
            $params['numero'] = $filtri['numero'];
        }
        if (!empty($filtri['utenza'])) {
            $conditions[] = "UTENZA LIKE :utenza";
            $params['utenza'] = "%" . $filtri['utenza'] . "%";
        }
        if (!empty($filtri['valore'])) {
            $conditions[] = "VALORE LIKE :valore";
            $params['valore'] = "%" . $filtri['valore'] . "%";
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        $stmt = $this->db->prepare("SELECT * FROM LETTURE $where");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function trovaPerId(string $codice): ?array {
        $stmt = $this->db->prepare("SELECT * FROM LETTURE WHERE NUMERO = :numero");
        $stmt->execute(['utenza' => $codice]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}