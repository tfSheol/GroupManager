<?php

namespace api\GroupManager\classes;

/**
 * Description of Sql
 *
 * @author Sheol
 */
class Sql {
    private $_user;
    private $_password;
    private $_db;
    private $_db_add;
    private $_sql;
    private $_loaded;
    
    public function __construct($db_add, $db, $user, $password) {
        $this->_db_add = $db_add;
        $this->_db = $db;
        $this->_user = $user;
        $this->_password = $password;
    }
    
    private function connect() {
        try {
            $this->_sql = new \PDO('mysql:host='.$this->_db_add.';dbname='.$this->_db,
                                  $this->_user, $this->_password);
            return true;
        } catch (\PDOException $e) {
            echo 'Failed to load SQL!<br />Error : '.$e->getMessage().'<br />';
            return false;
        }
    }
    
    public function setUserRightLvl($user, $rights) {
        if ($this->connect()) {
            $sql = "UPDATE users SET rights = :rights WHERE login = :login";
            $query = $this->_sql->prepare($sql);
            $query->bindValue(":rights", $rights, \PDO::PARAM_INT);
            $query->bindValue(":login", $user, \PDO::PARAM_INT);
            $query->execute();
        }
    }
    
    public function getUserRightLvl($user) {
        if ($this->connect()) {
            $sql = "SELECT rights FROM `users` WHERE login = :login";
            $query = $this->_sql->prepare($sql);
            $query->bindValue(":login", $user, \PDO::PARAM_INT);
            $query->execute();
            return $query->fetch()['rights'];
        } else {
            return "";
        }
    }
}
