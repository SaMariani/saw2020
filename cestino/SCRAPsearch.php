<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/codepenStyleForProducts.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body data-spy="scroll" data-target="#navbar-example">

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
            <a class="navbar-brand" href=../index.html>UN LOGO</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-example">

            <ul class="nav navbar-nav navbar-right">

                <li><a href="../accedi.html"><span class="glyphicon glyphicon-user"></span> Accedi</a></li>
                <li><a href="../under_costruction.html">Chi siamo</a></li>
                <li><a href="../products.html">Prodotti</a></li>
                <li><a href="../under_costruction.html">Contatti</a></li>

                <li>
                    <form class="navbar-form navbar-left" role="search" action="../search.html" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search" required>
                        </div>
                        <button type="submit" class="btn btn-info glyphicon glyphicon-search"></button>
                    </form>
                </li>

                <li><a href="../view_cart.php">Carrello <span class="glyphicon glyphicon-shopping-cart"></span></a></li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

    <?php
    // TODO: change credentials in the db/mysql_credentials.php file
    require_once('db/mysql_credentials.php');

    // Open DBMS Server connection
    include_once 'open_conn_DBMS.php';

    $state = true;
    $success = "";
    $error = "";

    // Get search string from $_GET['search']
    // but do it IN A SECURE WAY
    //$search = $_GET["search"]; // replace null with $_GET and sanitization
    $search = "1";
    $search_S = filter_var($search, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (empty($search))
    {
        $error .= "Nessuna stringa da cercare, inserisci per favore<br>";
        $state = false;
    }
    else if (!$search_S)
    {
        $error .= "Stringa non valida<br>";
        $state = false;
    }
    $search = $search_S;

    /**
     * @param string $success
     * @param string $error
     */
    function sendMessage(string $success, string $error):
    void
    {
        $comunicateResults = ['success' => $success, 'error' => $error];
        $myJSON = json_encode($comunicateResults);
        echo $myJSON;
    }

    if (!$state)
    {
        $results=null;
    }else{

        function sendLines(string $success, string $error):
        void
        {
            $comunicateResults = ['success' => $success, 'error' => $error];
            $myJSON = json_encode($comunicateResults);
            echo $myJSON;
        }

        function search($search, $db_connection)
        {
            // TODO: search logic here
            // prepare and bind
            $search = "%" . $search . "%";
            $stmt = $db_connection->prepare("select * from prodotti where codice like ? OR nomeprodotto like ? OR descrizione like ? OR prezzo like ?");
            $stmt->bind_param("ssss", $search, $search, $search, $search);
            $stmt->execute();
            $resultRows = $stmt->get_result();
            $stmt->close();
            if ($resultRows->num_rows > 0)
            {
                $allProducts = array();
                while ($row = $resultRows->fetch_assoc())
                {
                    $product = ['codice' => $row["codice"], 'nomeprodotto' => $row["nomeprodotto"], 'descrizione' => $row["descrizione"], 'prezzo' => $row["prezzo"]];
                    array_push($allProducts, $product);
                }
                return $allProducts;
            }
            else return null;

            // Return array of results

        }

        // Search on database
        $results = search($search, $con);
    }
    ?>

<div class="container"  style="margin-top: 100px">



    <div id="product" class="row list-group">
        <?php
        if ($results !== null)
        {
            $myJSON = json_encode($results);
            //echo $myJSON;
            $product_array = $results;
            foreach ($product_array as $key => $value)
            {
                ?>
                <div class="item  col-xs-4 col-lg-4">
                    <div class="thumbnail">
                        <img class="group list-group-image" src="http://placehold.it/400x250/000/fff" alt="" />
                        <div class="caption">
                            <h4 class="group inner list-group-item-heading">
                                <?php echo $product_array[$key]["nomeprodotto"]; ?>
                            </h4>
                            <p class="group inner list-group-item-text">
                                Product description... Lorem ipsum dolor sit amet, consectetuer adipiscing elit,
                                sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <p class="lead">
                                        <?php echo $product_array[$key]["prezzo"]; ?> €
                                    </p>
                                </div>
                                <form method="post" action="../cart.php?action=add&code=<?php echo $product_array[$key][codice]?>">
                                    <div class="col-xs-12 col-md-4">
                                        <input type="text" class="product-quantity" name="quantity" value="1" size="2" />
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <input type="submit" value="Add to Cart" class="btn-success" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
    </div>
            <?php
        }
        else
        {
            ?>
            <div>NO RESULTS</div>
            <?php
        }
        ?>

</div><!-- / container -->
</body>
</html>