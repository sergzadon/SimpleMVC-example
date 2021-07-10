<?php
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//ppre($User->explainAccess("admin/adminusers/index"));

?>

<div class="footer">
    Простая PHP CMS &copy; 2017. Все права принадлежат всем. ;) <a href="<?= Url::link("admin/adminusers/index") ?>"> Site Admin </a></a>
</div>





