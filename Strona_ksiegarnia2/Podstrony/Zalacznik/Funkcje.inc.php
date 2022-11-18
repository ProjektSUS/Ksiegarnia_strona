<?php
$typ_konta = "Użytkownik";

function PustePolaRejestracja($imie, $nazwisko, $miejscowosc, $kod_pocztowy, $adres, $numer_telefonu, $kraj, $email, $haslo, $powtorz_haslo){
    $wynik = false;
    if(empty($imie) || empty($nazwisko) || empty($miejscowosc) || empty($kod_pocztowy) || empty($adres) || empty($numer_telefonu) || empty($kraj) || empty($email) || empty($imie) || empty($powtorz_haslo)){
        $wynik = true;
    }
    else{
        $wynik = false;
    }
    return $wynik;
}

function NiepoprawnyEmail($email){
    $wynik = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $wynik = true;
    }
    else{
        $wynik = false;
    }
    return $wynik;
}
      
function RozneHasla($haslo, $powtorz_haslo){
    $wynik = false;
    if($haslo !== $powtorz_haslo){
        $wynik = true;
    }
    else{
        $wynik = false;
    }
    return $wynik;
}   

function EmailIstnieje($mysqli, $email){
    $query = "SELECT * FROM czytelnik WHERE Mail = ?;";
    $stmt = mysqli_stmt_init($mysqli);
    if(!mysqli_stmt_prepare($stmt, $query)){
        header("location: ../Rejestracja.php?error=MailIstnieje");
        exit(); 
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
} 

function StworzUzytkownika($mysqli, $imie, $nazwisko, $rok_urodzenia, $kod_pocztowy, $miejscowosc, $adres, $kraj, $numer_telefonu, $email, $haslo, $typ_konta){
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=ksiegarnia", "root", "");

        $hash_haslo = password_hash($haslo, PASSWORD_DEFAULT);

        if($rok_urodzenia == 0){
            $rok_urodzenia = NULL;
        }

        $insert = $dbh->prepare("INSERT INTO czytelnik(Imie, Nazwisko, Rok_urodzenia, Kod_pocztowy, Miejscowosc, Adres, Kraj, Telefon, Mail, Haslo, Typ_konta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        $insert->bindParam(1,$imie);
        $insert->bindParam(2,$nazwisko);
        $insert->bindParam(3,$rok_urodzenia);
        $insert->bindParam(4,$kod_pocztowy);
        $insert->bindParam(5,$miejscowosc);
        $insert->bindParam(6,$adres);
        $insert->bindParam(7,$kraj);
        $insert->bindParam(8,$numer_telefonu);
        $insert->bindParam(9,$email);
        $insert->bindParam(10,$hash_haslo);
        $insert->bindParam(11,$typ_konta);

        $insert->execute();

        header("location: ../Rejestracja_udana.php");
        exit(); 

    } catch(PDOException $e) {
        $_SESSION['error'] = 'Połączenie nie mogło zostać utworzone: '.$e->getMessage();
    }
} 

function PustePolaLogowania($email, $haslo){
    $wynik = false;
    if(empty($email) || empty($haslo)){
        $wynik = true;
    }
    else{
        $wynik = false;
    }
    return $wynik;
}

function logowanieUzytkownika($mysqli, $email, $haslo){
    $emailIstnieje = EmailIstnieje($mysqli, $email);

    if($emailIstnieje == false){
        header("location: ../Logowanie.php?error=emailnieistnieje");
        exit();
    }

    $hasloHashowane = $emailIstnieje["Haslo"];
    $hasloSprawdz = password_verify($haslo, $hasloHashowane);

    if($hasloSprawdz == false){
        header("location: ../Logowanie.php?error=zlehaslo");
        exit();
    }
    else if($hasloSprawdz == true){
        session_start();
        // u = uzytkownik || Dane użytkownika: ID, Mail, Typ konta
        $_SESSION["uID"] = $emailIstnieje["ID"];
        $_SESSION["uMail"] = $emailIstnieje["Mail"];
        $_SESSION["uTyp"] = $emailIstnieje["Typ_konta"];

        header("location: ../../index.php");
        exit();
    }

}