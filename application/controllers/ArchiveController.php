<?php
namespace application\controllers;

use application\assets\NewCustomCSSAsset;
use application\models\Article;
use application\models\Category;
use application\models\Subcategory;
use application\models\ExampleUser;

/**
 * Контроллер для вывода архива
 */
class ArchiveController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Архив";
    
    /**
     * @var string Пусть к файлу макета 
     */

    public $layoutPath = 'archivemain.php';
      
    /**
     * Выводит на экран  весь архив статей"
     */
     
     public function  indexAction() 
    {
        $Category = new Category();

        $categoryId = $_GET['id'] ?? null;
        $results['category'] = $Category->getById( $categoryId );
        
        if ($categoryId) { // если указан конктреный id категории сортировка по категории
            $viewArticle = $Article->getList(10000,$results['category'] ? $results['category']->id : null );
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->render('note/view-item.php');
        } else { // выводим полный список статей
        
        $results = [];
        $Article = new Article();
        $Category = new Category();
        $Subcategory = new Subcategory();
        $Authors = new ExampleUser();

//        $categoryId = ( isset( $_GET['categoryId'] ) && $_GET['categoryId'] ) ? (int)$_GET['categoryId'] : null;

//        $results['category'] = Category::getById( $categoryId );

//        $data = Article::getList( 100000, $results['category'] ? $results['category']->id : null );
        $data = $Article->getList(100000);

        $results['articles'] = $data['results'];
        $results['totalRows'] = $data['totalRows'];

        $data = $Category->getList();
        $results['categories'] = array();

        foreach ( $data['results'] as $category ) {
            $results['categories'][$category->id] = $category;
        }
        
        $data = $Subcategory->getList();
        $results['subcategories'] = array();

        foreach ( $data['results'] as $subcategory ) {
            $results['subcategories'][$subcategory->id] = $subcategory;
        }
    
//        $results['pageHeading'] = $results['category'] ?  $results['category']->name : "Article Archive";
//            echo "<pre>";
//            print_r($_GET);
//            echo "<pre>";
//            die();
        $this->view->addVar('articles', $results["articles"]);
        $this->view->addVar('categories', $results['categories']);
        $this->view->addVar('subcategories', $results['subcategories']);
        $this->view->addVar('homepageTitle', $this->homepageTitle);
        $this->view->addVar('Authors', $Authors);
        $this->view->render('archive/indexarchive.php');
       }

    }  
}


