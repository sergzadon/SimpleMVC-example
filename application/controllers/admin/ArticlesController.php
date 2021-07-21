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
            if (!empty($_POST['saveNewNote'])) {
                $Article = new Article();
                $newArticles = $Articles->loadFromArray($_POST);
                $newArticles->insert(); 
                $this->redirect($Url::link("admin/articles/index"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/articles/index"));
            }
        }
       // выводим форму для заполнения
        else {
//            $Article = new Article();
            $User = new ExampleUser();
            $Category = new Category();
            $Subcategory = new Subcategory();
            $results['article'] = new Article;
            $data = $Category->getList();
            $results['categories'] = $data['results'];

            $data = $Subcategory->getList();
            $results['subcategories'] = $data['results'];

            $data = $User->getList();
            $results["users"] = $data['results'];
            
            $results['article'] = new Article;
    //            echo "<pre>";
    //            print_r(count($results["users"]));
    //            echo "<pre>";
    //            die();
                $addArticleTitle = "Добавление новой главы";
                $this->view->addVar('categories', $results['categories']);
                $this->view->addVar('subcategories', $results['subcategories']);
                $this->view->addVar('users',$results["users"]);
                $this->view->addVar('articles',$results['article']);
                $this->view->addVar('addArticleTitle', $addArticleTitle);

                $this->view->render('article/add.php');
        }
    }
    
//    /**
//     * Выводит на экран форму для редактирования статьи (только для Администратора)
//     */
//    public function editAction()
//    {
//        $id = $_GET['id'];
//        $Url = Config::get('core.url.class');
//        
//        if (!empty($_POST)) { // это выполняется нормально.
//            
//            if (!empty($_POST['saveChanges'] )) {
//                $Note = new Note();
//                $newNotes = $Note->loadFromArray($_POST);
//                $newNotes->update();
//                $this->redirect($Url::link("admin/notes/index&id=$id"));
//            } 
//            elseif (!empty($_POST['cancel'])) {
//                $this->redirect($Url::link("admin/notes/index&id=$id"));
//            }
//        }
//        else {
//            $Note = new Note();
//            $viewNotes = $Note->getById($id);
//            
//            $editNoteTitle = "Редактирование заметки";
//            
//            $this->view->addVar('viewNotes', $viewNotes);
//            $this->view->addVar('editNoteTitle', $editNoteTitle);
//            
//            $this->view->render('note/edit.php');   
//        }
//        
//    }
//    
//    /**
//     * Выводит на экран предупреждение об удалении данных (только для Администратора)
//     */
//    public function deleteAction()
//    {
//        $id = $_GET['id'];
//        $Url = Config::get('core.url.class');
//        
//        if (!empty($_POST)) {
//            if (!empty($_POST['deleteNote'])) {
//                $Note = new Note();
//                $newNotes = $Note->loadFromArray($_POST);
//                $newNotes->delete();
//                
//                $this->redirect($Url::link("admin/notes/index"));
//              
//            }
//            elseif (!empty($_POST['cancel'])) {
//                $this->redirect($Url::link("admin/notes/edit&id=$id"));
//            }
//        }
//        else {
//            
//            $Note = new Note();
//            $deletedNote = $Note->getById($id);
//            $deleteNoteTitle = "Удалить заметку?";
//            
//            $this->view->addVar('deleteNoteTitle', $deleteNoteTitle);
//            $this->view->addVar('deletedNote', $deletedNote);
//            
//            $this->view->render('note/delete.php');
//        }
//    }
//    
//    
}
