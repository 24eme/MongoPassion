<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$serve."</title>"?>

	<?php require_once('layouts/header.php') ?>
</head>
<body>



<?php include('layouts/breadcrumb.php'); ?>

<div class="container">

<?php

//Titre de la page

echo "<h1 align='center' class='title font-weight-bold'><i title='adress ip of server' class='fa fa-fw fa-desktop'></i>".$serve."</h1>";

//Fin du titre de la page

?>

<!-- StartModal -->

<?php include('layouts/getServer/modalNewDatabase.php'); ?>
<!-- endModal -->


<!-- Tableau des bases de données -->
<div id="DivContentTable">
	<div id="main" class="border bg-light">

		<table class="table table-sm table-striped ">
			<?php echo  "<h3 class=\"text-center bg-success text-light\"><span><strong>Databases of ".$serve." </strong></span></h3>" ?>

			<?php
				$tabdbs= array();
				foreach ($dbs as $db) {
					array_push($tabdbs,$db->getName());
				}
				sort($tabdbs);
				foreach ($tabdbs as $db) {
					echo '<tr>';

					echo "<td><a autofocus='autofocus' class='text-success' href='index.php?action=getDb&serve=".$serve."&db=".$db."'><i title='It is database $db'class=' text-dark mr-3 fa fa-fw fa-database'></i>";
					echo $db;

					echo '</a></td>';
					echo '</tr>';
				}

			?>
		</table>

		<div class="m-2">
			<!-- Start Button add database -->
			<button type='button' class='btn btn-dark  float-right' data-toggle='modal' data-target='#myModal'>
					<i title="Create database" class='fa fa-fw fa-database'></i><i title="Create database" class='fa fa-fw fa-plus'></i>
			</button>
			<!-- End Button add database -->
			<?php
				echo '<a href="index.php"><button class="return btn btn-primary font-weight-bold">< Home</button></a>'
			?>
	   </div>
	</div>
</div>

</div>

	<!-- footer -->

<?php
	require_once('layouts/footer.php')
?>

   <!-- footer -->

<!-- Fin du tableau des bases de données -->

</body>
</html>
