<?php
/* Izrakstīšanās process, atiestāda un iznīcina sessijas mainīgos */
session_start();
session_unset();
session_destroy(); 

/* Atgriež lietotāju idex lapā */
if(isset($_SERVER['HTTP_REFERER'])) {
 header('Location: '.$_SERVER['HTTP_REFERER']);  
} else {
 header('Location: index.php');  
}
?>

<!--Ja PHP kods nenostrādā, tiek atvērta HTML lapa-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
    <div class="form">
          <h1>Paldies, ka izmantojāt mūsu pakalpojumus!</h1>
              
          <p><?= 'Jūs esiet izrakstījušies no sistēmas!'; ?></p>
          
          <a href="index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
