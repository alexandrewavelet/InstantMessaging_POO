<?php

	if (isset($message)) {
		echo $message;
		
	}
	
?>

<h3>Informations du profil</h3>
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<p><strong>Login</strong></p>
		</div>
		<div class="col-md-2">
			<?php echo $_SESSION['utilisateur']->getLogin(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2">
			<?php echo '<img class="img-responsive" src="assets/images/'.$_SESSION['utilisateur']->getPhoto().'"/>'; ?>
		</div>
		<div class="col-md-3">
			<h4>Changer l'image du profil</h4>
			<form role="form" action="cMessagerie.php?action=changerPhoto" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="avatar">Changer l'avatar</label>
					<input type="file" class="form-control" id="avatar" name="avatar" placeholder="Sélectionnez une image">
				</div>
				<button class="boutonHome">Changer</button>
			</form>
		</div>
	</div>
</div>
