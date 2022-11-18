<?php

include_once 'db.inc.php';

$nazwa = $_POST['dodaj_znizke'];
$wartosc = $_POST['dodaj_wartosc'];
$statusZnizki = "Nieaktywny";

$query = "SELECT Nazwa_rabat FROM rabat WHERE Nazwa_rabat = '$nazwa';";
$cos = mysqli_query($mysqli, $query);
$sprawdzenie = mysqli_fetch_array($cos);

if(!empty($sprawdzenie)){
    header("location: ../Zalogowany/Menadzer_znizek.php?znizka=IstniejeZnizka");
}
else{

    $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

    $insert = $dbh->prepare("INSERT INTO rabat(Nazwa_rabat, Wartosc, StatusZnizki) VALUES (?, ?, ?);");
    $insert->bindParam(1, $nazwa);
    $insert->bindParam(2, $wartosc);
    $insert->bindParam(3, $statusZnizki);

    $insert->execute();

    header("location: ../Zalogowany/Menadzer_znizek.php?znizka=DodanoZnizke");
}