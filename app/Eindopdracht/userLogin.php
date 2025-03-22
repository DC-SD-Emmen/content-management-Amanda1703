<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Form</title>
</head>
<body>
<a href="userregister.php"><button>register</button></a>
<a href="updateform.php"><button>UpdateForm</button></a>


<div class="log">
    <form id="Login" method="post" action="userHandling.php"> 
        <label for=username>username</Label><br>
        <input type="text" id="username" name="username" required><br>
        <label for= "password">password</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" name="login" id="login-button" value="login" ></input>
    </form>
</div>


</body>
</html>