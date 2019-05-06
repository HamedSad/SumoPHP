<!DOCTYPE html>
    <html>
        <head>
        <title>Sports</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>            
        </head>
             
        <body>

            <div class="wrapp">
          
                  <hr>
                  <h1>Menu administrateur</h1>
                  <a href='insert.php'><h5>Ajouter un sport</h5></a>
                  <hr>
   
                
             <div class="sports">
                                       
                 <?php
                      
                    require 'database.php';
                    $db = Database::connect();
                    $statement = $db->query("SELECT * FROM sports ORDER BY sports.idSport DESC");
                 
                while($sport = $statement->fetch()){
                    echo '<a href="viewAdmin.php?idSport=' . $sport['idSport']. '">' ;
                    echo "<div class='alignementsport'>";
                        echo "<div class='infosport'>"; 
                            echo "<img src=" . $sport['urlImageSport'] . ">";
                            echo $sport['nameSport'] . '<br>';
                            echo $sport['titleSport'] . '<br>';
                            echo $sport['seasonSport'] . '<br>'; 
                        echo "</div>";
                        echo '<a class="btn btn-danger" href="delete.php?idSport=' . $sport['idSport'] . ' "><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                    echo "</div>";

                    echo "</a>";
                    
                }
                
                     Database::disconnect();
      
                ?>
   
              </div>
            </div>             
        </body>
    </html>
                    