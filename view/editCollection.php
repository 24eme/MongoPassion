<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Edit ".$_GET['coll']."</title>"?>
	<meta charset="UTF-8">
</head>

<body>

<?php

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