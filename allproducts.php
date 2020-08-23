<?php

// Open DBMS Server connection
require_once 'db/open_conn_DBMS.php';

$success="";
$error="";

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

function getProducts($db_connection) {
    // TODO: getProducts logic here
    // prepare and bind
    $stmt = $db_connection->prepare("select * from prodotti");
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
$results = getProducts($con);

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
    $error .= "No products found";
    sendMessage($success, $error);
}