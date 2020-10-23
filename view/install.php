<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Setup Help</title>"?>
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/pagination.css" rel="stylesheet" type="text/css">
	<link href="public/css/modal.css" rel="stylesheet" type="text/css">
	<link href="public/css/install.css" rel="stylesheet" type="text/css">

	<script src="public/js/install.js"></script>
</head>

<body>
<div class="container">
  <div class="title">
	  <h1 class='font-weight-bold text-center'>Setup Help</h1>
  </div>


<!-- Liste des dépendances -->
<div class="row">
  <div class="col">
	  <h2 class="subtitle text-center">Dependencies List</h2><br>
	  <div class="accordion" id="accordionInstall">
		  <div class="card">
      		<div class="card-header alert <?php if (!$php_mongo): ?>alert-danger<?php endif ?>" id="headingPhpMongo">
	        	<h2 class="mb-0">
	          	<button class="btn btn-link btn-block text-left d-flex" type="button" data-toggle="collapse" data-target="#collapsePhpMongo" aria-expanded="true" aria-controls="collapsePhpMongo">
				  	<span>php-mongo</span>
					<span class="ml-auto text-<?php if ($php_mongo): ?>success<?php else: ?>danger<?php endif; ?>"><i class="fa fa-fw <?php if ($php_mongo): ?>fa-check<?php else: ?>fa-remove<?php endif; ?>"></i></span>
	          	</button>
	        	</h2>
      		</div>
      		<div id="collapsePhpMongo" class="collapse<?php if (!$php_mongo): ?> show<?php endif; ?>" aria-labelledby="headingPhpMongo" data-parent="#accordionInstall">
        		<div class="card-body">
					<p>To install the php-mongodb package, you can use the following command:</p>
					<code>sudo pecl install mongodb</code>
        		</div>
      		</div>
    	</div>
		<div class="card">
		  <div class="card-header alert <?php if (!$composer_mongo): ?>alert-danger<?php endif ?>" id="headingComposerMongo">
			  <h2 class="mb-0">
			  <button class="btn btn-link btn-block text-left d-flex" type="button" data-toggle="collapse" data-target="#collapseComposerMongo" aria-expanded="true" aria-controls="collapseComposerMongo">
				  <span>composer mongo</span>
				  <span class="ml-auto text-<?php if ($composer_mongo): ?>success<?php else: ?>danger<?php endif; ?>"><i class="fa fa-fw <?php if ($composer_mongo): ?>fa-check<?php else: ?>fa-remove<?php endif; ?>"></i></span>
			  </button>
			  </h2>
		  </div>
		  <div id="collapseComposerMongo" class="collapse<?php if (!$composer_mongo): ?> show<?php endif; ?>" aria-labelledby="headingComposerMongo" data-parent="#accordionInstall">
			  <div class="card-body">
				  <p>To install the mongodb/mongodb composer package, you can use the following command:</p>
		  		  <code>composer require mongodb/mongodb:^1.6</code>
			  </div>
		  </div>
	  </div>
	  <div class="card">
		<div class="card-header alert <?php if (!$jsoneditor): ?>alert-warning<?php endif ?>" id="headingJsonEditor">
			<h2 class="mb-0">
			<button class="btn btn-link btn-block text-left d-flex" type="button" data-toggle="collapse" data-target="#collapseJsonEditor" aria-expanded="true" aria-controls="collapseJsonEditor">
				<span>jsoneditor</span>
				<span class="ml-auto text-<?php if ($jsoneditor): ?>success<?php else: ?>warning<?php endif; ?>"><i class="fa fa-fw <?php if ($jsoneditor): ?>fa-check<?php else: ?>fa-remove<?php endif; ?>"></i></span>
			</button>
			</h2>
		</div>
		<div id="collapseJsonEditor" class="collapse<?php if (!$jsoneditor): ?> show<?php endif; ?>" aria-labelledby="headingJsonEditor" data-parent="#accordionInstall">
			<div class="card-body">
				<p>If jsoneditor is not correctly installed, you can try a reinstallation, see README.md for further details.</p>
			</div>
		</div>
	</div>
	</div>
  </div>
</div>

<br><br>

<!-- Bouton de retour au menu home -->

<br>
<div class="col text-center">

	<button class="btn btn-primary" href="?action=install"><i class="fa fa-undo">&nbsp;</i>&nbsp;Re-check</button>

	&nbsp;

	<button href="index.php" class="btn <?php if (!$php_mongo || !$composer_mongo): ?>btn-secondary" disabled="disabled<?php else: ?>btn-success<?php endif; ?>">Start</button>

</div>
<!-- Fin du bouton de retour au menu home -->

</div>
<!-- footer -->

<?php
	require_once('footer.php')
?>

<!-- footer -->

</body>
</html>
