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