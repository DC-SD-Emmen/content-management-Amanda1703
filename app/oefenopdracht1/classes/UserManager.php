<?php
    

    class UserManager {

        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }


        public function insertData($username, $password;) {

            //INSERT sql statement maken
            //$this-conn gebruiken om de SQL naar database te versturen
            //kijken of het gelukt is
            //feedback geven aan de gebruiker of het is gelukt of niet.
                try {
                // prepare sql and bind parameters
                $stmt = $this->conn->prepare("INSERT INTO personen (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                echo "New records created successfully";
            } catch(PDOException $e) {
              echo "Error insert function: " . $e->getMessage();
              exit();
            }
          } 
    }


?>