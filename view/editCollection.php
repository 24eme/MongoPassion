<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$_SESSION['serve']."</title>"?>
	<meta charset="UTF-8">
</head>

<body>

<?php

echo "<h1 class='title'>Edit ".$_GET['id']."</h1>";

?>

<div id="main">
	<?php
	echo '<form method="post" action="index.php?action=renameCollection&coll_id='.$_GET['id'].'">'; 
	echo '<br><label>Rename Collection</label><br>';
	echo '<input type="text" name="newname" id="newname" value="'.$_GET['id'].'" required />';
	echo '<input type="submit" name="rename" id="rename" value="Rename">';
	echo '</form>';

	echo '<form method="post" action="index.php?action=moveCollection&coll_id='.$_GET['id'].'">'; 
	echo '<br><label>Move Collection</label><br>';
	echo '<input type="text" name="newdb" id="newdb" placeholder="New Database" required />';
	echo '<input type="submit" name="move" id="move" value="Move">';
	echo '</form>';

	echo '<br><a href="index.php?action=getDb&db_id='.$_SESSION['db'].'">< Database</a>'; 
	?>
</div>

</body>
</html>