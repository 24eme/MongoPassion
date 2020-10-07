<!doctype html>
<html lang="fr">
<head>
	<title>Create Document</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/createDocument.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

echo '<h1 class = "title text-center font-weight-bold"><i class="fa fa-fw fa-book"></i> New Document</h1>';

//Fin titre de la page


//Bouton de retour

echo '<div id="nav_view">';
	if(isset($_GET['search'])){
	 	echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$_GET['s_id'].'&s_g='.$_GET['s_g'].'&page='.$_GET['search'].'"><button class="return btn btn-primary">< Collection</button></a>';
	}
	else{
	 	echo '<a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'"><button class="return btn btn-primary">< Collection</button></a>';
	}
echo '</div>';
?>

<!-- Fin du bouton de retour -->


<!-- Zone de texte -->

<div id="main">
	<?php
	 	$doc = array();
	 	$doc['example_field']='content[...]';
	 	$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
	 	echo '<form method="post" action="index.php?action=traitement_nD&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">';
	 	echo '<div id="create_content"><input type="submit" class="btn btn-primary" name="create" id="create" value="Create"></div>';
	 	echo '<div id="doc_content"><textarea name="doc_text" id="doc_text" rows="20" cols="200" required>'.$docs.'</textarea></div>';
	 	echo '</form>';
	?>
</div>

<!-- Fin de la zone de texte -->

</body>
</html>