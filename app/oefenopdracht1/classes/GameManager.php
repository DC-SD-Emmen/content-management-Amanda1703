
<?php

    class GameManager {

      private $conn;

      public function __construct(Database $db) {
        $this->conn = $db->getConnection();
      }

      public function insertGame($data, $imageName) {

          //use htmlspecialchars to prevent xss
          $title = htmlspecialchars($data['title']);
          $genre = htmlspecialchars($data['genre']);
          $platform = htmlspecialchars($data['platform']);
          $release_year = $data['release_year'];
          $rating = $data['rating'];
          $description = $data['description'];
          //make regex for name and email
          $titleRegex = "/^[A-Z][a-z]*+$/";
          $genreRegex = "/^[A-Z][a-z]*+$/";
          $platformRegex =  "/^[A-Z][a-z]*+$/";
          $descriptionRegex = "/^[A-Z][a-z]*$/";

          //check if name and email are correct
            if (!preg_match($titleRegex, $title)) {
              echo "Please enter a correct title";
          } else if (!preg_match($genreRegex, $genre)) {
              echo "Please enter a correct genre";
          } else if (!preg_match($platformRegex, $platform)) {
              echo "Please enter a correct platform";    
          } else if (!preg_match($descriptionRegex, $description)){
            echo "Please enter a correct description";
          } else {

            try {
              // prepare sql and bind parameters
              $stmt = $this->conn->prepare("INSERT INTO userlogin (title, genre, platform, release_year, rating, descriptionGame, image) VALUES (:title, :genre, :platform, :release_year, :rating, :descriprion, :image)");
              $stmt->bindParam(':title', $title);
              $stmt->bindParam(':genre', $genre);
              $stmt->bindParam(':platform', $platform);
              $stmt->bindParam(':release_year', $release_year);
              $stmt->bindParam(':rating', $rating);
              $stmt->bindParam(':descriprion', $description);
              $stmt->bindParam(':image', $imageName);
              $stmt->execute();
              echo "New records created successfully";
          } catch(PDOException $e) {
            echo "Error insert function: " . $e->getMessage();
            exit();
          }
      
          
        } 
    }

    public function selectData() {

      $games = [];

      try {
        
        $stmt = $this->conn->prepare("SELECT * FROM userlogin");
        $stmt->execute();
      
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        //voor elk resultaat een new Game object maken

        foreach($result as $rgame) {
          $game = new Game();
          $game->set_title($rgame['title']);
          $game->set_genre($rgame['genre']);
          $game->set_platform($rgame['platform']);
          $game->set_release_year($rgame['release_year']);
          $game->set_rating($rgame['rating']);
          $game->set_image($rgame['image']);
          $game->set_id($rgame["id"]);
          array_push($games, $game);

        }

        foreach($games as $data) {
          $id = $data->get_id();
          echo "<tr>";
            //echo "<td>" . $data->get_title(). "</td>"  ; 
            echo '<td><a href="http://localhost/eindopdracht2/classes/detail_page.php?' . "id=" . $id . '"' . "><img  class = 'picture' src='classes/uploads/" . $data->get_image() . "'></a></td>"; 
          echo "</tr>";
          
        }

        echo "</table>";
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    }

    public function selectDataSideBar() {

      $games = [];

      try {
        
        $stmt = $this->conn->prepare("SELECT * FROM userlogin");
        $stmt->execute();
      
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        //voor elk resultaat een new Game object maken

        foreach($result as $rgame) {
          $game = new Game();
          $game->set_title($rgame['title']);
          $game->set_genre($rgame['genre']);
          $game->set_platform($rgame['platform']);
          $game->set_release_year($rgame['release_year']);
          $game->set_rating($rgame['rating']);
          $game->set_image($rgame['image']);
          $game->set_id($rgame["id"]);
          array_push($games, $game);

        }

        echo "<ul>";

        foreach($games as $data) {
          $id = $data->get_id();
            echo '<li><a href="http://localhost/eindopdracht2/classes/detail_page.php?' . "id=" . $id . '"' . ">" . "<img  class = 'smallPicture' src='classes/uploads/" . $data->get_image() . "'>"; 
            echo "<td>" . $data->get_title() . "</a></li>" ; 
          
        }
        echo "</ul>";

        echo "</table>";
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }

    }

    public function fileUpload($file) {
      $target_dir = "classes/uploads/";
      $target_file = $target_dir . basename($file["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if image file is a actual image or fake image
      
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {
          echo "File is not an image.";
          $uploadOk = 0;
        }

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        return;
      }

      // Check file size
      if ($file["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
      }

      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }

    function get_game_details($id) {
      try {
          $stmt = $this->conn->prepare("SELECT title, genre, platform, release_year, rating, descriptionGame, image FROM userlogin WHERE id = :id");
          $stmt->bindParam(':id', $id);
          $stmt->execute();
  
          if ($stmt->rowCount() > 0) {
              $game = $stmt->fetch(PDO::FETCH_ASSOC);
              return $game; 
          } else {
              return null;
          }
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
  }
  
  }

?>












