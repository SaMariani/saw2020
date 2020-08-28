<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gomme biodegradabili, alta resistenza</title>
    <link rel="icon" type="image/png" href="images/tire-pngrepo-com.png">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleForProducts.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

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
            <a class="navbar-brand" href=index.php><img src="images/pneubio.png" alt="logo" style="max-height: 34px"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-example">

            <ul class="nav navbar-nav navbar-right">

                <?php
                if(!isset($_SESSION['myusersaw']))
                {
                    ?>
                    <li><a href="accedi.php"><span class="glyphicon glyphicon-user"></span> Accedi</a></li>
                    <?php
                }
                ?>
                <li><a href="under_construction.php">Chi siamo</a></li>
                <li><a href="products.php">Prodotti</a></li>
                <li><a href="under_construction.php">Contatti</a></li>



                <li>
                    <form class="navbar-form navbar-left" role="search" action="print_search.php" method="GET">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search" required>
                        </div>
                        <button type="submit" class="btn btn-info glyphicon glyphicon-search"></button>
                    </form>
                </li>

                <li><a href="view_cart.php">Carrello <span class="glyphicon glyphicon-shopping-cart"></span></a></li>

                <?php
                if(isset($_SESSION['myusersaw']))
                {
                    ?>
                    <li class="dropdown btn-info">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Ciao <?php echo $_SESSION['myusersaw']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="show_profile.php">Visualizza profilo</a></li>
                            <li><a href="update.php">Modifica profilo</a></li>

                        </ul>
                    </li>

                    <li><a href="destroySession.php">LOGOUT</a></li>
                    <?php
                }
                ?>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<h1 style="text-align: center; margin-top: 200px">under construction</h1>

</body>
</html>