          <?php
            require 'db.php';
            session_start();

            //if (isset($_POST['submitt'])) {

                $id = $_SESSION['id'];
                $first_name = $_SESSION['first_name'];
                $last_name = $_SESSION['last_name'];
                $email = $_SESSION['email'];

                $_SESSION['first_name'] = $_POST['firstname'];
                $_SESSION['last_name'] = $_POST['lastname'];
                $_SESSION['p_number'] = $_POST['pnumber'];

                // Escape all $_POST variables to protect against SQL injections
                $first_name = $mysqli->escape_string($_POST['firstname']);
                $last_name = $mysqli->escape_string($_POST['lastname']);
                $p_number = $mysqli->escape_string($_POST['pnumber']);


                $result = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', p_number = '$p_number' WHERE id = '$id'";
                $mysqli->query($result);

                if ($result) {
                    //echo "<p>Record Updated<p>";
                    //include 'profile.php';
                }
                else
                {
                    $_SESSION['message'] = "Atvainojiet, radās problēmas ar datu saglabāšanu!";
                    header("location: error.php");
                }
            //}

