<?php

//vecchia versione per search.html

// TODO: change credentials in the db/mysql_credentials.php file
require_once('db/mysql_credentials.php');

// Open DBMS Server connection
include_once 'openDBMSconnection.php';

$state = true;
$success="";
$error="";

// Get search string from $_GET['search']
// but do it IN A SECURE WAY
$search = $_GET["search"]; // replace null with $_GET and sanitization
$search_S = filter_var($search, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if(empty($search)) {
    $error .= "Nessuna stringa da cercare, inserisci per favore<br>";
    $state = false;
}else if(!$search_S) {
    $error .= "Stringa non valida<br>";
    $state = false;
}
$search = $search_S;

/**
 * @param string $success
 * @param string $error
 */
function sendMessage(string $success, string $error): void
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

function sendLines(string $success, string $error): void
{
    $comunicateResults = [
        'success' => $success,
        'error' => $error
    ];
    $myJSON = json_encode($comunicateResults);
    echo $myJSON;
}

function search($search, $db_connection) {
    // TODO: search logic here
    // prepare and bind
    $search="%".$search."%";
    $stmt = $db_connection->prepare("select * from prodotti");
    //$stmt->bind_param("ssss", $search, $search, $search, $search);
    $stmt->execute();
    $resultRows = $stmt->get_result();
    $stmt->close();
    if ($resultRows->num_rows > 0) {
        $allProducts=array();
        while($row = $resultRows->fetch_assoc()) {
            $product=[
                'codice' => $row["codice"],
                'nomeprodotto' => $row["nomeprodotto"],
                'descrizione' => $row["descrizione"],
                'prezzo' => $row["prezzo"]
            ];
            array_push($allProducts, $product);
        }
        return $allProducts;
    }else
        return null;

    // Return array of results
}

// Search on database
$results = search($search, $con);

if ($results!==null) {
    $myJSON = json_encode($results);
    echo $myJSON;
    /*foreach ($results as $result) {
        // Format as you like and print search results
        $myJSON = json_encode($result);
        echo $myJSON;
    }*/
} else {
    // No matches found
    $error .= "No results found";
    sendMessage($success, $error);
}