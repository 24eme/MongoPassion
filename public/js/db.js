
function afficher(){
	var s = document.getElementById("serve").value;
	var serve = s.slice(0, -1);
	var datab = document.getElementById("db").value;
	var db = datab.slice(0, -1);

	var f = document.createElement("form");
	f.setAttribute('method',"post");
	f.setAttribute('action',"index.php?action=createCollection&serve="+serve+"&db="+db);

	var i = document.createElement("input"); //input element, text
	i.setAttribute('type',"text");
	i.setAttribute('name',"name");

	var s = document.createElement("input"); //input element, Submit button
	s.setAttribute('type',"submit");
	s.setAttribute('value',"Create");

	f.appendChild(i);
	f.appendChild(s);

	var span = document.getElementById("nC");

	if (span.getAttribute('flag') == 'true')
		return;
	span.setAttribute('flag', 'true');
	span.appendChild(f);
};


//fonction pour confimer la suppression
function confirmDelete() {
  return confirm("Voulez vous vraiment supprimer");

  
}