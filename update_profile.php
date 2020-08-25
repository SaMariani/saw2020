<?php

session_start();

require_once 'db/open_conn_DBMS.php';

$state = true;
$success="";
$error="";

// Get value from $_SESSION
$email = $_SESSION['myusersaw']; // replace null with $_SESSION

// Get values from $_POST, but do it IN A SECURE WAY
$first_name = $_POST["firstname"]; // replace null with $_POST and sanitization
$first_name_S = filter_var($first_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if(empty($first_name)) {
    $error .= "Firstname mancante, inserisci per favore<br>";
    $state = false;
}else if(!$first_name_S) {
    $error .= "First name non valida<br>";
    $state = false;
}
$first_name = $first_name_S;

$last_name = $_POST["lastname"]; // replace null with $_POST and sanitization
$last_name_S = filter_var($last_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if(empty($last_name)) {
    $error .= "Lastname mancante, inserisci per favore<br>";
    $state = false;
}else if(!$last_name_S) {
    $error .= "Last name non valida<br>";
    $state = false;
}
$last_name = $last_name_S;

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly
$citta = $_POST["citta"]; // replace null with $_POST and sanitization
$citta_S = filter_var($citta, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if(!empty($citta)) {
    if (!$citta_S) {
        $error .= "Città non valida<br>";
        $state = false;
    }
}
$citta = $citta_S;

$desc = $_POST["desc"]; // replace null with $_POST and sanitization
$desc_S = filter_var($desc, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if(!empty($desc)) {
    if (!$desc_S) {
        $error .= "Descrizione non valida<br>";
        $state = false;
    }
}
$desc = $desc_S;

$mylink = $_POST["mylink"]; // replace null with $_POST and sanitization
$mylinkSanitizzata = filter_var($mylink, FILTER_SANITIZE_URL);
$mylinkValidata = filter_var($mylinkSanitizzata, FILTER_VALIDATE_URL);
if(!empty($mylink)) {
    if (!$mylinkValidata) {
        $error .= "URL non valida<br>";
        $state = false;
    }
}
$mylink = $mylinkValidata;


/**
 * @param string $success
 * @param string $error
 */
function sendMessage(string $success, string $error)
{
    $comunicateResults = [
        'success' => $success,
        'error' => $error
    ];
    $myJSON = json_encode($comunicateResults);
    echo $myJSON;
}

if(!$state) {
    $con->close();
    sendMessage($success, $error);
    die;
}


function update_user($email, $first_name, $last_name, $citta, $desc, $mylink, $db_connection) {
    // TODO: update logic here

    // prepare and bind
    $stmt = $db_connection->prepare("UPDATE utenti SET nome=?, cognome=?, citta=?, descrizione=?, link=? WHERE mail=?");
    $stmt->bind_param("ssssss", $first_name, $last_name, $citta, $desc, $mylink, $email);
    $result_ex = $stmt->execute();
    $stmt->close();
    // Return if the registration was successful
    return $result_ex;
}

// Get user from login
$successful = update_user($email, $first_name, $last_name, $citta, $desc, $mylink, $con);

if ($successful) {
    // Success message
    //header("Location: myprofile.php");
    $success .= "Aggiornamento eseguito!";
    sendMessage($success, $error);
    exit();
} else {
    // Error message
    $error .= "There was an error in the update process.";
    sendMessage($success, $error);
}
