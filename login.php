<?php
/* Lietotāja ielogošanās process, pārbauda vai lietotājs eksistē un parole ir pareiza */

// Izlaižam e-pastu lai aizsargātos no SQL injekcijām
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
//$result = $mysqli->query("SELECT * FROM profils JOIN users WHERE email='$email'");


// Lietotājs neeksistē
if ( $result->num_rows == 0 ){
    $_SESSION['message'] = "Lietotājs ar šādu e-pastu neeksistē!";
    header("location: error.php");
}
else { // Lietotājs eksistē
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
/*        $_SESSION['first_name'] = $profils['first_name'];
        $_SESSION['last_name'] = $profils['last_name'];
        $_SESSION['users_id'] = $profils['users_id'];*/
        $_SESSION['active'] = $user['active'];
        
        // Šis parāda, ka lietotājs ir pieslēdzies
        $_SESSION['logged_in'] = true;

        header("location: main.php");
    }
    else {
        $_SESSION['message'] = "Jūs esiet ievadījis nepareizu paroli, mēģiniet vēlreiz!";
        header("location: error.php");
    }
}

