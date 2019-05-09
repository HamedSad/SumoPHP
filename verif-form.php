<?php

require 'Admin/database.php';


    if(!empty($_GET["terme"])){
    $terme = checkInput($_GET["terme"]);
    }

$db = Database::connect();

   //$bdd->query("SET NAMES UTF8");

 if (isset($terme))
 {
  $terme = strtolower($terme);
  $select_terme = $db->prepare("SELECT sports.nameSport, sports.descriptionSport, sports.titleSport, sports.urlImageSport, sports.idSport FROM sports WHERE sports.nameSport LIKE ? OR sports.descriptionSport LIKE ? OR sports.titleSport LIKE ?");
  $select_terme->execute(array("%".$terme."%", "%".$terme."%", "%".$terme."%"));
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
        <title>Les résultats de recherche</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

          //echo "<div><h2>"  . $terme_trouve['nameSport'] . "</h2><p> " . $terme_trouve['descriptionSport'] . "</p>";

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



          }          

                         Database::disconnect();

                    ?>

                         </tbody>
                     </table>
     </body>
</html>