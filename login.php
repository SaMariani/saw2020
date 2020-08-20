<?php

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Add session control, header, ...
session_start();//avvia la sessione

// Open DBMS Server connection
include_once 'openDBMSconnection.php';

$success="";
$error="";
$state=true;
// Get credentials from $_POST['email'] and $_POST['pass']
// but do it IN A SECURE WAY
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

$pass = $_POST["pass"]; // replace null with $_POST and sanitization
if(empty($pass)) {
    $error .= "Password mancante, inserisci per favore<br>";
    $state = false;
}

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
    sendMessage($success, $error);
    die;
}

function login($email, $pass, $db_connection) {
    // TODO: login logic here

    // prepare and bind
    $stmt = $db_connection->prepare("select password from utenti where mail=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultRows = $stmt->get_result();
    $row = $resultRows->fetch_assoc();
    $stmt->close();
    if($row === null) {
        return null;
    } else {

        if(password_verify($pass, $row["password"])) {
            $_SESSION['myusersaw']=$email;
            // Return logged user
            return $email;
        }else{
            return null;
        }
    }

}

// Get user from login
$user = login($email, $pass, $con);


if ($user) {
    // Welcome message
    $success .= "Welcome $user!";
    sendMessage($success, $error);

    //header("Location:home.php");

} else {
    // Error message
    $error .= "Wrong email or password";
    sendMessage($success, $error);
    /*if($user==array()) //se utente è un array vuoto
        {
            header("Location: accedi.htm"); //torna al form di autenticazione
            exit;
        }*/
}
