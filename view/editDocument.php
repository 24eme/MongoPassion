<!doctype html>
<html lang="fr">
<head>
	<title>Edit Document</title>
	<meta charset="UTF-8">
</head>

<div id="main">
	<?php
		foreach ($result as $entry) {
			$doc=array();
		    foreach($entry as $x => $x_value) {
		 		if(gettype($x_value)!='object' or get_class($x_value)!='MongoDB\BSON\ObjectId'){
		 			$value = printable($x_value);
		 		}
		 		else{
		 	  		$value = $x_value;
		 		}
		 		$doc[$x] = $value;
		 	}
		 		$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
	 	}
	 	echo '<form method="post" action="'.$link_doc.'">';
	 	echo '<textarea name="comment_text" id="comment_text" rows="20" cols="200" required>'.$docs.'</textarea>';
	 	echo '<input type="submit" name="poster" id="poster" value="Poster">';
	 	echo '</form>';
	?>
</div>