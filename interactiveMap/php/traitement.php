<?php
//get the form elements and store them in variables
$name=$_POST["name"]; 
$utilisateur=$_POST["user"];
$identifiant= $_POST["identifiant"];
$latitude=$_POST["latitude"]; 
$longitude=$_POST["longitude"];
$temperature_moy=$_POST["tempMoy"]; 
$ph_moy=$_POST["phMoy"]; 
$ph_bandelette=$_POST["phBand"]; 
$ph_interpretation=$_POST["phInter"]; 
$ph_moy_mV=$_POST["phMoyMv"]; 
$conductivite_moy=$_POST["conduMoy"]; 
$conductivite_moy_mV=$_POST["conduMoyMv"]; 
$turbidite_moy_NTU=$_POST["turbMoyNTU"]; 
$turbidite_moy_mV=$_POST["turbMoyMv"]; 
$turbidite_interpretation=$_POST["turbInter"];
$profondeur=$_POST["profondeur"]; 
$debit_interpretation=$_POST["debitInter"]; 
$concentration_nitrate=$_POST["conNitra"]; 
$concentration_nitrite=$_POST["conNitri"]; 
$interpretation_nitrate=$_POST["conNitra"]*4.427; 
$interpretation_nitrite=$_POST["conNitri"]*3.28; 
$etat_mesure=$_POST["etatMesure"]; 
$observations=$_POST["observations"]; 

//establish connection
$con = mysqli_connect("localhost","sc4iouston_dbu_dev","THAQP72²WE$@++z{d50","sc4iouston_db_dev"); 

//on connection failure, throw an error
if(!$con) {  
die('Could not connect: '.mysql_error()); 
} 

//check ident already existant
$select = mysqli_query($con, "SELECT `identifiant` FROM `water_watch` WHERE `identifiant` = '".$_POST['identifiant']."'") or exit(mysqli_error($con));
if(mysqli_num_rows($select)) {
echo "<script type='text/javascript'>alert('ERREUR: Cet identifiant est déjà utilisé pour un point. Merci de rentrer un identifiant unique.');</script>"; 

} else {
$sql="INSERT INTO `sc4iouston_db_dev`.`water_watch` (`utilisateur`, `name` , `identifiant` , `gps_latitude`, `gps_longitude`, `temperature_moy`, `ph_moy`, `ph_bandelette`, `ph_interpretation`, `ph_moy_mV`, `conductivite_moy`,
 `conductivite_moy_mV`, `turbidite_moy_NTU`, `turbidite_moy_mV`, `turbidite_interpretation`, `profondeur`, `debit_interpretation`, `concentration_nitrate`, `concentration_nitrite`, `interpretation_nitrate`, 
 `interpretation_nitrite`, `etat_mesure`, `observations`) 
VALUES ('$utilisateur', '$name', '$identifiant', '$latitude', '$longitude', '$temperature_moy', '$ph_moy', '$ph_bandelette', '$ph_interpretation', '$ph_moy_mV', '$conductivite_moy', '$conductivite_moy_mV', '$turbidite_moy_NTU',
 '$turbidite_moy_mV', '$turbidite_interpretation', '$profondeur', '$debit_interpretation', '$concentration_nitrate', '$concentration_nitrite', '$interpretation_nitrate', '$interpretation_nitrite', '$etat_mesure', '$observations')"; 
mysqli_query($con,$sql); 

}
?>