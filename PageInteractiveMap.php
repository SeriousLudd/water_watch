<?php /*Template Name: PageInteractiveMap */;?>
<?php $path = $_SERVER['DOCUMENT_ROOT']; 
include_once $path . '/wp-load.php';?>

<?php get_header(); ?>
	<div id="container" >

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>
				
<button class="open-button" onclick="openForm()">Formulaire de Saisie</button>
<button class="open-button2" onclick="openInsert()">Insertion Fichier</button>
<button class="open-button3" onclick="openSearch()">Recherche</button>

<!-- Iframe vide afin de prévenir le rafraichissement de la page et conserver les données entrées dans le formulaire -->
<iframe name="dummyframe" style="display:none;"></iframe>
<div class="form-popup" id="myForm" onkeydown="return event.key != 'Enter';">
<form method="post" name="formMap" action="" target="dummyframe" onsubmit="updateMarkers()">
<label id="champ">Utilisateur:</label><input type="text" required="required" placeholder="Nom de l'utilisateur..." name="user" class="styleChamp"/><br>
<label id="champ">Nom ruisseau (Optionnel):</label><input type="text" placeholder="Nom du cours d'eau..." name="name" class="styleChamp"/><br>
<label id="champ">Identifiant Point:</label><input type="text" required="required" placeholder="Identifiant du point..." name="identifiant" class="styleChamp"/><br>
<label id="champ">Latitude:</label><input type="number" min="-90" max="90" step="0.0000000001" required="required" placeholder="Ex: 46.34689" name="latitude" class="styleChamp"/><br>
<label id="champ">Longitude:</label><input type="number" min="-180" max="180" step="0.0000000001" required="required" placeholder="Ex: 2.323453" name="longitude" class="styleChamp"/><br>
<label id="champ">Température moyenne:</label><input type="number" min="-5" max="35" required="required" placeholder="Ex: 7"name="tempMoy" class="styleChamp"/><br>
<label id="champ">PH Moyen (Sonde):</label><input type="number" min="0" max="14" required="required" placeholder="Ex: 4" name="phMoy" class="styleChamp"/><br>
<label id="champ">PH Bandelette:</label><input type="number" min="0" max="14" required="required" placeholder="Ex: 6" name="phBand" class="styleChamp"/><br>
<label id="champ">PH Moyen MV (Sonde):</label><input type="number" min="0" max="3000" required="required" placeholder="Ex: 7" name="phMoyMv" class="styleChamp"/><br>
<label id="champ">Conductivité moyenne (µS/cm):</label><input type="number" required="required" placeholder="Ex: 2000"name="conduMoy" class="styleChamp"/><br>
<label id="champ">Conductivité moyenne (mV):</label><input type="number" required="required" placeholder="Ex: 1500" name="conduMoyMv" class="styleChamp"/><br>
<label id="champ">Turbidité moyenne (NTU):</label><input type="number" required="required" placeholder="Ex: 500" name="turbMoyNTU" class="styleChamp"/><br>
<label id="champ">Turbidité moyenne (mV):</label><input type="number" required="required" placeholder="Ex: 2000" name="turbMoyMv" class="styleChamp"/><br>
<label id="champ">Profondeur (cm):</label><input type="number" min="1" max="300" required="required" placeholder="Ex: 200" name="profondeur" class="styleChamp"/><br>
<label id="champ">Concentration Nitrates (mg/L):</label><input type="number" min="0" max="50" required="required" placeholder="Ex: 30" name="conNitra" class="styleChamp"/><br>
<label id="champ">Concentration Nitrites (mg/L):</label><input type="number" min="0" max="3" required="required" placeholder="Ex: 2" name="conNitri" class="styleChamp"/><br>
<label id="champ">Interprétation Débit:</label><input type="text" required="required" placeholder="Votre interpretation ici..." name="debitInter" class="styleChamp"/><br>
<label id="champ">État mesuré:</label><input type="text" required="required" placeholder="Texte ici..." name="etatMesure" class="styleChamp"/><br>
<label id="champ">Observations (Optionnel):</label>
<textarea rows="4" cols="35" name="observations" placeholder="Vos observations, juste ici..." class="styleChampObs"></textarea><br>

<button type="submit" name="save">Sauvegarder</button><button type="reset" name="reset">Reset</button><button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
</form>
</div>
			<?php endwhile; ?>
	</div><!-- #primary -->

	<!-- INSERT INTO THE DATABASE -->
<?php
global $wpdb;
if(isset($_POST['submit']))
{
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
	
}
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>