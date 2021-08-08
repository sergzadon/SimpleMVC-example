<?php
namespace application\controllers\admin;
use application\models\Category;
use ItForFree\SimpleMVC\Config;

/* 
 *   Class-controller notes
 * 
 * 
 */

class CategoriesController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    public $layoutPath = 'categoriesmain.php';
    
    
    public function indexAction()
    {
        $Category = new Category();

        $categoryId = $_GET['id'] ?? null;
        
        if ($categoryId) { // если указан конкретная категория
            $viewCategories = $Category->getById($_GET['id']);
            $this->view->addVar('viewCategories', $viewCategories);
            $this->view->render('category/view-item.php');
        } else { // выводим полный список
            
            $categories = $Category->getList()['results'];
            $this->view->addVar('categories', $categories);
            $this->view->render('category/index.php');
        }
    }
    
    /**
     * Выводит на экран форму для создания новой категории (только для Администратора)
     */
    public function addAction()
    {
        $Url = Config::get('core.url.class');
        if (!empty($_POST)) {
            if (!empty($_POST['saveNewCategory'])) {
                $Category = new Category();
                $newCategories = $Category->loadFromArray($_POST);
                
                $newCategories->insert(); 
                $this->redirect($Url::link("admin/categories/index"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/categories/index"));
            }
        }
        else {
            $addCategoryTitle = "Добавление новой категории";
            $this->view->addVar('addCategoryTitle', $addCategoryTitle);
            
            $this->view->render('category/add.php');
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
                $Category = new Category();
                $newCategory = $Category->loadFromArray($_POST);
                $newCategory->update();
                $this->redirect($Url::link("admin/categories/index"));
            } 
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/categories/index&id=$id"));
            }
        }
        else {
            $Category = new Category();
            $viewCategories = $Category->getById($id);
            
            $editCategoryTitle = "Редактирование категории";
            
            $this->view->addVar('viewCategories', $viewCategories);
            $this->view->addVar('editCategoryTitle', $editCategoryTitle);
            
            $this->view->render('category/edit.php');   
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
                $Category = new Category();
                $newcategories = $Category->loadFromArray($_POST);
                $newcategories->delete();
                
                $this->redirect($Url::link("admin/categories/index"));
              
            }
            elseif (!empty($_POST['cancel'])) {
                $this->redirect($Url::link("admin/categories/edit&id=$id"));
            }
        }
        else {
            
            $Category = new Category();
            $CategoryId = $Category->getById($id);
            $deleteCategoryTitle = "Удалить категорию";

            $this->view->addVar('deleteCategoryTitle', $deleteCategoryTitle);
            $this->view->addVar('CategoryId', $CategoryId);
            
            $this->view->render('category/delete.php');
        }
    }
    
    
}
