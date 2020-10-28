// Fonction qui gère le nombre de documents affichés par page

function bypage(select)
{
    var nb = select.options[select.selectedIndex].text

    var url = window.location.search
    var parameters = new URLSearchParams(url)

    parameters.delete('bypage')
    parameters.set('bypage', nb)

    document.location.href = '/?'+parameters.toString()

}

function bypage_search(select)
{
    var nb = select.options[select.selectedIndex].text
    var key = document.getElementById("clé").innerHTML;
    var valeur = document.getElementById("valeur").value;

    var url = window.location.search
    var parameters = new URLSearchParams(url)

    parameters.delete('bypage')
    parameters.set('bypage', nb)

    parameters.set(key, valeur)

    document.location.href = '?'+parameters.toString()
}
