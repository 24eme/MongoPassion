
// Fonction qui gère le nombre de documents affichés par page

function bypage()
{
	var s10 = document.getElementById("10");
	var s20 = document.getElementById("20");
	var s30 = document.getElementById("30");
	var s50 = document.getElementById("50");

	if(s10.selected){
		var select = s10;
	}
	else if(s20.selected){
		var select = s20;
	}
	else if(s30.selected){
		var select = s30;
	}
	else if(s50.selected){
		var select = s50;
	}

	var link = document.location.href+'&bypage='+select.value;



	document.location.href = link;

}

function bypage_search()
{
	var s10 = document.getElementById("10");
	var s20 = document.getElementById("20");
	var s30 = document.getElementById("30");
	var s50 = document.getElementById("50");

	var clé = document.getElementById("clé").innerHTML;
	var valeur = document.getElementById("valeur").value;

	if(s10.selected){
		var select = s10;
	}
	else if(s20.selected){
		var select = s20;
	}
	else if(s30.selected){
		var select = s30;
	}
	else if(s50.selected){
		var select = s50;
	}

	var link = document.location.href+'&bypage='+select.value+'&'+clé+'='+valeur;

	document.location.href = link;
	
}