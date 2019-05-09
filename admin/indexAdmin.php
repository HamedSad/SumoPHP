<!DOCTYPE html>
    <html>
        <head>
        <title>Sports</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>            
        </head>
             
        <body>

            <div class="wrapp">
          
                  <hr>
                  <h1>Menu administrateur</h1>
                  <a href='insert.php'><h5> <span class="glyphicon glyphicon-plus-sign"></span>Ajouter un sport  </h5></a>
                  <hr>
                    <div class="recherche">
                        <?php
                            include "../recherche.php";
                        ?>
                        <br>
                    </div>
                
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Sport</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>                   
                    </thead>
                    
                    <tbody>
                                       
                 <?php
                      
                    require 'database.php';
                    $db = Database::connect();
                    $statement = $db->query("SELECT * FROM sports ORDER BY sports.idSport DESC");
                 
                    while($sport = $statement->fetch()){
                    
                        echo'<tr>';

                        echo '<td><img src=' . $sport['urlImageSport'] . ">" .'</td>';
                        echo '<td>' . $sport['nameSport'] . '</td>';
                        echo '<td>' . $sport['titleSport'] . '</td>';
                        echo '<td>' . '<a href="viewAdmin.php?idSport=' . $sport['idSport'] . ' "><span class="glyphicon glyphicon-eye-open"></span> Voir </a>';
                        echo '<a class="btn btn-primary" href="update.php?idSport='. $sport['idSport'] . ' "><span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
                        echo '<a class="btn btn-danger" href="delete.php?idSport=' . $sport['idSport'] . ' "><span class="glyphicon glyphicon-remove"></span> Supprimer </a>';
                        echo '<a href="viewAdmin.php?idSport=' . $sport['idSport']. '">' ;
                        echo "</a>";
                        echo '</tr>';
                    
                }
                
                     Database::disconnect();
      
                ?>
                       
                     </tbody>
                 </table>
   
              </div>
                      
        </body>
    </html>
                    