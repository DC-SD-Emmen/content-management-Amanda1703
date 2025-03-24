<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Form</title>
</head>
<body>

<a href="userregister.php" id="button1"><button>register</button></a>
<a href="updateform.php" id="button2"><button>UpdateForm</button></a>

<div class="log">
    <form id="Login" method="post" action="userHandling.php"> 
        <label for=username></Label><br>
        <input type="text" id="username" name="username" placeholder="username" required><br>
        <label for= "password"></label><br>
        <input type="password" id="password" name="password" placeholder="password" required><br>
        <input type="submit" name="login" id="login-button" value="login" ></input>
    </form>
</div>


</body>
</html>