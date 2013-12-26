<?php

	include("includes/header.php");
	
?>

<h2>Conversation</h2>
<div class="zoneMessages">
	<?php
		foreach ($messages as $message) {
			$message->afficher();
		}
	?>
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
