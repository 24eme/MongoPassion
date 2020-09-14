<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<?php echo "<title>Welcome</title>"?>
	<meta charset="UTF-8">
</head>

<body style="background-color:#FFFFFF;">

<?php

//echo "<h1 class='title'>Welcome</h1>";

?>

<div id="main" class="col-lg-6 offset-lg-3 mt-5">
	<h1 align="center">Interface de visualisation MongoDB</h1>
	<img align="center"  class="rounded-circle col-lg-6  offset-lg-4 mb-2 w-25" src="public/images/mongodb.jpg" alt="24eme">
	<form align="center" method="post" class="col-lg-6 offset-lg-3 " action="index.php?action=getServer">
		<input type="text" class="form-control" name="serve" id="serve" placeholder="Ajoutez votre address IP " maxLength = 20 required /> 
		<input type="submit" class="btn btn-success btn-sm" name="add" id="add" value="ADD">
	
	</form>
	<br>
	<div class="border border-dark col-lg-6 offset-lg-3 bg-light mt-1">
		<?php
		$serve_list=json_decode($_COOKIE['serve_list']);
		if(sizeof($serve_list)>0){
			echo '<table class="table">';
			foreach ($serve_list as $x) {
				echo '<tr>';
				echo "<td><a  class='text-dark' href='index.php?action=getServer&serve=".$x."'>";
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