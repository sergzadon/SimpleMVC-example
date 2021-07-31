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
         $Category = new Category();
         $Subcategory = new Subcategory();
         $Author = new ExampleUser();
         
         $data = $Category->getList();
         $results['categories'] = array();
         foreach ( $data['results'] as $category ) {
            $results['categories'][$category->id] = $category;
         }
         
         $data = $Subcategory->getList();
         $results["subcategories"] = array();
    
        foreach($data["results"] as $subcategory){
            $results["subcategories"][$subcategory->id] = $subcategory;
        }
 
//            echo "<pre>";
//            print_r($_GET);
//            echo "<pre>";
//            die();
//            $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
            $this->view->addVar('articles', $results["articles"]);
            $this->view->addVar('categories', $results['categories']);
            $this->view->addVar('subcategories', $results['subcategories']);
            $this->view->addVar('Author', $Author);
            $this->view->render('homepage/index.php');
    }
    
    
}
