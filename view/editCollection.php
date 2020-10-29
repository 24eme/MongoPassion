<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$coll."</title>"?>

	<?php require_once('layouts/header.php') ?>
</head>

<body>

<?php include('layouts/breadcrumb.php'); ?>

<div class="container">

<?php

//Titre de la page

echo "<h1 align=center class='title font-weight-bold'>Edit <i title='name of collection' class='fa fa-fw fa-server'></i> ".$coll." <button  class='btn mr-5'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$serve.'&db='.$db."  onclick='return confirmDelete()'><i title='delete this collection' class='fa fa-2x fa-trash'></i></a></button></h1>";


?>

<!-- Fin du titre de la page -->


<!-- Formulaire -->


<div>
	<div class="col">
		<div class="card">
			<form action="index.php?action=renameCollection&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll; ?>">
				<div class="card-header">Rename Collection</div>
					<div class="card-body">
						<div class="input-group mb-3">
							<input type="hidden" name="action" value="renameCollection">
							<input type="hidden" name="serve" value='<?php echo $serve ?>'>
							<input type="hidden" name="db" value='<?php echo $db ?>'>
							<input type="hidden" name="coll" value='<?php echo $coll ?>'>
							<input type="text" class="form-control" name="newname" id="newname" value="<?php echo $coll; ?>" required />
							<input type="submit" class="btn  bg-success text-light" id="rename" value="Rename">
						</div>
					</div>
			</form>
		</div>
	</div>
	<br><br>
	<div class="col">
		<div class="card">
			<form action="index.php?action=moveCollection&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll; ?>">
				<div class="card-header">Move Collection</div>
					<div class="card-body">
						<div class="input-group mb-3">
							<input type="hidden" name="action" value="moveCollection">
							<input type="hidden" name="serve" value='<?php echo $serve ?>'>
							<input type="hidden" name="db" value='<?php echo $db ?>'>
							<input type="hidden" name="coll" value='<?php echo $coll ?>'>
							<input type="text" class="form-control" name="newdb" id="newdb" placeholder="New Database" required />
							<input type="submit" class="btn bg-success text-light" name="move" id="move" value="Move">
						</div>
					</div>
			</form>
		</div>
	</div>
	<br><br>
	<div class="col">
		<a href="index.php?action=getDb&serve=<?php echo  $serve.'&db='.$db; ?>"><button class="return btn btn-primary font-weight-bold mb-2">< list collection</button></a>
	</div>
</div>

<!-- Fin du formulaire -->

<!-- footer -->

<?php
	require_once('layouts/footer.php')
?>

   <!-- footer -->

	<script src="public/js/db.js"></script>
</body>
</html>
