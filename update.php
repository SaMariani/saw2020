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
            <a class="navbar-brand" href="home.php">UN LOGO</a>
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
                <div class="form-group col-md-6">
                    <label for="firstname">Nome</label>
                    <input value='' id="firstname" name="firstname" placeholder="First name" type="text" class="form-control" />
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Cognome</label>
                    <input value='' id="lastname" name="lastname" placeholder="Last name" type="text" class="form-control" />
                </div>

                <div class="form-group col-md-12">
                    <label for="citta">Città</label>
                    <input id="citta" value='' name="citta" placeholder="Optional" type="text" class="form-control" />
                </div>
                <div class="form-group col-md-12">
                    <label for="desc">Descrizione profilo</label>
                    <input id="desc" value='' name="desc" placeholder="Optional" type="text" class="form-control" />
                </div>
                <div class="form-group col-md-12">
                    <label for="mylink">Link pagina personale</label>
                    <input id="mylink" value='' name="mylink" placeholder="Optional" type="url" class="form-control" />
                </div>
                <div class="form-group col-md-12">
                    <p><a href="change_password.php">Modifica password</a></p>
                </div>

                <div id="sub" class="form-group">
                    <input type="submit" class="btn btn-default btn-login-submit btn-block m-t-md" value="Submit" onclick="ajax_post()"/>
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

<script>
    var err = document.getElementById("infoE");
    var res = document.getElementById("infoS");
    function ajax_post() {
        var xmlHttp;
        if (window.XMLHttpRequest){
            xmlHttp = new XMLHttpRequest();
        }else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");<!-- per browser vecchi -->
        }

        //var a = document.getElementById("email").value;
        var b = document.getElementById("firstname").value;
        var c = document.getElementById("lastname").value;
        var t = document.getElementById("citta").value;
        var y = document.getElementById("desc").value;
        var u = document.getElementById("mylink").value;

        var infoUtente = "&firstname="+b+"&lastname="+c+"&citta="+t+"&desc="+y+"&mylink="+u;

        xmlHttp.onreadystatechange = function () {
            if(xmlHttp.readyState === 4 && xmlHttp.status === 200){ <!-- 0: richiesta non inizializzata; 1: richiesta non stabilita; 2: richiesta inviata; 3: Richiesta in processo; 4: Richiesta ultimata -->
                var myObj = JSON.parse(xmlHttp.responseText);
                if(myObj.error!==""){
                    res.innerHTML = "";
                    err.innerHTML = myObj.error;
                }
                else{
                    window.location.replace("show_profile.php");
                    err.innerHTML = "";
                    res.innerHTML = myObj.success;
                }
            }
        };
        xmlHttp.open("POST", "update_profile.php", true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xmlHttp.send(infoUtente);
    }
</script>

</body>
</html>