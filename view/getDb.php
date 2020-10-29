<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>

	<?php require_once('layouts/header.php') ?>
</head>


<?php include('layouts/breadcrumb.php'); ?>

<div class="container">

<!-- Titre de la page -->

<?php
	echo "<h1 align='center' class='title font-weight-bold mt-2'><i title='Name of database' class='fa fa-fw fa-database'></i>".$db."</h1>";
?>

<!-- Fin du titre de la page -->


<!-- Modal new Db -->

<nav class="mb-1">
	<!-- StartModal -->
	
<?php include('layouts/getDb/modalNewCollection.php'); ?>
	<!-- endModal -->

<!-- Fin modal new Db -->



<!-- Recherche -->

<div  class="m-auto border bg-light mt-1">
	<?php echo '<form action="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'">'; ?>
		<div class="input-group mb-1 mt-1">
			<input type="hidden" name="action" value="getDb_search">
			<input type="hidden" name="serve" value='<?php echo $serve ?>'>
			<input type="hidden" name="db" value='<?php echo $db ?>'>
			<input type="search" autofocus="autofocus" class="form-control border border-success" required="required" name="search_db" id="recherche_db" placeholder="Acces direct to a document by id"/>
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
	<div id="main" class="border bg-light mt-1 m-auto getDbDiv">


		<table class="table table-sm table-striped">
				<?php echo  "<h3 class=\"text-center bg-success text-light \"><span><strong> Collections of ".$db." </strong></span><button type='button' class='btn btn-dark py-1 float-right ' data-toggle='modal' data-target='#myModal'>
					<i title='Add new collection' class='fa fa-fw fa-plus'></i><i title='Add new collection' class='fa fa-fw fa-server'></i>
			           </button>
			                </h3>";
				foreach ($tabcollections as $name => $size) {

					echo "<tr>";
					echo "<td><a class='text-success' href='index.php?action=getCollection&serve=".$serve."&db=".$db."&coll=".$name."'><i title='Name of collection' class='text-dark mr-2 fa fa-fw fa-server'></i>";
					echo $name;
					echo '</a></td>';
					echo '<td style="color:#6c757d; font-size:16px;">'.$size.' bytes</td>';
					echo "<td><button  class='btn  float-right py-0'><a class='text-success' href=index.php?action=editCollection&serve=".$serve."&db=".$db."&coll=".$name."><i class='fa fa-edit'></i></a></button></td>";
					echo '</tr>';
				}
			?>
		</table>
	    <div class="mb-2">
			<!-- Start Button add database -->
			<button type='button' class='btn btn-dark  float-right ' data-toggle='modal' data-target='#myModal'>
					<i title="Add new collection" class='fa fa-fw fa-plus'></i><i title="Add new collection" class='fa fa-fw fa-server'></i>
			</button>
			<!-- End Button add database -->

			<!-- Bouton de retour -->

			<?php
			echo '<a href="index.php?action=getServer&serve='.$serve.'"><button class="return btn btn-primary font-weight-bold">< Database list</button></a>';
			?>
	    </div>
	</div>
</div>
<!-- Fin du tableau des collections -->
</div>


<!-- footer -->

<?php
	require_once('layouts/footer.php')
?>

   <!-- footer -->


</body>
</html>
