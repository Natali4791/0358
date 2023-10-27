<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
$mysqli = mysqli_connect("localhost", "nkoopvxg_0358", "pirogova", "nkoopvxg_0358");
if ($mysqli == false) {
  print("error");
} else {

  $email = trim(mb_strtolower($_POST["email"]));
  $pass = trim($_POST["pass"]);

  $result = $mysqli->query("SELECT * FROM `users` WHERE `email`='$email'");
  $result = $result->fetch_assoc();
  // var_dump($result ["pass"]);

  if (password_verify($pass, $result["pass"])) {
    echo "ok";
    $_SESSION["id"] =  $result["id"];
    $_SESSION["name"] =  $result["name"];
    $_SESSION["lastname"] =  $result["lastname"];
    $_SESSION["email"] =  $result["email"];
  } else {
    echo "not_found";
  }
}
