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
    	$error_id = searchError_doc_id();
    	if($error_id==true){
			echo "<script>alert(\"Le champ '_id' n'est pas modifiable\");document.location.href = 'index.php?action=getCollection';</script>";
    	}
    	else{
	    	$update = getUpdate_doc();
	    	$id = getDoc_id();
	    	updateDoc($id,$update);

	    	if(isset($_GET['search'])){
                header('Location: index.php?action=getCollection_search&page='.$_GET['search'].'');
            }
            else{
                header('Location: index.php?action=getCollection&coll_id='.$_SESSION['collection'].'');
            }
	    }
    }

    function getCollection()
    {
    	if(isset($_GET['coll_id']))
    	$_SESSION['collection']=$_GET['coll_id'];

    	else{
    		header('Location: index.php?action=error');
    	}

    	$bypage = 50;
    	$nbDocs = countDocs();
    	$nbPages = getNbPages($nbDocs,$bypage);

    	if(isset($_GET['page'])){
    		$page = $_GET['page'];
    	}
    	else{
    		$page = 1;
    	}

	    $docs = getDocs($page,$bypage);

    	require('view/getCollection.php');
    }

    function createDocument()
    {
    	require('view/createDocument.php');
    }

    function traitement_nD()
    {
    	$doc = getNew_doc();
    	insertDoc($doc);
    	header('Location: index.php?action=getCollection&coll_id='.$_SESSION['collection'].'');
    }

    function deleteDocument()
    {
    	deleteDoc();
    	if(isset($_GET['search'])){
            header('Location: index.php?action=getCollection_search&page='.$_GET['search'].'');
        }
        else{
            header('Location: index.php?action=getCollection&coll_id='.$_SESSION['collection'].'');
        }
    }

    function viewDocument()
    {
    	$result = getDocument();
    	require('view/viewDocument.php');
    }

    function getCollection_search()
    {
    	$bypage = 50;

    	if(isset($_GET['page'])){
    		$page = $_GET['page'];
    	}
    	else{
    		$page = 1;
    		$_SESSION['recherche_id'] = $_POST['recherche_id'];
    		$_SESSION['recherche_g'] = $_POST['recherche_g'];
    	}

    	if(isset($_SESSION['recherche_id']) and isset($_SESSION['recherche_g'])){
    		if($_SESSION['recherche_id']=="" and $_SESSION['recherche_g']=="field = content[...]"){
    			header('Location: index.php?action=getCollection&coll_id='.$_SESSION['collection'].'');
    		}
    		else{
	    		$docs = getSearch($_SESSION['recherche_id'],$_SESSION['recherche_g'],$page,$bypage);
	    	}
		}
    	else{
	    	$docs = getDocs($page,$bypage);
	    }


    	$nbDocs = countSearch($_SESSION['recherche_id'],$_SESSION['recherche_g']);
    	$nbPages = getNbPages($nbDocs,$bypage);

    	require('view/getCollection_search.php');
    }

    function renameCollection()
    {
        try{
            $newname = str_replace(' ', '_', $_POST['newname']);
            renameCollec($newname);
            header('Location: index.php?action=editCollection&id='.$newname.'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Le nouveau nom est identique à l'ancien\");document.location.href = 'index.php?action=getDb&db_id=".$_SESSION['db']."';</script>";
        }
    }

    function editCollection()
    {
        require('view/editCollection.php');
    }

    function createCollection()
    {
        try{
            $newname = str_replace(' ', '_', $_POST['name']);
            createCollec($newname);
            header('Location: index.php?action=getDb&db_id='.$_SESSION['db'].'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Cette collection existe déjà\");document.location.href = 'index.php?action=getDb&db_id=".$_SESSION['db']."';</script>";
        }
    }

    function deleteCollection()
    {
        deleteColl();
        header('Location: index.php?action=getDb&db_id='.$_SESSION['db'].'');
    }

    function moveCollection()
    {
        $db = $_POST['newdb'];
        moveCollec($db);
        header('Location: index.php?action=getDb&db_id='.$_SESSION['db'].'');
    }

    function getDb()
    {
    	if(isset($_GET['db_id']))
    	$_SESSION['db']=$_GET['db_id'];

    	else{
    		header('Location: index.php?action=error');
    	}
    	$collections = getCollections();
    	require('view/getDb.php');
    }

    function error()
    {
    	require('view/error.php');
    }

    function getServer()
    {
    	try{
            if(isset($_GET['serve'])){
        		$_SESSION['serve']=$_GET['serve'];
        	}
        	elseif(isset($_POST['serve'])){
        		$_SESSION['serve']=$_POST['serve'];
        		if(!in_array($_POST['serve'], $_SESSION['serve_list'])){
        			array_push($_SESSION['serve_list'], $_POST['serve']);
        		}
        	}
        	elseif(!isset($_SESSION['serve'])){
        		header('Location: index.php?action=error');
        	}
        	$dbs = getDbs();
        	require('view/getServer.php');
        }
        catch(Exception $e){
            if (($key = array_search($_POST['serve'], $_SESSION['serve_list'])) !== false) {
                unset($_SESSION['serve_list'][$key]);
                $_SESSION['serve']='localhost';
            }
            echo "<script>alert(\"Le serveur n'autorise pas la connexion\");document.location.href = 'index.php';</script>";
        }
    }

    function home()
    {
    	require('view/home.php');
    }