<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
    });
    
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
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

</head>
<body>
<?php
    require('db.php');
    session_start();
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']); 
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: cv.html");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <div class="search-box">
        <input type="text" autocomplete="off" class="login-input" name="username" placeholder="Username" autofocus="true" />
        <div class="result"></div>
        </div>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
  </form>
<?php
    }
?>
</body>
</html>
