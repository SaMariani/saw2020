<?php

require_once('mysql_credentials.php');

$con = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);//credenziali
if ($con->connect_error) {
    die("Errore di connessione: " . $con->connect_errno);
}