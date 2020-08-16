<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style4products.css">


    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>
<body data-spy="scroll" data-target="#navbar-example">

<nav class="navbar navbar-fixed-top">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-example" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=index.html>BETO LOGOS</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-example">

            <ul class="nav navbar-nav navbar-right">

                <li><a href=accedi.html>Accedi</a></li>
                <li><a href="under_costruction.html">Chi siamo</a></li>
                <li><a href="products.html">Prodotti</a></li>
                <li><a href="under_costruction.html">Contatti</a></li>

                <li>
                    <form class="navbar-form navbar-left" role="search" action="search.php" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-info glyphicon glyphicon-search"></button>
                    </form>
                </li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">

    <?php
    // TODO: change credentials in the db/mysql_credentials.php file
    require_once ('db/mysql_credentials.php');

    // Open DBMS Server connection
    include_once 'openDBMSconnection.php';

    $state = true;
    $success = "";
    $error = "";

    // Get search string from $_GET['search']
    // but do it IN A SECURE WAY
    $search = $_GET["search"]; // replace null with $_GET and sanitization
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
    <div id="list_grid" class="well well-sm">
        <br><br><strong>Results</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                    class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>

    <div id="product-grid" class="row list-group">
        <div class="txt-heading">Products</div>
        <?php
        if ($results !== null)
        {
            $myJSON = json_encode($results);
            //echo $myJSON;
            $product_array = $results;
            foreach ($product_array as $key => $value)
            {
                ?>
                <div class="product-item">
                    <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["codice"]; ?>">
                        <div class="product-image"><img src="<?php echo $product_array[$key]["descrizione"]; ?>"></div>
                        <div class="product-tile-footer">
                            <div class="product-title"><?php echo $product_array[$key]["nomeprodotto"]; ?></div>
                            <div class="product-price"><?php echo "$" . $product_array[$key]["prezzo"]; ?></div>
                            <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                        </div>
                    </form>
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

<script>
    $(document).ready(function() {
        $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
        $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
    });
</script>