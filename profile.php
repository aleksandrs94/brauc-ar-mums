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
    $id = $_SESSION['id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];

    // Escape all $_POST variables to protect against SQL injections
    //$first_name = $mysqli->escape_string($_POST['firstname']);
    //$last_name = $mysqli->escape_string($_POST['lastname']);
    //$p_number = $mysqli->escape_string($_POST['pnumber']);

}
?>

<?php
//Nospiežot submit pogu informācija tiek saglabāta datubāzē
  if(isset($_POST['submit'])){
    move_uploaded_file($_FILES['file']['tmp_name'],"img/profile/".$_FILES['file']['name']);
    $con = mysqli_connect("localhost","root","","accounts");
      //$q = mysqli_query($con,"UPDATE profils JOIN users SET profils.image = '".$_FILES['file']['name']."'WHERE users.email = '".$_SESSION['email']."'");
      $q = mysqli_query($con,"UPDATE users SET image = '".$_FILES['file']['name']."'WHERE email = '".$_SESSION['email']."'");
  }
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Profils</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
<!--Lapas galvene-->
<div class="header">

  <!--Logo-->
  <div class="logo">
    <a href="main.php">
      <img src="img/BrumLogo.png" alt="BrumBrum Logo" />
    </a>
  </div>

  <!--Pogas-->
  <div class="pogas-profile">
      <ul class="tab-group">
          <li class="tab active"><a href="profile.php">Profils</a></li>
      </ul>
  </div>


<div class="profile-wrapper">
    <!--Profile-->
    <div class="profile">
      <a href="profile.php">
      <?php
          $con = mysqli_connect("localhost","root","","accounts");
          //$q = mysqli_query($con,"SELECT * FROM profils JOIN users WHERE users.email = '".$_SESSION['email']."'");
          $q = mysqli_query($con,"SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
            while($row = mysqli_fetch_assoc($q)){
              if($row['image'] == ""){
                echo "<img width='50' height='50' src='img/profile/default.png' alt='Default Profile Pic'>";
                } else {
                echo "<img width='50' height='50' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                }
                echo "<br>";
                }
              ?>
      </a>
    </div>
    <!--Log Out-->
    <div class="log_out">
      <a href="logout.php">
        <img src="img/log_out.png" alt="BrumBrum Log Out" />
      </a>
    </div>
  </div>
</div>

<!--Lapas saturs-->
  <div class="profile-form">

          <h1>Jūsu Profils</h1>
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
            <form id="formaa" action="" method="post" enctype="multipart/form-data">
                <input id="filee" type="file" name="file">
                <input id="submitt" type="submit" name="submit">
            </form>

            <div class="profile-cover">
            <?php
              $con = mysqli_connect("localhost","root","","accounts");
                //$q = mysqli_query($con,"SELECT * FROM profils JOIN users WHERE users.email = '".$_SESSION['email']."'");
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

          <div class="top-row">
            <form action="" method="post" autocomplete="off">
                <div class="field-wrap">
                  <label>
                    Vārds<span class="req">*</span>
                  </label>
                  <input type="text" required autocomplete="off" name="firstname"/>
                </div>
            </form> 

            <form action="" method="post" autocomplete="off">
                <div class="field-wrap">
                  <label>
                    Uzvārds<span class="req">*</span>
                  </label>
                  <input type="text" required autocomplete="off" name="lastname"/>
                </div>
            </form> 
          </div>

          <form action="" method="post" autocomplete="off">
              <div class="field-wrap">
                <label>
                  Telefona Numurs<span class="req">*</span>
                </label>
                <input type="text" onkeypress='validate(event)' required autocomplete="off" name="pnumber"/>
              </div>
          </form>
          
          <a href="profile.php"><button class="button button-block" name="submit"/>Apstiprināt</button></a>
          <a href="main.php"><button class="button button-block" name="atpakal"/>Atpakaļ</button></a>

    </div>
    
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
