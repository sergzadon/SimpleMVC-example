<?php
namespace application\controllers;

use application\assets\NewCustomCSSAsset;
use application\models\Article;
use application\models\Category;
use application\models\Subcategory;
use application\models\ExampleUser;

/**
 * Контроллер для домашней страницы
 */
class HomepageController extends \ItForFree\SimpleMVC\mvc\Controller
{
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Домашняя страница";
    
    /**
     * @var string Пусть к файлу макета 
     */

//    public $layoutPath = 'main.php';


    public $layoutPath = 'frontmain.php';
      
    /**
     * Выводит на экран страницу "Домашняя страница"
     */
    public function indexAction()
    
    {
//        FrontCSSAsset::add();
         // список статей
         $frontResults = Array();
         $Article = new Article();
         $results = array();
         $data = $Article->getList(5);
         $results["articles"] = $data['results'];
//            echo "<pre>";
//            print_r($results);
//            echo "<pre>";
//            die();
         
         $i = 0;
         $Category = new Category();
         $Subcategory = new Subcategory();
         $Author = new ExampleUser();
         foreach ($results["articles"] as $article ) {
         $category = $Category->getById($article->categoryId);
         $subcategory = $Subcategory->getById($article->subcategoryId);
         $author = $Author->getAuthors($article->id);
//                     echo "<pre>";
//            print_r($author);
//            echo "<pre>";
//            die();
           $frontResults[$i] = (object) array_merge((array)$article, (array)$category, (array)$subcategory,(array)$author);
           $i += 1;
//         $results['totalRows'] = $data['totalRows'];
         }
         
//         FirstSiteSimpleMVC
//         $results['totalRows'] = $data['totalRows'];
//            echo "<pre>";
//            print_r($frontResults[0]);
//            echo "<pre>";
//            die();
//            $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
            $this->view->addVar('frontResults', $frontResults);
            $this->view->render('homepage/index.php');
    }
}
