
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
</div>
        <div class="flex">   
            <form id='game-form' method='POST' action='./index.php' enctype="multipart/form-data" style='display:none;'>
                   
                title: <input type="text" name="title"><br>
                genre: <input type="text" name="genre"><br>
                platform: <input type="text" name="platform"><br>
                release_year: <input type="date" name="release_year"><br>
                rating: <input type="number" name="rating"><br>
                image: <input type="file" name="image" id='image'><br>
                description: <textarea name="description"></textarea>
    
                <input type='submit' name='addgame' value='Versturen'>
            </form>  
    </div>    
</body>
</html>