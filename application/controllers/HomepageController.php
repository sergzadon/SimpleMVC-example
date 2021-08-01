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
    public $archiveCategory = " Категория";
    
    /**
     * @var string Название страницы
     */
    public $categoryTitle = "Домашняя страница";
    
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
        $Article = new Article();
        $Author = new ExampleUser();
        $Category = new Category();
        $Subcategory = new Subcategory();
        $results = array();

        $categoryId = $_GET['id'] ?? null;
        
        if ($categoryId) { // если указан конкретный пользователь
            $data = $Article->getFrontList(100000, $categoryId, false);
            //             echo "<pre>";
//    print_r($data);
//    echo "</pre>";
//    die();
            $results["articles"] = $data["results"];
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
            
            $this->view->addVar('articles', $results["articles"]);
            $this->view->addVar('categories', $results['categories']);
            $this->view->addVar('subcategories', $results['subcategories']);
            $this->view->addVar('Authors', $Author);
            $this->view->addVar('categoryTitle', $this->archiveCategory);
            $this->view->render('archive/indexarchive.php');
        }
        else{
//           $frontResults = Array();
         $Article = new Article();
         $results = array();

         $data = $Article->getFrontList(5,null,1);
//             echo "<pre>";
//    print_r($data);
//    echo "</pre>";
//    die();
         $results["articles"] = $data['results'];
         $Author = new ExampleUser();
         
            $this->view->addVar('articles', $results["articles"]);
            $this->view->addVar('Author', $Author);
            $this->view->render('homepage/index.php'); 
        }
         
    }
    
    
}
