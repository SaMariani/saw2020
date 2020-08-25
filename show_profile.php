<?php

require_once 'db/open_conn_DBMS.php';

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

$stmt = $con->prepare("select * from utenti where mail=?");
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
$citta=$row["citta"];
$desc=$row["descrizione"];
$mylink=$row["link"];
$_SESSION['mynamesaw']=$first_name;
$_SESSION['mysurnamesaw']=$last_name;
$_SESSION['mycittasaw']=$citta;
$_SESSION['mydescsaw']=$desc;
$_SESSION['mylinksaw']=$mylink;
// TODO: format it however you like in this page that shows profile data
/*echo $email; // replace null with $_POST and sanitization
echo $first_name; // replace null with $_POST and sanitization
echo $last_name; // replace null with $_POST and sanitization*/

include_once 'myprofile.php';