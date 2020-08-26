<?php
if(!isset($_SESSION['myusersaw']))
{
    //echo "non sei loggato";
    header("Location:accedi.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gomme biodegradali, alta resistenza</title>
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
        <a class="navbar-brand" href="home.php"><img src="images/pneubio.png" alt="logo" style="max-height: 34px"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-example">

      <ul class="nav navbar-nav navbar-right">

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

      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container">

    <div class="row">
        <div class='col-md-3'></div>
        <div class="col-md-6">
            <div class="login-box well">
                    <h3 style="text-align: center; margin-bottom: 30px;">I miei dati</h3>
                    <div class="form-group col-md-12">
                        <label>E-mail: </label>
                        <p><?php echo $_SESSION['myusersaw']; ?> </p>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Nome: </label>
                        <p><?php echo $_SESSION['mynamesaw']; ?> </p>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Cognome: </label>
                        <p><?php echo $_SESSION['mysurnamesaw']; ?> </p>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Città: </label>
                        <p><?php echo $_SESSION['mycittasaw']; ?> </p>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Breve descrizione: </label>
                        <p><?php echo $_SESSION['mydescsaw']; ?> </p>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Link personale: </label>
                        <p><?php echo $_SESSION['mylinksaw']; ?> </p>
                    </div>

                    <div id="sub" class="form-group">
                        <button type="button" class="btn btn-default btn-login-submit btn-block m-t-md" onclick="location.href = 'update.php'">Modifica</button>
                    </div>

                <!-- mio div -->
                <div class="error" id="infoE"></div>
                <div class="success" id="infoS"></div>

            </div>
        </div>
        <div class='col-md-3'></div>
    </div>

</div><!-- / container -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>