<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link href="css/cartstyle.css" type="text/css" rel="stylesheet" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-example" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=index.html>UN LOGO</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-example">

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="accedi.html"><span class="glyphicon glyphicon-user"></span> Accedi</a></li>
                    <li><a href="under_costruction.html">Chi siamo</a></li>
                    <li><a href="products.html">Prodotti</a></li>
                    <li><a href="under_costruction.html">Contatti</a></li>

                    <li>
                        <form class="navbar-form navbar-left" role="search" action="search.html" method="GET">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="Search" required>
                            </div>
                            <button type="submit" class="btn btn-info glyphicon glyphicon-search"></button>
                        </form>
                    </li>

                    <li><a href="view_cart.php">Carrello <span class="glyphicon glyphicon-shopping-cart"></span></a></li>

                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container" style="margin-top: 100px">
        <div id="shopping-cart" style="margin-top: 100px">
            <div class="txt-heading">Shopping Cart</div>

            <a id="btnEmpty" href="cart.php?action=empty">Empty Cart</a>
            <?php
            if (isset($_SESSION["cart_item"]))
            {
                $total_quantity = 0;
                $total_price = 0;
                ?>
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th style="text-align:left;">Codice</th>
                        <th style="text-align:left;">Nome prodotto</th>
                        <th style="text-align:right;">Quantità</th>
                        <th style="text-align:right;">Prezzo</th>
                        <th style="text-align:right;">Parziale</th>
                        <th style="text-align:center;">Remove</th>
                    </tr>
                    <?php
                    foreach ($_SESSION["cart_item"] as $item)
                    {
                        $item_price = $item["quantity"] * $item["prezzo"];
                        ?>
                        <tr>
                            <td><?php echo $item["codice"]; ?></td>
                            <td><img src="http://placehold.it/400x250/000/fff" class="cart-item-image" alt="prodotto"/><?php echo $item["nomeprodotto"]; ?></td>
                            <td style="text-align:right;">
                                <button onclick="location.href = 'cart.php?action=minus&codice=<?php echo $item["codice"]; ?>'">-</button>
                                <?php echo $item["quantity"]; ?>
                                <button onclick="location.href = 'cart.php?action=plus&codice=<?php echo $item["codice"]; ?>'">+</button>
                            </td>
                            <td  style="text-align:right;"><?php echo "€ " . $item["prezzo"]; ?></td>
                            <td  style="text-align:right;"><?php echo "€ " . number_format($item_price, 2); ?></td>
                            <td style="text-align:center;"><a href="cart.php?action=remove&codice=<?php echo $item["codice"]; ?>" class="btnRemoveAction"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>
                        <?php
                        $total_quantity += $item["quantity"];
                        $total_price += ($item["prezzo"] * $item["quantity"]);
                    }
                    ?>

                    <tr>
                        <td colspan="2">Totale:</td>
                        <td><?php echo $total_quantity; ?></td>
                        <td colspan="2"><strong><?php echo "€ " . number_format($total_price, 2); ?></strong></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <?php
            }
            else
            {
                ?>
                <div class="no-records">Your Cart is Empty</div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>