<?php
    
    class UserManager {

        private $conn;

        public function __construct() {
          session_start();
          include_once 'Database.php';
          $dbConnectie = new Database();
            $this->conn = $dbConnectie->getconnection();
        }

        //maakt een public funtie aan voor username en password en bind daarna de sql en bind parameters aan.
        public function insertUser($username, $password) {
            $username = htmlspecialchars($username);
            //INSERT sql statement maken
            //$this-conn gebruiken om de SQL naar database te versturen
            //kijken of het gelukt is
            //feedback geven aan de gebruiker of het is gelukt of niet.
                try {
               // prepare sql and bind parameters
                $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                echo "New records created successfully";
            } catch(PDOException $e) {
              echo "Error insert function: " . $e->getMessage();
              exit();
           }
        
        }

        public function login($username, $password) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username); 
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
              $_SESSION['username'] = $user['username'];
              header("Location: index.php");
            } else {
              echo "Password or username incorrect";
              exit();
            }
          }
        
        //selects de data en slaat het op in de userlogin database.
        public function selectData() {

          $this->save();

            try {
              
              $stmt = $this->conn->prepare("SELECT * FROM users");
              $stmt->execute();
            
              // set the resulting array to associative
              $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
              $result = $stmt->fetchAll();
  
            } catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
            }
        }     
        
    }
           
?>