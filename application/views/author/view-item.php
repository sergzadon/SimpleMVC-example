<?php
use ItForFree\SimpleMVC\Config;
use application\models\Category;
use application\models\Subcategory;
$User = Config::getObject('core.user.class');
?>

<?php // include('includes/admin-authors-nav.php');

        $Category = new Category();
        $Subcategory = new Subcategory();  ?>

<h2>Автор</h2>
<h3 style="color:red;"><?= $viewAuthor->login ?></h3>

<?php foreach($booksAuthor as $article) :?>

 <h2><?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/viewarticle/index&id=' 
         . $article->id . ">{$article->title}</a>" ) ?> </h2>
       
<h4> Дата публикации <?= $article->publicationDate ?> </h4>

   <?php endforeach; ?>



<!--    <span>
        <?= $User->returnIfAllowed("admin/articles/edit", 
            "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/articles/edit&id=". $viewArticles->id) 
            . ">[Редактировать]</a>");?>
        
        <?= $User->returnIfAllowed("admin/articles/delete",
                "<a href=" . \ItForFree\SimpleMVC\Url::link("admin/articles/delete&id=". $viewArticles->id)
            .    ">[Удалить]</a>"); ?>
    </span>
    
</h2> -->

<!--<p>Контент: <?= $viewArticles->content ?></p>
<p>Зарегестрирована: <?= $viewArticles->publicationDate ?></p>-->


