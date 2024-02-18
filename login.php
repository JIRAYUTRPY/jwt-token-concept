<?php
    require("helper/jwt_method.php");
    require("helper/db_method.php");
    $action=$_POST["action"];
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        try{
            $user_info = get_user_by_user_email("user");
            
        }catch($err){
            echo $err;
        }
        $validUsername = $user_info["username"];
        $validPassword = $user_info["password"];
        // Validate credentials
        if ($username === $validUsername && $password === $validPassword) {
            // Start session
            session_start();

            // Store username in session
            $_SESSION["username"] = $username;

            // Redirect to welcome page
            $token = encode_jwt($user_info);
            setcookie("token", $token, time() + (86400 * 30), "/");
            header("Location: index.php");
            exit;
        } else {
            $errorMessage = "Invalid username or password.";
        }
    }
    if($action=="login"){
        $user=$_POST["user"];
        try{
            $user_info = get_user_by_user_email("user");
            $token = encode_jwt($user_info);
            setcookie("token", $token, time() + (86400 * 30), "/");
        }catch($err){
            echo $err;
        }
    }
    if($action=="logout"){
        setcookie('token', '', time() - 3600, '/');
        unset($_COOKIE['token']);
    }
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
    <h2>Login</h2>
    <?php if(isset($errorMessage)) { ?>
        <p><?php echo $errorMessage; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>