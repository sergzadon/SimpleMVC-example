<?php 
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
?>

<?php include('includes/admin-categories-nav.php'); ?>

<h2><?= $deleteCategoryTitle ?></h2>

<form method="post" action="<?= $Url::link("admin/categories/delete&id=". $_GET['id'])?>" >
    Вы уверены, что хотите удалить категорию : <h2><?= $CategoryId->name ?></h2>?
    
    <input type="hidden" name="id" value="<?= $CategoryId->id ?>">
    <input type="submit" name="deleteNote" value="Удалить">
    <input type="submit" name="cancel" value="Вернуться"><br>
</form>
