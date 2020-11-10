<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>MongoPassion</title>"?>
	<?php require_once('layouts/header.php') ?>
</head>
<body>
<div class="container" id="home">
	<div id="main" class="text-center m-auto ">

		<!-- Titre de la page -->

		<div class='text-center align-items-end mt-3 d-inline-flex'>
			<img align="center" src="https://img.icons8.com/emoji/96/000000/mango-emoji.png" alt="24eme"/>
			<!-- <img align="center" src="public/images/mongo.png" alt="24eme"> -->
			<h1 class='text-center title font-weight-bold'>mongo<span class="text-secondary">Passion</span></h1>
		</div>

		<div class="col-lg-8 offset-lg-2 bg-light m-auto">
			<?php if (isset($flash_message) && $flash_message): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $flash_message; ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- Fin du titre de la page -->
		<!-- Formulaire serveurs -->
		<div>
			<form action="index.php?action=getServer">
					<div class="input-group btn-group">
						<input type="hidden" name="action" value="getServer">
						<input type="text" autofocus="autofocus" class="form-control border border-success" name="serve" id="serve" placeholder="mongo.example.net:27017"  maxLength=20 required />
						<div class="input-group-append">
						<input type="submit" class="btn btn-success font-weight-bold" id="add" value="Connect">
					</div>
				</div>
			</form>
			<div class="text-right mb-3">
				<a href="#" data-toggle="modal" data-target="#modal-connection">Advanced Connection</a>
			</div>
		</div>

		<!-- Fin du formulaire serveurs -->
	</div>



	<!-- Tableau des serveurs -->
	<?php require_once('layouts/home//tableauServerHome.php') ?>
	<!-- Fin du tableau des serveurs -->

	<!-- Modal connexion -->
	<?php require_once('layouts/home/modalHomeConnexion.php') ?>
	<!-- Fin du modal connexion -->


	<!-- Footer -->

	<?php require_once('layouts/footer.php') ?>
</div>
<script type="text/javascript">
<?php if ($modal_opened): ?>
	$('#modal-connection').modal("show")
<?php endif; ?>
</script>
</body>
</html>
