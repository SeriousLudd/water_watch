
<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
include_once $path . '/wp-load.php';
global $wpdb;
				$result = $wpdb->get_results ("SELECT * FROM water_watch", ARRAY_A);
				foreach($result as $row){
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
?>