<?php
session_start();

$id_czytelnika = $_SESSION['uID'];
$numer_produktu = $_POST['usun_pozycje'];

$dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

$usuwanie = $dbh->prepare("DELETE FROM koszyk WHERE ID_ksiazka = $numer_produktu AND ID_czytelnik = $id_czytelnika;");

$usuwanie ->execute();

header("location: ../Koszyk.php");
