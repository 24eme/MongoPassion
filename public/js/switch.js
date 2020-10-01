
// Fonction qui gère l'apparition et la disparition de JsonEditor en fonction de l'état du switch

function switchJ() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var json = document.getElementById("json");
  var main = document.getElementById("main");


  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    json.style.display = "block";
    main.style.display = "none";
  } else {
    json.style.display = "none";
    main.style.display = "block";
  }
}