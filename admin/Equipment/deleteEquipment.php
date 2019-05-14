<?php
//On requiere le fichier database.php pour pouvoir utiliser son contenu  
    require '../database.php';

    if(!empty($_GET['idField'])){
        $idField = checkInput ($_GET['idField']);
    }

if(!empty($_POST)){
   //ici je récupère mon id 
    $idField = checkInput ($_POST['idField']);
    //Et je lance ma requete pour supprimer l'item
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM field WHERE idField = ?");
    $statement->execute(array($idField));
    Database::disconnect();
    header("Location: ../indexAdmin.php");
    
}


//Cette fonction va vérifier plusieurs choses pour la sécurité
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
        <title>Supprimer un terrain</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="stylesAdmin.css">
        
    </head>
    
    <body>          
            <div class="wrapp">
                <hr>
                <h1><strong>Suppression</strong></h1>  
                <hr>
                <br>
                <!--  formulaire dynamique action en delete.php, après avoir soumis le form il reviendra sur la page delete.php, methode post car on lui donne les infos et enctype pour uploader des fichiers   -->
                <form class="form" role="form" action="deleteField.php?=" method="post">
                   <!--  Ici on récupère l'id de l'item à supprimer dans un input mais on passe le type en hidden pour qu'il ne soit pas visible -->
                    <input type="hidden" name="idField" value="<?php echo $idField; ?>">
                    <p>Etes-vous sure de vouloir supprimer ce terrain?</p>
                    <div class="form-actions-delete">
                        <button type="submit" class="btn btn-danger btn-lg"> Oui</button>
                        <a class="btn btn-default btn-lg" href="../indexAdmin.php"> Non</a>
                    </div>
                </form>                                 
            </div>  
    </body>
</html>