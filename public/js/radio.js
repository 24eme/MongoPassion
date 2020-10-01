
// Fonction qui gère le nombre de documents affichés par page

function bypage()
{
	var r10 = document.getElementById("10");
	var r20 = document.getElementById("20");
	var r30 = document.getElementById("30");
	var r50 = document.getElementById("50");

	if(r10.checked){
		var radio = r10;
	}
	else if(r20.checked){
		var radio = r20;
	}
	else if(r30.checked){
		var radio = r30;
	}
	else if(r50.checked){
		var radio = r50;
	}

	var link = document.location.href+'&bypage='+radio.value;

	document.location.href = link;

}

function bypage_search()
{
	var r10 = document.getElementById("10");
	var r20 = document.getElementById("20");
	var r30 = document.getElementById("30");
	var r50 = document.getElementById("50");

	var clé = document.getElementById("clé").innerHTML;
	var valeur = document.getElementById("valeur").value;

	if(r10.checked){
		var radio = r10;
	}
	else if(r20.checked){
		var radio = r20;
	}
	else if(r30.checked){
		var radio = r30;
	}
	else if(r50.checked){
		var radio = r50;
	}

	var link = document.location.href+'&bypage='+radio.value+'&'+clé+'='+valeur;

	document.location.href = link;
	
}