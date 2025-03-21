<?php
    
    class UserManager {

        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
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
          try {
              // Prepare the SQL query
              $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
              $stmt->bindParam(':username', $username); 
              $stmt->execute();
      
              // Fetch the user data
              $user = $stmt->fetch(PDO::FETCH_ASSOC);
      
              // Check if the user exists and password is correct
              if ($user && password_verify($password, $user['password'])) {
                  // Start the session if not already started
                  if (session_status() == PHP_SESSION_NONE) {
                      session_start();
                  }
                  
                  // Set session username
                  $_SESSION['username'] = $user['username'];

                  $_SESSION['user_id'] = $user['id'];


                  $this->checkSession();
      
                  // Redirect to the home page
                  header("Location: index.php");
                  exit();
              } else {
                  // If username or password is incorrect
                  throw new Exception("Password or username incorrect.");
              }
          } catch (Exception $e) {
              // Catch any exceptions and display the error message
              echo "Error: " . $e->getMessage();
              exit();
          }
      }
      
      // This function can be used to check if the session is correctly set
      public function checkSession() {
          if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
              return true;
          } else {
              echo "Session not set or username missing.";
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
        
        

        public function AddToWIshlist($user_id, $game_id) {
         
          try{
            $stmt = $this->conn->prepare("INSERT INTO user_games (user_id, game_id)
            VALUES (:user_id, :game_id)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':game_id', $game_id);
            $stmt->execute();
            echo "toevoegen aan wishlist is gelukt";
                  
          } catch(PDOException $e) {

            echo "ERROR: " . $e->getMessage();
          }
          
      }

      public function Wishlist($user_id) {
        echo gettype($user_id);
        // SQL-query voorbereiden
        $stmt = $this->conn->prepare("SELECT user_games.user_id, games.title FROM user_games INNER JOIN games ON user_games.game_id = games.id WHERE user_games.user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
    
        // Voer de query uit
        $stmt->execute();
    
        // Verkrijg alle resultaten in een associatieve array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Controleren of er games zijn gevonden
        if (count($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Title</th><th>User ID</th></tr>";
    
            // Loop door de resultaten en voeg elke game toe aan de tabel
            foreach ($result as $rgame) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($rgame['title']) . "</td>";
                echo "<td>" . htmlspecialchars($rgame['user_id']) . "</td>";
                echo "</tr>";
            }
    
            echo "</table>";
        } else {
            echo "Geen wishlisted games gevonden voor deze gebruiker.";
        }
    }
    

      public function delete($user_id) {

        try{
          $stmt = $this->conn->prepare("DELETE FROM user_games WHERE user_id = :user_id");
          $stmt->bindParam(':user_id', $user_id);

          $stmt->execute();
        } catch (PDOException $e) {
          echo "error" . $e->getMessage();
        }
      } 

      
    public function update($username, $password) {

      try{
        $stmt = $this->conn->prepare("UPDATE users SET username = :username, password = :password WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        $stmt->execute();
      } catch (PDOException $e) {
        echo "error" . $e->getMessage();
      }
    }
  
    }
           
?>