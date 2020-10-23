<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$coll."</title>"?>

	<?php require_once('header.php') ?>
</head>

<body>

<?php include('breadcrumb.php'); ?>

<?php

//Titre de la page

echo "<h1 align=center class='title font-weight-bold'>Edit <i title='name of collection' class='fa fa-fw fa-server'></i> ".$coll." <button  class='btn mr-5'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$serve.'&db='.$db."  onclick='return confirmDelete()'><i title='delete this collection' class='fa fa-2x fa-trash'></i></a></button></h1>";


?>

<!-- Fin du titre de la page -->


<!-- Formulaire -->

<div id="main" class="border  col-lg-8 offset-lg-2 bg-light mt-1">
	<?php

		//Renommer la collection

		echo '<form method="post" action="index.php?action=renameCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'">'; 
		echo '<br><label>Rename Collection</label><br>';
		echo ' <div class="input-group mb-3">';
		echo '<input type="text" class="form-control" name="newname" id="newname" value="'.$coll.'" required />';
		echo '<input type="submit" class="btn  bg-success text-light" name="rename" id="rename" value="Rename"></div>';

		echo '</form><hr>';

		//Déplacer la collection
	    
		echo '<form method="post" action="index.php?action=moveCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'">'; 
		echo '<br><label>Move Collection</label>';
		echo ' <div class="input-group mb-3">';
		echo '<input type="text" class="form-control" name="newdb" id="newdb" placeholder="New Database" required />';
		echo '<input type="submit" class="btn bg-success text-light" name="move" id="move" value="Move"></div>';
		echo '</form>';

		//Bouton de retour

		echo '<br><a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><button class="return btn btn-primary font-weight-bold">< Database</button></a>'; 
	?>
</div>

<!-- Fin du formulaire -->


<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->

	<script src="public/js/db.js"></script>
</body>
</html>