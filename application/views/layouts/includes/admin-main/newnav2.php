<?php 
use ItForFree\SimpleMVC\Config;
use ItForFree\SimpleMVC\Url;

$User = Config::getObject('core.user.class');


//vpre($User->explainAccess("homepage/index"));
?>
<div id="adminHeader">
    <h2>Widget News Admin</h2>
    <p>You are logged in as <b><?php // echo htmlspecialchars( $_SESSION['username']) ?></b>.
        <a href="admin.php?action=listArticles">Edit Articles</a>
        <a href="<?= Url::link("admin/articles/index") ?>">Articles</a> 
        <a href="admin.php?action=listCategories">Edit Categories</a>
        <a href="admin.php?action=listSubcategories">Edit Subcategories</a>
        <a href="admin.php?action=logout"?>Log Out</a>
        <a href="<?= Url::link("admin/adminusers/index") ?>">Пользователи</a>
        <a href="<?= Url::link("admin/notes/index") ?>"> Заметки </a>
        <a href="admin.php?action=listAuthors"?>Авторы</a>
    </p>
</div>

