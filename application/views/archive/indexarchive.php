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
<h2 style="color:red"><?= $homepageTitle , ":" ?>
    
</h2> 
    <?php foreach ($articles as $article) { ?>
        <li class='<?php echo $article->id?>'>
                Дата публикации : 
                    <?= $article->publicationDate ?> ;
                    <h2>   <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/viewarticle/index&id=' 
                            . $article->id . ">{$article->title}</a>" ) ?> </h2>
                     <h5>
                    <?php if (isset($article->categoryId)) { ?>
                        Категория 
                        <a href=".?action=archive&amp;categoryId=<?php echo $article->categoryId?>">
                               <?php echo htmlspecialchars($categories[$article->categoryId]->name )?>
                        </a> 
                <?php } 
                else { ?>
                         <span class="category">
                        <?php echo "Без категории"?>
                        
                        </span>

                <?php } ?>
                 </h5>
                <h5>
                <?php if (isset($article->subcategoryId) && $article->subcategoryId > 0) { ?>    
                    <span class="subcategory">
                        Подкатегория 
                        <a href=".?action=subcategoryArchive&amp;subcategoryId=<?php echo $article->subcategoryId?>">
                            <?php echo htmlspecialchars($subcategories[$article->subcategoryId]->titleSubcat)?>
                        </a>
                       
                    </span>
                <?php }
            
                else { ?>
                        <span class="subcategory">
                            <?php echo "Без подкатегории"?>
                        </span>
                <?php } ?>
               </h5>
                        
                <h4 style="color:green;"> Авторы </h4>
                       
                       <?php 
                            $count = 0;
                            $listAuthors = $Authors->getAuthors($article->id);
                            foreach($listAuthors as $Authors ) {
//                                } ?>
                             <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/authors/index&id=' 
		. $Authors->id . ">{$Authors->login}</a>" ) ?>
                                
                                <?php 
                                $count += 1;
                                if($count != count($listAuthors)) {
                                    echo ",";
                                } ?>
                             </a>
                          <?php  } 
                            $count = 0;
                        ?>
                    </span>
           
    <?php } ?>
 


