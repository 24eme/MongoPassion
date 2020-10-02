

//Fonction de confirmation de la suppression d'un élément

function confirmDelete() {
	return confirm("Do you really want to delete this element ?");
}


//Fonctions qui gèrent l'apparition et la disparition des barres de recherches dans getCollection et getCollection_search

function myFunctionCommand() {
	document.getElementById("searchId").style.display = "none";
	var x = document.getElementById("command");
	if (x.style.display === "none") {
    	x.style.display = "block";
    } 
	else {
		x.style.display = "none";
	}
}

function myFunctionSearch() {
	document.getElementById("command").style.display = "none";
	var x = document.getElementById("searchId");
	if (x.style.display === "none") {
    	x.style.display = "block";
	} 
	else {
    	x.style.display = "none";
	}
}


function myFunctionSearchGet() {
	document.getElementById("commandS").style.display = "none";
	var x = document.getElementById("searchIdS");
	if (x.style.display === "none") {
		x.style.display = "block";
	} 
	else {
		x.style.display = "none";
	}
}

function myFunctionCommandGet() {
	document.getElementById("searchIdS").style.display = "none";
	var x = document.getElementById("commandS");
	if (x.style.display === "none") {
    	x.style.display = "block";
  	} 
  	else {
    	x.style.display = "none";
    }

 }


  function myFunctionNewColl(){
 
	var x = document.getElementById("newColl");
	if (x.style.display === "none") {
    	x.style.display = "block";
  	} 
  	else {
    	x.style.display = "none";
    }


  }



