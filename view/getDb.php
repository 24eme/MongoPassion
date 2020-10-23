<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>

	<?php require_once('header.php') ?>
</head>

<body>

<?php include('breadcrumb.php'); ?>

<!-- Titre de la page -->

<?php
	echo "<h1 align='center' class='title font-weight-bold mt-2'><i class='fa fa-fw fa-database'></i>".$db."</h1>";
?>

<!-- Fin du titre de la page -->


<!-- Modal new Db -->

<nav class="mb-1">
	<!-- StartModal -->
	<div class="modal" id="myModal">
		<div class="modal-dialog">
		    <div class="modal-content">
			      <div class="modal-body">  				
						<div  class="border  bg-light m-auto mb-2">
							<label for="pet-select" class="font-weight-bold">Create a new collection :</label>
							<?php echo '<form autocomplete="off" method="post" action="index.php?action=createCollection&serve='.$serve.'&db='.$db.'">'; ?>
								<div class="input-group mb-3">
									<input type="text" list="browsers" placeholder="Collection name" required="required" class="form-control border border-success autofocus" name="name"  />
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

	<!-- endModal -->

<!-- Fin modal new Db -->



<!-- Recherche -->

<div  class="m-auto border col-lg-8 offset-lg-2 bg-light mt-1">
	<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'">'; ?>
		<div class="input-group mb-1 mt-1">
			<input type="search" autofocus="autofocus" class="form-control border border-success" required="required" name="recherche_db" id="recherche_db" placeholder="Search by document id in all collection"/>
			<div class="input-group-append">
			<input class="btn bg-success text-light mr-2" type="submit" name="search" id="search" value="Search"/>
			</div>
			<!--  -->
		</div>
	</form>
</div>

<!-- Fin de la recherche -->

</nav>




<!-- Tableau des collections -->
<div id="DivContentTable">
	<div id="main" class="border  col-lg-8 offset-lg-2 bg-light mt-1 m-auto getDbDiv">


		<table class="table table-sm table-striped">
				<?php echo  "<h3 class=\"text-center bg-success text-light \"><span><strong> Collections of ".$db." </strong></span><button type='button' class='btn btn-dark py-1 float-right ' data-toggle='modal' data-target='#myModal'>
					<i class='fa fa-fw fa-plus'></i><i class='fa fa-fw fa-server'></i>
			           </button>
			                </h3>";

				$tabcollections= array();
				foreach ($collections as $collection) {
					array_push($tabcollections,$collection->getName());
				}
				sort($tabcollections);

				foreach ($tabcollections as $collection) {
					echo "<tr>";
					echo "<td><a class='text-success' href='index.php?action=getCollection&serve=".$serve."&db=".$db."&coll=".$collection."'><i class='text-dark mr-2 fa fa-fw fa-server'></i>";
					echo $collection;
					echo '</a></td>';
					echo "<td><button  class='btn  float-right py-0'><a class='text-success' href=index.php?action=editCollection&serve=".$serve."&db=".$db."&coll=".$collection."><i class='fa fa-edit'></i></a></button></td>";
					// echo "<td><button  class='btn py-0'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$serve.'&db='.$db."&coll=".$collection->getName()."  onclick='return confirmDelete()'><i class='fa fa-trash'></i></a></button></td>";
					echo '</tr>';
				}
			?>
		</table>
	    <div class="mb-2">
			<!-- Start Button add database -->
			<button type='button' class='btn btn-dark  float-right ' data-toggle='modal' data-target='#myModal'>
					<i class='fa fa-fw fa-plus'></i><i class='fa fa-fw fa-server'></i>
			</button>
			<!-- End Button add database -->	

			<!-- Bouton de retour -->

			<?php
			echo '<a href="index.php?action=getServer&serve='.$serve.'"><button class="return btn btn-primary font-weight-bold">< db list</button></a>';
			?>
	    </div>
	</div>
</div>
<!-- Fin du tableau des collections -->



<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->


</body>
</html>