<?php
namespace application\controllers\admin;
use application\models\ExampleUser;
use application\models\Article;
use ItForFree\SimpleMVC\Config;

/* 
 *   Class-controller notes
 * 
 * 
 */

class AuthorsController extends \ItForFree\SimpleMVC\mvc\Controller
{
    
    public $layoutPath = 'authormain.php';
    
    
    public function indexAction()
    {
        $Author = new ExampleUser();
        $Books = new Article();

        $authorId = $_GET['id'] ?? null;
        
        if ($authorId) { // если указан конктреный пользователь
            $viewAuthor = $Author->getById($_GET['id']);
            $booksAuthor = $Books->getAuthorsBooks($authorId);
//                        echo "<pre>";
//            print_r( $booksAuthor);
//            echo "<pre>";
//            die();
            $this->view->addVar('viewAuthor', $viewAuthor);
            $this->view->addVar('booksAuthor', $booksAuthor);
            $this->view->render('author/view-item.php');

        } else { // выводим полный список
                $authors = $Author->getAllAuthors();
                
//            echo "<pre>";
//            print_r( $booksAuthor);
//            echo "<pre>";
//            die();
//                $results['totalRows'] = $data['totalRows'];
                $this->view->addVar('authors', $authors);
                $this->view->render('author/index.php');
             }
        }
}
