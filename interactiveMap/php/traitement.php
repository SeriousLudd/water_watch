<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
include_once $path . '/wp-load.php';
global $wpdb;

$uniqueident = $_POST["identifiant"];
$count = $wpdb->get_var("SELECT COUNT(*) FROM water_watch WHERE identifiant = '$uniqueident'");
if($count == 0){
    $wpdb->insert("water_watch", array(
        "name" => $_POST["name"],
        "utilisateur" => $_POST["user"],
        "identifiant" => $_POST["identifiant"],
        "gps_latitude" => $_POST["latitude"],
        "gps_longitude" => $_POST["longitude"],
        "temperature_moy" => $_POST["tempMoy"],
        "ph_moy" => $_POST["phMoy"],
        "ph_bandelette" => $_POST["phBand"],
        "ph_moy_mV" => $_POST["phMoyMv"],
        "conductivite_moy" => $_POST["conduMoy"],
        "conductivite_moy_mV" => $_POST["conduMoyMv"],
        "turbidite_moy_NTU" => $_POST["turbMoyNTU"],
        "turbidite_moy_mV" => $_POST["turbMoyMv"],
        "profondeur" => $_POST["profondeur"],
        "debit_interpretation" => $_POST["debitInter"],
        "concentration_nitrate" => $_POST["conNitra"],
        "concentration_nitrite" => $_POST["conNitri"],
        "interpretation_nitrate" => $_POST["conNitra"]*4.427,
        "interpretation_nitrite" => $_POST["conNitri"]*3.28,
        "etat_mesure" => $_POST["etatMesure"],
        "observations" => $_POST["observations"],
    ));
}
else {
    echo "<script type='text/javascript'>alert('ERREUR: Cet identifiant est déjà utilisé pour un point. Merci de rentrer un identifiant unique.');</script>"; 
}


?>