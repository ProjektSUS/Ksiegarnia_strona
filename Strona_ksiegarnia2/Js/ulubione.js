
function przekazanie_danych_ulubione(ksiazka, czytelnik){
    var xhttp;

    xhttp = new XMLHttpRequest();

    xhttp.open("GET", "Zalacznik/ulubione.inc.php?ksiazka=" + ksiazka + "&czytelnik=" + czytelnik, true);
    xhttp.send();

    document.location.reload();
}

function usuwanie_danych_ulubione(ksiazka, czytelnik){
    var xhttp;

    xhttp = new XMLHttpRequest();

    xhttp.open("GET", "Zalacznik/ulubione_usun.inc.php?ksiazka=" + ksiazka + "&czytelnik=" + czytelnik, true);
    xhttp.send();

    document.location.reload();
}