<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoUt</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="styles/s_index.css" rel="stylesheet">
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
        <h3 class="text-uppercase">faites connaitre votre événement !</h3>
    </div>

    <!--Connexion-->
    <div class="row">
        <div class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8">
            <form class="form-horizontal well" method="post" action="traitement/connect.php">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Connexion</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="pseudo" name="pseudo" type="text" placeholder="Pseudo" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="pass" name="pass" type="password" placeholder="Password" class="form-control input-md" required="">

                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="send"></label>
                        <div class="col-md-12">
                            <button id="send" name="send" class="btn btn-md btn-warning"><span class="glyphicon glyphicon-ok"></span> Envoyer</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <!--Bulle d'information-->
    <?php
    if(isset($_SESSION['status'])){
        if($_SESSION['status'] == 'success'){
            echo '<div class="alert alert-success alert-dismissible col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8">';
            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>Success !</strong> ';
            echo $_SESSION["info"];
            echo '</div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8">';
            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            echo '<strong>Danger !</strong> ';
            echo $_SESSION['info'];
            echo '</div>';
        }
    } ?>

    <!--Inscription-->
    <div class="row">
        <div class="col-md-offset-4 col-md-4 col-sm-offset-2 col-sm-8">
            <div class="well">
                <div class="text-center">
                    <a href="#aboutModal" data-target="#MonCollapse" data-toggle="collapse" aria-expanded="false" aria-controls="MonCollapse" class="btn btn-lg btn-warning">Nouveau sur GoUt ? <i class="fa fa-caret-down"></i></a>
                </div>
            <div id="MonCollapse" class="collapse">
                <form class="form-horizontal well" method="post" action="traitement/inscription.php">
                    <!-- Text input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="pseudo">Pseudo</label>
                            <input id="pseudo" name="pseudo" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="pseudo">Prénom</label>
                            <input id="firstName" name="firstName" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                    </div>


                    <!-- Text input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="pseudo">Nom</label>
                            <input id="lastName" name="lastName" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="pseudo">Mail</label>
                            <input id="mail" name="mail" type="text" placeholder="" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="pseudo">Password</label>
                            <input id="pass" name="pass" type="password" placeholder="" class="form-control input-md" required="">
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-12 control-label" for="send"></label>
                        <div class="col-md-12 text-center">
                            <button id="send" name="send" class="btn btn-md btn-warning"><span class="glyphicon glyphicon-ok"></span> Inscription</button>
                        </div>
                    </div>
                </form>
            </div>

            </div>
        </div>
    </div>

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>