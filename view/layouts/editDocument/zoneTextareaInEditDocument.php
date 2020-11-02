<!-- Affichage du formulaire mode édition classique -->

<form method="post" action="<?php echo $link_doc ?>">
	<input type="hidden" name="date_array" value="<?php echo htmlspecialchars(serialize($date_array)) ?>"></input>
	<input type="hidden" name="up_date_array" value="<?php echo htmlspecialchars(serialize($up_date_array)) ?>"></input>
	<div id="update_content"><input type="submit" class="btn btn-secondary" name="update" id="update" value="Save"></div>
	<div id="doc_content"><textarea autofocus="autofocus" name="doc_text" id="doc_text"  rows="20" cols="200" required><?php echo $docs ?></textarea></div>
	<div id="update_content" style="margin-top:2%;"><input type="submit" class="btn btn-secondary" name="update" id="update" value="Save"></div>
</form>
<br>
