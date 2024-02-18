<?php 
    require("../hepler/jwt_method.php");
    if(!isset($_COOKIE["token"])) {
        header( "location: http://www.localhost.com/login.php" );
        exit(0);
    }
?>