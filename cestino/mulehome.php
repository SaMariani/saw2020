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
<html lang="en"
<head>
    <meta charset="UTF-8">
    <title>Gomme biodegradali, alta resistenza</title>
    <link rel="icon" type="image/png" href="images/tire-pngrepo-com.png">
</head>
<body>
<h1>
    Panel de amministracion
</h1>
<h2>
    Bienvenido: <?php echo $_SESSION['myusersaw']; ?>
</h2>
<a href="../destroySession.php">LOGOUT</a>