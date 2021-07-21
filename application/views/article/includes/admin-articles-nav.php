<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//vpre($User->explainAccess("admin/adminusers/index"));
?>

<ul class="nav">
    
    <?php  if ($User->isAllowed("admin/articles/index")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/articles/index") ?>">Список</a>
    </li>
    <?php endif; ?>
    
    <?php  if ($User->isAllowed("admin/articles/add")): ?>
    <li class="nav-item ">
        <a class="nav-link" href="<?= Url::link("admin/articles/add") ?>"> + Добавить заметку</a>
    </li>
    <?php endif; ?>  
</ul>