<?php
require('../frame/top.php');
$myEvent = $_SESSION['me']->getMyEvents();

?>

<div class="col-lg-offset-3 col-lg-6 col-sm-12 well">
    <h2 class="text-center">My Events</h2>

    <?php
    if(empty($myEvent)){
        echo "<p class='text-center text-warning'>Vous n'avez pas encore crée d'événement, pour en crée veulliez vous rendre dans l'onglet \"new Event\"";
    }else{
        echo "<ul class='list-group'>";
        foreach ($myEvent as $id => $e){
            echo "<a class='text-center list-group-item' href='event.php?id=$id'>";
            echo "$e";
            echo "</a></a>";
        }
        echo "</ul>";
    }
    ?>

</div>

<?php
require  ('../frame/bottom.php');
?>

