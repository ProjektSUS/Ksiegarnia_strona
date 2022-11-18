<?php
include_once 'db.inc.php';

$kategoria = $_POST['dodaj_kategorie'];

$query = "SELECT Nazwa FROM `kategoria` WHERE Nazwa = '$kategoria'";
$cos = mysqli_query($mysqli, $query);
$wynik = mysqli_fetch_array($cos);

if(empty($wynik)){

    $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

    $insert = $dbh->prepare("INSERT INTO kategoria(Nazwa) VALUES (?);");
    $insert->bindParam(1, $kategoria);
    $insert->execute();

header("location: ../Zalogowany/Menadzer_kategorii.php");
}
else{
    header("location: ../Zalogowany/Menadzer_kategorii.php?error=IstniejeKategoria");
}
