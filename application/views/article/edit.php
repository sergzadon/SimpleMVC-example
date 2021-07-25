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
?>

<?php include('includes/admin-articles-nav.php'); ?>

<h2><?= $editArticleTitle ?></h2>

<form id="editNote" method="post" action="<?= $Url::link("admin/articles/edit&id=" . $_GET['id'])?>">
    <h5>Note title</h5> 
    <input type="text" name="title" placeholder="name note" value=<?= $viewArticles->title?>><br>
    <h5>Note content</h5>
    <textarea type="description" name="content" placeholred="контент"   value=><?= $viewArticles->content ?></textarea><br>

<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
<input type="submit" name="saveChanges" value="Сохранить">
<input type="submit" name="cancel" value="Назад">
</form>