<?php

session_start();

spl_autoload_register(function ($class) {
  include 'classes/' . $class . '.php';
});

$db = new Database();
$user = new UserManager($db->getConnection());

if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["login"] ))  {

      $username = $_POST['username'];
      $password = $_POST['password']; 
      
      $username = htmlspecialchars($username);

      $user->login($username,$password,);
       

    }elseif (isset($_POST["register"])) {
           
       $username = $_POST['username'];
       $password = $_POST['password'];
       $email = $_POST['email'];
 
       $username = htmlspecialchars($username);
       $hash = password_hash($password, PASSWORD_DEFAULT);
     
       $user->insertUser($username,$hash, $email);
     }
    }     
?>

