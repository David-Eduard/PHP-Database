<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<style>
body {
    background-image: url("background.jpg") ;
    height: 100%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.form {
    margin: 0vh auto;
    margin-top:22.5vh;
    width: 60vh;
    height: 40vh;
    background: #CCCCFF;
    border: 1.5vh solid black;
}

h1.login-title {
    color: #37123C;
    margin: 0vh auto 3.5vh;
    font-size: 3.5vh;
    font-weight: 10vh;
    text-align: center;
    font-weight: bold;
    margin-top:1vh;
}

.login-input {
    font-size: 2.5vh;
    border: 0.2vh solid #ccc;
    margin-left: 2vh;
    margin-bottom: 3.5vh;
    height: 3vh;
    width: 55vh;
}

.login-input:focus {
    border-color:#6e8095;
    outline: none;
}

.login-button {
    color: black;
    background: #37123C;
    font-weight: bold;
    border: 0vh;
    outline: 0vh;
    width: 80%;
    height: 7vh;
    margin-left: 6vh;
    font-size: 2.25vh;
    text-align: center;
    cursor: pointer;
}

.link {
    color: rgb(210, 23, 23);
    font-size: 3vh;
    text-align: center;
    margin-bottom: 0vh;
}

.link a {
    font-size:2vh;
    color: rgb(225, 27, 27);
}

h3 {
    font-size:2vh;
    font-weight: normal;
    text-align: center;
}
</style>

<body>
<?php
    require('db.php');
    if (isset($_REQUEST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $query    = "INSERT into `users` (username, password)
                     VALUES ('$username', '" . md5($password) . "')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
