<?php 
/* Galvenā lapa ar divām formām: pierakstīties un reģistrēties */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Galvenā</title>
  <?php include 'css/css.html'; ?>

</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['pasazieris'])) { //lietotāja pierakstīšanās

        require 'pasazieris.php';
        
    }
    
    elseif (isset($_POST['brauciens'])) { //lietotāja reģistrācija
        
        require 'brauciens.php';
        
    }
}
?>

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
  <div class="pogas-logged">
      <ul class="tab-group">
          <li class="tab"><a href="#brauciens">+ Brauciens</a></li>
          <li class="tab active"><a href="#pasazieris">+ Pasažieris</a></li>
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
              //echo $row['email'];
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
<!--Pievienot Pasažieri-->
  <div class="sludinajumu-form">
      <div class="tab-content">
         <div id="pasazieris">
          <h1>Pievienot Pasažieri</h1>

           <form action="pievienot.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                No<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='sakums' />
            </div>
        
            <div class="field-wrap">
              <label>
                Uz<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='beigas' />
            </div>
          </div>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Datums<span class="req">*</span>
              </label>
              <input type="text" placeholder='' onfocus="(this.type='date')" onfocusout="(this.type='text')" placeholder="false" required autocomplete="off" name='datums' />
            </div>
            
            <div class="field-wrap">
              <label>
                Laiks<span class="req">*</span>
              </label>
              <input type="text" placeholder='' onfocus="(this.type='time')" onfocusout="(this.type='text')" placeholder="false" required autocomplete="off" name='laiks'/>
            </div>
          </div>

          <div class="field-wrap">
              <label>
                Apraksts
              </label>
              <input type="textarea" autocomplete="off" name='description'/>
          </div>

          <button type="submit" class="button button-block" name="brauciens" />Pievienot</button>
          
          </form>
        </div>

          <!--Pievienot Braucienu-->
        <div id="brauciens">
          <h1>Pievienot Braucienu</h1>
          
          <form action="pievienot.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                No<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='sakums' />
            </div>
        
            <div class="field-wrap">
              <label>
                Uz<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='beigas' />
            </div>
          </div>

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Datums<span class="req">*</span>
              </label>
              <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')" required autocomplete="off" name='datums' />
            </div>
            
            <div class="field-wrap">
              <label>
                Laiks<span class="req">*</span>
              </label>
              <input type="text" onfocus="(this.type='time')" onfocusout="(this.type='text')" required autocomplete="off" name='laiks'/>
            </div>
          </div>

          <div class="field-wrap">
              <label class="active">
                Vietu skaits<span class="req">*</span>
              </label>
              <output name="output-skaits" id="outputId">1</output>
              <input id="inputId" type="range" required autocomplete="off" min="1" max="8" value="1" name="input-skaits" oninput="outputId.value = inputId.value"/>
              
          </div>

          <div class="field-wrap">
              <label>
                Apraksts
              </label>
              <input type="textarea" autocomplete="off" name='description'/>
          </div>

          <button type="submit" class="button button-block" name="brauciens" />Pievienot</button>
          
          </form>
        </div>  
      </div>
</div> 


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>