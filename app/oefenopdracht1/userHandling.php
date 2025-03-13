<?php
include 'classes/UserManager.php';
include 'classes/Database.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["login"] ))  {
      $username = $_POST['username'];
      $password = $_POST['password']; 
       
      $username = htmlspecialchars($username);

      $Usermanager = "login";

      $user = new UserManager();
      $user->login($username,$password);

      //maakt connectie tot de database
      function login($username,$password) {
        $stmt= $this->conn->prepare("SELECT*FROM userlogin WHERE username=:username");
        $stmt->execute();
    }
       

    }elseif (isset($_POST["register"])) {
           
       $username = $_POST['username'];
       $password = $_POST['password'];
 
       $username = htmlspecialchars($username);
       $hash = password_hash($password, PASSWORD_DEFAULT);

        $gameManager->fileUpload($_FILES['image']);
        $gameManager->insertGame($_POST, $_FILES['image']['name']);

      $db = new Database();
      $connection = $db->getConnection();

       $user = new UserManager();
       $user->insertUser($username,$hash);
     }
    }     
?>

