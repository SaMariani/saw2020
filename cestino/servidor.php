<?php

$firstname = $_POST['firstname'];

if(empty($firstname)){
    echo "Firstname mancante!";
} else {
    echo "OK!";
}