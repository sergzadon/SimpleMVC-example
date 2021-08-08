<?php 
use ItForFree\SimpleMVC\Config;


$User = Config::getObject('core.user.class');

?>
<!DOCTYPE html>
<html>
    <?php include('includes/newmain/head1.php'); ?>
    <body>
        <?php // include('includes/main/nav.php'); ?>
        <?php // include('includes/newmain/head2.php'); ?>
        <?php // include('includes/admin-main/newnav2.php'); ?>
        <?php  include('includes/admin-main/nav.php'); ?>
        <div class="container">
            <?= $CONTENT_DATA ?>
        </div>
        <?php include('includes/newmain/footer1.php'); ?>
    </body>
</html>