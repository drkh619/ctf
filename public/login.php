<?php

    if(isset($_POST["user"],$_POST["password"])){
        $users = json_decode(file_get_contents( filename: '../data/users.json'), associative:true);

        if(isset($users[$_POST["user"]])){
            if( $users[$_POST["user"]]["pass"] === md5($_POST["password"]) ){
                setcookie('token',$users[$_POST["user"]]["cookie"],time()+3600,'/');
                header(header: "Location: ./profile.php");
                exit();
            }
        }
        die("Ivalid login!");

    }

?>

<html>

    <head>
    <title>Super secure website</title>
    

        <style type="text/css">
      a {
        color: blue;
      }

      html, body {
        margin: 0;
        padding: 0;
        background: #edf0f5;
        font-family: Helvetica, Arial, sans-serif;
        font-size: 15pt;
      }

      input, textarea {
        font-family: Helvetica, Arial, sans-serif;
        font-size: 15pt;
      }

      div#top {
        background-color: #3b5998;
        padding: 10px;
        color: white;
      }

      div#top a {
        color: white;
      }

      div#container {
        
        padding: 10px;
      }

      div.post {
        background-color: white;
        width: 500px;
        padding: 20px;
        margin-bottom: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
      }

      textarea.inline {
        border: 0;
      }
    </style>

    </head>

    <body>
        <div id="top">
            <h1>Secure Website</h1>
            <a href="./index.php">Home</a>
            <a href="./login.php">Login</a>
            <a href="./register.php">Register</a>
        </div>

        <div id="container">
        <h2> Login</h2>
        <form method="post">
        
            <div><input name="user"></div>
            <div><input type="password" name="password"></div>
            <div><input type="submit" value="login"></div>
        </div>
        </form>

    </body>

</html>