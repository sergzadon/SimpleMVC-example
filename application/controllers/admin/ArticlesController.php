<?php
namespace application\controllers\admin;
use application\models\Article;
use application\models\Category;
use application\models\Subcategory;
use application\models\ExampleUser;
use ItForFree\SimpleMVC\Config;


class ArticlesController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    
    /**
     * @var string Название страницы
     */
    public $homepageTitle = "All articles";
    
    
    /**
     * @var string Пусть к файлу макета 
     */
    public $layoutPath = 'article-main.php';
    
    
    public function indexAction()
    {   
        $results = array();
        $Article = new Article();
        $Category = new Category();
        $Subcategory = new Subcategory();

        $articleId = $_GET['id'] ?? null;
        
        if ($articleId) { // если указан конктреный пользователь
            $viewArticles = $Article->getById($_GET['id']);
            $this->view->addVar('viewArticles', $viewArticles);
            $this->view->render('article/view-item.php');
        } else { // выводим полный список
            
            $articles = $Article->getList()['results'];
            
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
            $this->view->render('article/index.php');
        }
    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewArticle'])) {
                if (isset($_POST['ActiveArticle'])) {
                    $_POST['active'] = 1;
                }
                else{
                    $_POST['active'] = 0; 
                }
                $Article = new Article();
                $newArticle = $Article->loadFromArray($_POST);
                
                $Subcategory = new Subcategory();
                if($Subcategory->getById( $newArticle->subcategoryId
                )->outerId !=  $newArticle->categoryId ) {
                $results["errorMessage"] = "Данная подкатегория не соответствует категории";
                $Article = new Article;
                $results['article'] = $Article->loadFromArray($_POST);
                
                $User = new ExampleUser();
                $Category = new Category();
                $Subcategory = new Subcategory();
                $data = $Category->getList();
                $results['categories'] = $data['results'];

                $data = $Subcategory->getList();
                $results['subcategories'] = $data['results'];

                $data = $User->getList();
                $results["users"] = $data['results'];
                $addArticleTitle = "Добавление новой главы";
                $this->view->addVar('categories', $results['categories']);
                $this->view->addVar('subcategories', $results['subcategories']);
                $this->view->addVar('users',$results["users"]);
                $this->view->addVar('articles',$results['article']);
                $this->view->addVar('addArticleTitle', $addArticleTitle);
                if(isset($results["errorMessage"])){
                   $this->view->addVar('errorMessage', $results["errorMessage"]); 
                }
                

                $this->view->render('article/add.php');
                
                }
            else {
          //А здесь данные массива $article уже неполные(есть только Число от даты, категория и полный текст статьи)          
                $newArticle->insert(); 
                $this->redirect($Url::link("admin/articles/index"));
             }
                
            } 
            
        }
        elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/articles/index"));
            }
       // выводим форму для заполнения
        else {
//            $Article = new Article();
            $results['article'] = new Article;
            $User = new ExampleUser();
            $Category = new Category();
            $Subcategory = new Subcategory();
            $data = $Category->getList();
            $results['categories'] = $data['results'];

            $data = $Subcategory->getList();
            $results['subcategories'] = $data['results'];

            $data = $User->getList();
            $results["users"] = $data['results'];
            
//            $results['article'] = new Article;
                $addArticleTitle = "Добавление новой главы";
                $this->view->addVar('categories', $results['categories']);
                $this->view->addVar('subcategories', $results['subcategories']);
                $this->view->addVar('users',$results["users"]);
                $this->view->addVar('articles',$results['article']);
                $this->view->addVar('addArticleTitle', $addArticleTitle);

                $this->view->render('article/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) { // это выполняется нормально.
            
            if (!empty($_POST['saveChanges'] )) {
                $Article = new Article();
                $newArticle = $Article->loadFromArray($_POST);
//                            echo "<pre>";
//            print_r($newArticle);
//            echo "<pre>";
//            die();
                $newArticle->update();
                $this->redirect($Url::link("admin/articles/index&id=$id"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/articles/index&id=$id"));
            }
        }
        else {
            $Article = new Article();
            $viewArticles = $Article->getById($id);
            
            $editArticleTitle = "Редактирование заметки";
            
            $this->view->addVar('viewArticles', $viewArticles);
            $this->view->addVar('editArticleTitle', $editArticleTitle);
            
            $this->view->render('article/edit.php');  
        }
        
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        $Url = Config::get('core.url.class');
        
        if (!empty($_POST)) {
            if (!empty($_POST['deleteArticle'])) {
                $Article = new Article();
                $newArticles = $Article->loadFromArray($_POST);
                $newArticles->delete();
                
                $this->redirect($Url::link("admin/articles/index"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/articles/edit&id=$id"));
            }
        }
        else {
            
            $Article = new Article();
            $deletedArticle = $Article->getById($id);
            $deleteArticleTitle = "Удалить заметку?";
            
            $this->view->addVar('deleteArticleTitle', $deleteArticleTitle);
            $this->view->addVar('deletedArticle', $deletedArticle);
            
            $this->view->render('article/delete.php');
        }
    }
    
    
}
