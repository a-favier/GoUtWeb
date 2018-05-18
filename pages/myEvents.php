<?php
require('../frame/top.php');
$myEvent = $_SESSION['me']->getMyEvents();
?>

<div class="well">
    <h2 class="text-center">My Events</h2>

<?php
echo "<ul class='list-group'>";
foreach ($myEvent as $id => $e){
    echo "<a class='list-group-item' href='event.php/?id=$id'>";
    echo "$e";
    echo "</a></a>";
}
echo "</ul>";
?>

</div>


