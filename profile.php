<?php
/* Attēlojam lietotāja profila informāciju */
session_start();

// Pārbaudam vai lietotājs ir ielogojies, izmantojam sessijas mainīgos
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Lai apskatītu profila informāciju vispirms ir jāpierakstās!";
  header("location: error.php");    
}
else {
    // Padaram datus vieglāk nolasāmus
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

}
?>


<?php
//Nospiežot submit pogu informācija tiek saglabāta datubāzē
  if(isset($_POST['submit'])){
    move_uploaded_file($_FILES['file']['tmp_name'],"img/profile/".$_FILES['file']['name']);
    $con = mysqli_connect("localhost","root","","accounts");
      $q = mysqli_query($con,"UPDATE users SET image = '".$_FILES['file']['name']."' WHERE email = '".$_SESSION['email']."'");
  }
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Sveiki <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">

          <h1>Jūsu profils</h1>
          <p>
          Lūdzu ievadiet nepieciešamo informāciju!
          </p>
          <p>
          <?php 
     
          // Parādam ziņojumu par reģistrācijas apstiprināšanu tikai vienreiz
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Neatkartojam paziņojumu, lai netraucētu lietotājam
              unset( $_SESSION['message'] );
          }
          
          ?>
          </p>
          
          <?php
          // Atgādinam, ka reģistrācija ir jāapstiprina, līdz lietotājs neapstiprina
          if ( !$active ){
              echo
              '<div class="info">
              Reģistrācija nav apstiprināta, lūdzu apstipriniet to, nospiežot saņemto linku e-pastā!
              </div>';
          }
          ?>
          
          <div class="profile-picture">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" name="submit">
            </form>

            <div class="profile-cover">
            <?php
              $con = mysqli_connect("localhost","root","","accounts");
                $q = mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
              while($row = mysqli_fetch_assoc($q)){
                //echo $row['email'];
                if($row['image'] == ""){
                  echo "<img width='100' height='100' src='img/profile/default.png' alt='Default Profile Pic'>";
                } else {
                  echo "<img width='100' height='100' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                }
                echo "<br>";
              }
            ?>
            </div>
          </div>

          <h2><?php echo $first_name.' '.$last_name; ?></h2>
          <p><?= $email ?></p>

          <form action="" method="post" autocomplete="off">
            <div class="info-wrapper">
              <div class="field-wrap">
                <label>
                  Telefona Numurs<span class="req">*</span>
                </label>
                <input type="text" required autocomplete="off" name="number"/>
              </div>
            </div>
          </form> 
          
          <a href="main.php"><button class="button button-block" name="apstiprinat"/>Apstiprināt</button></a>
          <a href="logout.php"><button class="button button-block" name="logout"/>Izrakstīties</button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
