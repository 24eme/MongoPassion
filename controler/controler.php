<?php

    require('model/model.php');

    function editDocument()
    {
	    $result = getDocument();
	    $link_doc = getLink_doc();
	    require('view/editDocument.php');
    }


    function testJSON()
    {

        $result = getDocument();
        $link_doc = getLink_doc();
        require('view/testJSON.php');
    }


    function traitement_uD()
    {
    	try{
	    	$update = getUpdate_doc();
	    	$id = getDoc_id();
	    	updateDoc($id,$update);

	    	if(isset($_GET['search'])){
                header('Location: index.php?action=getCollection_search&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.htmlspecialchars($_GET['coll']).'&s_id='.htmlspecialchars($_GET['s_id']).'&s_g='.htmlspecialchars($_GET['s_g']).'&page='.htmlspecialchars($_GET['page']).'');
            }
            else{
                header('Location: index.php?action=getCollection&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.htmlspecialchars($_GET['coll']).'&page='.htmlspecialchars($_GET['page']).'');
            }
	    }
        catch(Exception $e){
           echo "<script>alert(\"Le champ '_id' n'est pas modifiable\");document.location.href = index.php?action=getCollection;</script>";
        }
    }

    function getCollection()
    {
    	try{
            if(isset($_GET['coll']))
        	$coll=htmlspecialchars($_GET['coll']);

        	else{
        		header('Location: index.php?action=error');
        	}

        	$bypage = 10;
        	$nbDocs = countDocs();
        	$nbPages = getNbPages($nbDocs,$bypage);

        	if(isset($_GET['page'])){
        		$page = htmlspecialchars($_GET['page']);
        	}
        	else{
        		$page = 1;
        	}

    	    $docs = getDocs($page,$bypage);

        	require('view/getCollection.php');
        }
        catch(Exception $e){
            echo $e;
        }
    }

    function createDocument()
    {
    	require('view/createDocument.php');
    }

    function traitement_nD()
    {
        try{
        	$doc = getNew_doc();
        	insertDoc($doc);
        	header('Location: index.php?action=getCollection&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.htmlspecialchars($_GET['coll']).'');
        }
        catch(Exception $e){
            echo $e;
        }
    }

    function deleteDocument()
    {
    	deleteDoc();
    	if(isset($_GET['search'])){
            header('Location: index.php?action=getCollection_search&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.htmlspecialchars($_GET['coll']).'&s_id='.htmlspecialchars($_GET['s_id']).'&s_g='.htmlspecialchars($_GET['s_g']).'&page='.htmlspecialchars($_GET['search']).'');
        }
        elseif(isset($_GET['search_db'])){
            header('Location: index.php?action=getDb_search&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&search_db='.htmlspecialchars($_GET['search_db']).'');
        }
        else{
            header('Location: index.php?action=getCollection&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.htmlspecialchars($_GET['coll']).'&page='.htmlspecialchars($_GET['page']).'');
        }
    }

    function viewDocument()
    {
    	try{
            $result = getDocument();
            require('view/viewDocument.php');
        }
        catch(Exception $e){
            echo "<script>alert(\"Le serveur n'autorise pas la connexion\");document.location.href = 'index.php';</script>";
        }
    }

    function getCollection_search()
    {
        try{
        	$bypage = 50;

        	if(isset($_POST['special_search'])){
                if(isset($_GET['page'])){
                    $page = htmlspecialchars($_GET['page']);
                }
                else{
                    $page = 1;
                }
                $s_search = htmlspecialchars($_POST['special_search']);
                $docs = getSpecialSearch($s_search,$page,$bypage);
                $nbDocs = countSpecialSearch($s_search);

            }
            elseif (isset($_GET['s_s'])) {
                if(isset($_GET['page'])){
                    $page = htmlspecialchars($_GET['page']);
                }
                else{
                    $page = 1;
                }
                $s_search = htmlspecialchars(urldecode($_GET['s_s']));
                $docs = getSpecialSearch($s_search,$page,$bypage);
                $nbDocs = countSpecialSearch($s_search);
            }
            else
            {
                if(isset($_GET['page'])){
                    $page = htmlspecialchars($_GET['page']);
                    // $recherche_id = htmlspecialchars($_GET['s_id']);
                    $recherche_g = htmlspecialchars(urldecode($_GET['s_g']));
                }
                else{
                    $page = 1;
                    // commentaire sur le $_POST[ 'recherche_id'] il n'est plus utilisé
                    // $recherche_id = htmlspecialchars($_POST['recherche_id']);
                    $recherche_g = htmlspecialchars($_POST['recherche_g']);
                }
                // if(isset($recherche_id) and isset($recherche_g)){
                if(isset($recherche_g)){
                    // if($recherche_id=="" and $recherche_g=="field : content[...]"){
                     if($recherche_g=="field : content[...]"){
                        header('Location: index.php?action=getCollection&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.htmlspecialchars($_GET['coll']).'');
                    }
                    else{
                        // $docs = getSearch($recherche_id, $recherche_g, $page,$bypage);
                         $docs = getSearch($recherche_g, $page,$bypage);
                    }
                }
                else{
                    $docs = getDocs($page,$bypage);
                }
                // J'ai retiré $recherche_id comme paramètre la fonction countSearch j'utilise plus l'input
                $nbDocs = countSearch($recherche_g);
            }

        	$nbPages = getNbPages($nbDocs,$bypage);

        	require('view/getCollection_search.php');
        }
        catch(Exception $e){
            echo $e;
        }
    }

    function renameCollection()
    {
        try{
            $newname = str_replace(' ', '_', htmlspecialchars($_POST['newname']));
            renameCollec($newname);
            header('Location: index.php?action=editCollection&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'&coll='.$newname.'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Le nouveau nom est identique à l'ancien\");document.location.href = 'index.php?action=getDb&db_id=".htmlspecialchars($_GET['db'])."';</script>";
        }
    }

    function editCollection()
    {
        require('view/editCollection.php');
    }

    function createCollection()
    {
        try{
            $newname = str_replace(' ', '_', htmlspecialchars($_POST['name']));
            createCollec($newname);
            header('Location: index.php?action=getDb&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Cette collection existe déjà\");document.location.href = 'index.php?action=getDb&serve=".htmlspecialchars($_GET['serve'])."&db=".htmlspecialchars($_GET['db'])."';</script>";
            echo $e;
        }
    }

    function deleteCollection()
    {
        deleteColl();
        header('Location: index.php?action=getDb&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'');
    }

    function moveCollection()
    {
        $db = htmlspecialchars($_POST['newdb']);
        moveCollec($db);
        header('Location: index.php?action=getDb&serve='.htmlspecialchars($_GET['serve']).'&db='.htmlspecialchars($_GET['db']).'');
    }

    function getDb()
    {
    	if(isset($_GET['db']))
    	$db=htmlspecialchars($_GET['db']);

    	else{
    		header('Location: index.php?action=error');
    	}
    	$collections = getCollections($db);
    	require('view/getDb.php');
    }

    function getDb_search()
    {
        if(isset($_GET['db'])){
            if(isset($_POST['recherche_db'])){
                $search = htmlspecialchars($_POST['recherche_db']);
            }
            elseif(isset($_GET['search_db'])){
                $search = urldecode(htmlspecialchars($_GET['search_db']));
            }
            $db = htmlspecialchars($_GET['db']);
        }

        else{
            header('Location: index.php?action=error');
        }

        $docs = getSearch_db($search,$db);

        $nbDocs = 0;        

        foreach ($docs as $key => $value) {
            if(sizeof($value)!=0){
                $nbDocs =+sizeof($value);
            }
        }

        require('view/getDb_search.php');

    }

    function error()
    {
    	require('view/error.php');
    }

    function getServer()
    {
        $serve_list=json_decode($_COOKIE['serve_list']);
    	try{
            if(isset($_GET['serve'])){
        		$serve=htmlspecialchars($_GET['serve']);
        	}
        	elseif(isset($_POST['serve'])){
        		$serve=htmlspecialchars($_POST['serve']);
        		if(!in_array(htmlspecialchars($_POST['serve']), $serve_list)){
        			array_push($serve_list, $serve);
                    setcookie('serve_list',json_encode($serve_list));
        		}
        	}
        	elseif(!isset($_SESSION['serve'])){
        		header('Location: index.php?action=error');
        	}
        	$dbs = getDbs($serve);
        	require('view/getServer.php');
        }
        catch(Exception $e){
            if (($key = array_search(htmlspecialchars($_POST['serve']), $serve_list)) !== false) {
                unset($serve_list[$key]);
                setcookie('serve_list',json_encode($serve_list));
                $serve='localhost';
            }
            echo "<script>alert(\"Le serveur n'autorise pas la connexion\");document.location.href = 'index.php';</script>";
        }
    }

    function home()
    {
    	require('view/home.php');
    }

    function thread()
    {
        try{
            $link_thread = getLink_thread();
                header('Location: '.$link_thread.'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Le serveur n'autorise pas la connexion\");document.location.href = 'index.php';</script>";
        }
    }