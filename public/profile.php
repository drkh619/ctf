<?php

function userUpdate($username,$realname){

    $users = json_decode( file_get_contents(filename: '../data/users.json'), associative: true );

    if(isset($users[$username])){

        $users[$username]["realname"] = $realname;
        file_put_contents( $filename = '../data/users.json', json_encode($users), JSON_PRETTY_PRINT );

    }

}

$u = false;
if(isset($_COOKIE["token"])){
    $token = $_COOKIE["token"];
    $users = json_decode( file_get_contents(filename: '../data/users.json'), associative: true );
    foreach($users as $user){
        if($user["cookie"] === $token){
            $u = $user;

            if( isset($_POST["user"],$_POST["realname"]) ){
                userUpdate($_POST["user"],$_POST["realname"]);
                header(header: 'Location: ./profile.php');
                exit();
            }
        }
    }

}
if($u){ ?>
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
        align: center;
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
    </div>

    <div class="container">
    <h2>Profile</h2>
    <p>Welcome back <?php echo $u["user"]; ?></p>

    <?php 
        if( $u["user"] ===  'admin' ){
            echo "<p>FLAG{}</p>";
        }
    ?>

    <form method="post">
        <input type="hidden" name="user" value="<?php echo $u["user"]; ?>" > 
    
        <div><input name="realname" value="<?php echo $u["realname"]; ?>"></div>
        
        <div><input type="submit" value="Update user"></div>
        <div><a href="logout.php">Logout</a></div>
    </div>
    </form>

</body>

</html>
<?php
} else {
    header(header: "Location: ./login.php");
    exit();
}

?>