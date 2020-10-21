<!doctype html>
<html lang="fr">
<head>
	<title>Create Document</title>

	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="public/css/breadcrumb.css" rel="stylesheet" type="text/css">
	<link href="public/css/createDocument.css" rel="stylesheet" type="text/css">
	<link href="public/css/titre.css" rel="stylesheet" type="text/css">
	<link href="public/css/btn_return.css" rel="stylesheet" type="text/css">
	<link href="jsoneditor/dist/jsoneditor.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="jsoneditor/dist/jsoneditor.min.js"></script>
    <script src="public/js/switch.js"></script>
</head>

<body>

<?php

//Fil d'Ariane

echo "<div class='container border-top  border-success bg-success col-lg-8 sticky-top'>";
	echo '<ol class="breadcrumb">';
		echo '<li class="breadcrumb-item"><a href="index.php?"><i class="fa fa-fw fa-home"></i>Home</a></li>';
		if(isset($serve)){
			if($_GET['action']=='getServer'){
				echo '<li class="breadcrumb-item active">'.$serve.'</li>';
			}
			else{
				echo '<li class="breadcrumb-item"><a href="index.php?action=getServer&serve='.$serve.'"><i class="fa fa-fw fa-desktop"></i> '.$serve.'</a></li>';
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
echo '</div>';

//Fin fil d'Ariane


//Titre de la page

echo '<h1 class = "title text-center font-weight-bold"><i class="fa fa-fw fa-book"></i> New Document</h1>';

//Fin titre de la page


//Bouton de retour

echo '<div id="nav_view">';
	if(isset($s_g)){
	 	echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'"><button class="return btn btn-primary">< Collection</button></a>';
	}
	else{
	 	echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'"><button class="return btn btn-primary">< Collection</button></a>';
	}
echo '</div>';
?>

<!-- Fin du bouton de retour -->


<!-- Bouton switch JsonEditor -->

<div id="switch">
	<label id="switch_json">JSONEditor</label>
	<label class="switch">
	  <input type="checkbox" id="myCheck" checked onclick="switchJ()">
	  <span class="slider round"></span>
	</label>
</div>

<!-- Fin du bouton switch JsonEditor -->


<!-- Zone de texte -->

<div id="DivContentTable">
	<div id="main" class="creatDocDiv" style="display: none">
		<?php
			$link_doc = 'index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'';
		 	$doc = array();
		 	$doc['example_field']='content[...]';
		 	$docs = stripslashes(json_encode($doc,JSON_PRETTY_PRINT));
		 	echo '<form method="post" action="index.php?action=traitement_nD&serve='.$serve.'&db='.$db.'&coll='.$coll.'">';
		 	echo '<div id="create_content"><input type="submit" class="btn btn-primary" name="create" id="create" value="Create"></div>';
		 	echo '<div id="doc_content"><textarea class="col-lg-8 offset-lg-2" name="doc_text" id="doc_text" rows="20" cols="200" style="height: 750px;" required>'.$docs.'</textarea></div>';
		 	echo '</form>';
		?>
	</div>
</div>

<!-- Fin de la zone de texte -->


<!-- Formulaire mode édition JsonEditor -->

<!-- Affichage du formulaire -->

<div id="DivContentTable">
	<div id="json"  style="display: block;">
	     <div id="create_content">
	     	<button class="btn btn-primary" id="create">Create</button>
	    </div>
	     <span id="nC"></span>
	 <div id="DivContentTable">
		<div id="jsoneditor" class="col-lg-8 offset-lg-2" style="height: 750px;"></div>
	 </div>

	</div>
</div>

<!-- Script de création et d'envoi du formulaire -->

<script type="text/javascript">
    const container = document.getElementById("jsoneditor")
    const options = {}
    const editor = new JSONEditor(container, options)
    var variableRecuperee = <?php echo stripslashes(json_encode($doc)); ?>;
    var link_doc = <?php echo (json_encode($link_doc)); ?>;

    /* Création du formulaire */

    const initialJson = variableRecuperee;
    editor.set(initialJson);
    editor.expandAll();

    /* Fonction d'envoi du formulaire */

    document.getElementById('getJSON').onclick = function () {
        const json = editor.get()
        var updatedJson = JSON.stringify(json, null, 2)

        var f = document.createElement("form");
        f.setAttribute('method',"post");
        f.setAttribute('action',link_doc);
        f.setAttribute('id',"idFormulaire");

        var i = document.createElement("input"); //input element, text
        i.setAttribute('type',"hidden");
        i.setAttribute('name',"doc_text");
        i.setAttribute('value',updatedJson);

        f.appendChild(i);

        var span = document.getElementById("nC");

        span.appendChild(f);

        document.getElementById("idFormulaire").submit();

    }
</script>

<!-- Fin du formulaire mode édition JsonEditor -->


<!-- footer -->

<?php 
	require_once('footer.php')
?>

   <!-- footer -->


</body>
</html>