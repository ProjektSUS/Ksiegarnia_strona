<?php

include_once 'db.inc.php';

$id_uzytkownika = $_GET["uID"];
$email = $_POST['dane_email'];

$sql = ("UPDATE czytelnik SET Mail = '$email' WHERE ID = '$id_uzytkownika';");

$mysqli -> query($sql);

header("location: ../Panel_uzytkownika.php");