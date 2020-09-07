<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Welcome</title>"?>
	<meta charset="UTF-8">
</head>

<body>

<?php

echo "<h1 class='title'>Welcome</h1>";

?>

<div id="main">
	<form method="post" action="index.php?action=getServer">
		<input type="text" name="serve" id="serve" placeholder="Ajouter une IP" maxLength = 20 required /> 
		<input type="submit" name="add" id="add" value="Add">
	</form>
	<br>
	<div>
		<?php
		$serve_list=json_decode($_COOKIE['serve_list']);
		if(sizeof($serve_list)>0){
			echo '<table>';
			foreach ($serve_list as $x) {
				echo '<tr>';
				echo '<td><a href="index.php?action=getServer&serve='.$x.'">';
				echo $x;
				echo '</a></td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		?>
	</div>

</div>

</body>
</html>