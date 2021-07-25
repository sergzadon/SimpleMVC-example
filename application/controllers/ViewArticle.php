<?php
namespace application\controllers\admin;
use application\models\Article;
use application\models\Category;
use application\models\Subcategory;
use application\models\ExampleUser;
use ItForFree\SimpleMVC\Config;


class ViewArticleController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "Article";
    
    
    /**
     * @var string Пусть к файлу макета 
     */
    public $layoutPath = 'viewarticle-main.php';
    
    
    public function viewArticle()
    {   
        $results = array();
        $Article = new Article();
        $Category = new Category();
        $Subcategory = new Subcategory();

//        $articleId = $_GET['id'] ?? null;
        
//        if ($articleId) { // если указан конктреный пользователь
            $viewArticles = $Article->getById($_GET['id']);
            $this->view->addVar('viewArticles', $viewArticles);
            $this->view->render('article/view-item.php');
//        } else { // выводим полный список
            
            
            $results['categories'] = array();
            $data = $Category->getList();
            foreach($data["results"] as $category){
                $results['categories'][$category->id] = $category;
            }
            
            $results['subcategories'] = array();
            $data = $Subcategory->getList();
            foreach($data["results"] as $subcategory){
                $results['subcategories'][$subcategory->id] = $subcategory;
            }
            
//            echo "<pre>";
//            print_r($category);
//            echo "<pre>";
//            die();
            $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
            $this->view->addVar('articles', $articles);
            $this->view->addVar('categories', $results['categories']);
            $this->view->addVar('subcategories', $results['subcategories']);
            $this->view->render('viewarticle/index.php');
//        }
    }
    
   
    
    
}

