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

<!-- Titre de la page -->

<br><br>
<h1 class='title font-weight-bold'align="center">Setup Help</h1>

<!-- Fin du titre de la page -->


<!-- Liste des dépendances -->
<br><br>
<h2 class="subtitle" align="center">Dependencies List</h2><br>

<table id='dependencies' align="center">
	<tr>
		<td>php-mongo</td>
		<?php if ($php_mongo){ ?>
			<td><i class="fa fa-fw fa-check" style="color: #28A745;"></i></td>
		<?php } else{ ?>
			<td><i class="fa fa-fw fa-remove" style="color: red;"></i></td>
		<?php } ?>
		<td><i class="fa fa-fw fa-question-circle" onclick="reveal_p()"></i></td>
	</tr>
	<tr>
		<td>composer mongodb/mongodb</td>
		<?php if ($composer_mongo){ ?>
			<td><i class="fa fa-fw fa-check" style="color: #28A745;"></i></td>
		<?php } else{ ?>
			<td><i class="fa fa-fw fa-remove" style="color: red;"></i></td>
		<?php } ?>
		<td><i class="fa fa-fw fa-question-circle" onclick="reveal_c()"></i></td>
	</tr>
	<tr>
		<td>jsoneditor</td>
		<?php if ($jsoneditor){ ?>
			<td><i class="fa fa-fw fa-check" style="color: #28A745;"></i></td>
		<?php } else{ ?>
			<td><i class="fa fa-fw fa-remove" style="color: red;"></i></td>
		<?php } ?>
		<td><i class="fa fa-fw fa-question-circle" onclick="reveal_j()"></i></td>
	</tr>
</table>

<!-- Fin de la liste des dépendances -->


<!-- Installation de php-mongo -->

<div id="php-mongo" class="modal text-left">
	<div class="modal-content">
		<span id="close" onclick="hide_p()">&times;</span>
		<p>To install the php-mongodb package, you can use the following command:</p>
		<div id="pre_content">
			<pre>sudo pecl install mongodb</pre>
		</div>
	</div>
</div>

<!-- Fin de l'installation de php-mongo -->


<!-- Installation de composer-mongo -->

<div id="composer-mongo" class="modal text-left">
	<div class="modal-content">
		<span id="close" onclick="hide_c()">&times;</span>
		<p>To install the mongodb/mongodb composer package, you can use the following command:</p>
		<div id="pre_content">
			<pre>composer require mongodb/mongodb</pre>
		</div>
	</div>
</div>

<!-- Fin de l'installation de php-mongo -->


<!-- Installation de jsoneditor -->

<div id="jsoneditor" class="modal text-left">
	<div class="modal-content" onclick="hide_j()">
		<span id="close">&times;</span>
		<p>If jsoneditor is not correctly installed, you can try a reinstallation, see README.md for further details.</p>
	</div>
</div>

<!-- Fin de l'installation de php-mongo -->


<!-- Bouton de retour au menu home -->

<br>
<button class="btn btn-success font-weight-bold"id="home" style="width: 4%; margin-left: 49%;"><a href="index.php" style="color:white;">Home</a></button>

<!-- Fin du bouton de retour au menu home -->


<!-- footer -->

<?php 
	require_once('footer.php')
?>

<!-- footer -->

</body>
</html>

<script type="text/javascript">
	var modal_p = document.getElementById("php-mongo");
	var modal_c = document.getElementById("composer-mongo");
	var modal_j = document.getElementById("jsoneditor");

	window.onclick = function(event) {
	  if (event.target == modal_p) {
	    modal_p.style.display = "none";
	  }
	  if (event.target == modal_c) {
	    modal_c.style.display = "none";
	  }
	  if (event.target == modal_j) {
	    modal_j.style.display = "none";
	  }
	}
</script>