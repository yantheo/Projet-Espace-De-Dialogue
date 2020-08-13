<?php
$mysqli = new Mysqli('localhost','root','', 'dialogue');
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
?>
<hr>
<form method="post" action="">
	<label for="pseudo">Pseudo</label><br>
	<input type="text" id="pseudo" name="pseudo" maxlength="20" pattern="[a-zA-Z0-9.-_]+" title="caractères autorisés : a-zA-Z0-9.-_"><br>
	
	<label for ="message">Message</label><br>
	<textarea id="message" name="message" cols="50" rows="7"></textarea><br>
	
	<input type="submit" value="Envoyer le message">
</form>