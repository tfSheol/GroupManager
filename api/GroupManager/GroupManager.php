<?php

namespace api\GroupManager;

/**
 * Description of GroupManager
 *
 * @author Sheol
 */

class GroupManager {
    private $_right;
    private $_sql;
    
    public function __construct($db_add, $bd, $user, $password) {
        spl_autoload_register(__NAMESPACE__.'\\GroupManager::loader');
        $this->_right = new classes\Rights();
        $this->_sql = new classes\Sql($db_add, $bd, $user, $password);
    }
    
    public function loader($classe) {
        $tab = explode('\\', $classe);
        if (file_exists(__DIR__.'/'.$tab[2].'/'.$tab[3].'.class.php')) {
            require_once (__DIR__.'/'.$tab[2].'/'.$tab[3].'.class.php');
        }
    }
    
    public function addRight($right) {
        $this->_right->addRight($right);
    }
    
    public function delRight($right) {
        $this->_right->deleteRight($right);
    }
    
    public function setUserRightLvl($user) {
        $this->_sql->setUserRightLvl($user, $this->getRightLvl($user));
    }
    
    public function setRightLvl($rightLvl) {
        $this->_right->setRightLvl($rightLvl);
    }
    
    public function hasRight($right) {
        return $this->_right->hasRight($right);
    }
    
    public function getRightLvl() {
        return $this->_right->getRightLvl();
    }
    
    public function getAllRight() {
        return $this->_right->getAllRight();
    }
    
    public function getUserRightLvl($user) {
        return $this->_sql->getUserRightLvl($user);
    }
}