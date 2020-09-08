<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$serve."</title>"?>
	<meta charset="UTF-8">
</head>

<body>

<?php

echo "<h1 class='title'>".$serve."</h1>";

?>

<div id="main">
	<br>
	<table>
		<?php
			foreach ($dbs as $db) {
				echo '<tr>';
				echo '<td><a href="index.php?action=getDb&serve='.$serve.'&db='.$db->getName().'">';
				echo $db->getName();
				echo '</a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php
	echo '<br><a href="index.php">< Accueil</a>'
	?>
</div>

</body>
</html>