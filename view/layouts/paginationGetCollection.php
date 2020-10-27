<div class="row">
	

                    <div aria-label="pagination " >
				        <ul class="pagination">

						      <?php
					            if($page!=1){
					            	echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page-1).'&bypage='.$bypage.'&s_g='.urlencode($recherche_g).'" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>';
					            }
					            else{
					            	echo '<span id="prev"><span aria-hidden="true">&laquo;</span></span>';
					           } ?>

							 
						</ul>
					 </div>
					 <div class="mx-1">
						 <h6 class=" pt-2">Documents <?= (1+(($page-1)*$bypage)) ?> -
									<?php if(($page*$bypage)<$nbDocs): ?>
										<?= $page*$bypage; ?>
									<?php else: ?>
										<?= $nbDocs . ' of '.$nbDocs ?>
									<?php endif; ?>
						 </h6>
					</div>
					
                    <div>
				            <span  class="text-center bg-light p-0 font-weight-bold mr-1">
								<select id="select_pagination" class="py-1" name="bypage" onchange="bypage(this)">
                    		<?php foreach([10, 20, 30, 50] as $nb) : ?>
                     			 <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                   			 <?php endforeach ?>
								</select>
							</span>
                    </div>
                   <div aria-label="pagination" class="ml-2 " >
				        <ul class="pagination pb-3">

				            <?php if($page!=$nbPages){
				            	echo '<a href="index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>';
				            }
				            else{
				            	echo '<span id="next"><span aria-hidden="true">&raquo;</span></span>';
				            }
				        ?>
				        </ul>
</div>