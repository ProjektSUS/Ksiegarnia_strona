<?php

require_once 'db.inc.php';
$kategoria = $_GET['kat'];

if ($kategoria == 0) {
    $sql = "SELECT * FROM ksiazka";
    $rezultat_zapytania = mysqli_query($mysqli, $sql);
} else {
    $sql = "SELECT * FROM ksiazka where ID_kategoria = ?";
    $stmt = mysqli_stmt_init($mysqli);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $kategoria);
    mysqli_stmt_execute($stmt);
    $rezultat_zapytania = mysqli_stmt_get_result($stmt);
}

while ($res = mysqli_fetch_assoc($rezultat_zapytania)) {

    ?>
        <a href = "Produkt.php?id=<?php echo $res['ID'] ?>">
    <?php
    
    echo '<div class="hity_tekst">
            <div class="okladka">
                <li><img src="data:image/jpeg;base64,' . base64_encode($res['Zdjecie']) . '" width = "150px"/></li>
            </div>   
            <div class = "podpis">
                <p class = "podpis_tytul"> <b>' . $res['Tytul'] . ' </b></p>
                <p> ' . $res['Autor'] . '</p>
                
                <p> ' . $res['Cena'] . ' zł</p>
            </div>
            </a>   
        </div>';
}
