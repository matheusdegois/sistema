<?php

$username = "root";
$password = "";

try {
  $conn = new PDO('mysql:host=localhost;dbname=siteFinal', $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "deu certo";
} catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
?>