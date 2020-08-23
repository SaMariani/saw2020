<?php

session_start();

// Open DBMS Server connection
require_once 'db/open_conn_DBMS.php';

$state = true;
$success="";
$error="";

// Get value from $_SESSION
$email = $_SESSION['myusersaw']; // replace null with $_SESSION

// Get values from $_POST, but do it IN A SECURE WAY
$password = $_POST["pass"]; // replace null with $_POST and sanitization
if(empty($password)) {
    $error .= "Password attuale mancante, inserisci per favore<br>";
    $state = false;
}

$newpassword = $_POST["newpass"]; // replace null with $_POST and sanitization
if(empty($newpassword)) {
    $error .= "Nuova password mancante, inserisci per favore<br>";
    $state = false;
}

$newpassword_confirm = $_POST["newpassconfirm"]; // replace null with $_POST and sanitization
if(empty($newpassword_confirm)) {
    $error .= "Conferma nuova password mancante, inserisci per favore<br>";
    $state = false;
}

if($newpassword != $newpassword_confirm) {
    $error .= "Le nuove pasword non corrispondono, correggi per favore<br>";
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
    $con->close();
    sendMessage($success, $error);
    die;
}

function check_old_password($email, $oldpass, $db_connection)
{
    // TODO: login logic here


    // prepare and bind
    $stmt = $db_connection->prepare("select password from utenti where mail=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultRows = $stmt->get_result();
    $row = $resultRows->fetch_assoc();
    $stmt->close();
    if ($row === null) {
        return false;
    } else {
        return password_verify($oldpass, $row["password"]);
    }
}

if(!check_old_password($email, $password, $con)){
    $con->close();
    $error .= "Password errata!";
    sendMessage($success, $error);
    die;
}

function update_password($email, $pass, $db_connection) {

    //cript password
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // prepare and bind
    $stmt = $db_connection->prepare("UPDATE utenti SET password=? WHERE mail=?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    $result_ex = $stmt->execute();
    $stmt->close();
    // Return if the registration was successful
    return $result_ex;

}

// Get user from login
$successful = update_password($email, $newpassword, $con);

if ($successful) {
    // Success message
    $success .= "Aggiornamento eseguito!";
    sendMessage($success, $error);
    exit();
} else {
    // Error message
    $error .= "There was an error in the password update process.";
    sendMessage($success, $error);
}
