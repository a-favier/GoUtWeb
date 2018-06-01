<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoUt</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../styles/s_index.css" rel="stylesheet">
</head>

<?php
session_start();
if(isset($_SESSION['me'])){
    echo "hello";
    session_unset();
}
?>

<body class="container-fluid">

<!--Titre-->
<div class="row text-center">
    <h1 class="well">GoUt</h1>
    <h3 class="text-uppercase">Aide a la connexion</h3>
</div>

<div class="row">
    <div class="col-lg-offset-1 col-lg-4 col-sm-offset-2 col-sm-8 col-xs-12">
        <div class="well">
            <div class="text-center">
                <a href="#aboutModal" data-target="#passwordModal" data-toggle="collapse" aria-expanded="false" aria-controls="MonCollapse" class="btn btn-lg btn-warning">J'ai oublier mon mot de passe<i class="fa fa-caret-down"></i></a>
            </div>
            <div id="passwordModal" class="collapse">
                <form class="well" method="post" action="../traitement/recovery.php">
                    <legend class="text-center">Pour récupérer votre mot de passe merci d'indiquer votre pseudo</legend>
                    <!-- Text input-->
                    <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="pseudo">Pseudo</label>
                        <div class="col-sm-10">
                            <input name="pseudo" type="text" class="form-control input-md" required>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group row">
                        <label class="col-md-12 control-label" for="send"></label>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-md btn-warning"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!--Inscription-->
    <div class="col-lg-offset-2 col-lg-4 col-sm-offset-2 col-sm-8 col-xs-12">
        <div class="well">
            <div class="text-center">
                <a href="#aboutModal" data-target="#pseudoModal" data-toggle="collapse" aria-expanded="false" aria-controls="MonCollapse" class="btn btn-lg btn-warning">J'ai oublier mon pseudo<i class="fa fa-caret-down"></i></a>
            </div>
            <div id="pseudoModal" class="collapse">
                <form class="well" method="post" action="../traitement/recovery.php">
                    <legend class="text-center">Pour récupérer vos pseudo merci d'indiquer votre adresse mail</legend>
                    <!-- Text input-->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="mail">Mail</label>
                        <div class="col-sm-10">
                            <input name="mail" type="mail" class="form-control input-md" required>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group row">
                        <label class="col-md-12 control-label" for="send"></label>
                        <div class="col-md-12 text-center">
                            <button class="btn btn-md btn-warning"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>