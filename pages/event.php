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
    <div class="container-fluid ">
        <div class="well table-responsive">
            <h2 class="text-center">Nom de l'événement</h2>

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
                </tbody>
            </table>

            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th width="10%" class="text-center">Catgorie</th>
                    <th width="10%" class="text-center">Libel</th>
                    <th width="35%" class="text-center strong">Valeur</th>
                    <th width="35%" class="text-center">Modification</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td rowspan="2" class="text-center">Générale</td>
                    <td class="text-center">Name</td>
                    <td class="text-center strong"><?php echo $event->getName()?></td>
                    <form method="post" action="../traitement/actionEvent.php">
                        <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                        <input name="action" type="hidden" value="namePut">
                        <td class="text-center"><input type="text" class="form-control" name="name"></td>
                        <td class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
                    </form>
                </tr>
                <tr>
                    <td class="text-center">Description</td>
                    <td class="text-center strong"><?php echo $event->getDescription()?></td>
                    <form method="post" action="../traitement/actionEvent.php">
                        <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                        <input name="action" type="hidden" value="descriptionPut">
                        <td class="text-center"><textarea class="form-control" rows="3" name="description"></textarea></td>
                        <td class="text-center"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
                    </form>
                </tr>

                <tr>
                    <td rowspan="2" class="text-center">Dates</td>
                    <td class="text-center">Début</td>
                    <td class="text-center strong"><?php echo $event->getDateStart()?></td>
                    <form method="post" action="../traitement/actionEvent.php">
                        <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                        <input name="action" type="hidden" value="datesPut">
                        <td class="text-center"><input type="datetime-local" class="form-control" name="dateStart"></td>
                        <td class="text-center" rowspan="2"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
                </tr>
                <tr>
                    <td class="text-center">Fin</td>
                    <td class="text-center strong"><?php echo $event->getDateEnd()?></td>
                    <td class="text-center"><input type="datetime-local" class="form-control" name="dateEnd"></td>
                    </form>
                </tr>

                <tr>
                    <td rowspan="4" class="text-center">Place</td>
                    <td class="text-center">Country</td>
                    <td class="text-center strong"><?php echo $event->getCountry()?></td>
                    <form method="post" action="../traitement/actionEvent.php">
                        <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                        <input name="action" type="hidden" value="placePut">
                        <td class="text-center"><input type="text" class="form-control" name="country"></td>
                        <td class="text-center" rowspan="4"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
                </tr>
                <tr>
                    <td class="text-center">City</td>
                    <td class="text-center strong"><?php echo $event->getCity()?></td>
                    <td class="text-center"><input type="text" class="form-control" name="city"></td>
                </tr>
                <tr>
                    <td class="text-center">Postal Code</td>
                    <td class="text-center strong"><?php echo $event->getPostalCode()?></td>
                    <td class="text-center"><input type="number" class="form-control" name="postalCode"></td>
                </tr>
                <tr>
                    <td class="text-center">Adresse</td>
                    <td class="text-center strong"><?php echo $event->getAdresse()?></td>
                    <td class="text-center"><input type="text" class="form-control" name="adresse"></td>
                    </form>
                </tr>

                </tbody>
            </table>

            <table class="table table-bordered table-striped table-condensed">
                <caption>
                    <h2 class="text-center">Autres information</h2>
                </caption>
                <thead>
                <tr>
                    <th width="33%" class="text-center">Clientele</th>
                    <th width="33%" class="text-center">Categorie</th>
                    <th width="34%" class="text-center">Tarif</th>
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

                    <td class="text-center">
                        <form method="post" action="../traitement/actionEvent.php" class="form-horizontal">
                            <h4 class="text-center">Ajouter un tarif</h4>
                            <input name="eventId" type="hidden" value="<?php echo $event->getId() ?>">
                            <input name="action" type="hidden" value="tarifAdd">

                            <div class="form-group">
                                <label class="control-label col-lg-2" for="libel">Libel :</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="libel">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="appendedtext">Prix : </label>
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
<?php
require  ('../frame/bottom.php');
?>