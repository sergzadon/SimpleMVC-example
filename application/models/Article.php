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
    
    public function getListArticles($numRows=1000000, 
        $categoryId=null, $order="publicationDate DESC",$active = false,
        $subcategoryId = null) 
    {
        echo $active;
        $connection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $subcategoryClause = $subcategoryId ? "WHERE subcategoryId = :subcategoryId" :"";
        $categoryClause = $categoryId ? "WHERE categoryId = :categoryId" : "";
        $Clause = "";
        $activeClaus = "";
        
                
        if(!empty($subcategoryClause)){
            $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) 
                AS publicationDate
                FROM articles WHERE subcategoryId = :subcategoryId 
                ORDER BY  $order  LIMIT :numRows";
            
        }
        elseif(!empty($categoryClause)){
            $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) 
                AS publicationDate
                FROM articles WHERE categoryId = :categoryId 
                ORDER BY  $order  LIMIT :numRows";
            
        }
        else{
            echo "cat";
            if($active !== false){
            $activeClaus = " active = :active";
            }

            if(!empty($activeClaus) && !empty($categoryClause)){
                        $Clause = $categoryClause . " AND" . $activeClaus; 
            }
            elseif(!empty($activeClaus)){
                    $Clause = "WHERE" . $activeClaus; 
            }
            elseif(!empty($categoryClause)){
                    $Clause = $categoryClause;
            }
            
            $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) 
                AS publicationDate
                FROM articles $Clause
                ORDER BY  $order  LIMIT :numRows";   
               echo $active, $categoryId;
        }			
        
        
        $study = $connection->prepare($sql);
//                        echo "<pre>";
//                        print_r($st);
//                        echo "</pre>";
                       // Здесь $st - текст предполагаемого SQL-запроса, причём переменные не отображаются
        $study->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        if($active !== false){
           $study->bindValue( ":active", $active, PDO::PARAM_INT);
            echo "567"; 
        }
        elseif (!empty($categoryId)){
          $study->bindValue(":categoryId",$categoryId,PDO::PARAM_INT);  
          echo "567";
        }
         
        elseif (!empty($subcategoryId)){ 
            $study->bindValue(":subcategoryId", $subcategoryId, PDO::PARAM_INT);
            
        }

        $study->execute(); // выполняем запрос к базе данных
//                        echo "<pre>";
//                        print_r($st);
//                        echo "</pre>";

                        // Здесь $st - текст предполагаемого SQL-запроса, причём переменные не отображаются
        $list = array();
        while ($row = $study->fetch(PDO::FETCH_ASSOC)) {
            $article = new Article($row);
            $list[] = $article;
        }
//        var_dump($row);
//        die();
        // Получаем общее количество статей, которые соответствуют критерию
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $connection->query($sql)->fetch();
        $conn = null;
        
//        echo"<pre>";
//        print_r($list);
//        echo"<pre";
//        die();
        
        return (array(
            "results" => $list, 
            "totalRows" => $totalRows[0]
            ) 
        );

    }
}

