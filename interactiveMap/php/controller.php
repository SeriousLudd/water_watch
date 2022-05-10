<?php

$host = "localhost";
$db_name = "sc4iouston_db_dev";
$username = "sc4iouston_dbu_dev";
$password = "THAQP72²WE$@++z{d50";

try{
    $db = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $db->exec("set names utf8");
}catch(PDOException $exception){
    echo "Erreur de connexion : " . $exception->getMessage();
}

$sql = "SELECT * FROM water_watch";

// Request prepare
$query = $db->prepare($sql);

// Request execution
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $rivers = [
        "id" => $id,
        "utilisateur" => $utilisateur,
        "nom" => $name,
        "identifiant" => $identifiant,
        "datetime" => $datetime,
        "gps_latitude" => $gps_latitude,
        "gps_longitude" => $gps_longitude,
        "temperature_moy" => $temperature_moy,
        "ph_moy" => $ph_moy,
        "ph_bandelette" => $ph_bandelette,
        "ph_interpretation" => $ph_interpretation,
        "ph_moy_mV" => $ph_moy_mV,
        "conductivite_moy" => $conductivite_moy,
        "conductivite_moy_mV" => $conductivite_moy_mV,
        "turbidite_moy_NTU" => $turbidite_moy_NTU,
        "turbidite_moy_mV" => $turbidite_moy_mV,
        "turbidite_interpretation" => $turbidite_interpretation,
        "profondeur" => $profondeur,
        "debit_interpretation" => $debit_interpretation,
        "concentration_nitrate" => $concentration_nitrate,
        "concentration_nitrite" => $concentration_nitrite,
        "interpretation_nitrate" => $interpretation_nitrate,
        "interpretation_nitrite" => $interpretation_nitrite,
        "etat_mesure" => $etat_mesure,
        "observations" => $observations,
    ];

    $tableauRivers['watcher_watch'][] = $rivers;
}

// JSON encode
echo json_encode($tableauRivers);