<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$_SESSION['db']."</title>"?>
	<meta charset="UTF-8">
</head>

<script src="public/js/db.js"></script>

<body>

<?php

echo "<h1 class='title'>".$_SESSION['db']."</h1>";

?>

<nav>
	<div id="options">
		<span id="nC">
			<button id='createCollec' flag = "false" onclick="afficher();">New Collection</button>
		</span>
	</div>
</nav>

<div id="main">
	<br>
	<table>
		<?php
			foreach ($collections as $collection) {
				echo '<tr>';
				echo '<td><a href="index.php?action=getCollection&coll_id='.$collection->getName().'">';
				echo $collection->getName();
				echo '</a></td>';
				// echo '<td><form method="post" action="index.php?action=renameCollection&coll_id='.$collection->getName().'">'; 
				// echo '<input type="text" name="newname" id="newname" value="'.$collection->getName().'" required />';
				// echo '<input type="submit" name="rename" id="rename" value="Rename">';
				// echo '</form></td>';
				echo '<td><a href=index.php?action=editCollection&id='.$collection->getName().'>Edit</a></td>';
				echo '<td><a href=index.php?action=deleteCollection&id='.$collection->getName().'>Delete</a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php
	echo '<br><a href="index.php?action=getServer">< Server</a>';
	?>
</div>



</body>
</html>