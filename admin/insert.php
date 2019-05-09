<?php
    
    require 'database.php';
    
    $nameSport = $nameSportError = $titleSport = $titleSportError = $seasonSport = $idField = $seasonSportError = $descriptionSport = $descriptionSportError = $urlImageSport = $urlImageSportError = $idFieldError = "";

    if(!empty($_POST)){
        $nameSport = checkInput($_POST['nameSport']);
        $titleSport = checkInput($_POST['titleSport']);
        $seasonSport = checkInput($_POST['seasonSport']);
        $descriptionSport = checkInput($_POST['descriptionSport']);
        $urlImageSport = checkInput($_POST['urlImageSport']); 
        $idField = checkInput($_POST['idField']);
        
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
           $statement = $db->prepare("INSERT INTO sports (nameSport, titleSport, seasonSport, descriptionSport, urlImageSport, idField) VALUES (?, ?, ?, ?, ?, ?)");
           $statement->execute(array($nameSport, $titleSport, $seasonSport, $descriptionSport, $urlImageSport, $idField));
           Database::disconnect();
           header("Location: indexAdmin.php");
       }
        
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
                <h1>Ajouter un sport</h1>
                <hr>
                <!-- Formulaire -->
                <div class="formAddSport">
                    <form class="form-horizontal" role="form" action="insert.php" method="post">
                        <fieldset>

                            <!---  Nom du sport --->
                            <div class="form-group">
                                <label for="nameSport"></label>
                                <input type="text" id=nameSport name="nameSport" placeholder="Nom du sport" value="<?php echo $nameSport; ?>">
                                <p class="comments"><?php echo $nameSportError; ?></p>                       
                            </div>

                            <!---  Description --->
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
                                <label for="descriptionSport" ></label>
                                <textarea name="descriptionSport" id="descriptionSport" placeholder="Règles du sport" cols="82" rows="10" ><?php echo $urlImageSport; ?></textarea>
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
                                <label for="field">Terrain : </label><br>
                                <select class="form" id="idField" name="idField">
                                    <?php
                                        $db = Database::connect();
                                        foreach($db->query("SELECT * FROM field") as $row){
                                            echo '<option value ="' . $row['idField'] . '">' . $row['nameField'].'</option>';
                                            }
                                        Database::disconnect();  
                                    
                                    ?>
                                </select>
                                <p class="comments"><?php echo $idFieldError; ?></p>
                            </div> 
                            
                            <!-- Menu déroulant terrain -->

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