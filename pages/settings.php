<?php
require('../frame/top.php');

//var_dump($_SESSION);
?>
<h1 class="text-center">Informations personnelles</h1>
<div class="well col-md-12">
    <h4 class="col-md-6 col-xs-12">Nom, Prénom : <?php echo $_SESSION['me']->getFirstName() . ' ' . $_SESSION['me']->getLastName()?></h4>
    <div class="col-mg-6 col-xs-12 pull-right"><a href="#" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modify</a></div>
</div>
