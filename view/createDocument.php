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
	 	echo '<form method="post" action="index.php?action=traitement_nD">';
	 	echo '<textarea name="doc_text" id="doc_text" rows="20" cols="200" required>'.$docs.'</textarea>';
	 	echo '<input type="submit" name="create" id="create" value="Create">';
	 	echo '</form>';
	 	if(isset($_GET['search'])){
	 		echo '<a href="index.php?action=getCollection_search&page='.$_GET['search'].'">< Collection</a>';
	 	}
	 	else{
	 		echo '<a href="index.php?action=getCollection&coll_id='.$_SESSION['collection'].'">< Collection</a>';
	 	}
	?>
</div>

</body>
</html>