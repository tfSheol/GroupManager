<?php

namespace api\GroupManager\classes;

/**
 * Description of Parse
 *
 * @author Sheol
 */
class Parse {
    const _PATH_FILE = "/../configs/rights.json";
    private $_file;
    private $_rights = array();
    
    private function setFileRight() {
        if (file_exists(__DIR__.self::_PATH_FILE)) {
            $this->_file = file_get_contents(__DIR__.self::_PATH_FILE);
            $this->getRightInFile();
        }
    }
    
    private function getRightInFile() {
        foreach (json_decode($this->_file, true)['rights'] as $key => $value) {
            $this->_rights[$key] = $value;
        }
    }
    
    public function getRightLst() {
        $this->setFileRight();
        return $this->_rights;
    }
}
