<?php
/*
$mysql_host = "localhost";

// TODO: use your credentials here
$mysql_user = "S4538910";
$mysql_pass = "SamuMassi897";
$mysql_db = "S4538910";

$con = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);//credenziali
if ($con->connect_error) {
    die("Errore di connessione: " . $con->connect_errno);
}
*/
$mysql_host = "localhost";

// TODO: use your credentials here
$mysql_user = "root";
$mysql_pass = "";
$mysql_db = "saw";

$con = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_db);//credenziali
if ($con->connect_error) {
    die("Errore di connessione: " . $con->connect_errno);
}