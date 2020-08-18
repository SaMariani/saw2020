<?php
session_start();
require_once ("dbcontroller.php");
$db_handle = new DBController();echo "INIZIO<BR>";
if (!empty($_GET["action"]))
{
    switch ($_GET["action"])
    {
        case "add":
            echo "deentro add<br>";
            if (!empty($_POST["quantity"]))
            {echo "dentro q non vuota<BR>";
                $productByCode = $db_handle->runQuery("SELECT * FROM prodotti WHERE codice='" . $_GET["codice"] . "'");
                $itemArray = array(
                    $productByCode[0]["codice"] => array(
                        'nomeprodotto' => $productByCode[0]["nomeprodotto"],
                        'codice' => $productByCode[0]["codice"],
                        'quantity' => $_POST["quantity"],
                        'prezzo' => $productByCode[0]["prezzo"]
                        //'image' => $productByCode[0]["image"]
                    )
                );
                $myJSON = json_encode($productByCode);
                echo "prodotto: ".$myJSON;

                if (!empty($_SESSION["cart_item"]))
                {echo "<BR>dentro session cart<BR>";
                    if (in_array($productByCode[0]["codice"], array_keys($_SESSION["cart_item"])))
                    {
                        foreach ($_SESSION["cart_item"] as $k => $v)
                        {
                            if ($productByCode[0]["codice"] == $k)
                            {
                                if (empty($_SESSION["cart_item"][$k]["quantity"]))
                                {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                        $myJSON = json_encode($_SESSION["cart_item"]);
                        echo "CART: ".$myJSON;
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
        case "empty":
            unset($_SESSION["cart_item"]);
            header("location: view_cart.php");
            break;
    }
}