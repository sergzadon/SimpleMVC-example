<?php
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-categories-nav.php'); ?>

<h2>
    <span>
        <?= $User->returnIfAllowed("admin/categories/edit", 
            "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/categories/edit&id=". $viewCategories->id) 
            . ">[Редактировать]</a>");?>
        
        <?= $User->returnIfAllowed("admin/categories/delete",
                "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/categories/delete&id=". $viewCategories->id)
            .    ">[Удалить]</a>"); ?>
    </span>
    
</h2> 
<h2>Категория : <?= $viewCategories->name ?></h2>


<h2>Описание : <?= $viewCategories->description ?></h2>


