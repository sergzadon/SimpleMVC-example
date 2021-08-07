<?php
namespace application\models;
/* 
 * class Article
 * 
 * 
 */

class Article extends BaseExampleModel {
    
    public $tableName = "articles";
    
    public $orderBy = 'publicationDate ASC';
    
    public $id = null;
    
    public $title = null;
    
    public $content = null;
    
    public $publicationDate = null;
    
    public $summary = null;
    
    public $categoryId = null;
    
    public $subcategoryId = null;
    
    public $active = null;
    
    public $authors = [];
    

    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (title, content, publicationDate,summary,categoryId,subcategoryId,active) VALUES (:title, :content, :publicationDate,:summary,:categoryId,:subcategoryId,:active)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":summary", $this->summary, \PDO::PARAM_STR );
        $st->bindValue( ":categoryId", $this->categoryId, \PDO::PARAM_STR );
        $st->bindValue( ":subcategoryId", $this->subcategoryId, \PDO::PARAM_STR );
        $st->bindValue( ":active", $this->active, \PDO::PARAM_STR );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
        
        foreach($this->authors as $author) {
            $sql2 = "INSERT INTO users_articles(user_id, article_id)
                    VALUES(:user_id, :article_id)";
            $st = $this->pdo->prepare ( $sql );
            $st->bindValue(":user_id",$author,PDO::PARAM_INT);
            $st->bindValue(":article_id", $this->id,PDO::PARAM_INT);
            $st->execute();
            
        }
    }
    
    public function update()
    {
//            echo "<pre>";
//            print_r($this->id);
//            echo "<pre>";
//            die();
        $sql = "UPDATE $this->tableName SET publicationDate=:publicationDate, title=:title, content=:content,"
                . " summary = :summary,categoryId= :categoryId, subcategoryId= :subcategoryId,active= :active WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
//                   echo "<pre>";
//            print_r($sql);
//            echo "<pre>";
//            die();
        
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );
        $st->bindValue( ":categoryId", $this->categoryId, \PDO::PARAM_INT );
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );
        $st->bindValue( ":summary", $this->summary, \PDO::PARAM_STR );
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue(":active", $this->active, \PDO::PARAM_INT);
        $st->bindValue(":subcategoryId",$this->subcategoryId,\PDO::PARAM_INT);
        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        
        $st->execute();
        
        // удаляем запись в таблице связей
        $sql2 = "DELETE FROM users_articles WHERE article_id = :article_id";
        $st = $this->pdo->prepare ( $sql2 );
        $st->bindValue(":article_id", $this->id, \PDO::PARAM_INT);
        $st->execute();
        // вставляем в таблицу связей авторов
          foreach ($this->authors as $authorId) {
              $sql3 = "INSERT INTO users_articles(user_id, article_id) 
                       VALUES(:user_id, :article_id)";
              $st = $this->pdo->prepare($sql3);
              $st->bindValue(":user_id", $authorId, \PDO::PARAM_INT);
              $st->bindValue(":article_id", $this->id, \PDO::PARAM_INT);
              $st->execute();         
          }
    }

      /*
     * вывод  статьи автора
     */
    public function getAuthorsBooks($id) {
        $sql = "SELECT * FROM  articles LEFT JOIN users_articles ON article_id = id 
               WHERE users_articles.user_id = :id" ;

        $modelClassName = static::class;
        
        $st = $this->pdo->prepare($sql); 
        
        $st->bindValue(":id", $id, \PDO::PARAM_INT);
        $st->execute();
//        $row = $st->fetch(); 
        
        $list = array();
        
        while ($row = $st->fetch()) {
            $article = new $modelClassName( $row );
            $list[] = $article;
        }

        return $list;
      
    }
    
    /**
     * Извлечет данные и вернет массив моделей из базы данных.
     * 
     * @param int $numRows ограничение на число строк
     * @return array
     */
    public function getFrontList($numRows=1000000, $categoryId = null, $active = false)  
    {   
        $Clause = $categoryId ? " WHERE categoryId = :categoryId" : "";
        if($active !== false){
            $Clause = " WHERE  active = :active";
        }
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $this->tableName
           $Clause ORDER BY  $this->orderBy LIMIT :numRows";
        
        $modelClassName = static::class;
       
        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":numRows", $numRows, \PDO::PARAM_INT );
        if($active !== false){
           $st->bindValue( ":active", $active, \PDO::PARAM_INT ); 
        }
        if($categoryId){
           $st->bindValue( ":categoryId", $categoryId, \PDO::PARAM_INT ); 
        }
 
        $st->execute();
        $list = array();
        
        while ($row = $st->fetch()) {
            $example = new $modelClassName($row);
            $list[] = $example;
        }

        $sql = "SELECT FOUND_ROWS() AS totalRows"; //  получаем число выбранных строк
        $totalRows = $this->pdo->query($sql)->fetch();
	
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }
}

