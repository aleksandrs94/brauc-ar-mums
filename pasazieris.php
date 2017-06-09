<?php
// Sludinājumu pievienošanas process
$_SESSION['sakums'] = $_POST['sakums'];
$_SESSION['beigas'] = $_POST['beigas'];
$_SESSION['datums'] = $_POST['datums'];
$_SESSION['laiks'] = $_POST['laiks'];
$_SESSION['description'] = $_POST['description'];

// Escape all $_POST variables to protect against SQL injections
$sakums = $mysqli->escape_string($_POST['sakums']);
$beigas = $mysqli->escape_string($_POST['beigas']);
$datums = $mysqli->escape_string($_POST['datums']);
$laiks = $mysqli->escape_string($_POST['laiks']);
$description = $mysqli->escape_string($_POST['description']);
$id = $_SESSION['id'];

// Check if user with that email already exists
// $result = $mysqli->query("SELECT * FROM users JOIN profils WHERE users.email='$email'") or die($mysqli->error());
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows < 0 ) {
    
    $_SESSION['message'] = 'Lietotājs ar šādu e-pastu neeksistē!';
    header("location: error.php");
    
}
else {
    $sql = "INSERT INTO braucejs (users_id, sakums, beigas, datums, laiks, description) " 
        . "VALUES ('$id','$sakums','$beigas','$datums','$laiks','$description')";

        $mysqli->query($sql);
    }

/*// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'Lietotājs ar šādu e-pastu jau eksistē!';
    header("location: error.php");
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash) " 
            . "VALUES ('$first_name','$last_name','$email','$password','$hash')";*/