<?php

$tytul = $_POST['tytul_dodaj'];
$autor = $_POST['autor_dodaj'];
$rok_wydania = $_POST['rok_wydania_dodaj'];
$ilosc = $_POST['ilosc_dodaj'];
$kategoria = $_POST['kategorie_dodaj'];
$wydawnictwo = $_POST['wydawnictwo_dodaj'];
$cena = $_POST['cena_dodaj'];
$opis = $_POST['textarea_dodajKs'];

$zdjecie = $_FILES['zdjecie_dodaj'];
$zdjecieSciezka = $_FILES['zdjecie_dodaj']['tmp_name'];
$zdjecieNazwa = $_FILES['zdjecie_dodaj']['name'];
$zdjecieRozmiar = $_FILES['zdjecie_dodaj']['size'];
$zdjecieBlad = $_FILES['zdjecie_dodaj']['error'];
$zdjecieTyp = $_FILES['zdjecie_dodaj']['type'];

$zdjecieRozszerzenie = explode('.', $zdjecieNazwa);
$zdjecieRoz = strtolower(end($zdjecieRozszerzenie));
$zdjecieDozwolone = array('jpg', 'jpeg', 'png');

if(in_array($zdjecieRoz, $zdjecieDozwolone)){
    if($zdjecieBlad === 0){
       if($zdjecieRozmiar < 16777215){
        $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

        $insert = $dbh->prepare("INSERT INTO ksiazka(Tytul, Autor, Rok_wydania, Ilosc, ID_kategoria, Wydawnictwo, Cena, Zdjecie, Opis) VALUES (?, ?, ?, ?, ?, ?, ?, LOAD_FILE(?), ?);");
        $insert->bindParam(1,$tytul);
        $insert->bindParam(2,$autor);
        $insert->bindParam(3,$rok_wydania);
        $insert->bindParam(4,$ilosc);
        $insert->bindParam(5,$kategoria);
        $insert->bindParam(6,$wydawnictwo);
        $insert->bindParam(7,$cena);
        $insert->bindParam(8,$zdjecieSciezka);
        $insert->bindParam(9,$opis);

        $insert->execute();

        header("location: ../Zalogowany/Menadzer_ksiazek.php?error=UdaloSie&roz=$zdjecieSciezka");
       }else{
            echo 'Zbyt duży plik!';
            header("location: ../Zalogowany/Menadzer_ksiazek.php?error=ZbytDuzyPlik");
       } 
    }else{
        echo 'Pojawił się nieoczkiwany błąd. Spróbuj ponownie później';
        header("location: ../Zalogowany/Menadzer_ksiazek.php?error=blad");
    }
}else{
    echo 'Niedozwolone rozszerzenie pliku! Dozwolone rozszerzenia: jpg, jpeg, png';
    header("location: ../Zalogowany/Menadzer_ksiazek.php?error=ZleRozszerzenie&roz=$zdjecieRoz&size=$zdjecieRozmiar&error=$zdjecieBladz&name=$zdjecieNazwa");
}

