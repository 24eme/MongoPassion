<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>Welcome</title>"?>
	<?php require_once('header.php') ?>
	<link href="public/css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main" class=" text-center m-auto ">

	<!-- Titre de la page -->

	<div class='text-center align-items-end mt-3 d-inline-flex'>
			<img align="center" src="public/images/mongo.png" alt="24eme">
			<h1 class='text-center title font-weight-bold'>mongo<span class="text-secondary">DoAllCRUD</span></h1>

	</div>

	<!-- Fin du titre de la page -->

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

	<!-- Modal connexion -->
	<div class="modal fade" id="modal-connection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <form method="post" action="index.php?action=getServer">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Connection</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			  <?php if ($modal_error): ?>
	  			<p class="text-danger">Unable to connect to the server</p>
	  		<?php endif; ?>
				<div class="form-group row">
			      	<label for="host" class="col-sm-3 col-form-label">Host:</label>
			      	<div class="col-sm-9">
	      				<input type="text" class="form-control" id="host" placeholder="mongo.example.org" value="<?php echo $modal_host; ?>">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="port" class="col-sm-3 col-form-label">Port:</label>
			      	<div class="col-sm-9">
	      				<input type="text" class="form-control" id="port" placeholder="27017" value="<?php echo $modal_port; ?>">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="user" class="col-sm-3 col-form-label">User:</label>
			      	<div class="col-sm-9">
	      				<input type="text" class="form-control" id="user" placeholder="myuser" value="<?php echo $modal_user; ?>">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="passwd" class="col-sm-3 col-form-label">Password:</label>
			      	<div class="col-sm-9">
	      				<input type="password" class="form-control" id="passwd" placeholder="mypassword">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="database" class="col-sm-3 col-form-label">Database:</label>
			      	<div class="col-sm-9">
	      				<input type="text" class="form-control" id="database" placeholder="mydatabase" value="<?php echo $modal_db; ?>">
	  		      	</div>
		    	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-success" type="submit">Connection</button>
	      </div>
	    </div>
	  </div>
     </form>
	</div>

	<!-- Fin du modal connexion -->


<!-- Footer -->

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
