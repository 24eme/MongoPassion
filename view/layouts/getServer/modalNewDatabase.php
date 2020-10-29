<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">

			    <div class="modal-body">
			        <div class="border  bg-light m-auto mb-2">
						<label for="pet-select" class="font-weight-bold">Create a new database :
						</label>
						<?php echo '<form autocomplete="off" action="index.php?action=getDb&serve='.$serve.'">'; ?>
						<div class="input-group mb-3">
							<input type="hidden" name="action" value="getDb">
							<input type="hidden" name="serve" value='<?php echo $serve ?>'>
							<input type="text"  list="browsers" placeholder="Database name" required="required" class="form-control border border-success autofocus" name="newdb"  />
							<div class="input-group-append">
								<input class="btn bg-success text-light "  type="submit"   value="Create"/>
							</div>
						 </div>
						</form>
						</div>
				  </div>
			 <div class="modal-footer">
        		    <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>


		</div>

	</div>
</div>