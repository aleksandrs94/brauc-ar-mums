<?php 
/* Galvenā lapa ar divām formām: pierakstīties un reģistrēties */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Sākums</title>
  <?php include 'css/css.html'; ?>

</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //lietotāja pierakstīšanās

        require 'login.php';
        
    }
    
    elseif (isset($_POST['register'])) { //lietotāja reģistrācija
        
        require 'register.php';
        
    }
}
?>

<body>
<!--Lapas galvene-->
<div class="header">

<!--Logo-->
<div class="logo">
  <a href="index.php">
    <img src="img/BrumLogo.png" alt="BrumBrum Logo" />
  </a>
</div>

<!--Pogas-->
  <div class="pogas">
      <ul class="tab-group">
          <li class="tab"><a href="#signup">Reģistrēties</a></li>
          <li class="tab active"><a href="#login, #main">Pierakstīties</a></li>
      </ul>
  </div>
</div>

<!--Login forma-->
  <div class="login-form">
      <div class="tab-content">
         <div id="login">   
          <form action="index.php" method="post" autocomplete="off">

            <div class="credentials-wrapper">
              <div class="field-wrap">
                <label>
                  E-pasta Adrese<span class="req">*</span>
                </label>
                <input type="email" required autocomplete="off" name="email"/>
              </div>
              
              <div class="field-wrap">
                <label>
                  Parole<span class="req">*</span>
                </label>
                <input type="password" required autocomplete="off" name="password"/>
              </div>
              
              <button class="button button-block" name="login" />Pierakstīties</button>

              <p class="forgot"><a href="forgot.php">Aizmirsāt Paroli?</a></p>

            </div>
          </form>
        </div>

        <!--Lapas saturs-->
        <div id="main" class="content">
          <h1>Braucam Kopā!</h1>
                    <div class="profile-cover">
                    <?php
                      $con = mysqli_connect("localhost","root","","accounts");
                      $q = mysqli_query($con,"SELECT * FROM users");


                        while($row = mysqli_fetch_assoc($q)){
                          echo '<div class="sludinajuma-info">';
                            echo '<div class="profile-info">';
                              if($row['image'] == ""){
                                echo "<img width='100' height='100' src='img/profile/default.png' alt='Default Profile Pic'>";
                              } else {
                                echo "<img width='100' height='100' src='img/profile/".$row['image']."' alt='Profile Pic'>";
                              }
                              echo '<div class="name">';
                              $name = $row['first_name'];
                              $surname = $row['last_name'];
                              echo "<p> $name $surname </p>"; 
                              echo '</div>';
                            echo '</div>';
                          echo '</div>';
                        }
                      ?>
                    </div>
                  </div>

          <!--Reģistrācija-->
        <div id="signup">   
          <h1>Rēģistrēties</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Vārds<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label>
                Uzvārds<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              E-pasta Adreses<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Iestatiet Paroli<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name='password'/>
          </div>

          <button type="submit" class="button button-block" name="register" />Reģistrēties</button>
          
          </form>
        </div>  
      </div>
</div> 


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
