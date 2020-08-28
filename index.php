<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gomme biodegradabili, alta resistenza</title>
    <link rel="icon" type="image/png" href="images/tire-pngrepo-com.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styleForProducts.css">

    <meta name="viewport" content="width=device-width, initial-scale=1" />

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
            <a class="navbar-brand" href="index.php"><img src="images/pneubio.png" alt="logo" style="max-height: 34px"></a>
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


<div id="carousel" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active" style="background-image: url(https://images.unsplash.com/photo-1578844251758-2f71da64c96f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80);">
            <div class="carousel-caption animated fadeInUp">
                <h3>Alta durata e sicurezza</h3>
                <p class="desc_index">
                    Pneumatici interamente biodegradabili, frutto di anni di studio e test. Disponibili online per auto, gomme 4X4, pneumatici per utilitarie, gomme per moto e pneumatici per scooter e biciclette.</p>
            </div>
        </div>
        <div class="item" style="background-image: url(https://images.unsplash.com/photo-1568644310089-8fce475968a7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1106&q=80);">
            <div class="carousel-caption animated fadeInUp">
                <h3>Tecnologie di nuova generazione</h3>
                <p class="desc_index">
                    Materiale che deriva da un processo innovativo di miscelazione, in forma liquida, di alcuni componenti del battistrada. Questo materiale è resistente e aumenta la resa chilometrica del pneumatico.</p>
            </div>
        </div>
        <div class="item" style="background-image: url(https://images.unsplash.com/photo-1559674697-7ebabb38c369?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80);">
            <div class="carousel-caption animated fadeInUp">
                <h3>Precisione e affidabilità</h3>
                <p class="desc_index">
                    Parti del battistrada si autorigenerano con il passare dei chilometri grazie a tecniche di stampa 3D, per offrire l'aderenza necessaria per tutta la durata dei pneumatici e in tutte le condizioni. Nel corso della vita dei pneumatici appaiono dei nuovi canali per una migliore aderenza su asfalti umidi.</p>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
