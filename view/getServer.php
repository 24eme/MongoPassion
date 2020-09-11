<!doctype html>
<html lang="fr">
<head>
	<?php echo "<title>".$serve."</title>"?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="background-color:#A48340;">

<?php

echo '<span>';
echo '<form method="post" action="index.php?action=thread">';
echo '<input type="hidden" name="action_thread" value="'.$_GET['action'].'"></input>';
if(isset($_GET['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_GET['serve'].'"/>';}
elseif(isset($_POST['serve'])){echo '<label>Server: </label><input type="search" name="serve_thread" id="serve_thread" value="'.$_POST['serve'].'"/>';}
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

echo "<h1 class='title'>".$serve."</h1>";


?>

<div id="main" class="col-lg-6 offset-lg-3 mt-5 bg-light">
	<br>
	<table class="table">
		<?php
			foreach ($dbs as $db) {
				echo '<tr>';
				echo "<td><a class='text-dark' href='index.php?action=getDb&serve=".$serve."&db=".$db->getName()."'>";
				// echo "<td><a  class='text-dark' href='index.php?action=getServer&serve=".$x."'>";
				echo $db->getName();
				echo '</a></td>';
				echo '</tr>';
			}
		?>
	</table>
	<?php
	echo '<br><a href="index.php">< Accueil</a>'
	?>
</div>

</body>
</html>