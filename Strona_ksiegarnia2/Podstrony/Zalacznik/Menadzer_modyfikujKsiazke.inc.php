<?php
include_once 'db.inc.php';

$ID_ksiazka = $_POST['id_modyfikacja'];
$tytul = $_POST['tytul_modyfikuj'];
$autor = $_POST['autor_modyfikuj'];
$rok_wydania = $_POST['rok_wydania_modyfikuj'];
$ilosc = $_POST['ilosc_modyfikuj'];
$kategoria = $_POST['kategorie_modyfikuj'];
$wydawnictwo = $_POST['wydawnictwo_modyfikuj'];
$cena = $_POST['cena_modyfikuj'];
$opis = $_POST['textarea_modyfikuj'];

$zdjecie = $_FILES['zdjecie_modyfikuj'];
$zdjecieSciezka = $_FILES['zdjecie_modyfikuj']['tmp_name'];
$zdjecieNazwa = $_FILES['zdjecie_modyfikuj']['name'];
$zdjecieRozmiar = $_FILES['zdjecie_modyfikuj']['size'];
$zdjecieBlad = $_FILES['zdjecie_modyfikuj']['error'];
$zdjecieTyp = $_FILES['zdjecie_modyfikuj']['type'];

$zdjecieRozszerzenie = explode('.', $zdjecieNazwa);
$zdjecieRoz = strtolower(end($zdjecieRozszerzenie));
$zdjecieDozwolone = array('jpg', 'jpeg', 'png');

$sth = mysqli_query($mysqli, "SELECT * From ksiazka WHERE ID = $ID_ksiazka");
$ksiazkaInfo = mysqli_fetch_array($sth);

if ($tytul != null && $tytul != $ksiazkaInfo['Tytul'] && $tytul != " " && $tytul != "") {
    $sql = ("UPDATE ksiazka SET Tytul = '$tytul' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if ($autor != null && $autor != $ksiazkaInfo['Autor'] && $autor != " " && $autor != "") {
    $sql = ("UPDATE ksiazka SET Autor = '$autor' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if ($rok_wydania != null && $rok_wydania != $ksiazkaInfo['Rok_wydania'] && $rok_wydania != " " && $rok_wydania != "") {
    $sql = ("UPDATE ksiazka SET Rok_wydania = '$rok_wydania' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if ($ilosc != null && $ilosc != $ksiazkaInfo['Ilosc'] && $ilosc != " " && $ilosc != "") {
    $sql = ("UPDATE ksiazka SET Ilosc = '$ilosc' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if ($kategoria != null && $kategoria != $ksiazkaInfo['ID_kategoria'] && $kategoria != " " && $kategoria != "") {
    $sql = ("UPDATE ksiazka SET ID_kategoria = '$kategoria' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if ($wydawnictwo != null && $wydawnictwo != $ksiazkaInfo['Wydawnictwo'] && $wydawnictwo != " " && $wydawnictwo != "") {
    $sql = ("UPDATE ksiazka SET Wydawnictwo = '$wydawnictwo' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if ($cena != null && $cena != $ksiazkaInfo['Cena'] && $cena != " " && $cena != "") {
    $sql = ("UPDATE ksiazka SET Cena = '$cena' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

if (in_array($zdjecieRoz, $zdjecieDozwolone)) {
    if ($zdjecieBlad === 0) {
        if ($zdjecieRozmiar < 16777215) {

            $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

            $insert = $dbh->prepare("UPDATE ksiazka SET Zdjecie = LOAD_FILE(?) WHERE ID = '$ID_ksiazka';");
            $insert->bindParam(1,$zdjecieSciezka);
            $insert->execute();

        } else {
            echo 'Zbyt duży plik!';
            header("location: ../Produkt.php?id=$ID_ksiazka&error=ZbytDuzyPlik");
        }
    } else {
        echo 'Pojawił się nieoczkiwany błąd. Spróbuj ponownie później';
        header("location: ../Produkt.php?id=$ID_ksiazka&error=blad");
    }
} else {
    echo 'Niedozwolone rozszerzenie pliku! Dozwolone rozszerzenia: jpg, jpeg, png';
    header("location:  ../Produkt.php?id=$ID_ksiazka&error=ZleRozszerzenie");
}


if ($opis != null && $opis != $ksiazkaInfo['Opis'] && $opis != " " && $opis != "") {
    $sql = ("UPDATE ksiazka SET Opis = '$opis' WHERE ID = '$ID_ksiazka';");
    $mysqli->query($sql);
}

header("location: ../Produkt.php?id=$ID_ksiazka");
