<?php
include_once 'db.inc.php';

session_start();

$ksiazka = $_POST['produkt_id'];
$czytelnik = $_SESSION['uID'];
$ilosc = $_POST['ilosc_ksiazek'];

//sprawdzenie ile jest książek
$query = "SELECT Ilosc FROM ksiazka WHERE ID = $ksiazka;";
$cos = mysqli_query($mysqli, $query);
$sprawdzenie = mysqli_fetch_array($cos);
$ilosc_ksiazek = $sprawdzenie['Ilosc'];

if($ilosc <=  $sprawdzenie['Ilosc']){
    $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

    $insert = $dbh->prepare("INSERT INTO koszyk(ID_czytelnik, ID_ksiazka, Ilosc) VALUES (?,?,?);");
    $insert->bindParam(1,$czytelnik);
    $insert->bindParam(2,$ksiazka);
    $insert->bindParam(3,$ilosc);

    $insert->execute();

    header("location: ../Produkt.php?id=$ksiazka");
}
else{  
    header("location: ../Produkt.php?id=$ksiazka&error=ZlaIlosc");
}