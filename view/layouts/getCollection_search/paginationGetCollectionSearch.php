<div class="row mr-2">
	<div aria-label="pagination" >
		<ul class="pagination">
			<?php if($page!=1){ ?>
				<a href="index.php?action=getCollection_search&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll.'&page='.($page-1).'&bypage='.$bypage.'&s_g='.urlencode($recherche_g) ?>" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>
			<?php }
			else{ ?>
				<span id="prev"><span aria-hidden="true">&laquo;</span></span>
			<?php } ?>

		</ul>
	</div>
	<div class="mx-1">
		<h6 class="pt-2">Documents <?php echo (1+(($page-1)*$bypage)) ?>-
			<?php if(($page*$bypage)<$nbDocs){echo $page*$bypage;}
			else{echo $nbDocs;}
			echo ' of '.$nbDocs; ?>
		</h6>
	</div>
	<div>
		<span  class="text-center bg-light font-weight-bold mr-1">
            <select id="select_pagination" class="py-1" name="bypage" onchange="bypage_search(this)">
                <?php foreach([10, 20, 30, 50] as $nb) : ?>
                    <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                <?php endforeach ?>
        	</select>
		</span>
	</div>
	<div aria-label="pagination" class="ml-2">
		<ul class="pagination">
			<?php if($page!=$nbPages){ ?>
				<a href="index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'&s_g='.urlencode($recherche_g).'" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>
			<?php }
			else{ ?>
				<span id="next"><span aria-hidden="true">&raquo;</span></span>
			<?php } ?>
		</ul>
	</div>
</div>