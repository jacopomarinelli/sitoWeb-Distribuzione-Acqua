const fattureSelezionate = new Set();

document.addEventListener("DOMContentLoaded", function () {

    const righe = document.querySelectorAll("table tr[data-numero]");

    righe.forEach(riga => {
        riga.addEventListener("click", function () {

            const numero = this.dataset.numero;

            if (fattureSelezionate.has(numero)) {

                // Era già selezionata: la deseleziono
                fattureSelezionate.delete(numero);
                this.classList.remove("selezionata");
            } else {

                // Non era selezionata: la seleziono
                fattureSelezionate.add(numero);
                this.classList.add("selezionata");
            }

            console.log(fattureSelezionate);
        });
    });

});

function eliminaFatture() {

    if (fattureSelezionate.size === 0) {
        alert("Seleziona almeno una fattura.");
        return;
    }

    if (!confirm("Eliminare le fatture selezionate?")) {
        return;
    }

    fetch("fatture.php?action=elimina", 
        {method: "POST",headers: {"Content-Type": "application/json"},
        body: JSON.stringify(Array.from(fattureSelezionate))
    }).then(() => location.reload());
}

function modificaFattura() {

    if(fattureSelezionate.size === 0) {
        alert("Seleziona almeno una fattura.");
        return;
    }

    if(fattureSelezionate.size > 1) {
        alert("Puoi modificare solo una fattura per volta.");
        return;
    }

    // 1. APRI PRIMA IL FORM: in questo modo eventuali reset
    // predefiniti della modale vengono eseguiti subito
    apriFormFattura();

    // 2. RECUPERA I DATI DALLA RIGA SELEZIONATA
    const riga = document.querySelector("tr.selezionata");
    const celle = riga.querySelectorAll("td");

    // 3. INIETTA I DATI (usando .trim() per rimuovere eventuali spazi invisibili)
    const inputNumero = document.getElementById("nuovo_num_fat");
    inputNumero.value = celle[0].textContent.trim();
    
    // Blocca il campo numero per evitare che la chiave primaria venga alterata, 
    // altrimenti la query UPDATE WHERE NUMERO = :numero non troverà la riga!
    inputNumero.setAttribute("readonly", true);

    document.getElementById("nuova_data_fat").value = celle[1].textContent.trim();
    document.getElementById("nuovo_imp").value = celle[2].textContent.trim();
    document.getElementById("nuova_iva").value = celle[3].textContent.trim();
    document.getElementById("nuovo_cos_tot").value = celle[4].textContent.trim();

    // 4. SOVRASCRIVI L'ACTION DEL FORM (adesso siamo sicuri che non verrà annullato)
    document.querySelector(".contenuto-fattura")
            .setAttribute("action", "fatture.php?action=modifica");
}

function nuovaFattura() {
    const inputNumero = document.getElementById("nuovo_num_fat");
    
    // 1. Sblocca il campo del numero fattura (togli il readonly)
    inputNumero.removeAttribute("readonly");
    
    // 2. Ripristina l'action originale del form per l'inserimento
    document.querySelector(".contenuto-fattura").setAttribute("action", "fatture.php?action=inserisci");
    
    // 3. Ripristina i testi originali dei titoli e dei pulsanti
    document.getElementById("compito-azione").textContent = "INSERISCI I DATI";
    document.getElementById("avvio").value = "AGGIUNGI";
    
    // 4. (Consigliato) Svuota i campi nel caso fossero rimasti scritti i dati di una modifica precedente
    inputNumero.value = "";
    document.getElementById("nuova_data_fat").value = "";
    document.getElementById("nuovo_imp").value = "";
    document.getElementById("nuova_iva").value = "";
    document.getElementById("nuovo_cos_tot").value = "";

    // 5. Infine, chiama la funzione esistente per mostrare il popup a schermo
    apriFormFattura();
}