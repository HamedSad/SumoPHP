<?php 

    require '../database.php';

    

    if(!empty ($_GET['idField'])){
        $idField = checkInput($_GET['idField']);
    }

    $db = Database::connect();
    $statement = $db->prepare('SELECT f.nameField, f.dimensionsField, f.urlImageField, s.nameSport 
    FROM field AS f
    INNER JOIN sports AS s
    ON s.idField = f.idField
    WHERE f.idField = ?');


    $statement->execute(array($idField));
    $field = $statement->fetch();

        function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    Database::disconnect();
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
        <div class="wrapp">
            <h1> <?php echo $field['nameField'] ; ?><br></h1>
            <hr>
            <div class="textesport">

                <?php echo "<img src=" . $field['urlImageField'] . ">" ; ?><br><br>
                <?php echo "Dimensions : " . $field['dimensionsField'] ; ?><br><br>
                 
             
               <?php 
                    
                if($field['nameSport'] !=null)   {
                    echo '<p>Sports pratiqués sur ce terrain : ';
                    echo $field['nameSport'] . '';
                
                  while($field = $statement->fetch()){
                    echo ', ';
                    echo $field['nameSport'] ; 
                    }
           
                  }
                    else{
                        echo "Ce terrain n'est pas encore utilisé";
                    }
                echo '</p>';
                
                
                
                ?>
                

            </div>
           <a class="btn btn-primary" href="../indexAdmin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
        </div>
    </body>
</html>