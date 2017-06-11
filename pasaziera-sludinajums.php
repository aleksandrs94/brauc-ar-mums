          <?php
              require 'db.php';
              session_start();

              $page_name = $_GET['page_id'];

                $result = $mysqli->query("SELECT * FROM users JOIN braucejs ON users.id=braucejs.users_id WHERE braucejs.id=$page_name") or die($mysqli->error());
                
                  while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="sludinajuma-info">';
                    //Lietotāja info
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
                      //Brauciena info
                      echo '<div class="brauciena-info">';
                        echo '<div class="marsruts-info">';
                          $sakums = $row['sakums'];
                          $beigas = $row['beigas'];
                          echo "<p>$sakums - $beigas</p>";
                        echo '</div>';
                        //pagaidu mainīgais, lai zinātu sludinājumu id
                        echo '<div class="id-info">';
                          $id = $row['id'];
                          echo "<p>$id</p>";
                        echo '</div>';

                        echo '<div class="datums-info">';
                          $datums = $row['datums'];
                          $laiks = $row['laiks'];
                          echo "<p>$datums | $laiks</p>";
                        echo '</div>';

                        echo '<div class="description-info">';
                          $description = $row['description'];
                          echo "<p>$description</p>";
                        echo '</div>';

                        echo '<div class="veids-ico">';
                          echo '<img src="img/human.png" width="35" height="70" alt="Search icon" />';
                        echo '</div>';

                      echo '</div>';
                    echo '</div>';
                  }

                 