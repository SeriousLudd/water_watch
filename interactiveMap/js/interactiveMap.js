// variable
var isUnique = true;

// init map
var map = L.map('map').setView([47.25408084297041, 2.262939453125001], 6);

// tiles loading
L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors </a>',
    maxZoom: 18,
    minZoom: 1,
    maxZoom: 20
}).addTo(map);

// init layers
var layerGroup = L.layerGroup().addTo(map);

// ajout du marqueur
function addMarkers(){
let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = () => {

    // La transaction est terminée ?
    if (xmlhttp.readyState == 4) {
        // Si la transaction est un succès
        if (xmlhttp.status == 200) {
            // On traite les données reçues
            let donnees = JSON.parse(xmlhttp.responseText)

            // On boucle sur les données (ES8)
            Object.entries(donnees.watcher_watch).forEach(rivers => {

                // fonctions //
                function interpretationConduct() {
                    if (rivers[1].conductivite_moy < 150) {
                        return "Peu minéralisée";
                    } else if (rivers[1].conductivite_moy > 1000) {
                        return "Très minéralisée";
                    }
                    else {
                        return "Normale";
                    }
                };

                function interpretationPH() {
                    if (rivers[1].ph_moy < 6.5) {
                        return "Acide";
                    } else if (rivers[1].ph_moyen > 7.5) {
                        return "Basique";
                    } else {
                        return "Neutre";
                    }
                };

                function interpretationNitrate() {
                    if (rivers[1].interpretation_nitrate < 10) {
                        return "Très bon état (" + rivers[1].interpretation_nitrate + ")";
                    } else if (rivers[1].interpretation_nitrate > 50) {
                        return "Mauvais état (" + rivers[1].interpretation_nitrate + ")";
                    } else if (rivers[1].interpretation_nitrate > 10 && rivers[1].interpretation_nitrate < 50) {
                        return "Bon état (" + rivers[1].interpretation_nitrate + ")";
                    } else {
                        return "Donnée éronnée (" + rivers[1].interpretation_nitrate + ")";
                    }
                };

                function interpretationNitrite() {
                    if (rivers[1].interpretationNitrite < 0.1) {
                        return "Très bon état (" + rivers[1].interpretation_nitrite + ")";
                    } else if (rivers[1].interpretation_nitrite > 0.1 && rivers[1].interpretation_nitrite < 0.3) {
                        return "Très bon état (" + rivers[1].interpretation_nitrite + ")";
                    } else if (rivers[1].interpretation_nitrite > 0.3 && rivers[1].interpretation_nitrite < 0.5) {
                        return "Bon état (" + rivers[1].interpretation_nitrite + ")"
                    } else if (rivers[1].interpretation_nitrite > 0.5 && rivers[1].interpretation_nitrite < 1) {
                        return "État médiocre (" + rivers[1].interpretation_nitrite + ")"
                    }
                    else if (rivers[1].interpretation_nitrite > 1) {
                        return "Mauvais état (" + rivers[1].interpretation_nitrite + ")";
                    } else {
                        return "Donnée éronnée (" + rivers[1].interpretation_nitrite + ")";
                    }
                };
                
                // on met le marqueur rivière
                let marker = L.marker([rivers[1].gps_latitude, rivers[1].gps_longitude]).addTo(layerGroup)
                marker.bindPopup("<b>Identifiant:</b> " + rivers[1].identifiant
                    + "<br><b> Temp Moyenne (°C):</b> " + rivers[1].temperature_moy
                    + "<br><b> Interpr. pH:</b> " + interpretationPH()
                    + "<br><b> Interpr. Conductivité:</b> " + interpretationConduct()
                    + "<br><b> Interpr. Turbidité:</b> " + rivers[1].turbidite_interpretation
                    + "<br><b> Interpr. Nitrate:</b> " + interpretationNitrate()
                    + "<br><b> Interpr. Nitrite:</b> " + interpretationNitrite()
                    + "<details><summary>Voir plus</summary><br>"
                    + "<br><b>Utilisateur:</b> " + rivers[1].utilisateur
                    + "<br><b> Nom:</b> " + rivers[1].nom
                    + "<br><b> Latitude:</b> " + rivers[1].gps_latitude
                    + "<br><b> Longitude:</b> " + rivers[1].gps_longitude
                    + "<br><b> pH Moyen:</b> " + rivers[1].ph_moy
                    + "<br><b> pH Bandelette:</b> " + rivers[1].ph_bandelette
                    + "<br><b> pH Moyen (MV):</b> " + rivers[1].ph_moy_mV
                    + "<br><b> Conduct. Moy (µS/cm):</b> " + rivers[1].conductivite_moy
                    + "<br><b> Conduct. Moy (MV):</b> " + rivers[1].conductivite_moy_mV
                    + "<br><b> Turb. Moy (NTU):</b> " + rivers[1].turbidite_moy_NTU
                    + "<br><b> Turb. Moy(MV):</b> " + rivers[1].turbidite_moy_mV
                    + "<br><b> Profondeur:</b> " + rivers[1].profondeur
                    + "<br><b> Interpr. Débit:</b> " + rivers[1].debit_interpretation
                    + "<br><b> Concentr. Nitrate (mg/L):</b> " + rivers[1].concentration_nitrate
                    + "<br><b> Concentr. Nitrite (mg/L):</b> " + rivers[1].concentration_nitrite
                    + "<br><b> État mesuré:</b> " + rivers[1].etat_mesure
                    + "<br><b> Observations: </b> " + rivers[1].observations + "</details>",
                )
            })
        } else {
            console.log(xmlhttp.statusText);
        }
    }
}




// Lecture de la table water_watch pour générer les marqueurs 
xmlhttp.open("GET", "https://dev.lavigiedeleau.eu/wp-content/themes/child/interactiveMap/php/controller.php");
xmlhttp.send(null);
}

addMarkers();

// Pop-up formulaire
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

// fonctions de réactualisation des marqueurs 
function updateMarkers() {
    layerGroup.clearLayers();
    setTimeout(function() {addMarkers();
      }, 1000);
    
}

// Module plein écran de la carte 
map.addControl(new L.Control.Fullscreen());

