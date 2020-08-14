<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Dialogue</title>
	<style><?php include "style.css";?></style>
</head>
<body>

<?php
// Partie connexion à la BDD
$mysqli = new Mysqli('localhost','root','', 'dialogue');
//--------------------------------------------------------------------------------------------------------------------
// Partie enregistrement
if($_POST)
{	//Ajout de la fonction addslashes au POST qui permet de gérer les apostrophes(rajout d'un anti-slash)
	$_POST['pseudo'] = addslashes($_POST['pseudo']);
	$_POST['message'] = addslashes($_POST['message']);
	
	if(!empty($_POST['pseudo'] && $_POST['message']))
	{
		$mysqli->query("INSERT INTO commentaire(pseudo, message, date_enregistrement) VALUES ('$_POST[pseudo]', '$_POST[message]', NOW())")
				OR DIE ($mysqli->error);
		echo "<div class='validation'>Votre message a bien été enregistré.</div>";
	}
	else
	{
		echo "<div class='erreur'>Afin de déposer un commentaire, veuillez svp remplir tous les champs de formulaire.</div>";
	}
}
//--------------------------------------------------------------------------------------------------------------------
//Partie affichage des commentaires
//Affichage de la date et heure au format français + ordonner les messages du plus récent au plus ancien.
$resultat = $mysqli->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS dateFr, 
							DATE_FORMAT(date_enregistrement, '%H:%i:%s') AS heureFr FROM commentaire ORDER BY date_enregistrement DESC");
echo "<h2>" . $resultat->num_rows . " nombres de message(s)</h2>";
while($commentaire = $resultat->fetch_assoc())
{
	echo "<div class='message'>";
		echo "<div class='titre'>Par : " . $commentaire['pseudo'] . ", le " . $commentaire['dateFr'] . " à " . $commentaire['heureFr'] . "</div>";
		echo "<div class='contenu'>" . $commentaire['message'] . "</div>";
	echo "</div><hr>";
}
//--------------------------------------------------------------------------------------------------------------------
//Partie formulaire d'envoie de commentaire
?>
	<form method="post" action="">
		<label for="pseudo">Pseudo</label><br>
		<input type="text" id="pseudo" name="pseudo" maxlength="20" pattern="[a-zA-Z0-9.-_]+" title="caractères autorisés : a-zA-Z0-9.-_"><br>
		
		<label for ="message">Message</label><br>
		<textarea id="message" name="message" cols="50" rows="7"></textarea><br>
		
		<input type="submit" value="Envoyer le message">
	</form>
</body>
</html>