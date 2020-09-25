<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="public/css/getDb.css" rel="stylesheet" type="text/css">
	<script src="public/js/db.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body style="background-color:#FFFFF;">

<?php

	//Fil d'Ariane

	echo "<nav class='nav sticky-top justify-content-center'>";
		echo '<ol class="breadcrumb">';
			echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
			if(isset($_GET['serve'])){
				if($_GET['action']=='getServer'){
					echo '<li class="breadcrumb-item active">'.$_GET['serve'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><i class="fa fa-fw fa-desktop"></i>'.$_GET['serve'].'</a></li>';
				}
			}
			if(isset($_GET['db'])){
				if($_GET['action']=='getDb'){
					echo '<li class="breadcrumb-item active"><i class="fa fa-fw fa-database"></i>'.$_GET['db'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'">'.$_GET['db'].'</a></li>';
				}
			}
			if(isset($_GET['coll'])){
				if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'){
					echo '<li class="breadcrumb-item active">'.$_GET['coll'].'</li>';
				}
				else{
					echo '<li class="breadcrumb-item"><a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'">'.$_GET['coll'].'</a></li>';
				}
			}
			if(isset($_GET['doc'])){
				echo '<li class="breadcrumb-item active"><i class="icon-book"></i>'.$_GET['doc'].'</li>';
			}
		echo '</ol>';
	echo '</nav>';

?>

<hr>
<<!-- div id="recherche" class="col-lg-5 offset-lg-4 mr-2"> -->
	<div  class="m-auto border border-success col-lg-5 bg-light mt-1">
	<h3 class="text-center bg-success text-light"><span><strong>ESPACE OF SEARCH</strong></span></h3>
	<label for="pet-select">Search in all collections:</label>
	<br>
	<?php echo '<form method="post" action="index.php?action=getDb_search&serve='.$_GET['serve'].'&db='.$_GET['db'].'">'; ?>
	<input type="search" class="form-control border border-success" name="recherche_db" id="recherche_db" placeholder="Search by id"/>
	<input class="btn bg-success text-light m-1" type="submit" name="search" id="search" value="Search"/>
	<?php echo '<button class="btn bg-secondary"><a class="text-light" href="index.php?action=getDb&serve='.$_GET['serve'].'&db='.$_GET['db'].'">Reinit</a></button>'; ?>
</form>
</div>
<hr>

<?php

echo "<h1 align='center' class='title'><i class='fa fa-fw fa-database'></i>".$db."</h1>";

?>

<nav>




	<div id="options" class="col-lg-4 offset-lg-4 mt-1">
		<span id="nC">
			<?php
			$serve=$_GET['serve'];
			$db=$_GET['db'];
			?>
			<input type=hidden id=serve value=<?php echo $serve; ?>/>
			<input type=hidden id=db value=<?php echo $db; ?>/>
			<button id='createCollec' class="btn btn-success btn-lg btn-block text-light mb-2" flag ="false" onclick="afficher();">New Collection</button>
		</span>
	</div>
</nav>

<div id="main" class="border  col-lg-4 offset-lg-4 bg-light mt-1">
	<br>
	<table class="table table-sm table-striped">
		<tr  align="center" class="bg-success text-light"> 
    		<?php echo '<th>Collections of '.$_GET['db'].' <i class=\'fa fa-fw fa-server\'></i></th>'; ?> 
    		<th></th>
    		<th></th>
    	</tr>
		<?php
			foreach ($collections as $collection) {
		
				echo "<tr>";
				echo "<td><a class='text-dark' href='index.php?action=getCollection&serve=".$_GET['serve']."&db=".$_GET['db']."&coll=".$collection->getName()."'><i class='mr-2 fa fa-fw fa-server'></i>";
				echo $collection->getName();
				echo '</a></td>';
				echo "<td><button  class='btn  py-0'><a class='text-primary' href=index.php?action=editCollection&serve=".$_GET['serve']."&db=".$_GET['db']."&coll=".$collection->getName()."><i class='fa fa-edit'></i></a></button></td>";
				// echo '<td><a href=index.php?action=deleteCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$collection->getName().'>Deletes</a></td>';

				echo "<td><button  class='btn py-0'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$_GET['serve'].'&db='.$_GET['db']."&coll=".$collection->getName()."  onclick='return confirmDelete()'><i class='fa fa-trash'></i></a></button></td>";
				echo '</tr>';


			}


					// 		echo "<td id='edit'><button  class='btn'><a href=".$link_e."><i class='fa fa-edit'></i></a></button></td>";
					// // echo '<td id="suppr"><a  href='.$link_d.'>Delete</a></td>';
					// echo  "<td id='suppr'><button  class='btn'><a href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";
					// echo '</tr>';
		?>
	</table>
	<?php
	echo '<br><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><button class="return btn btn-primary">< Server</button></a>';
	?>
</div>



</body>
</html>