<?php
require('../frame/top.php');
?>

<form action="../traitement/create.php" method="POST" class="form-horizontal col-lg-offset-3 col-lg-6 col-sm-12 well text-center">
  <div class="form-group">
    <legend>Créate event</legend>
  </div>
    <fieldset>
        <div class="row">
            <div class="form-group">
                <label for="text" class="col-lg-2 control-label">Name : </label>
                <div class="col-lg-9">
                    <input type="textinput" class="form-control" name="name" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="textarea" class="col-lg-2 control-label">Description : </label>
                <div class="col-lg-9">
                    <textarea type="textarea" row="10" class="form-control" name="description"></textarea>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="row">
            <div class="form-group">
                <label for="textarea" class="col-lg-2 control-label">Date start : </label>
                <div class="col-lg-9">
                    <input type="datetime-local" class="form-control" name="dateStart"  required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="select" class="col-lg-2 control-label">Date End : </label>
                <div class="col-lg-9">
                    <input type="datetime-local" class="form-control" name="dateEnd"  required>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="row">
            <div class="form-group">
                <label for="textarea" class="col-lg-2 control-label">Country : </label>
                <div class="col-lg-9">
                    <input type="textinput" class="form-control" name="country" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="select" class="col-lg-2 control-label">City : </label>
                <div class="col-lg-9">
                    <input type="textinput" class="form-control" name="city" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="textarea" class="col-lg-2 control-label">Postal Code : </label>
                <div class="col-lg-9">
                    <input type="number" class="form-control" name="cp" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="select" class="col-lg-2 control-label">Adresse : </label>
                <div class="col-lg-9">
                    <input type="textinput" class="form-control" name="adresse" required>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class="row">
            <div class="form-group">
                <label class="col-lg-2 control-label" for="radios">Booking : </label>
                <div class="col-lg-9">
                    <label class="radio-inline" for="booking">
                        <input type="radio" name="booking" value="1" checked="checked">
                        Yes
                    </label>
                    <label class="radio-inline" for="booking">
                        <input type="radio" name="booking" value="0">
                        No
                    </label>
                </div>
            </div>
        </div>
    </fieldset>
  <div class="form-group">
    <button class="col-lg-pull-6 btn btn-lg btn-warning">Suivant</button>
  </div>
</form>

<?php
require  ('../frame/bottom.php');
?>
