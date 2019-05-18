<?php 

    

    require 'admin/database.php';

    if(!empty ($_GET['idSport'])){
        $idSport = checkInput($_GET['idSport']);
    }

    $db = Database::connect();

    $statement = $db->prepare('SELECT sports.idSport, sports.nameSport, sports.titleSport, sports.seasonSport, sports.descriptionSport, sports.urlImageSport, field.idField, field.nameField, field.urlImageField FROM sports INNER jOIN field ON sports.idField = field.idField WHERE idSport = ?');

    $statement->execute(array($idSport));
    $sport = $statement->fetch();

        function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

session_start();
    $_SESSION['sportName'] = $sport['nameSport'];

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Sport</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles.css">
        <script src="js/script.js"></script>
    </head>
    
    <body> 
        <div class="wrapp">
            <h1> <?php echo $sport['nameSport'] ; ?><br></h1>
            <hr>
            <div class="textesport">

                <?php echo "<img src=" . $sport['urlImageSport'] . ">" ; ?><br><br>

                <p>
                    <?php echo $sport['titleSport'] ; ?><br><br>
                    Saison : <?php echo $sport['seasonSport'] ; ?><br><br>
                    Terrain : <?php echo '<a href="field.php?idField=' . $sport['idField'] . ' ">' . $sport['nameField'] . '</a>'; ?><br><br>
                    Règles du <?php echo $sport['nameSport'] ; ?> : <?php echo $sport['descriptionSport'] ; ?><br><br></p>
                    
            </div>
           <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>
    </body>
</html>
