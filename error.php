<?php
/* Parāda visus kļūdu paziņojumus */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kļūda</title>
  <?php include 'css/css.html'; ?>
  <meta name="viewport" content="width=device-width, initial-scale = 0.6, maximum-scale=0.6, user-scalable=no"> 
</head>
<body>
<div class="form">
    <h1>Kļūda</h1>
    <p>
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>     
    <a href="index.php"><button class="button button-block"/>Galvenā</button></a>
</div>
</body>
</html>
