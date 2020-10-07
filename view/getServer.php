<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$serve."</title>"?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
</head>

<?php

//Fil d'Ariane

	echo "<div class='container  col-lg-8 sticky-top'  style='margin-left: 100px;'>";
		echo '<ol class="breadcrumb">';
			echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
			if(isset($_GET['serve'])){
				if($_GET['action']=='getServer'){
					echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-desktop"></i> '.$_GET['serve'].'</li>';
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

echo "</div>";

//Fin fil d'Ariane


//Titre de la page

echo "<h1 align='center' class='title font-weight-bold'><i class='fa fa-fw fa-desktop'></i>".$serve."</h1>";

//Fin du titre de la page

?>

<!-- Tableau des bases de données -->

<div id="main" class="border col-lg-6 offset-lg-3 mt-5 bg-light">
	<br>
	<table class="table table-sm table-striped ">
		<?php echo  	"<h3 class=\"text-center bg-success text-light\"><span><strong><i class=\"fa fa-fw fa-database\"></i> Databases of ".$_GET['serve']."</strong></span></h3>" ?>
		<?php
			foreach ($dbs as $db) {
				echo '<tr>';
				echo "<td><a class='text-dark' href='index.php?action=getDb&serve=".$serve."&db=".$db->getName()."'><i class='mr-3 fa fa-fw fa-database'></i>";
				echo $db->getName();
				echo '</a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php
		echo '<br><a href="index.php"><button class="return btn btn-primary font-weight-bold">< Home</button></a>'
	?>
</div>

<!-- Fin du tableau des bases de données -->

</body>
</html>