/* CONTROLLO GENERALE */
function verificaCliente(event) {
    salvaCliente();
}

/* SALVA DATI DELLA RICERCA */
function salvaCliente() {
    const cliente = {
        cod_cliente: document.getElementById("cod").value,
        cod_fiscale: document.getElementById("cod_fis").value,
        nome_azienda: document.getElementById("rag_soc").value,
        indirizzo: document.getElementById("ind_cli").value,
        città: document.getElementById("cit_cli").value
    };
    sessionStorage.setItem(
        "ricercaCliente",
        JSON.stringify(cliente)
    );
}
document.addEventListener("DOMContentLoaded", function() {
    const dati = JSON.parse(
        sessionStorage.getItem("ricercaCliente")
    );

    if (!dati) return;
    document.getElementById("cod").value = dati.cod_cliente;
    document.getElementById("cod_fis").value = dati.cod_fiscale;
    document.getElementById("rag_soc").value = dati.nome_azienda;
    document.getElementById("ind_cli").value = dati.indirizzo;
    document.getElementById("cit_cli").value = dati.città;
});