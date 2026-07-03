// Diciamo a JavaScript di aspettare che l'HTML e il CSS siano completamente caricati
document.addEventListener("DOMContentLoaded", function() {

    // 1. crea mappa centrata sull’Italia
    const map = L.map('map').setView([42.5, 12.5], 5);

    // 2. layer mappa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap'
    }).addTo(map);

    // 3. punti fissi
    const punti = [
      { nome: "Monza", lat: 45.5845, lng: 9.2744 },
      { nome: "Parma", lat: 44.8015, lng: 10.3280 },
      { nome: "Andria", lat: 41.2294, lng: 16.2974 },
      { nome: "Firenze", lat: 43.7696, lng: 11.2558 },
      { nome: "Rimini", lat: 44.0575, lng: 12.5653 },
      { nome: "Taranto", lat: 40.4644, lng: 17.2470 },
      { nome: "Trento", lat: 46.0748, lng: 11.1217 },
      { nome: "Arezzo", lat: 43.4633, lng: 11.8783 },
      { nome: "Sassari", lat: 40.7259, lng: 8.5556 },
      { nome: "Ferrara", lat: 44.8381, lng: 11.6198 },
      { nome: "Ancona", lat: 43.6158, lng: 13.5189 },
      { nome: "Modena", lat: 44.6471, lng: 10.9252 },
      { nome: "Bari", lat: 41.1171, lng: 16.8719 },
      { nome: "Livorno", lat: 43.5485, lng: 10.3106 },
      { nome: "Pescara", lat: 42.4643, lng: 14.2142 },
      { nome: "Verona", lat: 45.4384, lng: 10.9916 },
      { nome: "Venezia", lat: 45.4408, lng: 12.3155 },
      { nome: "Siracusa", lat: 37.0755, lng: 15.2866 },
      { nome: "Perugia", lat: 43.1107, lng: 12.3908 },
      { nome: "Reggio Calabria", lat: 38.1144, lng: 15.6500 },
      { nome: "Cagliari", lat: 39.2238, lng: 9.1217 },
      { nome: "Latina", lat: 41.4676, lng: 12.9036 },
      { nome: "Piacenza", lat: 45.0526, lng: 9.6930 },
      { nome: "Palermo", lat: 38.1157, lng: 13.3615 },
      { nome: "Salerno", lat: 40.6780, lng: 14.7594 },
      { nome: "Forlì", lat: 44.2227, lng: 12.0407 },
      { nome: "Foggia", lat: 41.4622, lng: 15.5446 },
      { nome: "Napoli", lat: 40.8518, lng: 14.2681 },
      { nome: "Catanzaro", lat: 38.9054, lng: 16.5948 },
      { nome: "Reggio Emilia", lat: 44.6983, lng: 10.6313 },
      { nome: "Brescia", lat: 45.5416, lng: 10.2168 },
      { nome: "Udine", lat: 46.0711, lng: 13.2346 },
      { nome: "Ravenna", lat: 44.4184, lng: 12.2035 },
      { nome: "Padova", lat: 45.4064, lng: 11.8768 },
      { nome: "Vicenza", lat: 45.5455, lng: 11.5350 },
      { nome: "Pistoia", lat: 43.9317, lng: 10.9156 },
      { nome: "Prato", lat: 43.8777, lng: 11.1022 },
      { nome: "Torino", lat: 45.0703, lng: 7.6869 },
      { nome: "Bolzano", lat: 46.4908, lng: 11.3398 },
      { nome: "Terni", lat: 42.5630, lng: 12.6464 },
      { nome: "Catania", lat: 37.5079, lng: 15.0830 },
      { nome: "Bergamo", lat: 45.6983, lng: 9.6773 },
      { nome: "Milano", lat: 45.4642, lng: 9.1900 },
      { nome: "Novara", lat: 45.4468, lng: 8.6214 },
      { nome: "Bologna", lat: 44.4949, lng: 11.3426 },
      { nome: "Cesena", lat: 44.1391, lng: 12.2432 },
      { nome: "Lecce", lat: 40.3515, lng: 18.1750 },
      { nome: "Genova", lat: 44.4056, lng: 8.9463 },
      { nome: "Cosenza", lat: 39.2983, lng: 16.2537 },
      { nome: "Roma", lat: 41.9028, lng: 12.4964 },
      { nome: "Trieste", lat: 45.6495, lng: 13.7768 },
      { nome: "Messina", lat: 38.1938, lng: 15.5540 }
    ];

    // 4. aggiunta marker con opacità ed effetto Hover
    punti.forEach(p => {
      var marker = L.marker([p.lat, p.lng], {
        opacity: 0.3
      }).addTo(map);

      marker.bindTooltip(p.nome, {
        direction: 'top',   
        offset: [0, -10]    
      });

      marker.on('mouseover', function(e) {
        this.setOpacity(1);
      });

      marker.on('mouseout', function(e) {
        this.setOpacity(0.3);
      });
    });

});