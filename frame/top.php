<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GoUt</title>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="../styles/s_global.css" rel="stylesheet">
        <?php
        include ("../autoloader.php");
        session_start();

        // Vérification de la session
        if(!isset($_SESSION['me'])){
            $_SESSION['status'] = 'alert';
            $_SESSION['info'] = 'You must be connected';
            header("Location: ../index.php");
        }else{
            if(is_null($_SESSION['me']->getAuthToken())){
                $_SESSION['status'] = 'alert';
                $_SESSION['info'] = 'You must be connected';
                header("Location: ../index.php");
            }
        }

        // Get page name
        $pageName = explode("/", $_SERVER['PHP_SELF']);
        $pageName = $pageName[count($pageName)-1];
        ?>
    </head>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand"><span class="fa fa-user"></span><?php echo ' ' . $_SESSION['me']->getPseudo();?></a>
            </div>
            <ul class="nav navbar-nav">
                <li <?php if($pageName == "accueil.php") echo "class='active'"?> ><a href="../pages/accueil.php">Home</a></li>
                <li <?php if($pageName == "newEvent.php") echo "class='active'"?> ><a href="../pages/newEvent.php">new Event</a></li>
                <li <?php if($pageName == "myEvents.php") echo "class='active'"?> ><a href="../pages/myEvents.php">my Events</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if($pageName == "settings.php") echo "class='active'"?> ><a href="../pages/settings.php"><span class="fa fa-cogs"></span></a></li>
                <li><a href="../traitement/disconnect.php"><span class="glyphicon glyphicon-log-out"></span></a></li>
            </ul>
        </div>
    </nav>

    <body class="container-fluid">