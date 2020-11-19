<div id="DivContentTable">
	<?php if (isset($_GET['input']) && ($_GET['input'] === 'true')) { ?>
		<div id="main" class="creatDocDiv" style="display: block">
	<?php } else {
		if($jsoneditor){ ?>
			<div id="main" class="creatDocDiv" style="display: none">
		<?php }
		else{ ?>
			<div id="main" class="creatDocDiv">
		<?php }
	} ?>

		<?php
			if(isset($query) and isset($proj) and isset($a_s_coll)){
				$link_doc = 'index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s_coll='.$a_s_coll.'&query='.urlencode($query).'&proj='.urlencode($proj);
			}
			else{
				$link_doc = 'index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'';
			}
		 	$doc = array();
		 	$doc['example_field']='content[...]';
		    if(isset($_GET['doc_text'])){
		 		$docs= $_GET['doc_text'];
		 		$docs = json_decode($docs);
		 		$docs = $docs->data;
			} else {
		 		$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
		    } ?>
		 	<form method="post" action="<?php echo $link_doc ?>">
			 	<div id="create_content"><input type="submit" class="btn btn-primary" name="create" id="create" value="Create"></div>
			 	<div id="doc_content"><textarea class="col-lg-8 offset-lg-2" name="doc_text" id="doc_text" rows="20" cols="200" style="height: 750px;" required><?php echo $docs ?></textarea></div>
			 	<div id="create_content" style="margin-top:2%";><input type="submit" class="btn btn-primary" name="create" id="create" value="Create"></div>
		 	</form>
	</div>
</div>