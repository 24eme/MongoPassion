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
	<link href="public/css/getDb_search.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="public/js/db.js"></script>
</head>

<?php

//Fil d'Ariane

echo "<nav class='nav sticky-top ml-5'>";
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

<div  class="m-auto border border-success col-lg-6 offset-lg-3 bg-light mt-1">
	<hr>
	<label for="pet-select">Search in all collections:</label>
	<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'">'; ?>
	<input type="search" class="form-control border border-success" name="recherche_db" id="recherche_db" placeholder="Search by id"/>
	<input class="btn bg-success text-light m-1" type="submit" name="search" id="search" value="Search"/>
	<?php echo '<button class="btn bg-secondary"><a class="text-light" href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'">Reinit</a></button>'; ?>
	</form>
</div>
<br>

<!-- Fin de la recherche -->


<!-- Titre de la page -->

<?php
	echo "<h1 align='center' class='title'><i class='fa fa-fw fa-database'></i>Search results for <font color='#62a252'>".$search."</font> in <font color='#62a252'>".$db."</font></h1>";
?>

<!-- Fin du titre de la page -->


<!-- Tableau des résultats de la recherche -->

<br><br>
<div id="main" class="border  col-lg-6 offset-lg-3 bg-light mt-1 m-auto">
	<br>
	<table class="table table-sm table-striped">
		<?php
			if($nbDocs==0){
				echo 'Aucun document ne correspond à votre recherche.';
			}
			else{
				foreach ($docs as $coll => $doc) {
					if(sizeof($doc)!=0){
						foreach ($doc as $field) {

							//Liens des options de gestion des collections

							$link_v = 'index.php?action=viewDocument&serve='.strip_tags($_GET['serve']).'&db='.$db.'&coll='.$coll.'&doc='.$field['_id'].'&search_db='.urlencode($search).'&page=1';
							$link_e = 'index.php?action=editDocument&serve='.strip_tags($_GET['serve']).'&db='.$db.'&coll='.$coll.'&doc='.$field['_id'].'&search_db='.urlencode($search).'&page=1';
							$link_d = 'index.php?action=deleteDocument&serve='.strip_tags($_GET['serve']).'&db='.$db.'&coll='.$coll.'&doc='.$field['_id'].'&search_db='.urlencode($search).'&page=1';
							$link_c = 'index.php?action=getCollection&serve='.strip_tags($_GET['serve']).'&db='.$db.'&coll='.$coll.'';

							//Affichage du tableau

							echo '<tr>';
							echo '<td><a href="'.$link_v.'">'.$field['_id'].'</a></td>';
							echo '<td><a href="'.$link_c.'">'.$coll.'</a></td>';
							echo "<td id='id'><button  class='btn'><a class='text-primary' href=".$link_v."><i class='fa fa-eye'></a></button></td>";
							echo "<td id='edit'><button  class='btn'><a class='text-primary'href=".$link_e."><i class='fa fa-edit'></a></button></td>";
							echo  "<td id='suppr'><button  class='btn'><a class='text-danger'href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";
							echo '</tr>';
						}
					}
				}
			}
		?>
	</table>

	<!-- Bouton de retour -->

	<?php
		echo '<br><a href="index.php?action=getServer&serve='.strip_tags($_GET['serve']).'"><button class="return btn btn-primary">< Server</button></a>';
	?>
</div>

<!-- Fin du tableau des résultats de la recherche -->

</body>
</html>