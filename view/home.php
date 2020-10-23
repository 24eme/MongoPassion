<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Welcome</title>"?>
	<?php require_once('header.php') ?>
</head>
<body>
<div id="main" class=" text-center m-auto ">

	<!-- Titre de la page -->

	<div class='text-center align-items-end mt-3 d-inline-flex'>
			<img align="center" src="public/images/mongo.png" alt="24eme">
			<h1 class='text-center title font-weight-bold'>mongo<span class="text-secondary">DoAllCRUD</span></h1>

	</div>

	<!-- Fin du titre de la page -->


	<!-- Modal connexion -->
	<br><br>
	<div id="modal-connection" class="modal text-left">
	  <div class="modal-content">
	    <span id="close">&times;</span>
	    <h2 align="center">Connexion</h2><br>
		<?php if ($modal_error): ?>
			<p class="text-danger">La connexion au server a échoué</p>
		<?php endif; ?>
	    <form method="post" action="index.php?action=getServer">
	    	<input align="left" type="hidden" name="authentification">
	    	<label>Server :</label>
	    	<input type="text" class="border border-success" name="host" id="host" maxLength=20 required value="<?php echo $modal_host; ?>"/><br>
			<label>Port :</label>
	    	<input type="text" class="border border-success" name="port" id="port" maxLength=20 value="<?php echo $modal_port; ?>"/><br>
	    	<label>Username :</label>
	    	<input type="text" class="border border-success" name="user" id="user" maxLength=20 value="<?php echo $modal_user; ?>"/><br>
	    	<label>Password :</label>
	    	<input type="password" class="border border-success" name="passwd" id="passwd" maxLength=20 /><br>
	    	<label>Authentification Database :</label>
	    	<input type="text" class="border border-success" name="auth_db" id="auth_db" maxLength=20 value="<?php echo $modal_db; ?>" /><br><br>
	    	<div id="submit">
				<input type="submit" class="btn btn-success font-weight-bold" name="connexion" id="connexion" value="Connexion">
			</div>
	    </form>
	  </div>
	</div>

	<!-- Fin du modal connexion -->


	<!-- Formulaire serveurs -->
	<div class="col-lg-8 offset-lg-2">
	<form method="post" action="index.php?action=getServer">
			<div class="input-group btn-group">
			<input type="text" autofocus="autofocus" class="form-control border border-success" name="serve" id="serve" placeholder="mongo.example.net:27017"  maxLength=20 required />
			<div class="input-group-append">
			<input type="submit" class="btn btn-success font-weight-bold" name="add" id="add" value="Connect">
			</div>
		</div>
	</form>
	<p class="text-right"><a href="#" data-toggle="modal" data-target="#modal-connection">Advanced Connection</a></p>
	</div>

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
				echo "<td><a  class='text-success'  href='index.php?action=getServer&serve=".$x."'><i title='address IP of server' class='text-dark mr-2 fa fa-fw fa-desktop'></i>";
				echo $x;
				echo '</a></td>';
				echo '<td><a href="?action=removeServer&serve='.$x.'"><i title="Delete server" class="fa fa-fw fa-remove"></i></a></td>';
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
<script type="text/javascript">
<?php if ($modal_opened): ?>
	$('#modal-connection').modal("show")
<?php endif; ?>
</script>
</html>
