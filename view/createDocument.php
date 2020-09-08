<!doctype html>
<html lang="fr">
<head>
	<title>Create Document</title>
	<meta charset="UTF-8">
</head>

<body>

<div id="main">
	<?php

	 	$doc = array();
	 	$doc['example_field']='content[...]';
	 	$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
	 	echo '<form method="post" action="index.php?action=traitement_nD&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">';
	 	echo '<textarea name="doc_text" id="doc_text" rows="20" cols="200" required>'.$docs.'</textarea>';
	 	echo '<input type="submit" name="create" id="create" value="Create">';
	 	echo '</form>';
	 	if(isset($_GET['search'])){
	 		echo '<a href="index.php?action=getCollection_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&s_id='.$_GET['s_id'].'&s_g='.$_GET['s_g'].'&page='.$_GET['search'].'">< Collection</a>';
	 	}
	 	else{
	 		echo '<a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">< Collection</a>';
	 	}
	?>
</div>

</body>
</html>