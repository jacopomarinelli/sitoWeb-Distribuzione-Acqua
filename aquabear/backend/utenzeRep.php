<?php
// backend/ClientiRepository.php

class UtenzeRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function cerca(array $filtri): array {
        $conditions = [];
        $params = [];

        if (!empty($filtri['codice'])) {
            $conditions[] = "CODICE = :codice";
            $params['codice'] = $filtri['codice'];
        }
        if (!empty($filtri['cod_fis'])) {
            $conditions[] = "CODICE_FISCALE LIKE :cod_fis";
            $params['cod_fis'] = "%" . $filtri['cod_fis'] . "%";
        }
        if (!empty($filtri['indirizzo'])) {
            $conditions[] = "INDIRIZZO LIKE :indirizzo";
            $params['indirizzo'] = "%" . $filtri['indirizzo'] . "%";
        }
        if (!empty($filtri['citta'])) {
            $conditions[] = "CITTA LIKE :citta";
            $params['citta'] = "%" . $filtri['citta'] . "%";
        }
        if (!empty($filtri['stato'])) {
            $conditions[] = "STATO LIKE :stato";
            $params['stato'] = "%" . $filtri['stato'] . "%";
        }
        if (!empty($filtri['data_ap'])) {
            $conditions[] = "DATA_APERTURA LIKE :data_ap";
            $params['data_ap'] = "%" . $filtri['data_ap'] . "%";
        }
        if (!empty($filtri['data_ch'])) {
            $conditions[] = "DATA_CHIUSURA LIKE :data_ch";
            $params['data_ch'] = "%" . $filtri['data_ch'] . "%";
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        $stmt = $this->db->prepare("SELECT * FROM UTENZE $where");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function trovaPerId(string $codice): ?array {
        $stmt = $this->db->prepare("SELECT * FROM UTENZE WHERE CODICE = :codice");
        $stmt->execute(['codice' => $codice]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}