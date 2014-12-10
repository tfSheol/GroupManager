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
    
    public function __construct($db_add, $db, $user, $password) {
        $this->_db_add = $db_add;
        $this->_db = $db;
        $this->_user = $user;
        $this->_password = $password;
    }
    
    private function connect() {
        $this->_sql = new \PDO('mysql:host='.$this->_db_add.';dbname='.$this->_db,
                              $this->_user, $this->_password);
    }
    
    public function setUserRightLvl($user, $rights) {
        $this->connect();
        $sql = "UPDATE users SET rights = :rights WHERE login = :login";
        $query = $this->_sql->prepare($sql);
        $query->bindValue(":rights", $rights, \PDO::PARAM_INT);
        $query->bindValue(":login", $user, \PDO::PARAM_INT);
        $query->execute();
    }
    
    public function getUserRightLvl($user) {
        $this->connect();
        $sql = "SELECT rights FROM `users` WHERE login = :login";
        $query = $this->_sql->prepare($sql);
        $query->bindValue(":login", $user, \PDO::PARAM_INT);
        $query->execute();
        return $query->fetch()['rights'];
    }
}
