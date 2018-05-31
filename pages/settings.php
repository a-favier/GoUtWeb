<?php
require('../frame/top.php');
$me = $_SESSION['me'];
?>
<div class="container-fluid well">
    <h1 class="text-center">Informations personnelles</h1>
    <table class="table table-bordered table-striped table-condensed table-responsive">
        <thead>
        <tr>
            <th width="20%" class="text-center">Libel</th>
            <th width="35%" class="text-center">Valeur</th>
            <th width="35%" class="text-center">Modification</th>
            <th width="10%" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td rowspan="2" class="text-center">Nom, Prénom</td>
            <td class="text-center"><?php echo $me->getFirstName()?></td>
            <form method="post" action="../traitement/actionUser.php">
                <input name="action" type="hidden" value="namesPut">
                <td class="text-center"><input type="text" class="form-control" name="firstName"></td>
                <td rowspan="2" class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
        </tr>

        <tr>
            <td class="text-center"><?php echo $me->getLastName()?></td>
            <td class="text-center"><input type="text" class="form-control" name="lastName"></td>
            </form>
        </tr>

        <tr>
            <td class="text-center">Téléphone</td>
            <td class="text-center"><?php echo $me->getTel()?></td>
            <form method="post" action="../traitement/actionUser.php">
                <input name="action" type="hidden" value="telPut">
                <td class="text-center"><input type="text" class="form-control" name="tel"></td>
                <td class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
            </form>
        </tr>

        <tr>
            <td class="text-center">Mail</td>
            <td class="text-center"><?php echo $me->getMail()?></td>
            <form method="post" action="../traitement/actionUser.php">
                <input name="action" type="hidden" value="mailPut">
                <td class="text-center"><input type="text" class="form-control" name="mail"></td>
                <td class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
            </form>
        </tr>

        <tr>
            <td class="text-center">Date de naissance</td>
            <td class="text-center"><?php echo $me->getDateBorn() ?></td>
            <form method="post" action="../traitement/actionUser.php">
                <input name="action" type="hidden" value="bornPut">
                <td class="text-center"><input type="date" class="form-control" name="dateBorn"></td>
                <td class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
            </form>
        </tr>

        <tr>
            <td class="text-center">Mot de passe</td>
            <td class="text-center">***************</td>
            <form method="post" action="../traitement/actionUser.php">
                <input name="action" type="hidden" value="passwordPut">
                <td class="text-center"><input type="text" class="form-control" name="password"></td>
                <td class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
            </form>
        </tr>

        <tr>
            <td class="text-center">Pseudo</td>
            <td class="text-center"><?php echo $me->getPseudo()?></td>
            <td colspan="2" class="text-center">Impossible a modifier</td>
        </tr>


        </tbody>
    </table>

    </div>
</div>

