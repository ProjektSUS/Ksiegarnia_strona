<?php

if(isset($_POST["submit"])){
    
    $imie = $_POST['Imie'];
    $nazwisko = $_POST['Nazwisko'];
    $miejscowosc = $_POST['Miejscowosc'];
    $rok_urodzenia = $_POST['Rok_urodzenia'];
    $kod_pocztowy = $_POST['Kod_pocztowy'];
    $adres = $_POST['Adres'];
    $numer_telefonu = $_POST['Telefon'];
    $kraj = $_POST['Kraj'];
    $email = $_POST['Mail'];
    $haslo = $_POST['Haslo'];
    $powtorz_haslo = $_POST['Haslo_powtorz'];
    $typ_konta = "Użytkownik";

    require_once 'db.inc.php';
    require_once 'Funkcje.inc.php';

    if(PustePolaRejestracja($imie, $nazwisko, $kod_pocztowy, $miejscowosc, $adres, $kraj, $numer_telefonu, $email, $haslo, $powtorz_haslo) !== false){
        header("location: ../Rejestracja.php?error=pustepola");
        exit();
    }
    if(NiepoprawnyEmail($email) !== false){
        header("location: ../Rejestracja.php?error=niepoprawnyEmail");
        exit();
    }
    if(RozneHasla($haslo, $powtorz_haslo) !== false){
        header("location: ../Rejestracja.php?error=roznehasla");
        exit();
    }
    if(EmailIstnieje($mysqli, $email) !== false){
        header("location: ../Rejestracja.php?error=emailistnieje");
        exit();
    }

    StworzUzytkownika($mysqli, $imie, $nazwisko, $rok_urodzenia, $kod_pocztowy, $miejscowosc, $adres, $kraj, $numer_telefonu, $email, $haslo, $typ_konta);
   

}
else{
    header("location: ../Rejestracja.php?error=submitNieDziala");
    exit();
}