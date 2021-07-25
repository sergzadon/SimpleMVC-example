<?php 
use ItForFree\SimpleMVC\Config;


$User = Config::getObject('core.user.class');

?>
<html>
    <?php // include('includes/newmain/headfront.php'); ?>
    <body>
        <?php // include('includes/main/nav.php'); ?>
        <?php // include('includes/newmain/head2.php'); ?>
        <div class="container">
            <?= $CONTENT_DATA ?>
        </div>
        <?php include('includes/newmain/footer1.php'); ?>
    </body>
</html>

