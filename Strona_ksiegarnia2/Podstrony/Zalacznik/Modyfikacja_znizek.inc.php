<?php

include_once 'db.inc.php';

$nazwa = $_GET['nazwa'];
$statusAktywny = 'Aktywny';
$statusNieaktywny = 'Nieaktywny';

$query = "SELECT StatusZnizki FROM rabat WHERE Nazwa_rabat = '$nazwa';";
$cos = mysqli_query($mysqli, $query);
$sprawdzenie = mysqli_fetch_array($cos);
$sprawdzenieZnizki = $sprawdzenie['StatusZnizki'];

if($sprawdzenieZnizki == $statusAktywny){

    $sql = ("UPDATE rabat SET StatusZnizki = '$statusNieaktywny' WHERE Nazwa_rabat = '$nazwa';");
    $mysqli -> query($sql);

    header("location: ../Zalogowany/Menadzer_znizek.php?status=ZmienionoNaNieaktywny");
}
else if ($sprawdzenieZnizki == $statusNieaktywny){

    $sql = ("UPDATE rabat SET StatusZnizki = '$statusAktywny' WHERE Nazwa_rabat = '$nazwa';");
    $mysqli -> query($sql);

    header("location: ../Zalogowany/Menadzer_znizek.php?status=ZmienionoNaAktywny");
}
else{
    echo 
    '<script>
        alert("Coś poszło nie tak, skontaktuj się z administratorem bazy danych");
    </script?';
}

header("location: ../Zalogowany/Menadzer_znizek.php?status=$nazwa");