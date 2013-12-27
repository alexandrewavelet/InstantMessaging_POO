<?php

	include("includes/header.php");
	
?>

<h2>Conversation</h2>
<div class="zoneMessages">
	<?php
		foreach ($messages as $message) {
			$message->afficher($destinataire->getLogin());
		}
	?>
</div>
<form role="form" method="POST" action="">
	<?php echo '<input type="hidden" id="idConv" name="idConv" value="'.$idConversation.'" />'; ?>
	<div class="form-group">
		<textarea id="message" name="message"></textarea>
		<button type="submit" class="boutonHome btnDiscussion" id="envoyer" name="envoyer">Envoyer</button>
	</div>
</form>

<?php

	include("includes/footer.php");

?>
