<?php

require_once 'db/open_conn_DBMS.php';

$state = true;
$success="";
$error="";

// Get search string from $_GET['search']
// but do it IN A SECURE WAY
$search_min = $_GET["search_min"]; // replace null with $_GET and sanitization
$search_min_S = filter_var($search_min, FILTER_VALIDATE_INT);
if(empty($search_min)) {
    $error .= "Nessuna stringa da cercare, inserisci per favore<br>";
    $state = false;
}else if(!$search_min_S) {
    $error .= "Stringa non valida<br>";
    $state = false;
}
$search_min = $search_min_S;

$search_max = $_GET["search_max"]; // replace null with $_GET and sanitization
$search_max_S = filter_var($search_max, FILTER_VALIDATE_INT);
if(empty($search_max)) {
    $error .= "Nessuna stringa da cercare, inserisci per favore<br>";
    $state = false;
}else if(!$search_max_S) {
    $error .= "Stringa non valida<br>";
    $state = false;
}
$search_max = $search_max_S;

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

function sendLines(string $success, string $error)
{
    $comunicateResults = [
        'success' => $success,
        'error' => $error
    ];
    $myJSON = json_encode($comunicateResults);
    echo $myJSON;
}

function search($search_min, $search_max, $db_connection) {
    // TODO: search logic here
    // prepare and bind
    $stmt = $db_connection->prepare("select * from prodotti where prezzo BETWEEN ? AND ?");
    $stmt->bind_param("ss", $search_min, $search_max);
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
$results = search($search_min, $search_max, $con);

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