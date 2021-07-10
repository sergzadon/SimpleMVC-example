<?php
namespace application\controllers\admin;
use application\models\Article;
use ItForFree\SimpleMVC\Config;


class ArticlesController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    public $layoutPath = 'article-main.php';
    
    
    public function indexAction()
    {
        $Article = new Article();

        $articleId = $_GET['id'] ?? null;
        
        if ($articleId) { // если указан конктреный пользователь
            $viewArticles = $Article->getById($_GET['id']);
            $this->view->addVar('viewArticles', $viewArticles);
            $this->view->render('article/view-item.php');
        } else { // выводим полный список
            
            $articles = $Article->getList()['results'];
//            echo "<pre>";
//            print_r($articles);
//            echo "<pre>";
//            die();
            $this->view->addVar('articles', $articles);
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
                $Note = new Note();
                $newNotes = $Note->loadFromArray($_POST);
                $newNotes->insert(); 
                $this->redirect($Url::link("admin/notes/index"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/notes/index"));
            }
        }
        else {
            $addNoteTitle = "Добавление новой заметки";
            $this->view->addVar('addNoteTitle', $addNoteTitle);
            
            $this->view->render('note/add.php');
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
                $Note = new Note();
                $newNotes = $Note->loadFromArray($_POST);
                $newNotes->update();
                $this->redirect($Url::link("admin/notes/index&id=$id"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/notes/index&id=$id"));
            }
        }
        else {
            $Note = new Note();
            $viewNotes = $Note->getById($id);
            
            $editNoteTitle = "Редактирование заметки";
            
            $this->view->addVar('viewNotes', $viewNotes);
            $this->view->addVar('editNoteTitle', $editNoteTitle);
            
            $this->view->render('note/edit.php');   
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
            if (!empty($_POST['deleteNote'])) {
                $Note = new Note();
                $newNotes = $Note->loadFromArray($_POST);
                $newNotes->delete();
                
                $this->redirect($Url::link("admin/notes/index"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/notes/edit&id=$id"));
            }
        }
        else {
            
            $Note = new Note();
            $deletedNote = $Note->getById($id);
            $deleteNoteTitle = "Удалить заметку?";
            
            $this->view->addVar('deleteNoteTitle', $deleteNoteTitle);
            $this->view->addVar('deletedNote', $deletedNote);
            
            $this->view->render('note/delete.php');
        }
    }
    
    
}
