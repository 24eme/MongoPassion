<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$_GET['coll']."</title>"?>
	<meta charset="UTF-8">
</head>

<body>

<?php

echo '<span>';
echo '<form method="post" action="index.php?action=thread">';
echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
else{echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread"/>';}
if(isset($_GET['db'])){echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread" value="'.$_GET['db'].'"/>';}
else{echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread"/>';}
if(isset($_GET['coll'])){echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread" value="'.$_GET['coll'].'"/>';}
else{echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread"/>';}
if(isset($_GET['doc'])){echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread" value="'.$_GET['doc'].'"/>';}
else{echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread"/>';}
echo '<input type="submit" name="go" id="go" value="Go"/>';
echo '</form>';
echo '</span>';

echo "<h1 class='title'>Edit ".$_GET['coll']."</h1>";

?>

<div id="main">
	<?php
	echo '<form method="post" action="index.php?action=renameCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; 
	echo '<br><label>Rename Collection</label><br>';
	echo '<input type="text" name="newname" id="newname" value="'.$_GET['coll'].'" required />';
	echo '<input type="submit" name="rename" id="rename" value="Rename">';
	echo '</form>';

	echo '<form method="post" action="index.php?action=moveCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'; 
	echo '<br><label>Move Collection</label><br>';
	echo '<input type="text" name="newdb" id="newdb" placeholder="New Database" required />';
	echo '<input type="submit" name="move" id="move" value="Move">';
	echo '</form>';

	echo '<br><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'">< Database</a>'; 
	?>
</div>

</body>
</html>