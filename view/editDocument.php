<!doctype html>
<html lang="fr">
	<head>
		<title>Edit <?php echo $doc ?></title>

		<?php require_once('layouts/header.php') ?>
	</head>

	<body>

	<?php include('layouts/breadcrumb.php'); ?>

	<div class="container">

		<?php $link_d = 'index.php?action=deleteDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&doc='.$doc.'&page='.$page; ?>


			<!-- Titre de la page -->

			<h2 class='title text-center'>Edit <i title='id of document' class='fa fa-file-text-o'></i><?php echo ' '.$doc ?><button  class="btn "><a class="text-danger font-weight-bold" href="<?php echo $link_d ?>" onclick="return confirmDelete()"><i title='Delete this document'class='fa fa-2x fa-trash'></i></a></button></h2>

			<!-- Fin du titre de la page -->


			<!-- Message d'erreur -->

			<?php if(isset($_GET['msg'])){ ?>
				<div id="cacherAlert" class="text-center alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo $_GET['msg']; ?>
					<button type="button" class="close" onclick="cacherAlert()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php }

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
					<?php if (isset($_GET['input']) && ($_GET['input'] === 'true')) { ?>
				  		<input type="checkbox" id="myCheck" onclick="switchJ()">
				  	<?php } else { ?>
				  		<input type="checkbox" id="myCheck" checked onclick="switchJ()">
				  	<?php } ?>
				  <span class="slider round"></span>
				</label>
			</div>
		<?php }?>

		<!-- Fin du bouton switch JsonEditor -->


		<!-- Formulaire mode édition classique -->

			<?php if (isset($_GET['input']) && ($_GET['input'] === 'true')) { ?>
				<div id="main"  style="display: block">
			<?php } else {
				if($jsoneditor){ ?>
					<div id="main" style="display: none">
				<?php }
				else{ ?>
					<div id="main">
				<?php }
			}?>

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
				<?php if (isset($_GET['input']) && ($_GET['input'] === 'true')) { ?>
					<div id="json"  style="display: none;">
				<?php } else { ?>
					<div id="json"  style="display: block;">
				<?php } ?>
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


	<!-- Bouton de retour -->

	<div id="nav_view float-left">
		<?php if(isset($s_g)){ ?>
			<a href="index.php?action=getCollection_search&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'&page='.$page ?>"><button class="return text-center btn btn-primary">< search</button></a>
		<?php }
		elseif(isset($a_s)){ ?>
			<a class="text-center" href="index.php?action=advancedSearch&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll.'&a_s='.$a_s.'&page='.$page ?>"><button class="return  btn btn-primary">< advanced search</button></a>
		<?php }
		elseif(isset($search_db)){ ?>
			<a href="index.php?action=getDb_search&serve=<?php $serve.'&db='.$db.'&search_db='.$search_db ?>"><button class="return btn btn-primary">< list of collections</button></a>
		<?php }
		else{ ?>
			<a href="index.php?action=getCollection&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll.'&page='.$page ?>"><button class="return btn btn-primary">< list of docs</button></a>
		<?php } ?>
	</div>

	<!-- Fin bouton de retour -->

	<?php var_dump($date_array); ?>
	<?php var_dump($up_date_array); ?>
	
	<!-- footer -->

	<?php
		require_once('layouts/footer.php')
	?>

	   <!-- footer -->

	</body>
</html>
