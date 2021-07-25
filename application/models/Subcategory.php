<?php
namespace application\models;
/* 
 * class Note
 * 
 * 
 */

class Subcategory extends BaseExampleModel {
    
    public $tableName = "subcategories";
    
    public $orderBy = 'titleSubcat ASC';
    
    public $id = null;

    public $outerId = null;
    
    public $titleSubcat = null;
    
    public $description = null;
    
    
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (title, content, publicationDate) VALUES (:title, :content, :publicationDate)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );

        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }
    
    public function update()
    {
        $sql = "UPDATE $this->tableName SET publicationDate=:publicationDate, title=:title, content=:content WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        
        $st->bindValue( ":publicationDate", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":title", $this->title, \PDO::PARAM_STR );

        $st->bindValue( ":content", $this->content, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
}

