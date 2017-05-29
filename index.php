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

<!--Pogas-->
  <div class="pogas">
      <ul class="tab-group">
          <li class="tab"><a href="#signup">Reģistrēties</a></li>
          <li class="tab active"><a href="#login">Pierakstīties</a></li>
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

          <!--Reģistrācija-->
        <div id="signup">   
          <h1>Rēgistrēties</h1>
          
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
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              E-pasta Adreses<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label>
              Iestatiet Paroli<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>

          <button type="submit" class="button button-block" name="register" />Reģistrēties</button>
          
          </form>
        </div>  
      </div>
</div> 

<!--Lapas saturs-->
<div class="content">
  <h1>Lorem ipsum dolor!</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu sem odio. In in nisl vulputate, vulputate ante eget, posuere lacus. Nullam aliquam mollis nibh sed interdum. Nunc eget sem faucibus tellus finibus tempor. Nam ornare sagittis risus et aliquam. Mauris tincidunt imperdiet nisl vitae euismod. Suspendisse leo elit, consectetur ac gravida sed, viverra cursus tortor. Maecenas vel ullamcorper libero. Curabitur sollicitudin, urna ac efficitur vehicula, urna urna aliquam risus, ac sollicitudin sapien metus non arcu. Donec at orci urna. Sed tincidunt turpis hendrerit purus scelerisque, sed aliquet neque convallis. Ut tempor nunc tortor, eu eleifend ligula tempus eu.</br>
  Nullam aliquam mollis nibh sed interdum. Nunc eget sem faucibus tellus finibus tempor. Nam ornare sagittis risus et aliquam. Mauris tincidunt imperdiet nisl vitae euismod. Suspendisse leo elit, consectetur ac gravida sed, viverra cursus tortor. Maecenas vel ullamcorper libero. Curabitur sollicitudin, urna ac efficitur vehicula, urna urna aliquam risus, ac sollicitudin sapien metus non arcu. Donec at orci urna.</br>
  Nullam aliquam mollis nibh sed interdum. Nunc eget sem faucibus tellus finibus tempor. Nam ornare sagittis risus et aliquam. Mauris tincidunt imperdiet nisl vitae euismod. Suspendisse leo elit, consectetur ac gravida sed, viverra cursus tortor. Maecenas vel ullamcorper libero. Curabitur sollicitudin, urna ac efficitur vehicula, urna urna aliquam risus, ac sollicitudin sapien metus non arcu. Donec at orci urna.
  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu sem odio. In in nisl vulputate, vulputate ante eget, posuere lacus. Nullam aliquam mollis nibh sed interdum. Nunc eget sem faucibus tellus finibus tempor. Nam ornare sagittis risus et aliquam. Mauris tincidunt imperdiet nisl vitae euismod. Suspendisse leo elit, consectetur ac gravida sed, viverra cursus tortor. Maecenas vel ullamcorper libero. Curabitur sollicitudin, urna ac efficitur vehicula, urna urna aliquam risus, ac sollicitudin sapien metus non arcu. Donec at orci urna. Sed tincidunt turpis hendrerit purus scelerisque, sed aliquet neque convallis. Ut tempor nunc tortor, eu eleifend ligula tempus eu.</br>
  Nullam aliquam mollis nibh sed interdum. Nunc eget sem faucibus tellus finibus tempor. Nam ornare sagittis risus et aliquam. Mauris tincidunt imperdiet nisl vitae euismod. Suspendisse leo elit, consectetur ac gravida sed, viverra cursus tortor. Maecenas vel ullamcorper libero. Curabitur sollicitudin, urna ac efficitur vehicula, urna urna aliquam risus, ac sollicitudin sapien metus non arcu. Donec at orci urna.</br>
  Nullam aliquam mollis nibh sed interdum. Nunc eget sem faucibus tellus finibus tempor. Nam ornare sagittis risus et aliquam. Mauris tincidunt imperdiet nisl vitae euismod. Suspendisse leo elit, consectetur ac gravida sed, viverra cursus tortor. Maecenas vel ullamcorper libero. Curabitur sollicitudin, urna ac efficitur vehicula, urna urna aliquam risus, ac sollicitudin sapien metus non arcu. Donec at orci urna.</p>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
