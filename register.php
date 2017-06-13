<?php
/* Registration process, inserts user info into the database 
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];

//$_SESSION['image'] = $_POST['image'];
//$_SESSION['p_number'] = $_POST['pnumber'];
//$_SESSION['users_id'] = $_POST['usersid'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

//$image = $mysqli->escape_string($_POST['image']);
//$p_number = $mysqli->escape_string($_POST['pnumber']);
//$users_id = $mysqli->escape_string($_POST['usersid']);
      
// Check if user with that email already exists
// $result = $mysqli->query("SELECT * FROM users JOIN profils WHERE users.email='$email'") or die($mysqli->error());
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'Lietotājs ar šādu e-pastu jau eksistē!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash) " 
            . "VALUES ('$first_name','$last_name','$email','$password','$hash')";

/*    $sql_two = "INSERT INTO profils (first_name, last_name) " 
            . "VALUES ('$first_name','$last_name')";*/

    // Add user to the database
    if ( $mysqli->query($sql) ) {
        $result2 = $mysqli->query("SELECT * FROM users WHERE email='$email'");
            if ( $result2->num_rows == 0 ){
                $_SESSION['message'] = "Lietotājs ar šādu e-pastu neeksistē!";
                header("location: error.php");
            }
            else { // Lietotājs eksistē
                    $user = $result2->fetch_assoc();
                    //$mysqli->query($sql_two);
                    $_SESSION['id'] = $user['id'];
                    }
                    
        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Apstiprināšanas links tika nosūtīts uz $email, lūdzu apstiriniet savu profilu, nospiežot linku, kas atrodas ziņojumā!";

        // Nosūta reģistrācijas apstiprināšanas linku (verify.php)
        $to      = $email;
        $subject = 'Apstipriniet Registraciju ( braucarmums.lv )';
        $message_body = '
        Labdien '.$first_name.',

        Paldies par reģistrāciju!

        Lūdzu nospiedied šo linku, lai apstiprinātu profilu:

        http://localhost/test/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body );

        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Reģistrācija neizdevās!';
        header("location: error.php");
    }

}