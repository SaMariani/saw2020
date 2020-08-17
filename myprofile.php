<?php
session_start();
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
	<title>Document</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

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
      <a class="navbar-brand" href="officialhome.php">BETO LOGOS</a>
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
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
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
                <!-- <form method="POST"> -->
                    <legend>I tuoi dati</legend>
                    <div class="form-group">
                        <label for="email">E-mail: </label>
                        <p><?php echo $_SESSION['myusersaw']; ?> </p>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First name: </label>
                        <p><?php echo $_SESSION['mynamesaw']; ?> </p>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nome: </label>
                        <p><?php echo $_SESSION['mysurnamesaw']; ?> </p>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-default btn-login-submit btn-block m-t-md" onclick="location.href = 'update.php'"; >Modifica</button>
                    </div>

                <!-- </form> -->

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

<script type="text/javascript">
    var err = document.getElementById("infoE");
    var res = document.getElementById("infoS");
    function ajax_post() {
        var xmlHttp;
        if (window.XMLHttpRequest){
            xmlHttp = new XMLHttpRequest();
        }else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");<!-- per browser vecchi -->
        }

        var a = document.getElementById("email").value;
        var b = document.getElementById("firstname").value;
        var c = document.getElementById("lastname").value;

        var infoUtente = "email="+a+"&firstname="+b+"&lastname="+c;

        xmlHttp.onreadystatechange = function () {
            if(xmlHttp.readyState === 4 && xmlHttp.status === 200){ <!-- 0: richiesta non inizializzata; 1: richiesta non stabilita; 2: richiesta inviata; 3: Richiesta in processo; 4: Richiesta ultimata -->
                var myObj = JSON.parse(xmlHttp.responseText);
                if(myObj.error!==""){
                    res.innerHTML = "";
                    err.innerHTML = myObj.error;
                }
                else{
                    err.innerHTML = "";
                    res.innerHTML = myObj.success;
                }
            }
        };
        xmlHttp.open("POST", "registration.php", true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xmlHttp.send(infoUtente);
    }
</script>