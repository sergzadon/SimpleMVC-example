<?php
use ItForFree\SimpleMVC\Config;
use application\models\Category;
use application\models\Subcategory;
$User = Config::getObject('core.user.class');
?>

<?php // include('includes/admin-authors-nav.php');

    $Category = new Category();
    $Subcategory = new Subcategory();  ?>

    <h2><?php echo "Автор" ?> </h2>
    <h3><?= $viewAuthor->login ?></h3>

    <?php foreach ($booksAuthor as $books) { ?>
          <h3> <?= "<a href=" . \ItForFree\SimpleMVC\Url::link('admin/viewarticle/index&id=' 
                  . $books->id . ">{$books->title}</a>" ) ?> </h3>
                <p> <?php echo htmlspecialchars( $books->summary )?> </p>
                 <h5>
                     <span class="pubDate">
                         <?php echo ( $books->publicationDate)?>
                     </span>
                 
                 
                     <h4> <span class="pubDate">
                         Категория
                         <?php echo ($Category->getById($books->categoryId)->name)?>
                         </span>
                     </h4>
                 
               
                      <h4><span class="pubDate">
                         Подкатегория
                         <?php echo ($Subcategory->getById($books->subcategoryId)->titleSubcat)?>
                          </span>
                       </h4>
                </h5>

        <?php } ?>
<!--        <p><?php echo $results['totalRows']?> article<?php echo ( $i != 1 ) ? 's' : '' ?> in total.</p>

        <p><a href="./">Return to Homepage</a></p>-->


