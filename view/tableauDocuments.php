<h3 class="text-center mb-1 bg-success text-light"><strong>Documents <?php echo ($page-1)*$bypage+1 ?> to <?php echo ($page * $bypage < $nbDocs) ? $page * $bypage : $nbDocs; ?> of <?php echo $nbDocs; ?></strong>
    <button class="btn btn-dark align-items-center py-1 float-right new_doc font-weight-bold"><a class="text-light" href="index.php?action=createDocument&serve=<?php echo $serve ?>&db=<?php echo $db ?>&coll=<?php echo $coll ?>"><i class="fa fa-fw fa-plus"></i><i class="fa fa-fw fa-book"></i></a></button>
</h3>
<?php if($nbDocs==0): ?>
    <p>Aucun document ne correspond à votre recherche.</p>
<?php else: ?>
<table class="table table-sm table-striped">
    <?php foreach ($docs as $doc): ?>
        <?php
            $type_id = gettype($doc['_id']);
            if ($type_id=='object'){
                $id = (string)$doc['_id'];
            }
            else{
                $id = $doc['_id'];
            }
            $content = array();
            foreach($doc as $x => $x_value) {
                if(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\ObjectId'){
                    $value = $x_value;
                }
                elseif(gettype($x_value)=='object' and get_class($x_value)=='MongoDB\BSON\UTCDateTime'){
                    $value = $x_value->toDateTime();
                }
                else{
                    $value = printable($x_value);
                }
                $content[$x] =  improved_var_export($value);
            }
            $content = init_json($content);
            unset($content['_id']);
            $json = stripslashes(json_encode($content));
            $jsonView = stripslashes(json_encode($content,JSON_PRETTY_PRINT));
            ?>
    <tr>
        <td id='d'><a class='text-success text-center' data-toggle='tooltip' title='<?php echo $json ?>' href="index.php?action=editDocument&serve=<?php echo $_GET['serve'] ?>&db=<?php echo $_GET['db'] ?>&coll=<?php echo $_GET['coll'] ?>&doc=<?php echo $id ?>&type_id=<?php echo $type_id ?>&page=<?php echo $page ?><?php if(isset($recherche_g)): ?>&s_g=<?php echo urlencode($recherche_g) ?><?php endif; ?>"><i class='text-dark fa fa-fw fa-book'></i>&nbsp;<?php echo $id; ?></a></td>
        <td id="json"><?php echo substr($json, 0, 100).''; ?><?php if(strlen($json)>100): ?>[...]<?php endif; ?></td>
    </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
