<style> 
    
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    }
   
</style>

<?php 
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
$User = Config::getObject('core.user.class');
//            echo "<pre>";
//            print_r($User);
//            echo "<pre>";
//            die();
?>

<?php include('includes/admin-categories-nav.php'); ?>

<h2><?= $editCategoryTitle ?></h2>

<form id="editNote" method="post" action="<?= $Url::link("admin/categories/edit&id=" . $_GET['id'])?>">
    <h5>Category</h5> 
    <input type="text" name="name" placeholder="name note" value=<?= $viewCategories->name?>><br>
    <h5>Note content</h5>
    <textarea type="description" name="description" placeholred="контент"   value=><?= $viewCategories->description ?></textarea><br>

<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
<input type="submit" name="saveChanges" value="Сохранить">
<input type="submit" name="cancel" value="Назад">
</form>

