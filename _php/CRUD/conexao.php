<?php
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("BASE", "sislogin");

    $conn = mysqli_connect(HOST, USER, PASS, BASE);

    if(!$conn){
        die("Error on connection: ". mysqli_connect_error());
    }
?>