<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/pagination.css" rel="stylesheet" type="text/css">
	<link href="public/css/getDb.css" rel="stylesheet" type="text/css">

	<script src="public/js/db.js"></script>
</head>

<?php

//Fil d'Ariane

echo "<div class=' container  col-lg-7 sticky-top'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i>'.$serve.'</a></li>';
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

?>

<!-- Titre de la page -->

<?php
	echo "<h1 align='center' class='title font-weight-bold mt-5'><i class='fa fa-fw fa-database'></i>".$db."</h1>";
?>

<!-- Fin du titre de la page -->


<!-- Barre de boutons -->

<nav class="mb-3">
	<div id="options" class="text-center mb-3">
		<button type="button" class="btn btn-dark mr-5"  onclick="myFunctionNewColl()" data-toggle="modal" data-target="#myModal2">
			  <i class="fa fa-fw fa-plus"></i> New Collection 
		</button>

		<button type="button" class="btn btn-success"  onclick="myFunctionSearchInAllCollections()" data-toggle="modal" data-target="#myModal2">
			   <i class="fa fa-fw fa-search"></i>Search ID in all <i class="fa fa-fw fa-server"></i> collections
		</button>
	</div>
	<div id="newColl" class="border col-lg-6 offset-lg-3 bg-light m-auto mb-2">
		<hr>
		<label for="pet-select" class="font-weight-bold">Create a new collection :</label>
		<?php echo '<form autocomplete="off" method="post" action="index.php?action=createCollection&serve='.$serve.'&db='.$db.'">'; ?>
			<div class="input-group mb-3">
				<input type="text"  list="browsers" placeholder="New name" required="required" class="form-control border border-success" name="name"  />
				<input class="btn bg-success text-light "  type="submit"   value="Create"/>
			</div>
		</form>
	</div>

<!-- Fin de la barre de boutons -->


<!-- Recherche -->

<div  id="searchInAllColl" class="m-auto border col-lg-6 offset-lg-3 bg-light mt-1">
	<hr>
	<label for="pet-select" class="font-weight-bold">Search in all collections:</label>
	
	<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'">'; ?>
		<div class="input-group mb-3">
			<input type="search" class="form-control border border-success" name="recherche_db" id="recherche_db" placeholder="Search by id"/>
			<input class="btn bg-success text-light mr-2" type="submit" name="search" id="search" value="Search"/>
			<?php echo '<button class="btn bg-secondary"><a class="text-light" href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><i class="fa fa-fw fa-history"></i>Reinit</a></button>'; ?>
		</div>
	</form>
</div>

<!-- Fin de la recherche -->

</nav>

<!-- Fin du bouton nouvelle collection -->


<!-- Tableau des collections -->

<div id="main" class="border  col-lg-6 offset-lg-3 bg-light mt-1 m-auto">
	<br>
	<table class="table table-sm table-striped">
		<?php echo  "<h3 class=\"text-center bg-success text-light\"><span><strong><i class=\"fa fa-fw fa-server\"></i> Collections of ".$db."</strong></span></h3>";
		
			foreach ($collections as $collection) {
				echo "<tr>";
				echo "<td><a class='text-dark' href='index.php?action=getCollection&serve=".$serve."&db=".$db."&coll=".$collection->getName()."'><i class='mr-2 fa fa-fw fa-server'></i>";
				echo $collection->getName();
				echo '</a></td>';
				echo "<td><button  class='btn  py-0'><a class='text-success' href=index.php?action=editCollection&serve=".$serve."&db=".$db."&coll=".$collection->getName()."><i class='fa fa-edit'></i></a></button></td>";
				echo "<td><button  class='btn py-0'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$serve.'&db='.$db."&coll=".$collection->getName()."  onclick='return confirmDelete()'><i class='fa fa-trash'></i></a></button></td>";
				echo '</tr>';
			}
		?>
	</table>

	<!-- Bouton de retour -->

	<?php
	echo '<br><a href="index.php?action=getServer&serve='.$serve.'"><button class="return btn btn-primary font-weight-bold">< Server</button></a>';
	?>
</div>

<!-- Fin du tableau des collections -->

</body>
</html>