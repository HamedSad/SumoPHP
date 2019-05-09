<?php 

    require 'admin/database.php';

    if(!empty ($_GET['idField'])){
        $idField = checkInput($_GET['idField']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM field WHERE idField = ?');

    $statement->execute(array($idField));
    $field = $statement->fetch();

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
        <title>Terrains</title>
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
        <div class="wrapp2">
            <h2> <?php echo $field['nameField'] ; ?><br></h2>
            <hr>
            <div class="textesport">

                <?php echo "<img src=" . $field['urlImageField'] . ">" ; ?><br><br>
                    
            </div>
           <a href="index.php">Retour</a>
        </div>
    </body>
</html>