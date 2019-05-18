 <?php
                      
        require 'database.php';
        $db = Database::connect();
        $statement = $db->query("SELECT * FROM sports ORDER BY sports.idSport DESC");

    ?>



<!DOCTYPE html>
    <html>
        <head>
        <title>Sports</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        </head>
             
        <body>

            <div class="wrapp">
                  <hr>
                  <h1>Menu administrateur</h1>

                  <a href='insert.php'><h5> <span class="glyphicon glyphicon-plus-sign"></span>Ajouter un sport</h5></a>
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
                ?>
            
                       
                     </tbody>
                 </table>
                
                <br>
                <br>
                <br>
                <br>
                
                
                <a href='../admin/Field/insertField.php'><h5> <span class="glyphicon glyphicon-plus-sign"></span>Ajouter un terrain</h5></a>
                  <hr>
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Terrain</th>
                            <th>Dimensions</th>
                            <th>Actions</th>
                        </tr>                   
                    </thead>
                    
                    <tbody>
                                       
                 <?php
                      
                    
                    $statement = $db->query("SELECT * FROM field ORDER BY field.nameField ASC");
                 
                    while($field = $statement->fetch()){
                    
                        echo'<tr>';
                        echo '<td><img src=' . $field['urlImageField'] . ">" .'</td>';
                        echo '<td>' . $field['nameField'] . '</td>';
                        echo '<td>' . $field['dimensionsField'] . '</td>';
                        
                        echo '<td>' . '<a href="../Admin/Field/viewField.php?idField=' . $field['idField'] . ' "><span class="glyphicon glyphicon-eye-open"></span> Voir </a>';
                        
                        echo '<a class="btn btn-primary" href="../admin/Field/updateField.php?idField='. $field['idField'] . ' "><span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
                        
                        echo '<a class="btn btn-danger" href="../admin/Field/deleteField.php?idField=' . $field['idField'] . ' "><span class="glyphicon glyphicon-remove"></span> Supprimer </a>';
                        
                        echo '<a href="viewField.php?idField=' . $field['idField']. '">' ;
                        
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