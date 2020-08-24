<?php

    require('model/model.php');

    function editDocument()
    {
    	$result = getDocument();
    	$link_doc = getLink_doc();
    	require('view/editDocument.php');
    }

    function traitement_uD()
    {
    	updateDoc();
    }