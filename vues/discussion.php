<?php

	include("includes/header.php");
	
?>

<h3>Informations du profil</h3>
<div class="container zoneMessages">

</div>
<form role="form" method="POST" action="this">
	<div class="form-group">
		<textarea id="message" name="message"></textarea>
	</div>
	<button type="submit" class="boutonHome" id="envoyer" name="envoyer">Envoyer</button>
</form>

<?php

	include("includes/footer.php");

?>
