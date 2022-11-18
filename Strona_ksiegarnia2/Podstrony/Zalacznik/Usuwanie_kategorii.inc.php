<?php

$kategoria = $_POST['usun_kategorie'];

$dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

$usuwanie = $dbh->prepare("DELETE FROM kategoria WHERE ID = $kategoria;");

$usuwanie ->execute();

header("location: ../Zalogowany/Menadzer_kategorii.php");
