<?php

    class Database {

        // Geef database specificaties aan en maak connectie met het aan.
        private $servername = "mysql";
        private $username = "root";
        private $password = "root";
        private $dbname = "userlogin";
        public $conn;

        // Maak connectie met de database en geef feedback terug of het gelukt is of niet.
        public function __construct() {
            try {
                $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
                // set the PDO error mode to exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
              }
        }

        public function getConnection() {
          return $this->conn;
        }
    }
?>