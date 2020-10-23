<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$coll."</title>"?>

	<?php require_once('header.php') ?>
</head>

<body>

<?php include('breadcrumb.php'); ?>

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
<form method="post" action="index.php?action=renameCollection&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll; ?>">
<div class="card-header">Rename Collection</div>
<div class="card-body">
 <div class="input-group mb-3">
<input type="text" class="form-control" name="newname" id="newname" value="<?php echo $coll; ?>" required />
<input type="submit" class="btn  bg-success text-light" name="rename" id="rename" value="Rename"></div>
</form>
</div>
</div>
</div>
<br><br>
<div class="col">
<div class="card">
<form method="post" action="index.php?action=moveCollection&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll; ?>">
	<div class="card-header">Move Collection</div>
<div class="card-body">
 <div class="input-group mb-3">
<input type="text" class="form-control" name="newdb" id="newdb" placeholder="New Database" required />
<input type="submit" class="btn bg-success text-light" name="move" id="move" value="Move"></div>
</form>
</div>
</div>
</div>
<br><br>
<div class="col">
<a href="index.php?action=getDb&serve=<?php echo  $serve.'&db='.$db; ?>"><button class="return btn btn-primary font-weight-bold mb-2">< list collection</button></a>
</div>
</div>

<!-- Fin du formulaire -->
</div>

<!-- footer -->

<?php
	require_once('footer.php')
?>

   <!-- footer -->

	<script src="public/js/db.js"></script>
</body>
</html>
