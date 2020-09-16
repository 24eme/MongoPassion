<!doctype html>
<html lang="fr">
<head>
	<?php echo '<title>View '.$_GET['doc'].'</title>'; ?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/viewDocument.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php

	//Fil d'Ariane

	echo '<nav>';
		echo '<ol class="breadcrumb">';
			echo '<li class="breadcrumb-item"><a href="index.php?">Home</a></li>';
			if(isset($_GET['serve'])){
				if($_GET['action']=='getServer'){
					echo '<li class="breadcrumb-item active">'.$_GET['serve'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$_GET['serve'].'">'.$_GET['serve'].'</a></li>';
				}
			}
			if(isset($_GET['db'])){
				if($_GET['action']=='getDb'){
					echo '<li class="breadcrumb-item active">'.$_GET['db'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'">'.$_GET['db'].'</a></li>';
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
?>

<?php 
echo "<h1 class='title'>View ".$_GET['doc']."</h1>";

$link_edit = 'index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$_GET['doc'];
if(isset($_GET['type_id'])){
	$link_edit=$link_edit.'&type_id='.$_GET['type_id'];
}
$link_edit=$link_edit.'&page='.$_GET['page'];
echo '<div id="nav_view">';
if(isset($_GET['search'])){
	echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$_GET['s_id'].'&s_g='.$_GET['s_g'].'&page='.$_GET['search'].'"><button class="return btn btn-primary">< Collection</button></a>';
}
elseif(isset($_GET['s_s'])){
	echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_s='.$_GET['s_s'].'&page='.$_GET['page'].'"><button class="return btn btn-primary">< Collection</button></a>';
}
else{
	echo '<div class="btn_view"><a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&page='.$_GET['page'].'"><button class="return btn btn-primary view">< Collection</button></a></div>';
}
echo '<div id="content"><a href="'.$link_edit.'"><button class="btn btn-primary">Edit</button></a></div>';
echo '</div>';
?>

<div id="main">
	<?php
		foreach ($result as $entry) {
			$doc=array();
		    foreach($entry as $x => $x_value) {
		 		if(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\ObjectId'){
		 			$value = $x_value;
		 		}
		 		elseif(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\UTCDateTime'){
		 			$value = $x_value->toDateTime();
		 		}
		 		else{
		 	  		$value = printable($x_value);
		 		}
		 		$temp =  improved_var_export($value);
	 	  		$doc[$x] = getColor($temp);
		 	}
		 		$doc = init_json($doc);
		 		$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
	 	}
	 	echo '<pre name="doc_text" id="doc_text">'.$docs.'</pre>';
	 	echo '<br>';
	?>
</div>

</body>
</html>