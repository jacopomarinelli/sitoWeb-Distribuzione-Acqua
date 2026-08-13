<?php

class FattureRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function conversionePrezzoRicerca($valore) {
        $valore = str_replace('.', '', $valore);
        $valore = str_replace(',', '.', $valore);
        return $valore;
    }

    public function cerca(array $filtri): array {
        $conditions = [];
        $params = [];


        if (!empty($filtri['numero_fattura'])) {
            $conditions[] = "FATTURE.NUMERO LIKE :numero_fattura";
            $params['numero_fattura'] = "%" . $filtri['numero_fattura'] . "%";
        }
        if (!empty($filtri['data_fattura'])) {
            $data = DateTime::createFromFormat('Y-m-d', $filtri['data_fattura']);
            $conditions[] = "FATTURE.DATA = :data";
            $params['data'] = $data ? $data->format('d/m/Y') : $filtri['data_fattura'];
        }
        if (!empty($filtri['imponibile'])) {
            $conditions[] = "IMPONIBILE = :imponibile";
            $params['imponibile'] = $this->conversionePrezzoRicerca($filtri['imponibile']);
        }

        if (!empty($filtri['iva'])) {
            $conditions[] = "IVA = :iva";
            $params['iva'] = $this->conversionePrezzoRicerca($filtri['iva']);
        }

        if (!empty($filtri['totale'])) {
            $conditions[] = "TOTALE = :totale";
            $params['totale'] = $this->conversionePrezzoRicerca($filtri['totale']);
        }

        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        /*$query = "
            SELECT FATTURE.*, 
                   COUNT(LETTURE.NUMERO) AS NUMERO_LETTURE 
            FROM FATTURE 
            LEFT JOIN LETTURE ON LETTURE.FATTURA = FATTURE.NUMERO 
            $where
            GROUP BY FATTURE.NUMERO
        ";*/
        $stmt = $this->db->prepare("SELECT * FROM FATTURE $where");
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function trovaPerId(string $codice): ?array {
        $stmt = $this->db->prepare("SELECT * FROM FATTURE WHERE NUMERO = :numero_fatture");
        $stmt->execute(['numero_fatture' => $codice]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function insertOperation(array $fattura){
        $sql = "INSERT INTO FATTURE(DATA, IMPONIBILE, IVA, NUMERO, TOTALE) 
                VALUES(:data, :imponibile, :iva, :numero, :totale)";
        $stm = $this->db->prepare($sql);
        return $stm->execute([
            'numero' => $fattura['numero'],
            'data' => $fattura['data'],
            'imponibile' => $fattura['imponibile'],
            'iva' => $fattura['iva'],
            'totale' => $fattura['totale']
        ]);
        
    }

    public function deleteOperation(array $fatture): bool {

    $sql = "DELETE FROM FATTURE WHERE NUMERO = :numero";
    $stmt = $this->db->prepare($sql);

    foreach ($fatture as $numero) {
        $stmt->execute([
            'numero' => $numero
        ]);
    }

    return true;
}
    public function updateOperation(array $fattura): bool {

    $sql = "UPDATE FATTURE
            SET DATA = :data,
                IMPONIBILE = :imponibile,
                IVA = :iva,
                TOTALE = :totale
            WHERE NUMERO = :numero";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        'numero' => $fattura['numero'],
        'data' => $fattura['data'],
        'imponibile' => $fattura['imponibile'],
        'iva' => $fattura['iva'],
        'totale' => $fattura['totale']
    ]);
}

public function contaTutti(): int {
        $stmt = $this->db->query("SELECT COUNT(*) as totale FROM FATTURE");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $result['totale'];
    }

}