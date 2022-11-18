<?php
session_start();

require_once 'Zalacznik/db.inc.php';
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Księgarnia</title>
    <link rel="stylesheet" href="../CSS/wyglad_strony.css">
    <link rel="stylesheet" href="../CSS/logowanie.css">
    <link rel="stylesheet" href="../CSS/kod_rabatowy.css">
    <link rel="stylesheet" href="../CSS/produkt.css">
    <link rel="stylesheet" href="../CSS/panel.css">
    <link rel="stylesheet" href="../CSS/kategorie.css">
    <link rel="stylesheet" href="../CSS/faq.css">
    <link rel="stylesheet" href="../CSS/regulamin.css">
    <link rel="stylesheet" href="../CSS/koszyk.css">
    <script type="text/javascript" src="./../js/javascript.js"></script>
    <script src="./../js/jquery.min.js"></script>
    <script src="./../js/bootstrap.min.js"></script>
</head>

<body>

    <!----Header-->
    <header>
        <div id="header_content">
            <div class="header_logo">
                <a href="../index.php"><img src="../Grafiki/Logo.png" alt="LOGO" class="logo"></a>
            </div>

            <div class="header_przyciski_uzytkownik">

                <?php
                if (isset($_SESSION["uID"])){
                    echo '<span id="header_przycisk">
                            <a href="Koszyk.php"><button type="button" class="koszyk">Koszyk</button></a>
                            <a href="Panel_uzytkownika.php"><button type="button" class="zaloguj">Profil</button></a>
                            <a href="Zalacznik/Wylogowanie.inc.php"><button type="button" class="zaloguj">Wyloguj się</button></a>
                        </span>';
                }
                else {
                    echo '<span id="header_przycisk">
                        <a href="Logowanie.php"><button type="button" class="zaloguj">Zaloguj się</button></a>
                        </span>';
                }
                ?>
            </div>
        </div>
    </header>

    <!----Menu-->
    <div id="strona_calosc">
        <nav class="menu">
            <ul>
                <li><a href="../index.php">Strona główna</a></li>
                <li><a href="Kategorie.php">Kategorie</a></li>
                <li><a href="FAQ.php">FAQ</a></li>
                <li class="ostatni_element_menu"><a href="O_sklepie.php">O sklepie</a></li>
            </ul>
        </nav>

        <div id="zawartosc_strony">