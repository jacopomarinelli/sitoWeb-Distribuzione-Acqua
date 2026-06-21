/* CONTROLLO GENERALE */
function verificaLettura(event) {
    salvaLettura();
}

/* SALVA DATI DELLA RICERCA */
function salvaLettura() {
    const lettura = {
        num_lettura: document.getElementById("num_let").value,
        cod_utenza: document.getElementById("cod_ute").value,
        cod_fattura: document.getElementById("fattura").value,
        data_lettura: document.getElementById("data").value,
        valore_letto: document.getElementById("valore").value
    };
    sessionStorage.setItem(
        "ricercaLettura",
        JSON.stringify(lettura)
    );
}
document.addEventListener("DOMContentLoaded", function() {
    const dati = JSON.parse(
        sessionStorage.getItem("ricercaLettura")
    );

    if (!dati) return;
    document.getElementById("num_let").value = dati.num_lettura;
    document.getElementById("cod_ute").value = dati.cod_utenza;
    document.getElementById("fattura").value = dati.cod_fattura;
    document.getElementById("data").value = dati.data_lettura;
    document.getElementById("data").value = dati.valore_letto;
});