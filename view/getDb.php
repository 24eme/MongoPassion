<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$db."</title>"?>
	<meta charset="UTF-8">
	<script src="public/js/db.js"></script>
</head>



<body>

<?php

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