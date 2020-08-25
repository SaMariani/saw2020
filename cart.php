<?php
session_start();
require_once 'db/open_conn_DBMS.php';

$codice = filter_var($_GET["codice"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if (!empty($_GET["action"]))
{
    switch ($_GET["action"])
    {
        case "add":
            if (!empty($_GET["quantity"]))
            {
                $stmt = $con->prepare("SELECT * FROM prodotti WHERE codice = ?");
                $stmt->bind_param("s", $codice);
                $stmt->execute();
                $resultRows = $stmt->get_result();
                $stmt->close();
                if ($resultRows->num_rows > 0) {
                    $allProducts=array();
                    $row = $resultRows->fetch_assoc();
                        $product=[
                            'nomeprodotto' => $row["nomeprodotto"],
                            'codice' => $row["codice"],
                            'quantity' => $_GET["quantity"],
                            'prezzo' => $row["prezzo"]
                        ];
                        array_push($allProducts, $product);
                }
                $itemArray = array(
                    $allProducts[0]["codice"] => array(
                        'nomeprodotto' => $allProducts[0]["nomeprodotto"],
                        'codice' => $allProducts[0]["codice"],
                        'quantity' => $_GET["quantity"],
                        'prezzo' => $allProducts[0]["prezzo"]
                    )
                );

                if (!empty($_SESSION["cart_item"]))
                {
                    if (in_array($allProducts[0]["codice"], array_keys($_SESSION["cart_item"])))
                    {
                        foreach ($_SESSION["cart_item"] as $k => $v)
                        {
                            if ($allProducts[0]["codice"] == $k)
                            {
                                if (empty($_SESSION["cart_item"][$k]["quantity"]))
                                {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_GET["quantity"];
                            }
                        }
                    }
                    else
                    {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                }
                else
                {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"]))
            {
                foreach ($_SESSION["cart_item"] as $k => $v)
                {
                    if ($_GET["codice"] == $k) unset($_SESSION["cart_item"][$k]);
                    if (empty($_SESSION["cart_item"])) unset($_SESSION["cart_item"]);
                }
            }
            header("location: view_cart.php");
            break;
        case "plus":
            if (!empty($_SESSION["cart_item"]))
            {
                ++$_SESSION["cart_item"][$_GET["codice"]]["quantity"];
            }
            header("location: view_cart.php");
            break;
        case "minus":
            if (!empty($_SESSION["cart_item"]))
            {
                if($_SESSION["cart_item"][$_GET["codice"]]["quantity"]>1){
                    --$_SESSION["cart_item"][$_GET["codice"]]["quantity"];
                }
            }
            header("location: view_cart.php");
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            header("location: view_cart.php");
            break;
    }
}