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

echo "<nav class='nav sticky-top' style='margin-left: 100px;'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($_GET['serve'])){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$_GET['serve'].'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><i class="fa fa-fw fa-desktop"></i>'.$_GET['serve'].'</a></li>';
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
echo '</nav>';

//Fin fil d'Ariane

?>

<!-- Recherche -->

<div  class="m-auto border col-lg-6 offset-lg-3 bg-light mt-1">
	<hr>
	<label for="pet-select" class="font-weight-bold">Search in all collections:</label>
	
	<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'">'; ?>
		<div class="input-group mb-3">
			<input type="search" class="form-control border border-success" name="recherche_db" id="recherche_db" placeholder="Search by id"/>
			<input class="btn bg-success text-light mr-2" type="submit" name="search" id="search" value="Search"/>
			<?php echo '<button class="btn bg-secondary"><a class="text-light" href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'"><i class="fa fa-fw fa-history"></i>Reinit</a></button>'; ?>
		</div>
	</form>
</div>
<br>

<!-- Fin de la recherche -->


<!-- Titre de la page -->

<?php
	echo "<h1 align='center' class='title font-weight-bold'><i class='fa fa-fw fa-database'></i>".$db."</h1>";
?>

<!-- Fin du titre de la page -->


<!-- Bouton nouvelle collection -->


<nav class="mb-3">
	<div id="options" class="text-center mb-3">
		<button type="button" class="btn btn-success"  onclick="myFunctionNewColl()" data-toggle="modal" data-target="#myModal2">
			  <i class="fa fa-fw fa-server"></i> New Collection 
		</button>
	</div>
	<div id="newColl" class="border col-lg-6 offset-lg-3 bg-light m-auto mb-2">
		<hr>
		<label for="pet-select" class="font-weight-bold">Create a new collection :</label>
		<?php echo '<form autocomplete="off" method="post" action="index.php?action=createCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'">'; ?>
			<div class="input-group mb-3">
				<input type="text"  list="browsers" placeholder="New name" required="required" class="form-control border border-success" name="name"  />

				

				<input class="btn bg-success text-light "  type="submit"   value="Create"/>
			</div>
		</form>
	</div>
</nav>

<!-- Fin du bouton nouvelle collection -->


<!-- Tableau des collections -->

<div id="main" class="border  col-lg-6 offset-lg-3 bg-light mt-1 m-auto">
	<br>
	<table class="table table-sm table-striped">
		<?php echo  "<h3 class=\"text-center bg-success text-light\"><span><strong><i class=\"fa fa-fw fa-server\"></i> Collections of ".$_GET['db']."</strong></span></h3>";
		
			foreach ($collections as $collection) {
				echo "<tr>";
				echo "<td><a class='text-dark' href='index.php?action=getCollection&serve=".$_GET['serve']."&db=".$_GET['db']."&coll=".$collection->getName()."'><i class='mr-2 fa fa-fw fa-server'></i>";
				echo $collection->getName();
				echo '</a></td>';
				echo "<td><button  class='btn  py-0'><a class='text-primary' href=index.php?action=editCollection&serve=".$_GET['serve']."&db=".$_GET['db']."&coll=".$collection->getName()."><i class='fa fa-edit'></i></a></button></td>";
				echo "<td><button  class='btn py-0'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$_GET['serve'].'&db='.$_GET['db']."&coll=".$collection->getName()."  onclick='return confirmDelete()'><i class='fa fa-trash'></i></a></button></td>";
				echo '</tr>';
			}
		?>
	</table>

	<!-- Bouton de retour -->

	<?php
	echo '<br><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><button class="return btn btn-primary font-weight-bold">< Server</button></a>';
	?>
</div>

<!-- Fin du tableau des collections -->
</body>
</html>