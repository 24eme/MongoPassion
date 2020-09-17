<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<script src="public/js/db.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body style="background-color:#FFFFF§;">

<?php

	//Fil d'Ariane

	echo '<nav>';
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

// echo '<span>';
// echo '<form method="post" action="index.php?action=thread">';
// echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
// if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
// else{echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread"/>';}
// if(isset($_GET['db'])){echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread" value="'.$_GET['db'].'"/>';}
// else{echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread"/>';}
// if(isset($_GET['coll'])){echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread" value="'.$_GET['coll'].'"/>';}
// else{echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread"/>';}
// if(isset($_GET['doc'])){echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread" value="'.$_GET['doc'].'"/>';}
// else{echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread"/>';}
// echo '<input type="submit" name="go" id="go" value="Go"/>';
// echo '</form>';
// echo '</span>';

echo "<h1 align='center' class='title'>".$db."</h1>";

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
			<button id='createCollec' class="btn btn-success btn-lg btn-block text-light mb-1" flag ="false" onclick="afficher();">New Collection</button>
		</span>
	</div>
</nav>

<div id="main" class="border border-dark col-lg-4 offset-lg-4 bg-light mt-1">
	<br>
	<table class="table">
		<?php
			foreach ($collections as $collection) {
				echo '<tr>';
				echo "<td><a class='text-dark' href='index.php?action=getCollection&serve=".$_GET['serve']."&db=".$_GET['db']."&coll=".$collection->getName()."'><i class='mr-2 fa fa-fw fa-server'></i>";
				echo $collection->getName();
				echo '</a></td>';
				echo "<td><button  class='btn bg-light'><a class='text-primary' href=index.php?action=editCollection&serve=".$_GET['serve']."&db=".$_GET['db']."&coll=".$collection->getName()."><i class='fa fa-edit'></i></a></button></td>";
				// echo '<td><a href=index.php?action=deleteCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$collection->getName().'>Deletes</a></td>';

				echo "<td><button  class='btn bg-light'><a class='text-danger' href=index.php?action=deleteCollection&serve=".$_GET['serve'].'&db='.$_GET['db']."&coll=".$collection->getName()."  onclick='return confirmDelete()'><i class='fa fa-trash'></i></a></button></td>";
				echo '</tr>';


			}


					// 		echo "<td id='edit'><button  class='btn'><a href=".$link_e."><i class='fa fa-edit'></i></a></button></td>";
					// // echo '<td id="suppr"><a  href='.$link_d.'>Delete</a></td>';
					// echo  "<td id='suppr'><button  class='btn'><a href=".$link_d." onclick='return confirmDelete()' ><i class='fa fa-trash'></i></a></button></td>";
					// echo '</tr>';
		?>
	</table>
	<?php
	echo '<br><a href="index.php?action=getServer&serve='.$_GET['serve'].'"><button class="return btn btn-primary">< Serveur</button></a>';
	?>
</div>



</body>
</html>