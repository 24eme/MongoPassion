<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/pagination.css" rel="stylesheet" type="text/css">
	<link href="public/css/getDb.css" rel="stylesheet" type="text/css">

	<script src="public/js/db.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<?php

//Fil d'Ariane

echo "<div class=' container border-top  border-success bg-success col-lg-8 sticky-top'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i> '.$serve.'</a></li>';
			}
		}
		if(isset($db)){
			if($_GET['action']=='getDb'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-database"></i> '.$db.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$serve.'&db='.$db.'"><i class="fa fa-fw fa-database"></i>'.$db.'</a></li>';
			}
		}
		if(isset($coll)){
			if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-server"></i>'.$coll.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><i class="fa fa-fw fa-server"></i>'.$coll.'</a></li>';
			}
		}
		if(isset($doc)){
			echo '<li class="breadcrumb-item active"><i class="icon-book"></i>'.$doc.'</li>';
		}
	echo '</ol>';

echo '</div>';

//Fin fil d'Ariane

?>

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

<!-- Fin modal new Db -->



<!-- Recherche -->

<div  class="m-auto border col-lg-8 offset-lg-2 bg-light mt-1">
	<hr>
	<label for="pet-select" class="font-weight-bold">Search in all collections:</label>
	
	<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'">'; ?>
		<div class="input-group mb-1">
			<input type="search" class="form-control border border-success" required="required" name="recherche_db" id="recherche_db" placeholder="Search by id"/>
			<input class="btn bg-success text-light mr-2" type="submit" name="search" id="search" value="Search"/>
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
			
				foreach ($collections as $collection) {
					echo "<tr>";
					echo "<td><a class='text-success' href='index.php?action=getCollection&serve=".$serve."&db=".$db."&coll=".$collection->getName()."'><i class='text-dark mr-2 fa fa-fw fa-server'></i>";
					echo $collection->getName();
					echo '</a></td>';
					echo "<td><button  class='btn  float-right py-0'><a class='text-success' href=index.php?action=editCollection&serve=".$serve."&db=".$db."&coll=".$collection->getName()."><i class='fa fa-edit'></i></a></button></td>";
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
			echo '<a href="index.php?action=getServer&serve='.$serve.'"><button class="return btn btn-primary font-weight-bold">< Server</button></a>';
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