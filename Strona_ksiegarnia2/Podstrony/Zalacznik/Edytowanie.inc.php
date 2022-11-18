<?php

include_once 'db.inc.php';

$id_uzytkownika = $_GET["uID"];
$imie = $_POST['dane_imie'];
$nazwisko = $_POST['dane_nazwisko'];
$rok_urodzenia = $_POST['dane_rok'];
$kod_pocztowy = $_POST['dane_kodPocztowy'];
$miejscowosc = $_POST['dane_miejscowosc'];
$adres = $_POST['dane_adres'];
$kraj = $_POST['dane_kraj'];
$telefon = $_POST['dane_Telefon'];


$sql = ("UPDATE czytelnik
SET Imie = '$imie', Nazwisko = '$nazwisko', Rok_urodzenia = '$rok_urodzenia', 
Kod_pocztowy = '$kod_pocztowy', Miejscowosc = '$miejscowosc', 
Adres = '$adres', Kraj = '$kraj', Telefon = '$telefon'
WHERE ID = '$id_uzytkownika';");

$mysqli -> query($sql);

header("location: ../Panel_uzytkownika.php");