<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Open DBMS Server connection
include_once 'openDBMSconnection.php';

$state = true;
$success="";
$error="";


// Get profile data from database (check current session)
session_start();
if (!isset($_SESSION['myusersaw'])) {//se non è loggato torna al form e lo script termina
    //echo "non sei loggato";
    header("Location:accedi.html");
    exit;
}
$email=$_SESSION['myusersaw'];

$stmt = $con->prepare("select nome, cognome from utenti where mail=?");
$stmt->bind_param("s", $email);
$result_ex = $stmt->execute();
$resultRows = $stmt->get_result();

if ($resultRows->num_rows > 0) {
    // output data of each row
    $row = $resultRows->fetch_assoc();
} else {
    exit;
}

$stmt->close();
$first_name=$row["nome"];
$last_name=$row["cognome"];
$email=$_SESSION['myusersaw'];
$_SESSION['mynamesaw']=$first_name;
$_SESSION['mysurnamesaw']=$last_name;
// TODO: format it however you like in this page that shows profile data
/*echo $email; // replace null with $_POST and sanitization
echo $first_name; // replace null with $_POST and sanitization
echo $last_name; // replace null with $_POST and sanitization*/
include_once 'myprofile.php';
