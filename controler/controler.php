<?php

    require('model/model.php');

    function editDocument() //Fonction qui gère l'affichage de la page editDocument
    {   
        //Création des variables

	    $doc = htmlspecialchars($_GET['doc']);
        if(isset($_GET['type_id'])){
            $type_id = htmlspecialchars($_GET['type_id']);
        }
        else{
            $type_id=null;
        }
        $coll = htmlspecialchars($_GET['coll']);
        $db = htmlspecialchars($_GET['db']);
        $serve = htmlspecialchars($_GET['serve']);
        $page = htmlspecialchars($_GET['page']);
        if(isset($_GET['s_g'])){
            $s_g = htmlspecialchars($_GET['s_g']);
        }
        else{
            $s_g=null;
        }
        if(isset($_GET['a_s'])){
            $a_s = htmlspecialchars($_GET['a_s']);
        }
        else{
            $a_s=null;
        }
        if(isset($_GET['search_db'])){
            $search_db = htmlspecialchars($_GET['search_db']);
        }
        else{
            $search_db = null;
        }

        //Récupération du document au format curseur

        $result = getDocument($doc,$type_id,$coll,$db,$serve);

        // Création du lien d'envoi du formulaire

	    $link_doc = getLink_doc($search_db,$a_s,$s_g,$doc,$type_id,$coll,$db,$serve,$page);

	    require('view/editDocument.php');
    }


    function traitement_uD()
    {   
    	$doc = htmlspecialchars($_GET['id']);
        if(isset($_GET['type_id'])){
            $type_id = htmlspecialchars($_GET['type_id']);
        }
        $coll = htmlspecialchars($_GET['coll']);
        $db = htmlspecialchars($_GET['db']);
        $serve = htmlspecialchars($_GET['serve']);
        $page = htmlspecialchars($_GET['page']);

        if(isset($_GET['s_g'])){
            $s_g = htmlspecialchars($_GET['s_g']);
        }
        elseif(isset($_GET['a_s'])){
            $a_s = htmlspecialchars($_GET['a_s']);
        }
        elseif(isset($_GET['search_db'])){
            $search_db = htmlspecialchars($_GET['search_db']);
        }

        $doc_text = strip_tags($_POST['doc_text']);
      
        $date_array = unserialize($_POST['date_array']);
        $up_date_array = unserialize($_POST['up_date_array']);

        try{
           
           //on Check si le contenu respecte le format json si il reste sur la page avec l'erreur

             if(is_null(json_decode($doc_text)) ) {
            header('Location: index.php?action=editDocument&serve='.$_GET['serve'].'&db='.$_GET['db'].'&coll='.$_GET['coll'].'&doc='.$doc.'&type_id='.$type_id.'&page='.$page.'&msg=Désolé mauvais format nous acceptons que du format json {  "example_field": "content[...]"}'.'&doc_text='. json_encode(array(data => $doc_text)).'&input=true');
           
                return;

             } 
       
           
         
	    	$update = getUpdate_doc($doc_text,$date_array,$up_date_array);

	    	$id = getDoc_id($doc,$type_id);
	    	updateDoc($id,$update,$serve,$db,$coll);

	    	if(isset($s_g)){
                header('Location: index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'&page='.$page.'');
            }
            elseif (isset($a_s)) {
                header('Location: index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$page.'');
            }
            elseif (isset($search_db)) {
                header('Location: index.php?action=getDb_search&serve='.$serve.'&db='.$db.'&search_db='.$search_db.'');
            }
            else{
                header('Location: index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.$page.'');
            }
	    }
        catch(Exception $e){
           echo "<script>alert(\"Le champ '_id' n'est pas modifiable\");document.location.href = index.php?action=getCollection;</script>";
        }
    }

    function getCollection()
    {
    	try{
            if(isset($_GET['coll']) and isset($_GET['serve']) and isset($_GET['db'])){
            	$coll=htmlspecialchars($_GET['coll']);
                $serve=htmlspecialchars($_GET['serve']);
                $db=htmlspecialchars($_GET['db']);
            }
        	else{
        		header('Location: index.php?action=error');
        	}

            if(isset($_GET['bypage'])){
                $bypage = intval($_GET['bypage']);
            }
            else{
                $bypage = 20;
            }

            if(isset($_GET['page'])){
                $page = htmlspecialchars($_GET['page']);
            }
            else{
                $page = 1;
            }

        	$nbDocs = countDocs($serve,$db,$coll);
        	$nbPages = getNbPages($nbDocs,$bypage);

    	    $docs = getDocs($page,$bypage,$serve,$db,$coll);

        	require('view/getCollection.php');
        }
        catch(Exception $e){
            echo $e;
        }
    }

    function createDocument()
    {
    	$serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);
        if(isset($_GET['s_g'])){
            $s_g = htmlspecialchars($_GET['s_g']);
        }
        
        require('view/createDocument.php');
    }

    function traitement_nD()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);

        $doc_text = strip_tags($_POST['doc_text']);
    
        try{

            //on Check si le contenu respecte le format json si il reste sur la page avec l'erreur 

          if(is_null(json_decode($doc_text))) {
            header('Location: index.php?action=createDocument&serve='.$serve.'&db='.$db.'&coll='.$coll.'&msg=Désolé mauvais format nous acceptons que du format json {  "example_field": "content[...]"}'.'&doc_text='. json_encode(array(data => $doc_text)).'&input=true');
           
           
            return;

          } 
            

        	$doc = getNew_doc($doc_text);

        	insertDoc($doc,$serve,$db,$coll);
        	header('Location: index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'');
        }
        catch(Exception $e){
            echo $e;
        }
    }

    function deleteDocument()
    {
    	$serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);
        $doc = htmlspecialchars($_GET['doc']);
        if(isset($_GET['page'])){
            $page = htmlspecialchars($_GET['page']);
        }
        else{
            $page = 1;
        }
        if(isset($_GET['type_id'])){
            $type_id = htmlspecialchars($_GET['type_id']);
        }
        else{
            $type_id=null;
        }
        if(isset($_GET['s_g'])){
            $s_g = htmlspecialchars($_GET['s_g']);
        }
        if(isset($_GET['a_s'])){
            $a_s = htmlspecialchars($_GET['a_s']);
        }
        if(isset($_GET['search_db'])){
            $search_db = htmlspecialchars($_GET['search_db']);
        }

        deleteDoc($serve,$db,$coll,$doc,$type_id);

    	if(isset($s_g)){
            header('Location: index.php?action=getCollection_search&serve='.$serve.'&db='.$db.'&coll='.$coll.'&s_g='.$s_g.'&page='.$page.'');
        }
        elseif(isset($search_db)){
            header('Location: index.php?action=getDb_search&serve='.$serve.'&db='.$db.'&search_db='.$search_db.'');
        }
        elseif(isset($a_s)){
            header('Location: index.php?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'&a_s='.urlencode($a_s).'&page='.$page.'');
        }
        else{
            header('Location: index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'&page='.$page.'');
        }
    }

    function viewDocument()
    {
    	try{
            $doc = htmlspecialchars($_GET['doc']);
            if(isset($_GET['s_g'])){
                $s_g = htmlspecialchars($_GET['s_g']);
            }
            if(isset($_GET['a_s'])){
                $a_s = htmlspecialchars($_GET['a_s']);
            }
            if(isset($_GET['search_db'])){
                $search_db = htmlspecialchars($_GET['search_db']);
            }
            if(isset($_GET['type_id'])){
                $type_id = htmlspecialchars($_GET['type_id']);
            }
            else{
                $type_id = null;
            }
            $coll = htmlspecialchars($_GET['coll']);
            $db = htmlspecialchars($_GET['db']);
            $serve = htmlspecialchars($_GET['serve']);
            $page = htmlspecialchars($_GET['page']);

            $result = getDocument($doc,$type_id,$coll,$db,$serve);;
            require('view/viewDocument.php');
        }
        catch(Exception $e){
            echo "<script>alert(\"Le serveur n'autorise pas la connexion\");document.location.href = 'index.php';</script>";
        }
    }

    function getCollection_search()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);

        try{
        	if(isset($_GET['bypage'])){
                $bypage = intval($_GET['bypage']);
            }
            else{
                $bypage = 20;
            }

            if(isset($_GET['page'])){
                $page = htmlspecialchars($_GET['page']);
            }
            else{
                $page = 1; 
            }

            if(isset($_GET['s_g'])){
                $recherche_g = htmlspecialchars(urldecode($_GET['s_g']));
            }
            else{
                $recherche_g = htmlspecialchars($_POST['recherche_g']); 
            }

            if(isset($recherche_g)){
                if($recherche_g==""){
                    header('Location: index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'');
                }
                else{
                    $docs = getSearch($recherche_g,$page,$bypage,$serve,$db,$coll);
                }
            }
            else{
                header('Location: index.php?action=getCollection&serve='.$serve.'&db='.$db.'&coll='.$coll.'');
            }
            $nbDocs = countSearch($recherche_g,$serve,$db,$coll);
        	$nbPages = getNbPages($nbDocs,$bypage);

        	require('view/getCollection_search.php');
        }
        catch(Exception $e){
            echo $e;
        }
    }

    function advancedSearch()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);

        if(isset($_GET['bypage'])){
            $bypage = intval($_GET['bypage']);
        }
        else{
            $bypage = 20;
        }

        if(isset($_GET['page'])){
            $page = htmlspecialchars($_GET['page']);
        }
        else{
            $page = 1;
        }

        if(isset($_GET['a_s'])){
            $a_s = htmlspecialchars(urldecode($_GET['a_s']),ENT_NOQUOTES);
        }
        elseif (isset($_GET['s_g'])) {
            $s_g = htmlspecialchars(urldecode($_GET['s_g']),ENT_NOQUOTES);
            if(!strpos($s_g, ':')){
                try{
                    new MongoDB\BSON\ObjectId($s_g);
                    $a_s = 'db.'.$coll.'.find("'.$s_g.'")';
                }
                catch (Exception $e){
                    $a_s = 'db.'.$coll.'.find({_id:"'.$s_g.'"})';
                }
            }
            else{
                $s_g = str_replace(' ', '', $s_g);
                $s_g_array = explode(':', $s_g);
                $a_s = 'db.'.$coll.'.find({'.$s_g_array[0].':"'.$s_g_array[1].'"})';
            }
        }
        else{
            $a_s = 'db.'.$coll.'.find({})';
        }

        if(isset($a_s)){
            $result = getAdvancedSearch($a_s,$page,$bypage,$serve,$db,$coll);
            
            if(testProjection($a_s,$serve,$db)){
                $docs = $result;
            }

            $nbDocs = countAdvancedSearch($a_s,$serve,$db,$coll);
            $nbPages = getNbPages($nbDocs,$bypage);
        }

        $link_search = '?'.$_SERVER['QUERY_STRING'];

        $link_reinit = '?action=advancedSearch&serve='.$serve.'&db='.$db.'&coll='.$coll.'';

        require('view/advancedSearch.php');

    }

    function renameCollection()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);

        try{
            $newname = str_replace(' ', '_', htmlspecialchars($_POST['newname']));
            renameCollec($newname,$serve,$db,$coll);
            header('Location: index.php?action=editCollection&serve='.$serve.'&db='.$db.'&coll='.$newname.'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Le nouveau nom est identique à l'ancien\");document.location.href = 'index.php?action=editCollection&serve=".$serve."&db=".$db."&coll=".$coll."';</script>";
        }
    }

    function editCollection()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);
        
        require('view/editCollection.php');
    }

    function createCollection()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);

        try{
            $newname = str_replace(' ', '_', htmlspecialchars($_POST['name']));
            createCollec($newname,$serve,$db);
            header('Location: index.php?action=getDb&serve='.$serve.'&db='.$db.'');
        }
        catch(Exception $e){
            echo "<script>alert(\"Cette collection existe déjà\");document.location.href = 'index.php?action=getDb&serve=".$serve."&db=".$db."';</script>";
        }
    }

    function deleteCollection()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);

        deleteColl($serve,$db,$coll);
        header('Location: index.php?action=getDb&serve='.$serve.'&db='.$db.'');
    }

    function moveCollection()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $db = htmlspecialchars($_GET['db']);
        $coll = htmlspecialchars($_GET['coll']);

        $newdb = htmlspecialchars($_POST['newdb']);

        moveCollec($newdb,$serve,$db,$coll);
        header('Location: index.php?action=getDb&serve='.$serve.'&db='.$db.'');
    }

    function getDb()
    {
    	if(isset($_GET['serve'])){
            $serve=htmlspecialchars($_GET['serve']);
        }
    	else{
    		header('Location: index.php?action=error');
    	}
        if(isset($_GET['db'])){
            $db=htmlspecialchars($_GET['db']);
        }
        elseif (isset($_POST['newdb'])) {
            $db=htmlspecialchars($_POST['newdb']);
        }
        else{
            header('Location: index.php?action=error');
        }
    	$collections = getCollections($serve,$db);
    	require('view/getDb.php');
    }

    function getDb_search()
    {
        if(isset($_GET['db']) and isset($_GET['serve'])){
            if(isset($_POST['recherche_db'])){
                $search = htmlspecialchars($_POST['recherche_db']);
            }
            elseif(isset($_GET['search_db'])){
                $search = urldecode(htmlspecialchars($_GET['search_db']));
            }
            $db = htmlspecialchars($_GET['db']);
            $serve=htmlspecialchars($_GET['serve']);
        }

        else{
            header('Location: index.php?action=error');
        }

        $docs = getSearch_db($search,$db,$serve);

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
        if(isset($_POST['authentification'])){
            try{
                $serve=htmlspecialchars($_POST['serve']);
                if(!strpos($serve, ':')){
                    $serve = $serve.':27017';
                }
                $user = htmlspecialchars($_POST['user']);
                $passwd = htmlspecialchars($_POST['passwd']);
                $auth_db = htmlspecialchars($_POST['auth_db']);

                $cookie_option = array('path'=> $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']);

                setcookie('user', $user, $cookie_option);
                setcookie('passwd',$passwd, $cookie_option);
                setcookie('auth_db',$auth_db, $cookie_option);

                $dbs = getDbs($serve,$user,$passwd,$auth_db);
                require('view/getServer.php');                
            }
            catch(Exception $e){
                echo "<script>alert(\"L'authentification a échoué\");document.location.href = 'index.php';</script>";
            }
        }
        else{
            $serve_list=json_decode($_COOKIE['serve_list']);
        	try{
                if(isset($_GET['serve'])){
            		$serve=htmlspecialchars($_GET['serve']);
            	}
            	elseif(isset($_POST['serve'])){
            		$serve=htmlspecialchars($_POST['serve']);
                    if(!strpos($serve, ':')){
                        $serve = $serve.':27017';
                    }
            		if(!in_array($serve, $serve_list)){
            			array_push($serve_list, $serve);
                        setcookie('serve_list',json_encode($serve_list));
            		}
            	}
            	else{
            		header('Location: index.php?action=error');
            	}
            	$dbs = getDbs($serve);
            	require('view/getServer.php');
            }
            catch(Exception $e){
                if (($key = array_search($serve, $serve_list)) !== false) {
                    unset($serve_list[$key]);
                    setcookie('serve_list',json_encode($serve_list));
                    $serve='localhost:27017';
                }
                echo "<script>alert(\"Le serveur n'autorise pas la connexion\");document.location.href = 'index.php';</script>";
            }
        }
    }

    function home()
    {
        setcookie('user', "", time() - 3600);
        setcookie('passwd',"", time() - 3600);
        setcookie('auth_db',"", time() - 3600);

        if(extension_loaded('mongodb') == false){
            header('Location: index.php?action=install');
        }

        $file_compopser = 'composer.json'; 
        $data_composer = file_get_contents($file_compopser);
        if(strpos($data_composer, 'mongodb/mongodb') == false){
            header('Location: index.php?action=install');
        }

        // $file_json = 'jsoneditor/package.json'; 
        // $data_json = file_get_contents($file_json);
        // if(strpos($data_json, 'jsoneditor') == false){
        //     header('Location: index.php?action=install');
        // }

        require('view/home.php');
    }

    function removeServer()
    {
        $serve = htmlspecialchars($_GET['serve']);
        $serve_list=json_decode($_COOKIE['serve_list']);

        $key = array_search($serve, $serve_list);

        unset($serve_list[$key]);
        setcookie('serve_list',json_encode($serve_list));

        echo "<script>document.location.href = 'index.php';</script>";
    }

    function install()
    {
        $system = "Other";
        if (preg_match('/debian/i', php_uname())) {
            $system = "Debian";
        }elseif (preg_match('/redhat/i', php_uname())) {
            $system = "RedHat";
        }

        if(extension_loaded('mongodb') !== false){
            $php_mongo = true;
        }
        else{
            $php_mongo = false;
        }

        $file_compopser = 'composer.json'; 
        $data_composer = file_get_contents($file_compopser);
        if(strpos($data_composer, 'mongodb/mongodb') !== false){
            $composer_mongo = true;
        }
        else{
            $composer_mongo = false;
        }

        $file_json = 'jsoneditor/package.json'; 
        $data_json = file_get_contents($file_json);
        if(strpos($data_json, 'jsoneditor') !== false){
            $jsoneditor = true;
        }
        else{
            $jsoneditor = false;
        }

        require('view/install.php');
    }