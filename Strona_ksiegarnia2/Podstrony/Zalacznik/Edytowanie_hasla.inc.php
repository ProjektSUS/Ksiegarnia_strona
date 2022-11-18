<?php

include_once 'db.inc.php';

$id_uzytkownika = $_GET["uID"];
$haslo = $_POST['dane_haslo'];
$hasloPowtorz = $_POST['dane_hasloPowtorz'];


if ($haslo == $hasloPowtorz){
    $hasloHash = password_hash($haslo, PASSWORD_DEFAULT);

    $sql = ("UPDATE czytelnik
    SET Haslo = '$hasloHash'
    WHERE ID = '$id_uzytkownika';");

    $mysqli -> query($sql);
    header("location: ../Panel_uzytkownika.php");

}
else{
    header("location: ../Panel_uzytkownika.php?error=RozneHasla");
}
