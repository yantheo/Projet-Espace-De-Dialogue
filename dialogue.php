<?php
$mysqli = new Mysqli('localhost','root','', 'dialogue');
if($_POST)
{
	echo "pseudo posté: $_POST[pseudo]<br>";
	echo "message posté: $_POST[message]<br>";
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