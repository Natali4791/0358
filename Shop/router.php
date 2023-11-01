<?php

$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);

if ($url[1] == "contact") {
  $content = file_get_contents("pages/contact.php");
} else if ($url[1] == "blog") {
  $content = file_get_contents("pages/blog.html");
} else if ($url[1] == "register") {
  $content = file_get_contents("pages/register.html");
} else if ($url[1] == "auth") {
  $content = file_get_contents("pages/login.html");
} else if ($url[1] == 'users") {
  require_once("pages/users/index.html");
} else {
  $content = file_get_contents("pages/index.php");
}
if (!empty($content))
  require_once("template.php");
