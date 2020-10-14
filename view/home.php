<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Welcome</title>"?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/home.css" rel="stylesheet" type="text/css">
</head>

<div id="main" class=" text-center m-auto ">

	<!-- Titre de la page -->

	<div class ='title text-center mt-2'>
		<img align="center" src="public/images/mongo.png" alt="24eme">
		<h1 class='text-center title font-weight-bold'>mongoCRUD</h1>
	</div>

	<!-- Fin du titre de la page -->

	<!-- Formulaire serveurs -->

	<form autocomplete="off" method="post" class="col-lg-8 offset-lg-2 " action="index.php?action=getServer">

			<div class="input-group ">
			<input type="text" class="form-control border border-success" name="serve" id="serve" placeholder="Add your IP address" maxLength = 20 required /> 
			<input type="submit" class="btn btn-success font-weight-bold" name="add" id="add" value="ADD">
		</div>
	</form>

	<!-- Fin du formulaire serveurs -->
</div>

<!-- Tableau des serveurs -->

<div class="border col-lg-8 offset-lg-2 bg-light m-auto">
	<?php
		$serve_list=json_decode($_COOKIE['serve_list']);
		if(sizeof($serve_list)>0){
			echo '<table class="table table-sm table-striped ">';
			echo  	"<h3 class=\"text-center bg-success text-light\"><span><strong>Server list </strong></span></h3>" ;
			foreach ($serve_list as $x) {
				echo '<tr>';
				echo "<td><a  class='text-success' href='index.php?action=getServer&serve=".$x."'><i class=' text-dark mr-2 fa fa-fw fa-desktop'></i>";
				echo $x;
				echo '</a></td>';
				echo '<td><a href="?action=removeServer&serve='.$x.'"><i class="fa fa-fw fa-remove"></i></a></td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	?>
</div>

<!-- Fin du tableau des serveurs -->
<!-- Copyright Footer -->
  <div class="container footer-copyright font-weight-bold col-lg-8 offset-lg-2  text-light text-center py-3 bg-success">© 2020 Copyright:
    <a class="text-light" href="https://github.com/24eme/Interface-MongoDB">MongoCRUD<i class="text-light fa fa-fw fa-github"></i></a>
  </div>
  <!-- Copyright footer -->

</body>
</html>