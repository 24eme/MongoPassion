	<div class="modal" id="myModal">
		<div class="modal-dialog">
		    <div class="modal-content">
			      <div class="modal-body">
						<div  class="border  bg-light m-auto mb-2">
							<label for="pet-select" class="font-weight-bold">Create a new collection :</label>
							<form autocomplete="off" action="index.php?action=createCollection&serve=<?php echo $serve.'&db='.$db ?>">'
								<div class="input-group mb-3">
									<input type="hidden" name="action" value="createCollection">
									<input type="hidden" name="serve" value='<?php echo $serve ?>'>
									<input type="hidden" name="db" value='<?php echo $db ?>'>
									<input type="text" list="browsers" placeholder="Collection name" required="required" class="form-control border border-success autofocus" name="name"  />
									<div class="input-group-append">
										<input class="btn bg-success text-light " type="submit" value="Create"/>
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