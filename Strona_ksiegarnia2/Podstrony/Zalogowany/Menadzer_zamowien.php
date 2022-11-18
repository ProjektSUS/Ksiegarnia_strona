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
        <h2> Menadżer zamówień </h2>
        <div class="tabelka_menadzer_zamowien">

            <ul>
                <nav class="menu_status_zamowienia">
                    <select id="status_zamowienia" onchange="ladowanie_zamowien()">
                        <option>Wybierz z listy</option>';
                        <option value="Nowe">Nowe</option>';
                        <option value="Zaksiegowane">Zaksięgowane</option>';
                        <option value="Wyslane">Wysłane</option>';
                        <option value="Anulowane">Anulowane</option>';
                    </select>
                </nav>
            </ul>

            <div id="zamowienia">
                <?php

                ?>
            </div>
        </div>
    </div>
</div>


</div>
</div>


<!----Stopka-->
<?php
include 'Stopka_zal.php';
?>