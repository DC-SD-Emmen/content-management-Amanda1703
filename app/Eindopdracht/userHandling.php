<?php

session_start();

spl_autoload_register(function ($class) {
  include 'classes/' . $class . '.php';
});

$db = new Database();
$user = new UserManager($db->getConnection());

//controleert of de login is gedrukt
if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["login"] ))  {

      $username = $_POST['username'];
      $password = $_POST['password']; //haalt de variabelen op.
      
      $username = htmlspecialchars($username);

      $user->login($username,$password,);//roept login functie op en stuurt argumenten mee.
       

    }elseif (isset($_POST["register"])) { //checkt of de register knop is gedrukt.
           
       $username = $_POST['username'];//haalt variabelen op.
       $password = $_POST['password'];
       $email = $_POST['email'];
 
       $username = htmlspecialchars($username);
       $hash = password_hash($password, PASSWORD_DEFAULT);
     
       $user->insertUser($username,$hash, $email);//roept insertuser functie op.

     }
    }     
?>

