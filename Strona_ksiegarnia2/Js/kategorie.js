
function ladowanie_kategorii(){
    var xhttp;
    var kategorie = document.getElementById("kategorie").value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("kategorie_produkty").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Zalacznik/Kategorie_wyszukaj.inc.php?kat=" + kategorie, true);
    xhttp.send();
}