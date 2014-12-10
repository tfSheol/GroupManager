<?php

namespace api\GroupManager\classes;

/**
 * Description of Rights
 *
 * @author Sheol
 */
class Rights {
    private $_rightLvl;
    private $_parse;
    private $_right = array();
    
    public function __construct($operator = 0x00) {
        $this->_rightLvl = $operator;
        $this->_parse = new Parse();
        $this->_right = $this->_parse->getRightLst();
    }
    
    private function getGoodRight($right) {
        foreach ($this->_right as $key => $value) {
            if ($value === $right) {
                return pow(2, $key + 1);
            }
        }
        return 0x00;
    }
    
    public function getRightLvl() {
        return $this->_rightLvl;
    }
    
    public function getAllRight() {
        $ret = array();
        $i = -1;
        foreach ($this->_right as $value) {
            if ($this->hasRight($value)) {
                $ret[++$i] = $value;
            }
        }
        return $ret;
    }
    
    public function hasRight($right) {
        if ($this->getGoodRight($right) & $this->_rightLvl) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addRight($right) {
        $this->_rightLvl |= $this->getGoodRight($right);
    }
    
    public function deleteRight($right) {
        $this->_rightLvl ^= $this->getGoodRight($right);
    }
    
    public function setRightLvl($rightLvl) {
        $this->_rightLvl = $rightLvl;
    }
}
