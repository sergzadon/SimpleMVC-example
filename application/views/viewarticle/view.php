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

<?php // include('includes/admin-articles-nav.php'); ?>
<h2><?= $homepageTitle , ":" ?>

    
    <span>
        <?= $article->title ?>
    </span>
    
</h2> 
<h2><?php echo "Авторы" ?></h2>
<?php foreach($listAuthors as $author) { ?>
                <h5>
                    <span class="author">
                        <?php echo $author->login ?>
                    </span>
                </h5>
   <?php } ?>

<?php if ($category) { ?>
       
        <a href="./?action=archive&amp;categoryId=<?php echo $category->id?>">
            <?php echo htmlspecialchars($category->name) ?>
        </a>
    <?php } ?>

<p><?= $article->content ?></p>
<p>Зарегестрирована: <?= $article->publicationDate ?></p>

