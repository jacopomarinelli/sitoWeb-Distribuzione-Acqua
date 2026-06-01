// Array contenente tutte le aziende (ragioni sociali)
var aziende = ["PureFlow Idrica Srl di Alessandro Ricci", "Rete Idrica Nazionale SpA di Matteo Colombo",
"BluFonte Distribuzione SpA di Giovanni Greco", "Acquedotto Peninsulare SpA di Lorenzo Conti", "Acqua & Territorio SpA di Davide Gallo",
"Servizi Idrici del Nord Srl di Stefano Bruno", "BluAcqua Forniture Srl di Giuseppe Esposito", "AcquaPura Italia Srl di Maria Costa",
"Acque del Sud Italia SpA di Elena Giordano", "Fonti Chiare Distribuzione Srl di Laura Mancini", "Acqua Sicura Forniture Srl di Chiara Lombardi",
"Idroservice Nazionale SpA di Sara Rizzo", "AquaVerde Servizi Idrici Srl di Andrea Ferrari", "Cristallina Acque Srl di Giulia Moretti",
"Gestione Idrica Integrata SpA di Francesco Bianchi", "Acquedotto Centrale Italiano Srl di Antonio Romano", "Acque Chiare Servizi Srl di Marco Rossi",
"Sorgenti d'Italia Srl di Roberto Marino", "Idro Distribuzione Italiana SpA di Luca Russo", "Idrogest Italia SpA di Paolo De Luca"];

var città = ["Ancona", "Andria", "Arezzo", "Bari", "Bergamo", "Bologna", "Bolzano", "Brescia", "Cagliari", "Catania", "Catanzaro", "Cesena",
"Cosenza", "Ferrara", "Firenze", "Foggia", "Forlì", "Genova", "Latina", "Lecce", "Livorno", "Milano", "Modena", "Monza", "Napoli", "Novara",
"Padova", "Palermo", "Parma", "Perugia", "Pescara", "Piacenza", "Prato", "Ravenna", "Reggio Calabria", "Reggio Emilia", "Rimini", "Roma",
"Salerno", "Sassari", "Siracusa", "Taranto", "Terni", "Torino", "Trento", "Trieste", "Udine", "Venezia", "Verona", "Vicenza"];

function autocomplete(inp, arr) {  // argomenti sono il campo text e lista di possibili opzioni
    var currentFocus;
    inp.addEventListener("input", function(e) {  // esegue quando viene scritto nel campo text
        var a, b, i, val = this.value;
        closeAllLists();  // chiude eventuali liste di autocompletamenti
        if (!val) { return false;}
        currentFocus = -1;
        a = document.createElement("DIV");  // DIV è l'elemento che conterrà i valori
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);  // elemento DIV come child del suo contenitore
        for (i = 0; i < arr.length; i++) {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) { // se arr[i] inizia con lettere inserite
                b = document.createElement("DIV");  // crea elemento DIV per ogni corrispondenza
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>"; // lettere corrispondenti in grassetto
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>"; // input field contenente valore corrente
                b.addEventListener("click", function(e) {  // esegue quando viene cliccato un elemento della lista
                    inp.value = this.getElementsByTagName("input")[0].value;  // inserisce selezionato come valore del campo
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    inp.addEventListener("keydown", function(e) {    // esegue quando viene cliccato un tasto della tastiera
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {  // freccia giù premuta
            currentFocus++;
            addActive(x);  // rende elemento lista più visibile
        } else if (e.keyCode == 38) { // freccia su premuta
            currentFocus--;
            addActive(x);  // rende elemento lista più visibile
        } else if (e.keyCode == 13) { // tasto invio premuto
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();  // simula click su elemento lista 'attivo'
           }
        }
    });
    
    function addActive(x) {  // classifica un elemento lista come 'attivo'
        if (!x) return false;
        removeActive(x);  // rimuova 'attivo' da tutti gli altri elementi
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }
  
    function removeActive(x) {  // rimuove classe 'active' da tutti gli elementi
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
  
    function closeAllLists(elmnt) {  // chiude tutte le liste di autocompletamenti tranne quello passato in parametro
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {  // esegue quando viene cliccata la pagina
        closeAllLists(e.target);
    });
}


function verificaStato() {  // abilita e disabilita la data di chiusura
    var data = document.getElementById("data_ch");
    var stato = document.querySelector(".attività input[type='radio']:checked")?.value;
    if (stato ===  "attiva") {
        data.classList.add("data_non_ammessa");  // aggiunge classe 
        data.disabled = true;  // disabilita campo data
        data.value = "";  // svuota scelta già presente
    } else {
        data.classList.remove("data_non_ammessa");  // rimuove classe
        data.disabled = false;  // abilita campo data
    }
}
document.addEventListener("DOMContentLoaded", function () {
    verificaStato();

    const radios = document.querySelectorAll(".attività input[type='radio']");
    radios.forEach(radio => {  // per ogni input radio controlla cambio di valore
        radio.addEventListener("change", verificaStato);
    });
});