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
