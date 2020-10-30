<nav aria-label="pagination" style="width: 16%; margin: auto; padding-left: 0;">
    <ul class="pagination">
        <?php if($page!=1){ ?>
            <a href="index.php?action=advancedSearch&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll.'&page='.($page-1).'&bypage='.$bypage.'&a_s='.urlencode($a_s) ?>" id="prev" aria-current="page"><span aria-hidden="true">&laquo;</span></a>
        <?php }
        else{ ?>
            <span id="prev"><span aria-hidden="true">&laquo;</span></span>
        <?php } ?>

        <span id="radio" class="text-center font-weight-bold">
            <select id="select_pagination" name="bypage" onchange="bypage_search(this)">
                    <?php foreach([10, 20, 30, 50] as $nb) : ?>
                        <option value="<?= $nb ?>" <?= ($bypage == $nb) ? 'selected="selected"': '' ?>><?= $nb ?></option>
                    <?php endforeach ?>
            </select>
        </span>

        <?php if($page!=$nbPages){ ?>
            <a href="index.php?action=advancedSearch&serve=<?php echo $serve.'&db='.$db.'&coll='.$coll.'&page='.($page+1).'&bypage='.$bypage.'&a_s='.urlencode($a_s) ?>" id="next" aria-current="page"><span aria-hidden="true">&raquo;</span></a>
        <?php }
        else{ ?>
            <span id="next"><span aria-hidden="true">&raquo;</span></span>
        <?php } ?>
    </ul>
</nav>