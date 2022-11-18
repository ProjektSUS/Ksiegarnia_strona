<?php

$ksiazka = $_GET['ksiazka'];
$czytelnik = $_GET['czytelnik'];

$dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

$usuwanie = $dbh->prepare("DELETE FROM ulubione WHERE ID_czytelnik = $czytelnik AND ID_ksiazka = $ksiazka;");

$usuwanie ->execute();

header("location: ../Produkt.php?id=$ksiazka");
