
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

function ladowanie_zamowien(){
    var xhttp;
    var zamowienia = document.getElementById("status_zamowienia").value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("zamowienia").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../Zalacznik/Zamowienie_wyszukaj.inc.php?zam=" + zamowienia, true);
    xhttp.send();
}

function zmienianie_zamowien(id){
    var xhttp;
    var numer_zam = document.getElementById("numer_zamowionka"+id).value;
    var wartosc = document.getElementById("zmien_status_zamowienia"+id).value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            ladowanie_zamowien();
        }
    };
    
    xhttp.open("POST", "../Zalacznik/Zamowienie_zmien.inc.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("stat=" + wartosc + "&numer_zam=" + numer_zam);

    alert("Zamówienie o numerze " + numer_zam + " zostało dodane do: " + wartosc);
}

window.onload = function babelZnikaj(){
    setTimeout(() => {
        document.getElementById('babel').style.display = "none";
    }, 4000);
}