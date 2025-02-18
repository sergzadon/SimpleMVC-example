<?php

namespace application\models;

/**
 * Пример реализации класса пользователя (реализуем требующие этого методы абстрактные методы)
 * Эту модель наследуем от специального класа-модели User из ядра SimpleMVC
 */
class ExampleUser extends \ItForFree\SimpleMVC\User 
{
    /**
     * Проверка авторизационных данных пользователя
     * 
     * @param string $login логин
     * @param string $pass  пароль
     * @return boolean      признак успешности
     */
    
    public $tableName = 'users';
    
    /**
     * @var string Критерий сортировки строк таблицы
     */
    public $orderBy = 'timestamp DESC';
    
    /**
     * Логин пользователя
     * @var type 
     */
    public $login = null;
    
    /**
     * Логин пользователя
     * @var type 
     */
    public $salt = null;
    /**
     * @var type 
     */
    public $pass = null;
    
    /**
     * @var type 
     */
    public $email = null;
    
    /**
     * @var type 
     */
    public $id = null;
    
    /**
     * @var type 
     */
    public $timestamp = null;
    
    /**
     * @var type 
     */
    public $role = null;
    
    
    protected function checkAuthData($login, $pass) 
    {
        $result = false;
        
        $sql = "SELECT salt, pass FROM users WHERE login = :login";
        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":login", $login, \PDO::PARAM_STR);
        $st->execute();
        $siteAuthData = $st->fetch();
   
        $pass .= $siteAuthData['salt'];
        $passForCheck = password_verify($pass, $siteAuthData['pass']);

        if (isset($siteAuthData['pass'])) {
            if ($passForCheck) {
                $result = true;
            }
        }
	
        return $result;
    }
    
    /**
     * Вернёт id пользователя
     * 
     * @return int
     */
    public function getId()
    {
        if ($this->userName !== 'guest'){
            $sql = "SELECT id FROM users where login = :userName";
            $st = $this->pdo->prepare($sql); 
            $st -> bindValue( ":userName", $this->userName, \PDO::PARAM_STR );
            $st -> execute();
            $row = $st->fetch();
            return $row['id']; 
        } else  {
            return null;
        }  
    }
    
    /**
     * Получить роль по имени пользователя
     * 
     * @param string $userName имя пользователя
     * @return string
     */
    protected function getRoleByUserName($userName)
    {
        $sql = "SELECT role FROM users WHERE login = :login";
        $st = $this->pdo->prepare($sql);
        $st->bindValue( ":login", $userName, \PDO::PARAM_STR);
        $st->execute();
        
        $siteAuthData = $st->fetch();
        if (isset($siteAuthData['role'])) {
            return $siteAuthData['role'];
        }
    }
    
    
    public function insert()
    {
        $sql = "INSERT INTO $this->tableName (timestamp, login, salt, pass, role, email) VALUES (:timestamp, :login, :salt, :pass, :role, :email)"; 
        $st = $this->pdo->prepare ( $sql );
        $st->bindValue( ":timestamp", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":login", $this->login, \PDO::PARAM_STR );
        
        //Хеширование пароля
        $this->salt = rand(0,1000000);
        $st->bindValue( ":salt", $this->salt, \PDO::PARAM_STR );
//        \DebugPrinter::debug($this->salt);
        
        $this->pass .= $this->salt;
        $hashPass = password_hash($this->pass, PASSWORD_BCRYPT);
//        \DebugPrinter::debug($hashPass);
        $st->bindValue( ":pass", $hashPass, \PDO::PARAM_STR );
        
        $st->bindValue( ":role", $this->role, \PDO::PARAM_STR );
        $st->bindValue( ":email", $this->email, \PDO::PARAM_STR );
        $st->execute();
        $this->id = $this->pdo->lastInsertId();
    }
    
    public function update()
    {
        $sql = "UPDATE $this->tableName SET timestamp=:timestamp, login=:login, pass=:pass, role=:role, email=:email  WHERE id = :id";  
        $st = $this->pdo->prepare ( $sql );
        
        $st->bindValue( ":timestamp", (new \DateTime('NOW'))->format('Y-m-d H:i:s'), \PDO::PARAM_STMT);
        $st->bindValue( ":login", $this->login, \PDO::PARAM_STR );
        
        // Хеширование пароля
        $this->salt = rand(0,1000000);
        //$st->bindValue( ":salt", $this->salt, \PDO::PARAM_STR );
        //$this->pass .= $this->salt;
        //$hashPass = password_hash($this->pass, PASSWORD_BCRYPT);
        $st->bindValue( ":pass", $this->pass, \PDO::PARAM_STR );
        
        $st->bindValue( ":role", $this->role, \PDO::PARAM_STR );
        $st->bindValue( ":email", $this->email, \PDO::PARAM_STR );
        $st->bindValue( ":id", $this->id, \PDO::PARAM_INT );
        $st->execute();
    }
    
    /*
     * вывод авторов статьи
     */
    public function getAuthors($id) {
        $tableName = "users_articles";
        $sql = "SELECT * FROM  $tableName LEFT JOIN users ON user_id = id 
               WHERE users_articles.article_id = :id ";

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
     *  вывод  всех авторов статей
     */
    public  function getAllAuthors() {
        $sql = "SELECT DISTINCT user_id FROM  users_articles";
;
        $modelClassName = static::class;
        $st = $this->pdo->prepare($sql);

        $listAuthors = array();
        $st->execute();
        
        $count = 0;
        while ($row = $st->fetch()) {
          $listAuthors[] = $row["user_id"];
          $count += 1;
        }

        $list = array();
        $sql2 = "SELECT SQL_CALC_FOUND_ROWS *  FROM  users WHERE id = :id";

        $modelClassName = static::class;
        $st = $this->pdo->prepare($sql2);
        $i = 0;

        while($i < $count) {
           $st->bindValue(":id", $listAuthors[$i], \PDO::PARAM_INT);
           $st->execute();
           $st->execute();
           $row = $st->fetch();
           $author = new $modelClassName( $row );
            $list[] = $author;
           $i += 1;
        }
        return $list;
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

    
}
