<?php
$servername = "localhost";
$username = "username";
$password = "password";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function get_user_by_user_email($email){
    $sql = "SELECT * FROM users WHERE email=" . $email;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result;
      } else {
        return die("user not found");
      }
}
?>