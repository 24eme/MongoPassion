<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$_GET['coll']."</title>"?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php

//Fil d'Ariane

echo "<div class='container col-lg-8 sticky-top' style='margin-left: 100px;'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($_GET['serve'])){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$_GET['serve'].'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><i class="fa fa-fw fa-desktop"></i> '.$_GET['serve'].'</a></li>';
			}
		}
		if(isset($_GET['db'])){
			if($_GET['action']=='getDb'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-database"></i>'.$_GET['db'].'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'"><i class="fa fa-fw fa-database"></i>'.$_GET['db'].'</a></li>';
			}
		}
		if(isset($_GET['coll'])){
			if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-server"></i>'.$_GET['coll'].'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'"><i class="fa fa-fw fa-server"></i>'.$_GET['coll'].'</a></li>';
			}
		}
		if(isset($_GET['doc'])){
			echo '<li class="breadcrumb-item active"><i class="icon-book"></i>'.$_GET['doc'].'</li>';
		}
	echo '</ol>';
echo '</div>';

//Fin fil d'Ariane


//Titre de la page

echo "<h1 align=center class='title font-weight-bold'>Edit <i class='fa fa-fw fa-server'></i> ".$_GET['coll']."</h1>";

?>

<!-- Fin du titre de la page -->


<!-- Formulaire -->

<div id="main" class="border  col-lg-6 offset-lg-3 bg-light mt-1">
	<?php

		//Renommer la collection

		echo '<form method="post" action="index.php?action=renameCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; 
		echo '<br><label>Rename Collection</label><br>';
		echo ' <div class="input-group mb-3">';
		echo '<input type="text" class="form-control" name="newname" id="newname" value="'.$_GET['coll'].'" required />';
		echo '<input type="submit" class="btn  bg-success text-light" name="rename" id="rename" value="Rename"></div>';

		echo '</form><hr>';

		//Déplacer la collection
	    
		echo '<form method="post" action="index.php?action=moveCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; 
		echo '<br><label>Move Collection</label>';
		echo ' <div class="input-group mb-3">';
		echo '<input type="text" class="form-control" name="newdb" id="newdb" placeholder="New Database" required />';
		echo '<input type="submit" class="btn bg-success text-light" name="move" id="move" value="Move"></div>';
		echo '</form>';

		//Bouton de retour

		echo '<br><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'"><button class="return btn btn-primary font-weight-bold">< Database</button></a>'; 
	?>
</div>

<!-- Fin du formulaire -->

</body>
</html>