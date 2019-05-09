<?php
    
    require 'database.php';

        if(!empty($_GET['idSport'])) 
    {
        $idSport = checkInput($_GET['idSport']);
    }
    
    $nameSport = $nameSportError = $titleSport = $titleSportError = $seasonSport = $idField = $seasonSportError = $descriptionSport = $descriptionSportError = $urlImageSport = $idFieldError = $urlImageSportError = "";

    if(!empty($_POST)){
        $nameSport = checkInput($_POST['nameSport']);
        $titleSport = checkInput($_POST['titleSport']);
        $seasonSport = checkInput($_POST['seasonSport']);
        $descriptionSport = checkInput($_POST['descriptionSport']);
        $idField = checkInput($_POST['idField']);
        $urlImageSport = checkInput($_POST['urlImageSport']); 
        
        $isSuccess = true;
        
        if(empty($nameSport)){
            $nameSportError = "Le nom du sport doit être entré";
            $isSuccess = false;
        }
        
        if(empty($titleSport)){
            $titleSportError = "Une brève description du sport doit être entrée";
            $isSuccess = false;
        }
        
        if(empty($seasonSport)){
            $seasonSportError = "La saison doit être entrée";
            $isSuccess = false;
        }
        
        if(empty($descriptionSport)){
            $descriptionSportError = "Merci d'entrer les règles du sport";
            $isSuccess = false;
        }
        
        if(empty($urlImageSport)){
            $urlImageSportError = "L'url menant vers une photo du sport doit être entré";
            $isSuccess = false;
        }
        
        if(empty($idField)){
            $idFieldError = "Le terrain du sport doit être entré";
            $isSuccess = false;
        }
        
       if($isSuccess){
           $db = Database::connect();
           $statement = $db->prepare("UPDATE sports SET nameSport = ?, titleSport = ?, seasonSport = ?, descriptionSport = ?, urlImageSport = ?, idField = ? WHERE idSport = ?");
           $statement->execute(array($nameSport, $titleSport, $seasonSport, $descriptionSport, $urlImageSport, $idField, $idSport));
           Database::disconnect();
           header("Location: indexAdmin.php");
            }
        
        
       }
        else {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM sports WHERE idSport = ?");
        $statement->execute(array($idSport));
            
        $sports = $statement->fetch();
        $nameSport = $sports['nameSport'];
        $titleSport = $sports['titleSport'];
        $seasonSport = $sports['seasonSport'];
        $descriptionSport = $sports['descriptionSport'];
        $idField = $sports['idField'];
        $urlImageSport = $sports['urlImageSport'];
        Database::disconnect();
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
        <title>Sports</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="stylesAdmin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>    
        <link rel="stylesheet" href="../stylesAdmin.css">
        <script src="js/script.js"></script>
        </head>
             
        <body>

            <div class="wrapp">
                <hr>
                <h1>Modifier un sport</h1>
                <hr>
                <!-- Formulaire -->
                <div class="formAddSport">
                    <form class="form" role="form" action="<?php echo 'update.php?idSport='.$idSport;?>" method="post">
                        <fieldset>

                            <!---  Nom du sport --->
                            <div class="form-group">
                                <label for="nameSport"></label>
                                <input type="text" id=nameSport name="nameSport" placeholder="Nom du sport" value="<?php echo $nameSport; ?>">
                                <p class="comments"><?php echo $nameSportError; ?></p>                       
                            </div>

                            <!---  Titre --->
                            <div class="form-group">
                                <label for="titleSport"></label>
                                <input type="text" id="titleSport" name="titleSport" placeholder="Breve description" value="<?php echo $titleSport; ?>">
                                <p class="comments"><?php echo $titleSportError; ?></p>
                            </div>

                            <!---  Saison --->
                            <div class="form-group">
                                <label for="seasonSport"></label>
                                <input type="text" id="seasonSport" name="seasonSport" placeholder="Saison" value="<?php echo $seasonSport; ?>">
                                <p class="comments"><?php echo $seasonSportError; ?></p>
                            </div>

                            <!---  Règles --->
                            <div class="form-group">
                                <label for="descriptionSport"></label>
                                <textarea name="descriptionSport" id="descriptionSport" placeholder="Règles du sport" cols="82" rows="10" value="<?php echo $descriptionSport; ?>"><?php echo $descriptionSport; ?></textarea>
                                <p class="comments"><?php echo $descriptionSportError; ?></p>
                                <!--<input type="text" placeholder="Règles du sport" name="reglesSport" ngModel required /><br>-->
                            </div>

                            <!---  Image --->
                            <div class="form-group">
                                <label for="urlImageSport"></label>
                                <input type="text" placeholder="Url photo" id="urlImageSport" name="urlImageSport" value="<?php echo $urlImageSport; ?>">
                                <p class="comments"><?php echo $urlImageSportError; ?></p>
                            </div>

                            <!-- Terrain  -->
                            <div class="form-group">
                                <label for="select">Terrain : </label><br>
                                <option>Selectionner</option>
                                <select id="idField" name="idField">
                                    <?php 
                                        $db = Database::connect();
                                        
                                        foreach($db->query('SELECT * FROM field') as $row){
                                            if($row['idField'] == $idField)
                                            echo '<option selected="selected" value ="' . $row['idField'] . '">' . $row['nameField'] . '</option>' ;
                                        else
                                            echo '<option value ="' . $row['idField'] . '">' . $row['nameField'] . '</option>' ;   
                                        }
                                    Database::disconnect();
                                    ?>
                                    
                                  
                                </select>
                            </div> 

                            <!--- Bouttons --->
                            <div class="form-actions">
                                <a class="btn btn-primary" href="indexAdmin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                                <button type="reset" class="btn btn-danger">Tout supprimer</button>
                                <button type="submit" class="btn btn-success" class="btn btn-primary">Valider</button>

                            </div>

                        </fieldset>
                    </form>
                </div>

            </div>
        
        </body>
        
    </html>