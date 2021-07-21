<?php 

use application\assets\DemoJavascriptAsset;
DemoJavascriptAsset::add();


?>

     <ul id="headlines">
    <?php foreach ($frontResults as $article) { ?>
        <li class='<?php echo $article->id?>'>
            <h2>
                <span class="pubDate">
                    <?= $article->publicationDate ?> ;
                </span>
                
                <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>">
                    <?php echo htmlspecialchars( $article->title )?>
                </a>
                
                <?php if (isset($article->categoryId)) { ?>
                    <span class="category">
                        Категория 
                        <a href=".?action=archive&amp;categoryId=<?php echo $article->categoryId?>">
                            <?php echo htmlspecialchars($article->name )?>
                        </a>
                    </span>
                <?php } 
                else { ?>
                    <span class="category">
                        <?php echo "Без категории"?>
                    </span>

                <?php } ?>
                
                <?php if (isset($article->subcategoryId) && $article->subcategoryId > 0) { ?>    
                    <span class="subcategory">
                        Подкатегория 
                        <a href=".?action=subcategoryArchive&amp;subcategoryId=<?php echo $article->subcategoryId?>">
                            <?php echo htmlspecialchars($article->titleSubcat)?>
                        </a>
                    </span>
            </h2>
                <?php }
            
                else { ?>
                    <h2>
                        <span class="subcategory">
                            <?php echo "Без подкатегории"?>
                        </span>
                    </h2>
                <?php } ?>
                
            <p class="summary"><?php echo htmlspecialchars($article->summary)?></p>
            <p class="summary"><?php echo htmlspecialchars(mb_strimwidth($article->content, 0, 50,"..."))?></p>
            <img id="loader-identity" src="JS/ajax-loader.gif" alt="gif">
            <ul class="ajax-load">
                <li><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="ajaxArticleBodyByPost" data-contentId="<?php echo $article->id?>">Показать продолжение (POST)</a></li>
                <li><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="ajaxArticleBodyByGet" data-contentId="<?php echo $article->id?>">Показать продолжение (GET)</a></li>
                <li><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="ajaxArticleBodyByPostNew" data-summury="<?php echo $article->id?>">(POST) -- NEW</a></li>
                <li><a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="ajaxArticleBodyByGetNew" data-summury="<?php echo $article->id?>">(GET)  -- NEW</a></li>
            </ul>
            <a href=".?action=viewArticle&amp;articleId=<?php echo $article->id?>" class="showContent" data-contentId="<?php echo $article->id?>">Показать полностью</a>
        </li>
    <?php } ?>
    </ul>
    <p><a href="./?action=archive">Article Archive</a></p>
<!--<div class="row">
    <div class="col"><h1 class="callAlert"><?php echo $homepageTitle ?></h1>
        </div>
</div>
<div class="row">
    <div class="col ">
      <p class="lead"> Добро пожаловать в SimpleMVC! </p>
    </div>
</div>-->