<div class='container col-lg-8 sticky-top'>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
		<?php if(isset($serve)): ?>
			<li class="breadcrumb-item <?php if($_GET['action']=='getServer'): ?>active<?php endif; ?>"><a href="index.php?action=getServer&serve=<?php echo $serve ?>"><i class="fa fa-fw fa-desktop"></i> <?php echo $serve ?></a></li>
		<?php endif; ?>
        <?php if(isset($db)): ?>
			<li class="breadcrumb-item <?php if($_GET['action']=='getDb'): ?>active<?php endif; ?>"><a href="index.php?action=getDb&serve=<?php echo $serve ?>&db=<?php echo $db ?>"><i class="fa fa-fw fa-database"></i> <?php echo $db ?></a></li>
		<?php endif; ?>
        <?php if(isset($coll)): ?>
			<li class="breadcrumb-item <?php if($_GET['action']=='getCollection' or $_GET['action']=='getCollection_search'): ?>active<?php endif; ?>"><a href="index.php?action=getCollection&serve=<?php echo $serve ?>&db=<?php echo $db ?>&coll=<?php echo $coll ?>"><i class="fa fa-fw fa-server"></i> <?php echo $coll ?></a></li>
		<?php endif; ?>
        <?php if(isset($doc)): ?>
			<li class="breadcrumb-item active"><a href="index.php?action=editDocument&serve=<?php echo $serve ?>&db=<?php echo $db ?>&coll=<?php echo $coll ?>&doc=<?php echo $doc; ?>"><i class="fa fa-fw fa-book"></i> <?php echo $doc ?></a></li>
		<?php endif; ?>
	</ol>
</div>
