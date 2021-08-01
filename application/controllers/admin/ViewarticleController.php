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
    
    
    public function indexAction()
    {   
        $results = array();
        $Article = new Article();
        $Category = new Category();
        $Subcategory = new Subcategory();

        $articleId = $_GET['id'] ?? null;
        
//        if ($articleId) { // если указан конкретный пользователь
            $viewArticles = $Article->getById($articleId);

            $results['category'] = $Category->getById($viewArticles->categoryId);

            $results['subcategory'] = $Subcategory->getById($viewArticles->subcategoryId);
//            }
            $Authors = new ExampleUser();
            $listAuthors = $Authors->getAuthors($articleId);
//            
//            echo "<pre>";
//            print_r($results['authors']);
//            echo "<pre>";
//            die();
            $this->view->addVar('homepageTitle', $this->homepageTitle); // передаём переменную по view
            $this->view->addVar('article', $viewArticles);
            $this->view->addVar('category', $results['category']);
            $this->view->addVar('subcategory', $results['subcategory']);
            $this->view->addVar('listAuthors', $listAuthors);
            $this->view->render('viewarticle/view.php');
        }
    }
 
    


