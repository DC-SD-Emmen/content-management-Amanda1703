<?php
    include 'wishlist.php';

    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.php';
    });

    
    $id = isset($_GET['id']) ? $_GET['id'] : 0;


?>
                
        <?php  
            // replaces the big pictures with all the data
            $db = new Database();
            $gamesOphalen = new GameManager($db->getConnection());
            $gameDetails = $gamesOphalen->get_game_details($id);
            if ($gameDetails) {
                echo "<h1>{$gameDetails['title']}</h1>";
                echo "<img src='uploads/{$gameDetails['image']}' alt='{$gameDetails['title']}'>";
                echo "<p><strong>Genre:</strong> {$gameDetails['genre']}</p>";
                echo "<p><strong>Platform:</strong> {$gameDetails['platform']}</p>";
                echo "<p><strong>Release Year:</strong> {$gameDetails['release_year']}</p>";
                echo "<p><strong>Rating:</strong> {$gameDetails['rating']}</p>";
                echo "<p><strong>Description:</strong> {$gameDetails['descriptionGame']}</p>";
            } else {
                echo "<h2>Game not found.</h2>";
            }


        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>
    <link rel="stylesheet" href="styleEindopdracht.css">
    <link rel="stylesheet" href="detail_page.css">
</head>
<body>

<form method="POST">
    <input type="hidden" name="id" id="id" value=""> 
    <button type="submit" id="AddToWishlist" name="AddToWishlist" value="AddToWishlist" action="wishlist.php">ADD to Wishlist</button>
</form>

</body>
</html>