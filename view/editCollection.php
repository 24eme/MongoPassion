<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$coll."</title>"?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<script src="public/js/db.js"></script>
</head>

<body>

<?php

//Fil d'Ariane

echo "<div class='container border-top  border-success bg-success col-lg-8 sticky-top'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i> '.$serve.'</a></li>';
			}
		}
		if(isset($db)){
			if($_GET['action']=='getDb'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-database"></i>'.$db.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><i class="fa fa-fw fa-database"></i>'.$db.'</a></li>';
			}
		}
		if(isset($coll)){
			if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-server"></i>'.$coll.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-server"></i>'.$coll.'</a></li>';
			}
		}
		if(isset($doc)){
			echo '<li class="breadcrumb-item active"><i class="icon-book"></i>'.$doc.'</li>';
		}
	echo '</ol>';
echo '</div>';

//Fin fil d'Ariane


//Titre de la page

echo "<h1 align=center class='title font-weight-bold'>Edit <i class='fa fa-fw fa-server'></i> ".$coll." <button  class='btn mr-5'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$serve.'&db='.$db."  onclick='return confirmDelete()'><i class='fa fa-2x fa-trash'></i></a></button></h1>";


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