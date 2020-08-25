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
    <link rel="stylesheet" href="css/codepenStyleForProducts.css">

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
                <h3 style="text-align: center; margin-bottom: 30px;">Modifica password</h3>
                <div class="form-group">
                    <label for="pass">Password attuale</label>
                    <input id="pass" value='' name="pass" placeholder="Password" type="password" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="newpass">Nuova password</label>
                    <input id="newpass" value='' name="newpass" placeholder="New password" type="password" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="newpassconfirm">Conferma nuova password</label>
                    <input id="newpassconfirm" value='' name="newpassconfirm" placeholder="Confirm new password" type="password" class="form-control" />
                </div>

                <div class="form-group">
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
        var b = document.getElementById("pass").value;
        var c = document.getElementById("newpass").value;
        var d = document.getElementById("newpassconfirm").value;

        var infoUtente = "&pass="+b+"&newpass="+c+"&newpassconfirm="+d;

        xmlHttp.onreadystatechange = function () {
            if(xmlHttp.readyState === 4 && xmlHttp.status === 200){ <!-- 0: richiesta non inizializzata; 1: richiesta non stabilita; 2: richiesta inviata; 3: Richiesta in processo; 4: Richiesta ultimata -->
                var myObj = JSON.parse(xmlHttp.responseText);
                if(myObj.error!==""){
                    res.innerHTML = "";
                    if (myObj.error==="Troppi tentativi!"){
                        window.location.replace("destroySession.php");
                    }
                    err.innerHTML = myObj.error;
                }
                else{
                    //window.location.replace("show_profile.php");
                    err.innerHTML = "";
                    res.innerHTML = myObj.success;
                }
            }
        };
        xmlHttp.open("POST", "new_password.php", true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xmlHttp.send(infoUtente);
    }
</script>

</body>
</html>