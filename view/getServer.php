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

<body style="background-color:#FFFFFF;">

<?php

	//Fil d'Ariane

	echo '<nav>';
		echo '<ol class="breadcrumb">';
			echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
			if(isset($_GET['serve'])){
				if($_GET['action']=='getServer'){
					echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-desktop"></i>'.$_GET['serve'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><i class="fa fa-fw fa-desktop"></i>'.$_GET['serve'].'</a></li>';
				}
			}
			if(isset($_GET['db'])){
				if($_GET['action']=='getDb'){
					echo '<li class="breadcrumb-item active">'.$_GET['db'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'"><i class="fa fa-fw fa-database"></i>'.$_GET['db'].'</a></li>';
				}
			}
			if(isset($_GET['coll'])){
				if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
					echo '<li class="breadcrumb-item active">'.$_GET['coll'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'.$_GET['coll'].'</a></li>';
				}
			}
			if(isset($_GET['doc'])){
				echo '<li class="breadcrumb-item active">'.$_GET['doc'].'</li>';
			}
		echo '</ol>';
	echo '</nav>';
// echo '<span>';
// echo '<form method="post" action="index.php?action=thread">';
// echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
// if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
// elseif(isset($_POST['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_POST['serve'].'"/>';}
// else{echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread"/>';}
// if(isset($_GET['db'])){echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread" value="'.$_GET['db'].'"/>';}
// else{echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread"/>';}
// if(isset($_GET['coll'])){echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread" value="'.$_GET['coll'].'"/>';}
// else{echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread"/>';}
// if(isset($_GET['doc'])){echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread" value="'.$_GET['doc'].'"/>';}
// else{echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread"/>';}
// echo '<input type="submit" name="go" id="go" value="Go"/>';
// echo '</form>';
// echo '</span>';

echo "<h1 align='center' class='title'>".$serve."</h1>";


?>

<div id="main" class="border border-dark col-lg-6 offset-lg-3 mt-5 bg-light">
	<br>
	<table class="table">
		<?php
			foreach ($dbs as $db) {
				echo '<tr>';
				echo "<td><a class='text-dark' href='index.php?action=getDb&serve=".$serve."&db=".$db->getName()."'>";
				// echo "<td><a  class='text-dark' href='index.php?action=getServer&serve=".$x."'>";
				echo $db->getName();
				echo '</a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php
	echo '<br><a href="index.php"><button class="return btn btn-primary">< Accueil</button></a>'
	?>
</div>

</body>
</html>