<?php
include_once 'db.inc.php';

$numer_zam = $_POST["numer_zam"];
$status = $_POST['stat'];

$sql = ("UPDATE zamowienie SET StatusZam = '$status' WHERE ID = $numer_zam;");

$mysqli -> query($sql);

header("location: ../Zalogowany/Menadzer_zamowien.php?stat=$status&numer=$numer_zam");