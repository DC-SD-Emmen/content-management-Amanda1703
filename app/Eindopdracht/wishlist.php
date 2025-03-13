<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

class Wishlist {

    public function AddToWIshlist () {

        try{
          $stmt = $this->conn->prepare("SELECT*FROM user_games WHERE user_id = :user_id AND game_id = :game_id");
          $stmt->bindParam(':user_id', $user_id);
          $stmt->bindParam(':game_id', $game_id);
          $stmt->execute();
      
          $id = $stmt->fetch(PDO::FETCH_ASSOC);
        
        } catch(PDOException $e) {
          echo "ERROR: " . $e->getMessage();
        }

        
    }
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(isset($_POST['AddToWIshlist'])) {
        $user_id = $_POST['user_id'];
        $user_games = $_POST['user_games']; 
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST">
<button type="submit" id="AddToWIshlist" name="AddToWIshlist" value="AddToWIshlist"></button>
</form>

</body>
</html>