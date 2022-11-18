
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

function odblokowanie_pol(){

    document.getElementById("dane_imie").disabled = false;
    document.getElementById("dane_nazwisko").disabled = false;
    document.getElementById("dane_adres").disabled = false;
    document.getElementById("dane_kodPocztowy").disabled = false;
    document.getElementById("dane_rok").disabled = false;
    document.getElementById("dane_miejscowosc").disabled = false;
    document.getElementById("dane_kraj").disabled = false;
    document.getElementById("dane_Telefon").disabled = false;

    var przycisk_zmien = document.getElementById("zmien_dane_wysylkowe");
    var przycisk_zatwierdz = document.getElementById("zatwierdz_dane_wysylkowe");

    przycisk_zmien.style.visibility = "hidden";
    przycisk_zatwierdz.style.visibility = "visible";
    
}

function odblokowanie_polEmail(){

    document.getElementById("dane_email").disabled = false;

    var przycisk_zmien = document.getElementById("zmien_dane_email");
    var przycisk_zatwierdz = document.getElementById("zatwierdz_dane_email");

    przycisk_zmien.style.visibility = "hidden";
    przycisk_zatwierdz.style.visibility = "visible";

}

function odblokowanie_polHaslo(){

    document.getElementById("dane_haslo").disabled = false;
    document.getElementById("dane_hasloPowtorz").disabled = false;

    var przycisk_zmien = document.getElementById("zmien_dane_haslo");
    var przycisk_zatwierdz = document.getElementById("zatwierdz_dane_haslo");

    przycisk_zmien.style.visibility = "hidden";
    przycisk_zatwierdz.style.visibility = "visible";
    
}
