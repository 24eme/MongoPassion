<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>MongoDoAllCRUD</title>"?>
	<?php require_once('header.php') ?>
</head>
<body>
<div class="container" id="home">
<div id="main" class="text-center m-auto ">

	<!-- Titre de la page -->

	<div class='text-center align-items-end mt-3 d-inline-flex'>
			<img align="center" src="public/images/mongo.png" alt="24eme">
			<h1 class='text-center title font-weight-bold'>mongo<span class="text-secondary">DoAllCRUD</span></h1>

	</div>

	<div class="col-lg-8 offset-lg-2 bg-light m-auto">
		<?php if (isset($flash_message) && $flash_message): ?>
			<div class="alert alert-success" role="alert">
				<?php echo $flash_message; ?>
			</div>
		<?php endif; ?>
	</div>

	<!-- Fin du titre de la page -->
	<!-- Formulaire serveurs -->
	<div>
	<form method="post" action="index.php?action=getServer">
			<div class="input-group btn-group">
			<input type="text" autofocus="autofocus" class="form-control border border-success" name="serve" id="serve" placeholder="mongo.example.net:27017"  maxLength=20 required />
			<div class="input-group-append">
			<input type="submit" class="btn btn-success font-weight-bold" name="add" id="add" value="Connect">
			</div>
		</div>
	</form>
	<div class="text-right">
		<a href="#" data-toggle="modal" data-target="#modal-connection">Advanced Connection</a>
	</div>
	</div>

	<!-- Fin du formulaire serveurs -->
</div>

<br/><br/>

<!-- Tableau des serveurs -->

<div class="bg-light m-auto">
	<div class="border">
	<?php
		$serve_list=json_decode($_COOKIE['serve_list']);
		if(sizeof($serve_list)>0){
			echo '<table class="table table-sm table-striped serverlist">';
			echo  	"<h3 class=\"text-center bg-success text-light\"><span><strong>Server list </strong></span></h3>" ;
			foreach ($serve_list as $x) {
				echo '<tr>';
				echo "<td><a  class='text-success'  href='index.php?action=getServer&serve=".$x."'><i title='address IP of server' class='text-dark mr-2 fa fa-fw fa-desktop'></i>";
				echo $x;
				echo '</a></td>';
				echo '<td class="text-right"><a href="?modal_opened=1&serve='.$x.'"><i title="Edit server" class="fa fa-fw fa-edit"></i></a> &nbsp; <a href="?action=removeServer&serve='.$x.'" class="text-mutted"><i title="Delete server" class="fa fa-fw fa-remove"></i></a></td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	?>
</div></div>

<!-- Fin du tableau des serveurs -->

	<!-- Modal connexion -->
	<div class="modal fade" id="modal-connection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <form method="POST" action="index.php?action=getServer">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Connection</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			  <?php if ($flash_error): ?>
			  <div class="alert alert-danger">
	  			<?php echo $flash_error; ?>
			  </div>
	  		<?php endif; ?>
				<div class="form-group row">
			      	<label for="host" class="col-sm-4 col-form-label">Host:</label>
			      	<div class="col-sm-8">
	      				<input type="text" class="form-control" id="host" name="host" placeholder="mongo.example.org" value="<?php echo $modal_host; ?>">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="port" class="col-sm-4 col-form-label">Port:</label>
			      	<div class="col-sm-8">
	      				<input type="text" class="form-control" id="port" name="port" placeholder="27017" value="<?php echo $modal_port; ?>">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="user" class="col-sm-4 col-form-label">User:</label>
			      	<div class="col-sm-8">
	      				<input type="text" class="form-control" id="user" name="user" placeholder="my user" value="<?php echo $modal_user; ?>">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="passwd" class="col-sm-4 col-form-label">Password:</label>
			      	<div class="col-sm-8">
	      				<input type="password" class="form-control" id="passwd" name="passwd" placeholder="my password">
	  		      	</div>
		    	</div>
				<div class="form-group row">
			      	<label for="auth_db" class="col-sm-4 col-form-label">Auth. Database:</label>
			      	<div class="col-sm-8">
	      				<input type="text" class="form-control" id="auth_db" name="auth_db" placeholder="the auth database" value="<?php echo $modal_auth_db; ?>">
	  		      	</div>
		    	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-success">Connect</button>
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
</div>
<script type="text/javascript">
<?php if ($modal_opened): ?>
	$('#modal-connection').modal("show")
<?php endif; ?>
</script>
</body>
</html>
