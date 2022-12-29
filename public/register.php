<?php
    $filename = '../data/users.json';
    if(isset($_POST["user"],$_POST["password"])){
        $users = json_decode(file_get_contents( $filename), associative: true);
        $user = $_POST["user"];
        $password = md5($_POST["password"]);
        
        if( !isset($users[$user])){

            $hash = md5( string: microtime().print_r($_SERVER, return: true).rand() );

            $users[$user] = array(
                'user'      => $user,
                'realname'  => '',
                'pass'      => $password,
                'cookie'    => $hash
            );
            
            file_put_contents( $filename, json_encode( $users )  );
            setcookie('token',$hash,time()+3600,'/');
            header(header: "Location: ./profile.php");
            exit(); 
        }

        else{
            die("User Exits!!");
        }
        

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
        float: left;
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

        <div class="container">
        <h2>Register Page</h2>
        <form method="post">
        
            <div><input name="user"></div>
            <div><input type="password" name="password"></div>
            <div><input type="submit" value="Register"></div>
        </div>
        </form>

    </body>

</html>