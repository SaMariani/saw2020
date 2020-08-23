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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/codepenStyleForProducts.css">

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
            <a class="navbar-brand" href="../home.php">UN LOGO</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-example">

            <ul class="nav navbar-nav navbar-right">

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

                <li class="dropdown btn-info">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Ciao <?php echo $_SESSION['myusersaw']; ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="../show_profile.php">Visualizza profilo</a></li>
                        <li><a href="../update.php">Modifica profilo</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>

                <li><a href="../destroySession.php">LOGOUT</a></li>

            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>



<div class="container" style="margin-top: 100px">

    <div id="list_grid" class="well well-sm" style="visibility: hidden">
        <strong>Results</strong>
        <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                    class="glyphicon glyphicon-th"></span>Grid</a>
        </div>
    </div>

    <div id='products' class='row list-group'>

    </div>

</div><!-- / container -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="../js/bootstrap.min.js"></script>



</body>
</html>

<script type="text/javascript">
    var res = document.getElementById("products");
    var listgrid = document.getElementById("list_grid");

    var x, template = "";
    var xmlHttp;
    if (window.XMLHttpRequest){
        xmlHttp = new XMLHttpRequest();
    }else {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");<!-- per browser vecchi -->
    }
    var a = "1";//cerco uno spazio, mi stamperà tutto

    var infoUtente = "search="+a;

    xmlHttp.onreadystatechange = function () {
        if(xmlHttp.readyState === 4 && xmlHttp.status === 200){ <!-- 0: richiesta non inizializzata; 1: richiesta non stabilita; 2: richiesta inviata; 3: Richiesta in processo; 4: Richiesta ultimata -->

            //console.log(myObj);

            res.innerHTML = "";
            txt="";
            listgrid.style.visibility='visible';
            myObj = JSON.parse(this.responseText);
            txt += "<table border='1'>"
            for (x in myObj) {

                template+=
                    "<div class='item  col-xs-4 col-lg-4'>"+
                    "<div class='thumbnail'>"+
                    "<img class='group list-group-image' src='http://placehold.it/400x250/000/fff' alt='' />"+
                    "<div class='caption'>"+
                    "<h4 class='group inner list-group-item-heading'>"+
                    myObj[x].nomeprodotto + "</h4>"+
                    "<p class='group inner list-group-item-text' style='margin-top: 10px'>"+
                    myObj[x].descrizione + "</p>"+
                    "<div class='row' style='margin-top: 10px'>"+
                    "<div class='col-xs-12 col-md-4'>"+
                    "<p class='lead'>"+
                    myObj[x].prezzo + " €</p>"+
                    "</div>"+
                    "<div class='col-xs-12 col-md-4'>"+
                    "<input type='text' class='product-quantity' name='quantity' value='1' size='2' id='" + myObj[x].codice + "'/>"+
                    "</div>"+
                    "<div class='col-xs-12 col-md-4'>"+
                    "<button type='button' class='btn btn-success btn-lg' data-toggle='modal' data-target='#myModal' onclick='ajax_get(" + myObj[x].codice + ")'>Compra</button>"+
                    "</div>"+
                    "<!-- Modal -->"+
                    "<div class='modal fade' id='myModal' role='dialog'>"+
                    "<div class='modal-dialog modal-sm'>"+
                    "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                    "<button type='button' class='close' data-dismiss='modal'>&times;</button>"+
                    "<h4 class='modal-title'>Aggiunto al carrello!</h4>"+
                    "</div>"+
                    "<div class='modal-body'>"+
                    "<p>" +
                    myObj[x].nomeprodotto+"</p>"+
                    "</div>"+
                    "<div class='modal-footer'>"+
                    "<a href='../view_cart.php'>Termina acquisto</a>"+
                    "&nbsp;&nbsp;<button type='button' class='btn btn-default' data-dismiss='modal'>Prosegui</button>"+
                    "</div>"+
                    "</div>"+
                    "</div>"+
                    "</div>"+
                    "</div>"+
                    "</div>"+
                    "</div>"+
                    "</div>"
            }
            res.innerHTML=template;


        }
    };
    xmlHttp.open("GET", "allproducts.php?"+infoUtente, true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")//Send the proper header information along with the request
    xmlHttp.send();
</script>

<script type="text/javascript">
    //var err = document.getElementById("infoE");

    //var res = document.getElementById("products");


    var x, template = "";
    function ajax_get(codice) {
        //idquantity=datiprodotto.codice;
        var quantity = document.getElementById(codice).value;
        var xmlHttp;
        if (window.XMLHttpRequest){
            xmlHttp = new XMLHttpRequest();
        }else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");<!-- per browser vecchi -->
        }
        //var a = document.getElementById("search").value;

        var info = "codice="+codice+"&quantity="+quantity;
        //updatecart.innerHTML=quantity+" Aggiunto al carrello!";
        xmlHttp.onreadystatechange = function () {
            if(xmlHttp.readyState === 4 && xmlHttp.status === 200){ <!-- 0: richiesta non inizializzata; 1: richiesta non stabilita; 2: richiesta inviata; 3: Richiesta in processo; 4: Richiesta ultimata -->
                //err.innerHTML=xmlHttp.responseText;
            }
        };
        xmlHttp.open("GET", "cart.php?action=add&"+info, true);
        xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")//Send the proper header information along with the request
        xmlHttp.send();
    }
</script>


<script>
    $(document).ready(function() {
        $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
        $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
    });
</script>