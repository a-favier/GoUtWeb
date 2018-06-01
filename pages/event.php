<?php
require('../frame/top.php');


/** On vérifie que l'événement appartient bien a l'utilisateur */
$myEvent = $_SESSION['me']->getMyEvents();
if(!array_key_exists($_GET['id'], $myEvent)) {
    $_SESSION['message'] = "Action interdite";
    $_SESSION['messageType'] = "alert-danger";
    header("Location: accueil.php");
}

$event = new Event();
$event->fillEventById($_GET['id']);

$event->fillTarif();
$event->fillClientele();
$event->fillCategorie();

$entities = new Entities();

$allCategorie = $entities->getAllCategorie();
$allClientele = $entities->getAllClientele();


?>
<div class="well table-responsive">
    <h2 class="text-center">Nom de l'événement</h2>

    <div class="row col-lg-12">
        <div class="col-lg-5 col-lg-offset-1">
            <table class="table table-bordered table-striped table-condensed">
                <tbody>
                <tr>
                    <td class="text-center" width="50%">
                        <form method="post" action="../traitement/actionEvent.php">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="activePut">
                            <h4 class="text-center">Etat de l'événement</h4>
                            <select name="actif" class="col-lg-offset-2 col-lg-6 text-center">
                                <?php
                                if($event->isActive()){
                                    echo "<option value='1' selected>L'événement est actif</option><option value='0'>L'événement est désactiver</option>";
                                }else{
                                    echo "<option value='1'>L'événement est actif</option><option value='0' selected>L'événement est désactiver</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-success col-lg-2"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-5">
            <table class="table table-bordered table-striped table-condensed">
                <tbody>
                <tr>
                    <td class="text-center" width="50%">
                        <form method="post" action="../traitement/actionEvent.php">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="bookingPut">
                            <h4 class="text-center">Reservation</h4>
                            <select name="booking" class="col-lg-offset-2 col-lg-6 text-center">
                                <?php
                                if($event->isBooking()){
                                    echo "<option value='1' selected>L'événement est sur reservation</option><option value='0'>L'événement n'est pas sur reservation</option>";
                                }else{
                                    echo "<option value='1'>L'événement est sur reservation</option><option value='0' selected>L'événement n'est pas sur reservation</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-success col-lg-2"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row col-lg-offset-2 col-lg-7">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center col-lg-3">Catgorie</th>
                <th class="text-center col-lg-3">Libel</th>
                <th class="text-center strong col-lg-5">Valeur</th>
                <th class="text-center col-lg-1">Modification</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td rowspan="2" class="text-center">Générale</td>
                <td class="text-center">Name</td>
                <td class="text-center strong">
                    <p id="nameText"><?php echo $event->getName()?></p>
                    <div id="nameFrom">
                        <form method="post" action="../traitement/actionEvent.php"  class="form-horizontal col-lg-12">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="namePut">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 control-label">Name </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="name"  value="<?php echo $event->getName()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary pull-right" id="nameButton"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>
            <tr>
                <td class="text-center">Description</td>
                <td class="text-center strong">
                    <p id="descriptionText"><?php echo $event->getDescription()?></p>
                    <div id="descriptionForm">
                        <form method="post" action="../traitement/actionEvent.php"  class="form-horizontal col-lg-12">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="descriptionPut">
                            <div class="row">
                                <div class="form-group">
                                    <label for="description" class="col-lg-2 control-label">Description </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" rows="1" name="description"  value="<?php echo $event->getDescription()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            </div>

                        </form>
                    </div>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary pull-right" id="descriptionButton"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>

            <tr>
                <td class="text-center">Dates</td>
                <td class="text-center">Début<br />Fin</td>
                <td class="text-center strong">
                    <p id="dateText"><?php echo $event->getDateStart()?><br /><?php echo $event->getDateEnd()?></p>
                    <div id="dateForm">
                        <form method="post" action="../traitement/actionEvent.php" class="form-horizontal col-lg-12">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="datesPut">

                            <div class="row">
                                <div class="form-group">
                                    <label for="dateEnd" class="col-lg-2 control-label">Date start </label>
                                    <div class="col-lg-10">
                                        <input type="datetime-local" class="form-control" name="dateEnd">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="dateStart" class="col-lg-2 control-label">Date end </label>
                                    <div class="col-lg-10">
                                        <input type="datetime-local" class="form-control" name="dateStart">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary pull-right" id="dateButton"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>

            <tr>
                <td class="text-center">Place</td>
                <td class="text-center">Country<br />City<br />Postal Code<br />Adresse</td>
                <td class="strong">
                    <p class="text-center" id="placeText"><?php echo $event->getCountry()?><br /><?php echo $event->getCity()?><br /><?php echo $event->getPostalCode()?><br /><?php echo $event->getAdresse()?></p>
                    <div id="placeFrom">
                        <form method="post" action="../traitement/actionEvent.php" class="form-horizontal col-lg-12">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="placePut">

                            <div class="row">
                                <div class="form-group">
                                    <label for="country" class="col-lg-2 control-label">Country </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="country" value="<?php echo $event->getCountry()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="city" class="col-lg-2 control-label">City </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="city" value="<?php echo $event->getCity()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="postalCode" class="col-lg-2 control-label">Postal Code </label>
                                    <div class="col-lg-10">
                                        <input type="number" class="form-control" name="postalCode" value="<?php echo $event->getPostalCode()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="adresse" class="col-lg-2 control-label">Adresse </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="adresse" value="<?php echo $event->getAdresse()?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary pull-right" id="placeButton"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row col-lg-12">
        <div class="col-lg-4">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th class="text-center">Clientele</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">
                        <ul class="list-group">
                            <form method="post" action="../traitement/actionEvent.php">
                                <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                                <input name="action" type="hidden" value="clienteleDel">
                                <?php
                                foreach ($event->getListClientele() as $c){
                                    echo "<li class='list-group-item'>";
                                    echo "<button type='submit' class='btn-xs btn-danger pull-right'><span class='fa fa-times'></span></button>";
                                    echo $c->getName();
                                    echo "<input name='clienteleId' type='hidden' value='".$c->getId()."'>";
                                    echo "</li>";
                                }
                                ?>
                            </form>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <form method="post" action="../traitement/actionEvent.php">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="clienteleAdd">
                            <h4 class="text-center">Ajouter une clientèle</h4>
                            <select name="clienteleId" class="col-lg-offset-2 col-lg-6 text-center">
                                <option value="" selected></option>
                                <?php
                                foreach ($allClientele as $c){
                                    echo "<option value='".$c->getId()."'>".$c->getName()."</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-success col-lg-2"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class=" col-lg-4">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th class="text-center">Categorie</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">
                        <ul class="list-group">
                            <form method="post" action="../traitement/actionEvent.php">
                                <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                                <input name="action" type="hidden" value="categorieDel">
                                <?php
                                foreach ($event->getListCategorie() as $c){
                                    echo "<li class='list-group-item'>";
                                    echo "<button type='submit' class='btn-xs btn-danger pull-right'><span class='fa fa-times'></span></button>";
                                    echo $c->getName();
                                    echo "<input name='categorieId' type='hidden' value='".$c->getId()."'>";
                                    echo "</li>";
                                }
                                ?>
                            </form>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <form method="post" action="../traitement/actionEvent.php">
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="categorieAdd">
                            <h4 class="text-center">Ajouter une categorie</h4>
                            <select name="categorieId" class="col-lg-offset-2 col-lg-6 text-center">
                                <option value="" selected></option>
                                <?php
                                foreach ($allCategorie as $c){
                                    echo "<option value='".$c->getId()."'>".$c->getName()."</option>";
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-success col-lg-2"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th class="text-center">Tarif</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">
                        <ul class="list-group">
                            <form method="post" action="../traitement/actionEvent.php">
                                <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                                <input name="action" type="hidden" value="tarifDel">
                                <?php
                                foreach ($event->getListTarif() as $t){
                                    echo "<li class='list-group-item'>";
                                    echo "<button type='submit' class='btn-xs btn-danger pull-right'><span class='fa fa-times'></span></button>";
                                    echo $t->getName() . " : " . $t->getPrice() . " €";
                                    echo "<input name='tarifId' type='hidden' value='".$t->getId()."'>";
                                    echo "</li>";
                                }
                                ?>
                            </form>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <form method="post" action="../traitement/actionEvent.php" class="form-horizontal">
                            <h4 class="text-center">Ajouter un tarif</h4>
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="tarifAdd">

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="libel">Libel </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="libel">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="appendedtext">Prix </label>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input name="prix" class="form-control" type="text">
                                        <span class="input-group-addon">€</span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-ok"></span> Valider</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require  ('../frame/bottom.php');
?>