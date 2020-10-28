<div id="DivContentTable">
	<?php
	if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
		echo '<div id="main" class="creatDocDiv" style="display: block">';
	} else {
		if($jsoneditor){
			echo '<div id="main" class="creatDocDiv" style="display: none">';
		}
		else{
			echo '<div id="main" class="creatDocDiv">';
		}
	}
	?>
		<?php
			$link_doc = 'index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'';
		 	$doc = array();
		 	$doc['example_field']='content[...]';
		    if(isset($_GET['doc_text'])){
		 		$docs= $_GET['doc_text'];
		 		$docs = json_decode($docs);
		 		$docs = $docs->data;
			} else {
		 		$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
		    }
		 	echo '<form method="post" action="index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'">';
		 	echo '<div id="create_content"><input type="submit" class="btn btn-primary" name="create" id="create" value="Create"></div>';
		 	echo '<div id="doc_content"><textarea class="col-lg-8 offset-lg-2" name="doc_text" id="doc_text" rows="20" cols="200" style="height: 750px;" required>'.$docs.'</textarea></div>';
		 	echo '</form>';
		?>
	</div>
</div>