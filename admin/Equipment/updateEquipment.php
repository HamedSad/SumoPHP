<?php
    
    require '../database.php';

        if(!empty($_GET['idField'])) 
    {
        $idField = checkInput($_GET['idField']);
    }
    
    $nameField = $nameFieldError = $dimensionsField = $dimensionsFieldError = $urlImageField = $urlImageFieldError = "";

    if(!empty($_POST)){
        $nameField = checkInput($_POST['nameField']);
        $dimensionsField = checkInput($_POST['dimensionsField']);
        $urlImageField = checkInput($_POST['urlImageField']);
        //$idField = checkInput($_POST['idField']);
        
        $isSuccess = true;
        
        if(empty($nameField)){
            $nameFieldError = "Le nom du terrain doit être entré";
            $isSuccess = false;
        }
        
        if(empty($dimensionsField)){
            $dimensionsFieldError = "Les dimensions du terrain doivent être entrée";
            $isSuccess = false;
        }
        
        if(empty($urlImageField)){
            $urlImageFieldError = "L'url de l'image du terrain doit être entrée";
            $isSuccess = false;
        }      
 
        
       if($isSuccess){
           $db = Database::connect();
           $statement = $db->prepare("UPDATE field SET nameField = ?, dimensionsField = ?, urlImageField = ? WHERE idField = ?");
           $statement->execute(array($nameField, $dimensionsField, $urlImageField, $idField));
           Database::disconnect();
           header("Location: ../indexAdmin.php");
            }
        
}
       
        else {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM field WHERE idField = ?");
        $statement->execute(array($idField));
            
        $field = $statement->fetch();
        $nameField = $field['nameField'];
        $dimensionsField = $field['dimensionsField'];
        $urlImageField = $field['urlImageField'];
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
        <title>Terrain</title>
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
                <h1>Modifier un terrain</h1>
                <hr>
                <!-- Formulaire -->
                <div class="formAddSport">
                    <form class="form" role="form" action="<?php echo 'updateField.php?idField='.$idField;?>" method="post">
                        <fieldset>

                            <!---  Nom du terrain --->
                            <div class="form-group">
                                <label for="nameField"></label>
                                <input type="text" id=nameField name="nameField" placeholder="Nom du terrain" value="<?php echo $nameField; ?>">
                                <p class="comments"><?php echo $nameFieldError; ?></p>                       
                            </div>
  
                            <!---  Dimensions --->
                            <div class="form-group">
                                <label for="dimensionsField"></label>
                                <input type="text" id="dimensionsField" name="dimensionsField" placeholder="Dimensions du terrainn" value="<?php echo $dimensionsField; ?>">
                                <p class="comments"><?php echo $dimensionsFieldError; ?></p>
                            </div>

                            <!---  Image --->
                            <div class="form-group">
                                <label for="urlImageField"></label>
                                <input type="text" placeholder="Url photo" id="urlImageField" name="urlImageField" value="<?php echo $urlImageField; ?>">
                                <p class="comments"><?php echo $urlImageFieldError; ?></p>
                            </div>



                            <!--- Bouttons --->
                            <div class="form-actions">
                                <a class="btn btn-primary" href="../indexAdmin.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                                <button type="reset" class="btn btn-danger">Tout supprimer</button>
                                <button type="submit" class="btn btn-success" class="btn btn-primary">Valider</button>

                            </div>

                        </fieldset>
                    </form>
                </div>

            </div>
        
        </body>
        
    </html>