<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>
	<meta charset="UTF-8">
	<script src="public/js/db.js"></script>
</head>



<body>

<?php

echo '<span>';
echo '<form method="post" action="index.php?action=thread">';
echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
else{echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread"/>';}
if(isset($_GET['db'])){echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread" value="'.$_GET['db'].'"/>';}
else{echo '-><label>Database: </label><input type="search" name="db_thread" id="db_thread"/>';}
if(isset($_GET['coll'])){echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread" value="'.$_GET['coll'].'"/>';}
else{echo '-><label>Collection: </label><input type="search" name="coll_thread" id="coll_thread"/>';}
if(isset($_GET['doc'])){echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread" value="'.$_GET['doc'].'"/>';}
else{echo '-><label>Document: </label><input type="search" name="doc_thread" id="doc_thread"/>';}
echo '<input type="submit" name="go" id="go" value="Go"/>';
echo '</form>';
echo '</span>';

echo "<h1 class='title'>".$db."</h1>";

?>

<nav>
	<div id="options">
		<span id="nC">
			<?php
			$serve=$_GET['serve'];
			$db=$_GET['db'];
			?>
			<input type=hidden id=serve value=<?php echo $serve; ?>/>
			<input type=hidden id=db value=<?php echo $db; ?>/>
			<button id='createCollec' flag = "false" onclick="afficher();">New Collection</button>
		</span>
	</div>
</nav>

<div id="main">
	<br>
	<table>
		<?php
			foreach ($collections as $collection) {
				echo '<tr>';
				echo '<td><a href="index.php?action=getCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$collection->getName().'">';
				echo $collection->getName();
				echo '</a></td>';
				echo '<td><a href=index.php?action=editCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$collection->getName().'>Edit</a></td>';
				// echo '<td><a href=index.php?action=deleteCollection&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$collection->getName().'>Deletes</a></td>';

				echo "<td><a href=index.php?action=deleteCollection&serve=".$_GET['serve'].'&db='.$_GET['db']."&coll=".$collection->getName()."  onclick='return confirmDelete()'>Delete</a></td>";
				echo '</tr>';


			}
		?>
	</table>
	<?php
	echo '<br><a href="index.php?action=getServer&serve='.$_GET['serve'].'">< Server</a>';
	?>
</div>



</body>
</html>