<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "ksiegarnia";

//Połączenie 1
$mysqli = new mysqli($host, $username, $password, $db);

if ($mysqli -> connect_errno) {
    echo "Problem z łączniem z bazą danych: " . $mysqli -> connect_error;
    exit();
}
