<?php

// Open DBMS Server connection
require_once 'db\open_conn_DBMS.php';

$state = true;
$success="";
$error="";

// Get values from $_POST, but do it IN A SECURE WAY
$email = $_POST["email"]; // replace null with $_POST and sanitization
$emailSanitizzata = filter_var($email, FILTER_SANITIZE_EMAIL);
$emailValidata = filter_var($emailSanitizzata, FILTER_VALIDATE_EMAIL);
if(empty($email)) {
    $error .= "E-mail mancante, inserisci per favore<br>";
    $state = false;
}else if(!$emailValidata) {
    $error .=  "E-mail non valida<br>";
    $state = false;
}
$email = $emailValidata;

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

$password = $_POST["pass"]; // replace null with $_POST and sanitization
if(empty($password)) {
    $error .= "Password mancante, inserisci per favore<br>";
    $state = false;
}

$password_confirm = $_POST["confirm"]; // replace null with $_POST and sanitization
if(empty($password_confirm)) {
    $error .= "Conferma password mancante, inserisci per favore<br>";
    $state = false;
}

if($password != $password_confirm) {
    $error .= "Le pasword non corrispondono, correggi per favore<br>";
    $state = false;
}

// Get additional values from $_POST, but do it IN A SECURE WAY
// If you have additional values, change functions params accordingly

function insert_user($email, $first_name, $last_name, $password, $password_confirm, mysqli $db_connection) {
    // TODO: check if passwords match
    if (strcmp($password, $password_confirm) != 0)
        return false;

    // TODO: registration logic here
    //cript password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // prepare and bind
    $stmt = $db_connection->prepare("INSERT INTO utenti (mail, nome, cognome, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $first_name, $last_name, $hashedPassword);
    $result_ex = $stmt->execute();
    $stmt->close();
    // Return if the registration was successful
    return $result_ex;
}

// Get user from login
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
$successful = insert_user($email, $first_name, $last_name, $password, $password_confirm, $con);
$con->close();

if ($successful) {
    // Success message
    $success .= "$email registered successfully!";
    sendMessage($success, $error);
} else {
    // Error message
    $error .= "There was an error in the registration process.";//cambiare
    sendMessage($success, $error);
}