<?php


spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

//new database object
$db = new Database();
//new usermanager object
$userManager = new UserManager($db->getConnection());


//controleerd of er of de delete knop gedrukt it.
if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    if  (isset($_POST['delete'])) {

        $user_id = $_POST['user_id']; //haalt variabelen op en stuurt ze mee.
        $game_id = $_POST['game_id'];
        $userManager->delete($user_id, $game_id); //neemt argumenten mee naar delete functie.

        echo "game succesfully deleted!";
    }
} else {
        echo 'unable to be deleted';
}

?>