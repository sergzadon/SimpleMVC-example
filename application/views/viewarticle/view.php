<!--<style> 
    
    textarea{
        height: 200%;
        width: 1110px;
        color: #003300;
    }
   
</style>-->

<?php 
use ItForFree\SimpleMVC\Config;

$Url = Config::getObject('core.url.class');
$User = Config::getObject('core.user.class');
?>

<?php // include('includes/admin-articles-nav.php'); ?>
<!--<h2><?= $homepageTitle , ":" ?>

    
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
<p>Зарегестрирована: <?= $article->publicationDate ?></p>-->


<h1 style="width: 75%;"><?php echo htmlspecialchars( $article->title )?></h1>
    <?php if(!empty($listAuthors)) { ?>
          
        <h2><?php echo "Авторы" ?></h2>
       
        <?php foreach($listAuthors as $author) { ?>
                <h3>
                    <span class="author">
                        <?php echo $author->login ?>
                    </span>
                </h3>
            <?php } ?>
       <?php } ?>
    
    <div style="width: 75%; font-style: italic;"><?php echo htmlspecialchars( $article->summary )?></div>
    <div style="width: 75%;"><?php echo $article->content?></div>
    <p class="pubDate">Published on <?php  echo($article->publicationDate)?>
    
    <?php if ( $category ) { ?>
        in 
        <a href="./?action=archive&amp;categoryId=<?php echo $category->id?>">
            <?php echo htmlspecialchars($category->name) ?>
        </a>
    <?php } ?>
        
    </p>

    <p><a href="./">Вернуться на главную страницу</a></p>

