<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$serve."</title>"?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-color:#A48340;">

<?php

echo "<h1 align='center' class='title'>IP: ".$serve."</h1>";

?>

<div id="main" class="col-lg-6 offset-lg-3 mt-5 bg-light">
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
	echo '<br><a href="index.php">< Accueil</a>'
	?>
</div>

</body>
</html>