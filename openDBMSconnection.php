<?php
    $con = new mysqli($mysql_host, $mysql_user, '', $mysql_db);//credenziali
    if ($con->connect_error) {
        die("Errore di connessione: " . $con->connect_errno);
    }