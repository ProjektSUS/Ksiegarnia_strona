<?php
include_once 'Naglowek_zal.php';
?>

<script src="../../Js/funkcje.js"></script>

<!----Główna zawartość strony-->
<div class="zawartosc_panel">
    <div class="menu_lewo">
        <ul>
            <h3>Dane użytkownika</h3>
            <ul>
                <li><a href="../Panel_uzytkownika.php">Dane</a></li>

            </ul>
            <h3>Moje konto</h3>
            <ul>
                <li><a href="Zamowienia.php">Zamówienia</a></li>
                <li><a href="Ulubione.php">Ulubione</a></li>
            </ul>

            <?php
            $idUz = $_SESSION['uID'];
            $uTyp = $_SESSION["uTyp"];

            if ($uTyp === "Admin") {
                echo "<h3>Panel admina</h3>
                    <ul>
                        <li><a href='Menadzer_kategorii.php'>Menadżer kategorii</a></li>
                        <li><a href='Menadzer_ksiazek.php'>Menadżer książek</a></li>
                        <li><a href='Menadzer_zamowien.php'>Menadżer zamówień</a></li>
                        <li><a href='Menadzer_znizek.php'>Menadżer zniżek</a></li>
                    </ul>";
            }
            ?>
        </ul>
    </div>

    <div class="menu_prawa_strona">
        <h2> Menadżer książek </h2>
        <h3>Dodawanie</h3>

        <form method="POST" action="../Zalacznik/Menadzer_dodajKsiazke.inc.php" enctype="multipart/form-data">
            <div class="panel_dane">
                <h3><b>Zdjęcie: </b></h3>
                    <input type="file" id="zdjecie_dodaj" name="zdjecie_dodaj">
            </div>

            <div class="panel_dane">
                <h3><b>Tytuł: </b></h3>
                    <input type="text" id="tytul_dodaj" name="tytul_dodaj">
            </div>

            <div class="panel_dane">
                <h3><b>Autor: </b></h3>
                    <input type="text" id="autor_dodaj" name="autor_dodaj">
            </div>

            <div class="panel_dane">
                <h3><b>Rok wydania: </b></h3>
                    <input type="text" id="rok_wydania_dodaj" name="rok_wydania_dodaj">
            </div>

            <div class="panel_dane">
                <h3><b>Ilość: </b></h3>
                    <input type="text" id="ilosc_dodaj" name="ilosc_dodaj" >
            </div>

            <div class="panel_dane">
                <h3><b>Kategoria: </b></h3>
                <ul>
                    <nav class="menu_kategorie">
                        <select id="kategorie_dodaj" name = "kategorie_dodaj">
                            <?php
                            $sth = mysqli_query($mysqli, "SELECT * From kategoria");
                            while ($res = mysqli_fetch_array($sth)) {
                                echo '<option value="'.$res['ID'].'">'. $res['Nazwa'].'</option>';
                            }
                            ?>
                        </select>
                    </nav>
                </ul>
            </div>

            <div class="panel_dane">
                <h3><b>Wydawnictwo: </b></h3>
                    <input type="text" id="wydawnictwo_dodaj" name="wydawnictwo_dodaj">
            </div>

            <div class="panel_dane">
                <h3><b>Cena: </b></h3>
                    <input type="text" id="cena_dodaj" name="cena_dodaj">
            </div>

            <div class="panel_dane">
                <h3><b>Opis: </b></h3>
                    <textarea class="textarea_dodajKs" name="textarea_dodajKs"></textarea>
            </div>

            <div class="panel_dane">
                <button type="submit">Dodaj książkę</button>
            </div>
        </form>

    </div>
</div>
</div>
</div>


<!----Stopka-->
<?php
include 'Stopka_zal.php';
?>