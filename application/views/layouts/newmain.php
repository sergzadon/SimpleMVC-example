<?php 
use ItForFree\SimpleMVC\Config;


$User = Config::getObject('core.user.class');

?>
<!DOCTYPE html>
<html>
    <?php include('includes/main/head.php'); ?>
    <body>
        <?php include('includes/main/nav.php'); ?>
        <?php include('includes/newmain/newnav.php'); ?>
        <div class="container">
            <?= $CONTENT_DATA ?>
        </div>
        <?php include('includes/newmain/newfooter.php'); ?>
    </body>
</html>

