<!--
<style> 
    
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    }
   
</style>-->

<?php 
use ItForFree\SimpleMVC\Config;
use application\models\Category;
$Url = Config::getObject('core.url.class');
$User = Config::getObject('core.user.class');
?>

<?php $Category = new Category(); ?>
<?php // include('includes/admin-articles-nav.php'); ?>
<h1><?php if(isset($ArticleTitle)) { ?>
     <?= $ArticleTitle?> </h1>
<?php } 
         
else { ?>
     <h1 class="categoryDescription"><?= $category->name?></h1>
 <?php } ?> 
 
    <ul id="headlines" class="archive">

    <?php foreach ( $articles as $article ) { ?>

            <li>
                <h2>
                    <span class="pubDate">
                        <?php echo ($article->publicationDate)?>
                    </span>
                    <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/viewarticle/index&id=' 
		. $article->id . ">{$article->title}</a>" ) ?>

                    <?php if ( !$category && $article->categoryId ) { ?>
                    <span class="category">
                        in 
                        <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('archive/index&categoryId=' 
		. $article->categoryId . ">{$Category->getById($article->categoryId)->name}</a>" ) ?>
                    </span>
                    <?php } ?>          
                </h2>
              <p class="summary"><?php echo htmlspecialchars( $article->summary )?></p>
            </li>

    <?php } ?>

    </ul>
 
 
 


