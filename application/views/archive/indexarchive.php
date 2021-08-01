
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
<?php if(isset($homepageTitle)) { ?>
     <h2 style="color:red"><?= $homepageTitle , ":" ?>
<?php } 
         
else { ?>
   <h2 style="color:red"><?= $categoryTitle , ":" ?> 
 <?php } ?>
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
 <?php 
use ItForFree\SimpleMVC\Config;

$User = Config::getObject('core.user.class');
?>

<?php include('includes/admin-articles-nav.php'); ?>
<div class="row">
    <div class="col"><h1 class="callAlert"><?php echo $homepageTitle ?></h1>
        </div>
</div>
<table class="table">
    <thead>
    <tr>
      <th scope="col">Дата</th>
      <th scope="col">Оглавление</th>
      <th scope="col">Категория</th>
      <th scope="col">Подкатегория</th>
      <th scope="col">Авторы</th>
      <th scope="col">Активность</th>
    </tr>
     </thead>
    <tbody>
    <?php foreach($articles as $article): ?>
    <tr>
        <td> <?= $article->publicationDate ?> </td>
        <td> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/articles/index&id=' 
		. $article->id . ">{$article->title}</a>" ) ?> </td>
        <td> <?php 
                 if(isset ($article->categoryId) && $article->categoryId > 0) {
                    echo $categories[$article->categoryId]->name;                        
                }
                else {
                echo "Без категории";
                }?> </td>
        <td><?php 
                 if(isset ($article->subcategoryId) && $article->subcategoryId > 0) {
                    echo $subcategories[$article->subcategoryId]->titleSubcat;                        
                }
                else {
                echo "Без подкатегории";
                }?></td>
        <td> <? ?> </td>
        <td>
                <?php
                    if($article->active == 1)
                    {
                        echo "Active";                        
                    }
                    else
                    { 
                        echo "Not active";
                    }
                
                ?>
              </td>
        <!--<td> <?= $article->content ?> </td>-->
        
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>


    <p> Список заметок пуст</p>


