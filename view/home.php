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
	<link href="public/css/modal.css" rel="stylesheet" type="text/css">
</head>

<div id="main" class=" text-center m-auto ">

	<!-- Titre de la page -->

	<div class='text-center align-items-end mt-3 d-inline-flex'>
			<img align="center" src="public/images/mongo.png" alt="24eme">
			<h1 class='text-center title font-weight-bold'>mongo<span class="text-secondary">DoAllCRUD</span></h1>
		
	</div>

	<!-- Fin du titre de la page -->


	<!-- Modal connexion -->
	<br><br>
	<button id="authen" class="btn btn-success font-weight-bold" style="width: 6%; margin: auto; margin-bottom: 10px;">Login</button>
	<div id="connex" class="modal text-left">
	  <div class="modal-content">
	    <span id="close">&times;</span>
	    <h2 align="center">Connexion</h2><br>
	    <form method="post" action="index.php?action=getServer">
	    	<input align="left" type="hidden" name="authentification">
	    	<label>Server :</label>
	    	<input type="text" class="border border-success" name="serve" id="serve" maxLength = 20 required /><br>
	    	<label>Username :</label>
	    	<input type="text" class="border border-success" name="user" id="user" maxLength = 20 required /><br>
	    	<label>Password :</label>
	    	<input type="password" class="border border-success" name="passwd" id="passwd" maxLength = 20 required /><br>
	    	<label>Authentification Database :</label>
	    	<input type="text" class="border border-success" name="auth_db" id="auth_db" maxLength = 20 required /><br><br>
	    	<div id="submit">
				<input type="submit" class="btn btn-success font-weight-bold" name="connexion" id="connexion" value="Connexion">
			</div>
	    </form>
	  </div>
	</div>

	<!-- Fin du modal connexion -->


	<!-- Formulaire serveurs -->

	<form method="post" class="col-lg-8 offset-lg-2 " action="index.php?action=getServer" style="margin-bottom: 50px;">

			<div class="input-group">
			<input type="text" autofocus="autofocus" class="form-control border border-success" name="serve" id="serve" placeholder="mongo.example.net:27017" required />
			<input type="submit" class="btn btn-success font-weight-bold" name="add" id="add" value="Connexion">
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

<?php 
require_once('footer.php')
?>



</body>
</html>

<script type="text/javascript">
	// Get the modal
	var modal = document.getElementById("connex");

	// Get the button that opens the modal
	var btn = document.getElementById("authen");

	// Get the <span> element that closes the modal
	var span = document.getElementById("close");

	// When the user clicks on the button, open the modal
	btn.onclick = function() {
	  modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
</script>