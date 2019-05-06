<?php 

    require 'database.php';

    if(!empty ($_GET['idSport'])){
        $idSport = checkInput($_GET['idSport']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM sports WHERE idSport = ?');

    $statement->execute(array($idSport));
    $sport = $statement->fetch();

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
        <title>Sport Admin</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../styles.css">
        <script src="js/script.js"></script>
    </head>
    
    <body> 
        
        <div class="wrapp">
            <h1>Menu admin</h1>
            <h1> <?php echo $sport['nameSport'] ; ?><br></h1>
            <hr>
            <div class="textesport">

                <?php echo "<img src=" . $sport['urlImageSport'] . ">" ; ?><br><br>

                <p>
                    <?php echo $sport['nameSport'] ; ?><br><br>
                    Saison : <?php echo $sport['seasonSport'] ; ?><br><br>
                    Règles du <?php echo $sport['nameSport'] ; ?> : <?php echo $sport['descriptionSport'] ; ?><br></p>
            </div>
           <a href="indexAdmin.php">Retour</a>
        </div>
    </body>
</html>
