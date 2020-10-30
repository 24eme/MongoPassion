<!doctype html>
<html lang="fr">
	<head>
		<?php echo '<title>Edit '.$doc.'</title>'; ?>

		<?php require_once('layouts/header.php') ?>
	</head>

	<body>

	<?php include('layouts/breadcrumb.php'); ?>

	<div class="container">

		<?php

			$link_d = 'index.php?action=deleteDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$doc.'&page='.$page;


			//Titre de la page

			echo "<h2 class='title text-center'>Edit <i title='id of document' class='fa fa-file-text-o'></i>".$doc."<button  class=\"btn \"><a class=\"text-danger font-weight-bold\" href=".$link_d." onclick=\"return confirmDelete()\"><i title='Delete this document'class='fa fa-2x fa-trash'></i></a></button></h2>";

			//Fin du titre de la page


			//Message d'erreur

			if(isset($_GET['msg'])){

			  echo '<div id="cacherAlert" class="text-center alert alert-danger alert-dismissible fade show" role="alert">';
			   echo $_GET['msg'];
			  echo '<button type="button" class="close" onclick="cacherAlert()" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>';
			  echo '</div>';


			}

			//Fin Messagege d'erreur

			if(isset($type_id)){

				$link_d=$link_d.'&type_id='.$type_id;
			}
			if(isset($a_s)){

				$link_d=$link_d.'&a_s='.$a_s;
			}
			if(isset($s_g)){

				$link_d=$link_d.'&s_g='.$s_g;
			}
			if(isset($search_db)){

				$link_d=$link_d.'&search_db='.$search_db;
			}
		?>

		<!-- Fin du bouton de retour -->


		<!-- Bouton switch JsonEditor -->

		<?php if($jsoneditor){?>
		<div id="switch">
			<label id="switch_json">JSONEditor</label>
			<label class="switch">
				<?php
				if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
			  		echo '<input type="checkbox" id="myCheck" onclick="switchJ()">';
			  	} else {
			  		echo '<input type="checkbox" id="myCheck" checked onclick="switchJ()">';
			  	}
			  ?>
			  <span class="slider round"></span>
			</label>
		</div>
		<?php }?>

		<!-- Fin du bouton switch JsonEditor -->


		<!-- Formulaire mode édition classique -->
		<!--
		<div id="main"  style="display: none"> -->
			<?php
			if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
				echo '<div id="main"  style="display: block">';
			} else {
				if($jsoneditor){
					echo '<div id="main" style="display: none">';
				}
				else{
					echo '<div id="main">';
				}
			}
			?>
		    <!-- Formatage des données du document en JSON -->
			<?php include('layouts/editDocument/formatJsonInEditDocument.php'); ?>
		     <!--Fin formatage des données du document en JSON -->

			
		
		 	<!-- Affichage du formulaire mode édition classique -->
	        <?php include('layouts/editDocument/zoneTextareaInEditDocument.php'); ?>
       
	         <!-- Fin du formulaire mode édition classique -->
	</div>

	<!-- Formulaire mode édition JsonEditor -->

	<?php if($jsoneditor){?>
	<div id="DivContentTable">
			<?php
				if (isset($_GET['input']) && ($_GET['input'] === 'true')) {
					echo '<div id="json"  style="display: none;">';
				} else {
					echo '<div id="json"  style="display: block;">';
				}
			?>
		    <div  id="getJson_content">
		     	<button class="btn btn-secondary" id="getJSON">Save</button>
		    </div>
		    <span id="nC"></span>
			<div id="DivContentTable">
				<div id="jsoneditor" style="height: 750px;"></div>
			</div>
			<div  id="getJson_content">
				<button class="btn btn-secondary" id="getJSON2">Save</button>
			</div>
		</div>
	</div>
	<?php }?>

		<!--Fin formulaire mode édition JsonEditor -->

	<!-- Script de création et d'envoi du formulaire -->
	<?php include('layouts/scriptOfCreateFormModeJsonEdition.php'); ?>
	<!-- Fin Script de création et d'envoi du formulaire -->

	<!-- Fin du formulaire mode édition JsonEditor -->
	

	<?php

	//Bouton de retour
	echo '<div id="nav_view float-left">';
		if(isset($s_g)){
			echo '<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'&page='.$page.'"><button class="return text-center btn btn-primary">< Collection</button></a>';
		}
		elseif(isset($a_s)){
			echo '<a class="text-center" href="index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.$a_s.'&page='.$page.'"><button class="return  btn btn-primary">< Collection</button></a>';
		}
		elseif(isset($search_db)){
			echo '<a href="index.php?action=getDb_search&serve='.$serve.'&db='.$db.'&search_db='.$search_db.'"><button class="return btn btn-primary">< Collection</button></a>';
		}
		else{
			echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.$page.'"><button class="return btn btn-primary">< list of docs</button></a>';
		}
	echo '</div>';

	//Fin bouton de retour
	?>




	<!-- footer -->

	<?php
		require_once('layouts/footer.php')
	?>

	   <!-- footer -->


	</body>
</html>
