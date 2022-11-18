<?php
    
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];

    require_once 'db.inc.php';
    require_once 'Funkcje.inc.php';

    if(PustePolaLogowania($email, $haslo) !== false){
        header("location: ../Logowanie.php?error=pustepola");
        exit();
    }

    logowanieUzytkownika($mysqli, $email, $haslo);
    
}
else{
    header("location: ../Logowanie.php?error=cosposzlonietak");
    exit();
}
