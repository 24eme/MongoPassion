<!doctype html>
<html lang="fr">
<head>
	<title><?php echo $db ?></title>

	<?php require_once('layouts/header.php') ?>
</head>


<?php include('layouts/breadcrumb.php'); ?>

<div class="container">


<!-- Titre de la page -->

<h1 align='center' class='title font-weight-bold mt-2'><i title='Name of database' class='fa fa-fw fa-database'></i><?php echo $db ?></h1>

<!-- Fin du titre de la page -->


<nav class="mb-1">

<!-- Modal new Db -->

<?php include('layouts/getDb/modalNewCollection.php'); ?>

<!-- Fin modal new Db -->


<!-- Recherche -->

<div  class="m-auto border bg-light mt-1">
	<form action="index.php?action=getDb_search&serve=<?php echo $serve.'&db='.$db ?>">
		<div class="input-group mb-1 mt-1">
			<input type="hidden" name="action" value="getDb_search">
			<input type="hidden" name="serve" value='<?php echo $serve ?>'>
			<input type="hidden" name="db" value='<?php echo $db ?>'>
			<input type="search" autofocus="autofocus" class="form-control border border-success" required="required" name="search_db" id="recherche_db" placeholder="Acces direct to a document by id"/>
			<div class="input-group-append">
			<input class="btn bg-success text-light mr-2" type="submit" name="search" id="search" value="Search"/>
			</div>
		</div>
	</form>
</div>

<!-- Fin de la recherche -->

</nav>

<!-- Tableau des collections -->

<div id="DivContentTable">
	<div id="main" class="border bg-light mt-1 m-auto getDbDiv">
		<table class="table table-sm table-striped">
				<h3 class="text-center bg-success text-light">
					<span><strong> Collections of <?php echo $db ?></strong></span>
					<button type='button' class='btn btn-dark py-1 float-right ' data-toggle='modal' data-target='#myModal'>
						<i title='Add new collection' class='fa fa-fw fa-plus'></i><i title='Add new collection' class='fa fa-fw fa-server'></i>
			        </button>
			    </h3>
				<?php foreach ($tabcollections as $name => $size) { ?>
					<tr>
						<td><a class='text-success' href='index.php?action=getCollection&serve=<?php echo $serve."&db=".$db."&coll=".$name ?>'><i title='Name of collection' class='text-dark mr-2 fa fa-fw fa-server'></i>
						<?php echo $name; ?>
						</a></td>

						<td style="color:#6c757d; font-size:16px;"><?php echo $size ?> bytes</td>

						<td><button class='btn  float-right py-0'><a class='text-success' href=index.php?action=editCollection&serve=<?php echo $serve."&db=".$db."&coll=".$name ?>><i class='fa fa-edit'></i></a></button></td>
					</tr>
				<?php } ?>
		</table>
	    <div class="m-2">

			<!-- Start Button add database -->

			<button type='button' class='btn btn-dark  float-right ' data-toggle='modal' data-target='#myModal'>
					<i title="Add new collection" class='fa fa-fw fa-plus'></i><i title="Add new collection" class='fa fa-fw fa-server'></i>
			</button>

			<!-- End Button add database -->


			<!-- Bouton de retour -->

			<a href="index.php?action=getServer&serve=<?php echo $serve ?>"><button class="return btn btn-primary font-weight-bold">< Database list</button></a>
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
