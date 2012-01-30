<?php

class Application_Model_Post extends Zend_Db_Table_Abstract {
  protected $_name = 'posts';

  public function init() {
    $this->db = Zend_Registry::get('db');
  }
  
  public function getAll() {
    //This is probably a different style then "normal".
    //We could use joins, but this is better. 
    //Better for clarity, better for scale, etc. 
    //(it probably deserves a blog post of its own :)
    $posts = $this->fetchAll();
    $finall = array();
    foreach ($posts as $post) {
      $tmp = $post->toArray();
      $select = $this->db->select()->from('authors')->where("id = '$post->author_id'");
      $author = array_pop($this->db->query($select)->fetchAll());
      $select = $this->db->select()->from('comments')->where("post_id = '$post->id'");
      $comments = $this->db->query($select)->fetchAll();
      $tmp['author'] = $author;
      $tmp['comments'] = $comments;
      $final[] = $tmp;
    }
    return $final;
  }

  public function getOne() {
  }

  public function delete($id) {
  }

  public function save($data) {
  }

}

?>