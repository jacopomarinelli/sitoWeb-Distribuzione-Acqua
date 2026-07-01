<?php

class ClientiRepository {
    // Oggetto PDO che rappresenta la connessione al database
    private PDO $db;

    public function __construct() {
        // Quando la classe viene creata, recupera la connessione al DB
        $this->db = Database::getConnection();
    }

    public function cerca(array $filtri): array {
        // Qui accumuliamo le condizioni SQL (WHERE dinamico)
        $conditions = [];

        // Qui accumuliamo i parametri da passare in modo sicuro alla query
        $params = [];

        // Se esiste un filtro "codice", cerchiamo corrispondenza esatta
        if (!empty($filtri['codice'])) {
            $conditions[] = "CODICE = :codice";
            $params['codice'] = $filtri['codice'];
        }

        // Se esiste "codice_fiscale", cerchiamo corrispondenza parziale
        if (!empty($filtri['codice_fiscale'])) {
            $conditions[] = "CODICE_FISCALE LIKE :cod_fisc";
            // I % servono per dire: "qualsiasi cosa prima e dopo"
            $params['cod_fisc'] = "%" . $filtri['codice_fiscale'] . "%";
        }

        // Ricerca per ragione sociale (parziale)
        if (!empty($filtri['ragione_sociale'])) {
            $conditions[] = "RAGIONE_SOCIALE LIKE :rag_soc";
            $params['rag_soc'] = "%" . $filtri['ragione_sociale'] . "%";
        }

        // Ricerca per città (parziale)
        if (!empty($filtri['citta'])) {
            $conditions[] = "CITTA LIKE :citta";
            $params['citta'] = "%" . $filtri['citta'] . "%";
        }

        // Ricerca per indirizzo (parziale)
        if (!empty($filtri['indirizzo'])) {
            $conditions[] = "INDIRIZZO LIKE :indirizzo";
            $params['indirizzo'] = "%" . $filtri['indirizzo'] . "%";
        }

        // Se ci sono condizioni, le uniamo con AND, altrimenti query senza WHERE
        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

        // Costruiamo la query finale usando LEFT JOIN e GROUP BY
        $query = "
        SELECT CLIENTI.*, 
        COUNT(UTENZE.CODICE) AS NUMERO_UTENZE 
        FROM CLIENTI 
        LEFT JOIN UTENZE ON UTENZE.CLIENTE = CLIENTI.CODICE 
        $where
        GROUP BY CLIENTI.CODICE
    ";
        
        $stmt = $this->db->prepare($query);

        // Eseguiamo la query passando i parametri in modo sicuro
        $stmt->execute($params);

        // Restituiamo tutti i risultati come array associativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function trovaPerId(string $codice): ?array {
        // Query per cercare un cliente specifico tramite codice
        $stmt = $this->db->prepare("SELECT * FROM CLIENTI WHERE CODICE = :codice");

        // Passiamo il parametro in modo sicuro
        $stmt->execute(['codice' => $codice]);

        // Prendiamo una sola riga (non una lista)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se non trova nulla, ritorna null invece di false
        return $result ?: null;
    }
}