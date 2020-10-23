<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>

	<?php require_once('header.php') ?>
</head>

<?php include('breadcrumb.php'); ?>

<!-- Titre de la page -->

<?php
	echo "<h2 align='center' class='title font-weight-bold mt-5'><i title='search results in database $db' class='fa fa-fw fa-database'></i>Search results for <font color='#62a252'>".$search."</font> in <font color='#62a252'>".$db."</font></h2>";
?>

<!-- Fin du titre de la page -->

	

	<!-- StartModal -->
	<div class="modal" id="myModal">
		<div class="modal-dialog">
		    <div class="modal-content">

			      <div class="modal-body">
				      				
						<div  class="border  bg-light m-auto mb-2">
							<label for="pet-select" class="font-weight-bold">Create a new collection :</label>
							<?php echo '<form autocomplete="off" method="post" action="index.php?action=createCollection&serve='.$serve.'&db='.$db.'">'; ?>
								<div class="input-group mb-3">
									<input type="text"  list="browsers" placeholder="New name" required="required" class="form-control border border-success" name="name"  />
									<input class="btn bg-success text-light "  type="submit"   value="Create"/>
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


<!-- Fin du bouton de recherche -->


<!-- Recherche -->
<nav class="mb-2">
	<div   class="m-auto border  col-lg-8 offset-lg-2 bg-light">
		<hr>
		<label for="pet-select" class="font-weight-bold">Search in all collections:</label>
		<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'">'; ?>
			<div class="input-group mb-1">
				<input type="search" class="form-control border border-success mr" name="recherche_db" id="recherche_db" placeholder="Search by id"/>
				<input class="btn bg-success text-light mr-2 " type="submit" name="search" id="search" value="Search">
				<?php echo '<button class="btn bg-secondary"><a class="text-light" href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><i title="Reset and return to the getDb page" class="fa fa-fw fa-remove"></i></a></button>'; ?>
			</div>
		</form>
	</div>

</nav>
<!-- Fin de la recherche -->


<!-- Tableau des résultats de la recherche -->
<div id="DivContentTable">
	<div id="main" class="border  col-lg-8 offset-lg-2 bg-light mt-1 m-auto">
		
		<table class="table table-sm table-striped">
			<?php
			echo"<h3 class=\"text-center bg-success text-light\"><span><strong>Search results for :".$search."</strong></span></h3>"; 
				if($nbDocs==0){
					echo 'Aucun document ne correspond à votre recherche.';
				}
				else{
					foreach ($docs as $coll => $doc) {
						if(sizeof($doc)!=0){
							foreach ($doc as $field) {

								//Liens des options de gestion des collections

								$link_v = 'index.php?action=viewDocument&serve='.strip_tags($serve).'&db='.$db.'&coll='.$coll.'&doc='.$field['_id'].'&search_db='.urlencode($search).'&page=1';
								$link_e = 'index.php?action=editDocument&serve='.strip_tags($serve).'&db='.$db.'&coll='.$coll.'&doc='.$field['_id'].'&search_db='.urlencode($search).'&page=1';
								$link_d = 'index.php?action=deleteDocument&serve='.strip_tags($serve).'&db='.$db.'&coll='.$coll.'&doc='.$field['_id'].'&search_db='.urlencode($search).'&page=1';
								$link_c = 'index.php?action=getCollection&serve='.strip_tags($serve).'&db='.$db.'&coll='.$coll.'';

								//Affichage du tableau

								echo '<tr>';
								echo '<td><a class="text-success" href="'.$link_e.'"><i class=" text-dark mr-2 fa fa-fw fa-server"></i>'.$field['_id'].'</a></td>';
							}
						}
					}
				}
			?>
		</table>
	    <div class="mb-2">
			<!-- Start Button new collection -->
			<button type='button' class='btn btn-dark  float-right ' data-toggle='modal' data-target='#myModal'>
					<i title="Add new collection" class='fa fa-fw fa-plus'></i><i title="Add new collection" class='fa fa-fw fa-server'></i>
			</button>
			<!-- End Button add new collection -->

			<!-- Bouton de retour -->

			<?php
				echo '<a href="index.php?action=getServer&serve='.strip_tags($serve).'"><button class="return btn btn-primary font-weight-bold">< Database list</button></a>';
			?>
	    </div>
	</div>
</div>
<!-- Fin du tableau des résultats de la recherche -->


<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->

</body>
</html>