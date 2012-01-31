<?php

class Application_Model_Author extends Zend_Db_Table_Abstract {
  protected $_name = 'authors';

  public function init() {
    $this->db = Zend_Registry::get('db');
  }
  
  public function getOne($id) {
    $select = $this->db->select()->from('authors')->where("id = '$id'");
    return array_pop($this->db->query($select)->fetchAll());
  }
  
  public function getLookup($data) {
    $select = $this->db->select()->from('authors')
              ->where("first_name = '$data[first_name]'")
              ->where("last_name = '$data[last_name]'");
    return array_pop($this->db->query($select)->fetchAll());
  }

}

?>