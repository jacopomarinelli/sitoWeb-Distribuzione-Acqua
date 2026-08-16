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
        });
    });

});

async function eliminaFatture() {

    if (fattureSelezionate.size === 0) {
        creaMessaggioErrore("Seleziona almeno una fattura!");
        return;
    }

    const confermato = await confermaEliminazione(fattureSelezionate.size);
    if (!confermato) {
        return;
    }

    fetch("fatture.php?action=elimina", 
        {method: "POST",headers: {"Content-Type": "application/json"},
        body: JSON.stringify(Array.from(fattureSelezionate))
    }).then(() => location.reload());
}

function modificaFattura() {

    if(fattureSelezionate.size === 0) {
        creaMessaggioErrore("Seleziona almeno una fattura!");
        return;
    }

    if(fattureSelezionate.size > 1) {
        creaMessaggioErrore("Puoi modificare solo una fattura per volta!");
        return;
    }

    apriFormFattura();

    // recupera dati di riga selezionata
    const riga = document.querySelector("tr.selezionata");
    // recupera tutte le colonne della riga selezionata
    const celle = riga.querySelectorAll("td");

    const inputNumero = document.getElementById("nuovo_num_fat");
    inputNumero.value = celle[0].textContent.trim();
    
    // blocca il campo nuovo_num_fat per evitare che la chiave primaria venga modificata, 
    // evitando che query UPDATE WHERE NUMERO = :numero non trovi la riga
    inputNumero.setAttribute("readonly", true);

    document.getElementById("nuova_data_fat").value = celle[1].textContent.trim();
    const formatter = new Intl.NumberFormat('it-IT', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    document.getElementById("nuovo_imp").value = formatter.format(celle[2].textContent.trim())+" €";
    document.getElementById("nuova_iva").value = formatter.format(celle[3].textContent.trim())+" €";
    document.getElementById("nuovo_cos_tot").value = formatter.format(celle[4].textContent.trim())+" €";

    // action del form sovrascritta
    document.querySelector(".contenuto-fattura")
            .setAttribute("action", "fatture.php?action=modifica");
}

function nuovaFattura() {
    const inputNumero = document.getElementById("nuovo_num_fat");
    
    inputNumero.removeAttribute("readonly");
    
    // ripristina l'action inserisci del form
    document.querySelector(".contenuto-fattura").setAttribute("action", "fatture.php?action=inserisci");

    document.getElementById("compito-azione").textContent = "INSERISCI I DATI";
    document.getElementById("avvio").value = "AGGIUNGI";
    
    // svuota i campi nel caso siano rimasti scritti dati di una modifica precedente
    inputNumero.value = "";
    document.getElementById("nuova_data_fat").value = "";
    document.getElementById("nuovo_imp").value = "";
    document.getElementById("nuova_iva").value = "";
    document.getElementById("nuovo_cos_tot").value = "";
    
    apriFormFattura();
}