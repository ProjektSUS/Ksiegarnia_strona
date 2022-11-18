<?php

$ksiazka = $_GET['ksiazka'];
$czytelnik = $_GET['czytelnik'];

$dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

$insert = $dbh->prepare("INSERT INTO ulubione(ID_czytelnik, ID_ksiazka) VALUES (?, ?);");
$insert->bindParam(1,$czytelnik);
$insert->bindParam(2,$ksiazka);

$insert->execute();

header("location: ../Produkt.php?id=$ksiazka");
