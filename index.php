<?php
    require("middleware/token.php");
    $user_info = decode_jwt($_COOKIE["token"]);
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>username : <?php $user_info["username"] ?></h1>
    <h1>password : <?php $user_info["password"] ?></h1>
</body>
</html>