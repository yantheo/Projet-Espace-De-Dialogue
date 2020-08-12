<?php
$mysqli = new Mysqli('localhost','root','', 'dialogue');
if($_POST)
{
	//echo "pseudo posté: $_POST[pseudo]<br>";
	//echo "message posté: $_POST[message]<br>";
	$mysqli->query("INSERT INTO commentaire(pseudo, message, date_enregistrement) VALUES ('$_POST[pseudo]', '$_POST[message]', NOW())")
			OR DIE ($mysqli->error);
	echo "<div class='validation'>Votre message a bien été enregistré.</div>";
}
?>
<hr>
<form method="post" action="">
	<label for="pseudo">Pseudo</label><br>
	<input type="text" id="pseudo" name="pseudo"><br>
	
	<label for ="message">Message</label><br>
	<textarea id="message" name="message" cols="50" rows="7"></textarea><br>
	
	<input type="submit" value="Envoyer le message">
</form>