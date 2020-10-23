<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$serve."</title>"?>

	<?php require_once('header.php') ?>
</head>

<?php

//Fil d'Ariane

	echo "<div class='container  border-top  border-success bg-success col-lg-8 sticky-top'>";
		echo '<ol class="breadcrumb">';
			echo '<li class="breadcrumb-item"><a href="index.php?"><i title="return page of home" class="fa fa-fw fa-home"></i>Home</a></li>';
			if(isset($serve)){
				if($_GET['action']=='getServer'){
					echo '<li class="breadcrumb-item active"><i title="return address ip of server" class="fa fa-fw fa-desktop"></i> '.$serve.'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i  class="fa fa-fw fa-desktop"></i> '.$serve.'</a></li>';
				}
			
		}
		if(isset($db)){
			if($_GET['action']=='getDb'){
				echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-database"></i>'.$db.'</li>';
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

echo "</div>";

//Fin fil d'Ariane



//Titre de la page

echo "<h1 align='center' class='title font-weight-bold'><i title='adress ip of server' class='fa fa-fw fa-desktop'></i>".$serve."</h1>";

//Fin du titre de la page

?>
		
		<!-- StartModal -->
		<div class="modal" id="myModal">
		 <div class="modal-dialog">
		    <div class="modal-content">

			      <div class="modal-body">
			      		<div class="border  bg-light m-auto mb-2">
							<label for="pet-select" class="font-weight-bold">Create a new database :</label>
							<?php echo '<form autocomplete="off" method="post" action="index.php?action=getDb&serve='.$serve.'">'; ?>
								<div class="input-group mb-3">
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
	</div>

<!-- endModal -->


<!-- Tableau des bases de données -->
<div id="DivContentTable">
	<div id="main" class="border col-lg-8 offset-lg-2 mt-2 bg-light">

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

		<div class="mb-2">
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

	<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->

<!-- Fin du tableau des bases de données -->

</body>
</html>