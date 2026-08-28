/* FUNZIONE WIDGET DATA */
$(function () {
    $.datepicker.setDefaults($.datepicker.regional["it"]); // mette in italiano
    $(".widget-data").datepicker({  // aggiunge widget a tutti elementi con classe widget-data
        dateFormat: "dd/mm/yy",  // selezione formato 
        firstDay: 1, // parte da lunedì
        changeMonth: true,
        changeYear: true,
        yearRange: "2020:2030"
    });
});

/* FUNZIONI POPUP */
function creaMessaggioErrore(messaggio) {  // mostra messaggio di errore nel popup
    document.getElementById("messaggio_popup").innerHTML = `
        <i class="fa-solid fa-triangle-exclamation icona-popup"></i>
        <div class="testo-popup">
            ${messaggio}
        </div>
    `;
    document.getElementById("popup").style.display = "flex";   // apre popup
}

function chiudiPopup() {
    document.getElementById("messaggio_popup").innerText = "";  // pulisce contenuto del popup
    document.getElementById("popup").style.display = "none";
}

function chiudiSeFuori(event) {
    if (event.target.id === "popup") {
        chiudiPopup();
    }
}

/* FUNZIONI ORDINAMENTO */
function ordinaColonna(th, ordine) {
    // recupero elementi necessari
    const tabella = th.closest("table");
    const tbody = tabella.querySelector("tbody");
    const righe = Array.from(tbody.querySelectorAll("tr"));
    const tipo = th.dataset.tipo;
    const indiceColonna = th.cellIndex;

    // confronto valori
    righe.sort((rigaA, rigaB) => {
        const cellaA = rigaA.cells[indiceColonna];
        const cellaB = rigaB.cells[indiceColonna];

        const valoreA = cellaA.dataset.valore;
        const valoreB = cellaB.dataset.valore;

        return confrontoValori(tipo, valoreA, valoreB);
    });
    // ordine crescente/decrescente: se decrescente array al contrario, altrimenti si lascia così
    if (ordine === "decrescente") {
        righe.reverse();
    }

    // riordino righe tabella
    const frammento = document.createDocumentFragment();
    righe.forEach(riga => {
        frammento.appendChild(riga);
    });
    tbody.appendChild(frammento);
}

function confrontoValori(tipo, valoreA, valoreB) {
    switch (tipo) {
        case "codice-cliente":
            return valoreA.localeCompare(valoreB);

        case "codice-fiscale":
            return valoreA.localeCompare(valoreB);

        case "codice-numerico":
            return Number(valoreA) - Number(valoreB); //funziona

        case "codice-fattura":
            return confrontoFattura(valoreA, valoreB);
            //funziona ma lento (riga intestazioni compare in mezzo dopo righe senza codice fatture se inverto segni di else)

        case "data":
            return confrontoData(valoreA, valoreB);

        case "prezzo":
            return valoreA - valoreB;

        case "valore":
            return Number(valoreA) - Number(valoreB); //funziona
    }
}

function confrontoFattura(codiceA, codiceB) {
    const [, annoA, numA] = String(codiceA).split("-");
    const [, annoB, numB] = String(codiceB).split("-");

    if (codiceA !== "" && codiceB !== "") {
        if (Number(annoA) !== Number(annoB)) {
            return Number(annoA) - Number(annoB);
        }
        return Number(numA) - Number(numB);
    } else if (codiceA === "") {
        return 1;
    } else if (codiceB === "") {
        return -1;
    }
}

function confrontoData(dataA, dataB) {
    const [giornoA, meseA, annoA] = dataA.split("/");
    const [giornoB, meseB, annoB] = dataB.split("/");
    const formatoData1 = `${annoA}-${meseA}-${giornoA}`;
    const formatoData2 = `${annoB}-${meseB}-${giornoB}`;
    return formatoData1.localeCompare(formatoData2);
}