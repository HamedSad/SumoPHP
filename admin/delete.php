<?php
//On requiere le fichier database.php pour pouvoir utiliser son contenu  
    require 'database.php';

    if(!empty($_GET['idSport'])){
        $id = checkInput ($_GET['idSport']);
    }

if(!empty($_POST)){
   //ici je récupère mon id 
    $idSport = checkInput ($_POST['idSport']);
    //Et je lance ma requete pour supprimer l'item
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM sports WHERE idSport = ?");
    $statement->execute(array($idSport));
    Database::disconnect();
    header("Location: indexAdmin.php");
    
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
        <title>Supprimer un sport</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../styles.css">
        
    </head>
    
    <body>          
            <div class="wrapp">
    
                <h1><strong>Supprimer un sport</strong></h1>  
                <br>
                <!--  formulaire dynamique action en delete.php, après avoir soumis le form il reviendra sur la page delete.php, methode post car on lui donne les infos et enctype pour uploader des fichiers   -->
                <form class="form" role="form" action="delete.php" method="post">
                   <!--  Ici on récupère l'id de l'item à supprimer dans un input mais on passe le type en hidden pour qu'il ne soit pas visible -->
                    <input type="hidden" name="idSport" value="<?php echo $id; ?>">
                    <p class="alerte alert-warning">Etes-vous sure de vouloir supprimer ce sport ?</p>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning"> Oui</button>
                        <a class="btn btn-default" href="indexAdmin.php"> Non</a>

                    </div>
                </form>                                 
            </div>  
    </body>
</html>