<?php 
/* Apstiprina reģistrējušās lietotāja e-pastu, links uz šo saiti tiek iekļauts register.php epasta adresē,
lietotājs to redz saņemtajā e-pastā */

require 'db.php';
session_start();

// Pārbaudam vai e-pasta un paroles haša mainīgie nav tukši
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 
    
    // Tiek atlasīts lietotājs ar sakritušo epasta adresi un paroles hašu un kas vēl nav apstiprinājuši profilu (active = 0)
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message'] = "Profils jau ir aktivizēts vai URL adrese ir nepareiza!";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Jūsu profils ir veiksmīgi apstiprināts!";
        
        // Iestādam lietotāja profilu kā aktīvu (active = 1)
        $mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        
        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Tika iesniegti nepareizi dati profila apstiprināšanai!";
    header("location: error.php");
}     
?>