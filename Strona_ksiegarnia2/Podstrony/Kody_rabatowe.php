<?php
    include_once 'Naglowek.php';
    include_once 'Zalacznik/db.inc.php';
?> 

<!---Wracanko UwU-->
<div id="przycisk_wracanka">
        <button onclick="history.back()" class="przycisk_powrotu"> << Powrót</button>
</div>

<!----Główna zawartość strony-->
        <div id="Kod_rabatowy">
            <H2>Nasze aktualnie kody rabatowe:</H2>
            <?php
            $query = "SELECT Nazwa_rabat, Wartosc FROM rabat WHERE StatusZnizki = 'Aktywny'";
            $cos = mysqli_query($mysqli, $query);
            while ($znizka = mysqli_fetch_array($cos)) {
                echo '<p><b>'.$znizka['Nazwa_rabat'].'</b> - zniżka '.$znizka['Wartosc'].'% na zamówienie</p>';
            }

                
            ?>
            <br>
            <p>Kody rabatowe są aktualizowane na stronie oraz dodatkowo rozsyłane, w okresie świąt, zarejestrowanym użytkownikom w naszym serwisie</p>
        </div> 

    </div>        
</div>


<!----Stopka-->
<?php
    include 'Stopka.php';
?>