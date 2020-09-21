<!doctype html>
<html lang="fr">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<?php echo "<title>Welcome</title>"?>
	<meta charset="UTF-8">
</head>

<body style="background-color:#FFFFFF;">

<?php

//echo "<h1 class='title'>Welcome</h1>";

?>

<div id="main" class="col-lg-6 offset-lg-3 mt-5">
	<h1 class='title'align="center">Interface de visualisation MongoDB</h1>
	<img align="center"  class="rounded-circle col-lg-6  offset-lg-4 mb-2 w-25" src="public/images/mongodb.jpg" alt="24eme">
	<form align="center" method="post" class="col-lg-6 offset-lg-3 " action="index.php?action=getServer">
		<input type="text" class="form-control" name="serve" id="serve" placeholder="Ajoutez votre address IP " maxLength = 20 required /> 
		<input type="submit" class="btn btn-success btn-sm mt-1" name="add" id="add" value="AJOUTER">
	
	</form>
	<br>
	<div class="border col-lg-6 offset-lg-3 bg-light mt-1">
		<?php
		$serve_list=json_decode($_COOKIE['serve_list']);
		if(sizeof($serve_list)>0){
			echo '<table class="table table-sm table-striped ">';
			echo '<tr  align="center" class="bg-success text-light"> 
    				<th>La liste  des machines <i class="fa fa-fw fa-desktop"></i></th> 
    			</tr>';
			foreach ($serve_list as $x) {
				echo '<tr>';
				echo "<td><a  class='text-dark' href='index.php?action=getServer&serve=".$x."'><i class='mr-2 fa fa-fw fa-desktop'></i>";
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