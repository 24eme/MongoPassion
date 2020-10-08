

//Fonction de confirmation de la suppression d'un élément

function confirmDelete() {
	return confirm("Do you really want to delete this element ?");
}


//Fonctions qui gèrent l'apparition et la disparition des barres de recherches dans getCollection et getCollection_search

function myFunctionCommand() {
	document.getElementById("searchId").style.display = "none";
	document.getElementById("command").style.display = "block";
	var x = document.getElementById("command");
	// var y = document.getElementById("searchId");
	if (x.style.display === "none") {
    	x.style.display = "block";
    } 

}

function myFunctionSearch() {
	 document.getElementById("command").style.display = "none";
	var x = document.getElementById("searchId");
	// var y = document.getElementById("command");
	if (x.style.display === "none") {
    	x.style.display = "block";
	} 

}


function myFunctionSearchGet() {
	document.getElementById("commandS").style.display = "none";
	var x = document.getElementById("searchIdS");
	if (x.style.display === "none") {
		x.style.display = "block";
	} 

}

function myFunctionCommandGet() {
	document.getElementById("searchIdS").style.display = "none";
	document.getElementById("commandS").style.display = "block";
	var x = document.getElementById("commandS");
	if (x.style.display === "none") {
    	x.style.display = "block";
  	} 

 }


  function myFunctionNewColl(){
    document.getElementById("searchInAllColl").style.display = "none";
	var x = document.getElementById("newColl");
	if (x.style.display === "none") {
    	x.style.display = "block";
  	} 
  	else {
    	x.style.display = "none";
    }

  }

function myFunctionSearchInAllCollections(){
 document.getElementById("newColl").style.display = "none";
	var x = document.getElementById("searchInAllColl");
	if (x.style.display === "none") {
    	x.style.display = "block";
  	} 
  	else {
    	x.style.display = "none";
    }

  }



