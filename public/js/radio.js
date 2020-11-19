// Fonction qui gère le nombre de documents affichés par page

function bypage(select)
{
    var nb = select.options[select.selectedIndex].text

    var url = window.location.search
    var parameters = new URLSearchParams(url)

    parameters.delete('bypage')
    parameters.set('bypage', nb)

    document.location.href = '?'+parameters.toString()

}

function bypage_search(select)
{
    var nb = select.options[select.selectedIndex].text
    var key_c = document.getElementById("clé_c").innerHTML;
    var valeur_c = document.getElementById("valeur_c").value;
    var key_q = document.getElementById("clé_q").innerHTML;
    var valeur_q = document.getElementById("valeur_q").value;
    var key_p = document.getElementById("clé_p").innerHTML;
    var valeur_p = document.getElementById("valeur_p").value;

    var url = window.location.search
    var parameters = new URLSearchParams(url)

    parameters.delete('bypage')
    parameters.set('bypage', nb)

    parameters.set(key_c, valeur_c)
    parameters.set(key_q, valeur_q)
    parameters.set(key_p, valeur_p)

    document.location.href = '?'+parameters.toString()
}
