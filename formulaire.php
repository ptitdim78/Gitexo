<?php 
echo '<pre>'; print_r($_POST); echo '</pre>';

if($_POST)
{
    $border = "border border-danger";

    if(empty($_POST['prenom']))
    {

        $errorPrenom = "<p class='text-danger font-italic'>Merci de renseigner un Prenom.</p>";

        $error = true;
    
    }
    if(empty($_POST['nom']))
    {
        $errorNom = "<p class='text-danger font-italic'>Merci de renseigner un nom.</p>";

        $error = true;
    }
    if(!is_numeric($_POST['telephone']) || iconv_strlen($_POST['telephone']) != 10)
    {
        $errorTel = "<p class='text-danger font-italic'>Merci de renseigner un telephone valide.</p>";

        $error = true;
    }
    if(empty($_POST['profession']))
    {
        $errorProf = "<p class='text-danger font-italic'>Merci de renseigner une profession.</p>";

        $error = true;
    }
    if(!is_numeric($_POST['codepostal']) || iconv_strlen($_POST['codepostal']) != 5)
    {
        $errorCP = "<p class='text-danger font-italic'>Merci de renseigner un code postal valide.</p>";

        $error = true;
    }
    if(empty($_POST['date_de_naissance']))
    {

        $errorDN = "<p class='text-danger font-italic'>Merci d'indiquer votre date de naissance</p>";

        $error = true;
    
    }
    if($_POST['sexe'] == 'select')
    {
        $errorSexe = "<p class='text-danger font-italic'>Merci d'indiquer votre civilité</p>";

        $error = true;
    }
    if(!isset($error))
    {
    $bdd = new PDO('mysql:host=localhost;dbname=repertoire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    
    $insert = $bdd->prepare("INSERT INTO annuaire(nom, prenom, telephone, profession, ville, codepostal, adresse, date_de_naissance, sexe, description) VALUES (:nom, :prenom, :telephone, :profession, :ville, :codepostal, :adresse, :date_de_naissance, :sexe, :description)");
    $insert->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
    $insert->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $insert->bindValue(':telephone', $_POST['telephone'], PDO::PARAM_INT);
    $insert->bindValue(':profession', $_POST['profession'], PDO::PARAM_STR);
    $insert->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
    $insert->bindValue(':codepostal', $_POST['codepostal'], PDO::PARAM_INT);
    $insert->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
    $insert->bindValue(':date_de_naissance', $_POST['date_de_naissance'], PDO::PARAM_STR);
    $insert->bindValue(':sexe', $_POST['sexe'], PDO::PARAM_STR);
    $insert->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
    
    $insert->execute();

    $ajoutMess = "<p class='col-md-3 mx-auto bg-success text-center text-white p-3 rounded my-4'>Félicitations, vous etes maintenant inscrit !</p>";
    }
}
if(isset($ajoutMess)) echo $ajoutMess;
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>TP 2 PHP</title>
</head>
<body>
<H1 class="col-md-8 text-center mx-auto">C'est pas beau de faire du copier coller !!!</H1>

<form method="post" class="col-md-4 text-center mx-auto" action="">
    <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control <?php if(isset($errorNom)) echo $border; ?>" id="nom" name="nom">
        <?php if(isset($errorNom)) echo $errorNom;?>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control <?php if(isset($errorPrenom)) echo $border; ?>" id="prenom" name="prenom">
        <?php if(isset($errorPrenom)) echo $errorPrenom;?>
    </div>
    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input type="text" class="form-control <?php if(isset($errorTel)) echo $border; ?>" id="telephone" name="telephone">
        <?php if(isset($errorTel)) echo $errorTel;?>
    </div>
    <div class="form-group">
        <label for="profession">Profession</label>
        <input type="text" class="form-control <?php if(isset($errorProf)) echo $border; ?>" id="profession" name="profession">
        <?php if(isset($errorProf)) echo $errorProf;?>
    </div>
    <div class="form-group">
        <label for="ville">Ville</label>
        <input type="text" class="form-control" id="ville" name="ville">
    </div>
    <div class="form-group">
        <label for="codepostal">Code postal</label>
        <input type="text" class="form-control <?php if(isset($errorCP)) echo $border; ?>" id="codepostal" name="codepostal">
        <?php if(isset($errorCP)) echo $errorCP;?>
    </div>
    <div class="form-group">
        <label for="adresse">Adresse</label>
        <textarea class="form-control" id="adresse" rows="3" name="adresse"></textarea>
    </div>
    <div class="form-group">
        <label for="date_de_naissance">Date de naissance</label>
        <input type="date" class="form-control <?php if(isset($errorDN)) echo $border; ?>" id="date_de_naissance" name="date_de_naissance">
        <?php if(isset($errorDN)) echo $errorDN;?>
    </div>
    <div class="form-group">
                <label for="sexe">Civilité</label>
                <select class="form-control <?php if(isset($errorSexe)) echo $border; ?>" id="sexe" name="sexe">
                    <option value="select">Selectionnez votre civilité</option>
                    <option value="m">Homme</option>
                    <option value="f">Femme</option>
                </select>
                <?php if(isset($errorSexe)) echo $errorSexe;?>
    </div>
    <div class="form-group" style="text-align: left;">
        <label for="description">Description</label>
    </div>
    <div>
    <textarea name="description" id="description" cols="55" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Enregistrement</button>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>