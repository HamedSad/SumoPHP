<?php

require 'Admin/database.php';


    if(!empty($_GET["terme"])){
    $terme = checkInput($_GET["terme"]);
    }
$message = "";
$nombre = 0;
$db = Database::connect();

   //$bdd->query("SET NAMES UTF8");

 if (isset($terme))
 {
  $terme = strtolower($terme);
  $select_terme = $db->prepare("SELECT * FROM sports s
  INNER JOIN field f
  ON s.idField = f.idField
  WHERE s.nameSport LIKE ? OR s.descriptionSport LIKE ? OR s.titleSport LIKE ? OR f.nameField LIKE ? ");
  $select_terme->execute(array("%".$terme."%", "%".$terme."%", "%".$terme."%", "%".$terme."%"));
 }
 else
 {
  $message = "Vous devez entrer votre requete dans la barre de recherche";
 }
 

function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Les résultats de recherche</title>     
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link type="text/css" rel="stylesheet" href="admin/stylesAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        
        
            
        
    </head>
     <body>
         <h1>Les résultats de recherche : </h1>

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
                while($terme_trouve = $select_terme->fetch())
                    {
                    echo'<tr>';
                        echo '<td><img src=' . $terme_trouve['urlImageSport'] . ">" .'</td>';
                        echo '<td>' . $terme_trouve['nameSport'] . '</td>';
                        echo '<td>' . $terme_trouve['titleSport'] . '</td>';
                        echo '<td><a href="admin/viewAdmin.php?idSport=' . $terme_trouve['idSport'] . ' "><span class="glyphicon glyphicon-eye-open"></span> Voir </a>';
                        echo '<a class="btn btn-primary" href="admin/update.php?idSport='. $terme_trouve['idSport'] . ' "><span class="glyphicon glyphicon-pencil"></span> Modifier </a>';
                        echo '<a class="btn btn-danger" href="admin/delete.php?idSport=' . $terme_trouve['idSport'] . ' "><span class="glyphicon glyphicon-remove"></span> Supprimer </a>';
                        echo '<a href="viewAdmin.php?idSport=' . $terme_trouve['idSport']. '">' ;
                        echo "</a></td>";
                    echo '</tr>';
                    
                    $nombre++; 
                    
                    }          
                    echo '<br>';  
                if($nombre == 0){            
                    echo 'Désolé, il n y a pas de résultat  à votre recherche';              
                }
                else if($nombre == 1){
                    echo 'Il y a ' . $nombre . ' résultat à votre recherche';
                }
                else{
                    echo 'Il y a ' . $nombre . ' résultats à votre recherche';
                }
                   
                   

                Database::disconnect();
                    
                    ?>

            </tbody>
        </table>
     </body>
</html>