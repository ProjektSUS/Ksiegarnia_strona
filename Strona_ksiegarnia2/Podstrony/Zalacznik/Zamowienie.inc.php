<?php
session_start();
include_once 'db.inc.php';

//Dodawanie do tabeli z zamowieniami
$czytelnik = $_SESSION['uID'];
$cena = $_POST['podsumowanie_cena'];
$rabat = $_POST['podsumowanie_rabat'];

//sprawdzenie ile jest książek na stanie
$query11 = "SELECT ko.Ilosc as IloscKoszyk, ko.ID_ksiazka, ks.Ilosc as IloscKsiazka 
            FROM koszyk as ko 
            INNER JOIN ksiazka as ks ON ks.ID = ko.ID_ksiazka 
            WHERE ID_czytelnik = $czytelnik;";
$cos11 = mysqli_query($mysqli, $query11);
$wierszeKoszyk = mysqli_num_rows($cos11);

$query12 = "SELECT ko.Ilosc as IloscKoszyk, ko.ID_ksiazka, ks.Ilosc as IloscKsiazka 
            FROM koszyk as ko 
            INNER JOIN ksiazka as ks ON ks.ID = ko.ID_ksiazka 
            WHERE ID_czytelnik = $czytelnik AND ks.Ilosc >= ko.Ilosc;";
$cos12 = mysqli_query($mysqli, $query12);
$wierszeKsiazka = mysqli_num_rows($cos12);

if ($wierszeKoszyk ==  $wierszeKsiazka) {

    //Tabela zamówienie
    $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");
    $status = 'Nowe';

    if ($rabat == "" || $rabat == " " || $rabat == null) {
        $insert = $dbh->prepare("INSERT INTO zamowienie(Cena_koncowa, ID_czytelnik, StatusZam) VALUES (?, ?, ?);");
        $insert->bindParam(1, $cena);
        $insert->bindParam(2, $czytelnik);
        $insert->bindParam(3, $status);

        $insert->execute();
     
    } else {
        $insert = $dbh->prepare("INSERT INTO zamowienie(Cena_koncowa, Nazwa_rabat, ID_czytelnik, StatusZam) VALUES (?, ?, ?, ?);");
        $insert->bindParam(1, $cena);
        $insert->bindParam(2, $rabat);
        $insert->bindParam(3, $czytelnik);
        $insert->bindParam(4, $status);

        $insert->execute();
    }

    //Tabela szczegóły
    $query = "INSERT INTO zamowienie_ksiazka(ID_zamowienie, ID_ksiazka, Ilosc)
    SELECT (SELECT ID FROM zamowienie WHERE ID_czytelnik = $czytelnik ORDER BY Data_zlozenia DESC LIMIT 1), 
    ID_ksiazka, Ilosc FROM koszyk WHERE ID_czytelnik = $czytelnik;";

    $dbh->query($query);


    //Tabela ksiazka
    $query2 = "SELECT ks.ID, (ks.Ilosc - ko.Ilosc) as nowaIlosc FROM ksiazka as ks INNER JOIN koszyk as ko ON ko.ID_ksiazka = ks.ID WHERE ko.ID_czytelnik = $czytelnik;";
    $cos2 = mysqli_query($mysqli, $query2);

    while ($ilosc = mysqli_fetch_array($cos2)) {
        $nowaIlosc = $ilosc['nowaIlosc'];
        $idKsiazki = $ilosc['ID'];

        $zmienIlosc = $dbh->prepare("UPDATE ksiazka SET Ilosc = $nowaIlosc WHERE ID = $idKsiazki;");
        $zmienIlosc->execute();
    }

    //Usuwanie z koszyka
    $usuwanie = $dbh->prepare("DELETE FROM koszyk WHERE ID_czytelnik = $czytelnik;");
    $usuwanie->execute();

    header("location: ../Koszyk.php?info=UdaloSie&znizka=$rabat");
} 
else {
    
    header("location: ../Koszyk.php?error=IloscSieNieZgadza");
    
}
