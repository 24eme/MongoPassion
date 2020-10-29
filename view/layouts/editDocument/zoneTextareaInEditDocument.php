<?php
	 	//Affichage du formulaire mode édition classique

	 	echo '<form method="post" action="'.$link_doc.'">';
	 		echo '<input type="hidden" name="date_array" value="'.htmlspecialchars(serialize($date_array)).'"></input>';
	 		echo '<input type="hidden" name="up_date_array" value="'.htmlspecialchars(serialize($up_date_array)).'"></input>';
	 		echo '<div id="update_content"><input type="submit" class="btn btn-secondary" name="update" id="update" value="Save"></div>';
	 		echo '<div id="doc_content"><textarea autofocus="autofocus" name="doc_text" id="doc_text"  rows="20" cols="200" required>'.$docs.'</textarea></div>';
	 		echo '<div id="update_content" style="margin-top:2%;"><input type="submit" class="btn btn-secondary" name="update" id="update" value="Save"></div>';
	 	echo '</form>';
	 	echo '<br>'
?>