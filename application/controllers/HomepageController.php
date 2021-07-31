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
        
        $Category = new Category();

        $categoryId = $_GET['id'] ?? null;
        
        if ($categoryId) { // если указан конктреный пользователь
            $viewCategories = $Category->getList(5,null,1);
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->render('note/view-item.php');
        }
        else{
           $frontResults = Array();
         $Article = new Article();
         $results = array();
         $data = $Article->getList(5,null,1);
         $results["articles"] = $data['results'];
         $Author = new ExampleUser();
         
            $this->view->addVar('articles', $results["articles"]);
            $this->view->addVar('Author', $Author);
            $this->view->render('homepage/index.php'); 
        }
         
    }
    
    
}
