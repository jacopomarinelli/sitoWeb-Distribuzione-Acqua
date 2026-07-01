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


        if (!empty($filtri['citta'])) {
            $conditions[] = "CITTA LIKE :citta";
            $params['citta'] = "%" . $filtri['citta'] . "%";
        }
        if (!empty($filtri['cliente'])) {
            $conditions[] = "CLIENTE LIKE :cliente";
            $params['cliente'] = "%" . $filtri['cliente'] . "%";
        }
        if (!empty($filtri['codice'])) {
            $conditions[] = "CODICE = :codice";
            $params['codice'] = $filtri['codice'];
        }
        if (!empty($filtri['data_ap'])) {
            $data = DateTime::createFromFormat('Y-m-d', $filtri['data_ap']);
            $conditions[] = "DATA_APERTURA = :data_ap";
            $params['data_ap'] = $data ? $data->format('d/m/Y') : $filtri['data_ap'];
        }
        if (!empty($filtri['data_ch'])) {
            $data = DateTime::createFromFormat('Y-m-d', $filtri['data_ch']);
            $conditions[] = "DATA_CHIUSURA = :data_ch";
            $params['data_ch'] = $data ? $data->format('d/m/Y') : $filtri['data_ch'];
        }
        if (!empty($filtri['indirizzo'])) {
            $conditions[] = "INDIRIZZO LIKE :indirizzo";
            $params['indirizzo'] = "%" . $filtri['indirizzo'] . "%";
        }
        if (isset($filtri['stato']) && $filtri['stato'] !== '') {
            $conditions[] = "STATO = :stato";
            $params['stato'] = ($filtri['stato'] === 'attiva') ? 'Attivo' : 'Inattivo';
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

        $query = "
            SELECT UTENZE.*, 
                   COUNT(LETTURE.NUMERO) AS NUMERO_LETTURE 
            FROM UTENZE 
            LEFT JOIN LETTURE ON LETTURE.UTENZA = UTENZE.CODICE 
            $where
            GROUP BY UTENZE.CODICE
        ";

        $stmt = $this->db->prepare($query);
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