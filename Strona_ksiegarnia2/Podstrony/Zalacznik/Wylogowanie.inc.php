<?php

    session_start();
    session_unset();
    session_destroy();

    $url = "http://localhost/Strona_ksiegarnia/index.php";
    $headers = @get_headers($url);
    
    if($headers){
        header("location: ../../index.php");
        exit();
    }
    else{
        header("location: index.php");
        exit();
    }
    