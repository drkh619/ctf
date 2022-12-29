<?php 

setcookie('token',null,time()-3600,'/'); 
header(header: "Location: ./login.php");

?>