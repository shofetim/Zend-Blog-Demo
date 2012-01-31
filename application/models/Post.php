<?php

class Application_Model_Post extends Zend_Db_Table_Abstract {
  protected $_name = 'posts';

  public function init() {
    $this->db = Zend_Registry::get('db');
    require_once dirname(__FILE__) . '/../utils/Crypto.php';
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

  public function getOne($slug) {
    $select = $this->db->select()->from('posts')->where("slug = '$slug'");
    $post = array_pop($this->db->query($select)->fetchAll());
    $select = $this->db->select()->from('authors')->where("id = '$post[author_id]'");
    $author = array_pop($this->db->query($select)->fetchAll());
    $post['author'] = $author;
    $select = $this->db->select()->from('comments')->where("post_id = '$post[id]'");
    $comments = $this->db->query($select)->fetchAll();
    $tmp = array();
    foreach ($comments as $comment) {
      $select = $this->db->select()->from('authors')->where("id = '$comment[author_id]'");
      $comment['author'] = array_pop($this->db->query($select)->fetchAll());
      $tmp[] = $comment;
    }
    $post['comments'] = $tmp;
    return $post;
  }

  public function getById($id) {
    $select = $this->db->select()->from('posts')->where("id = '$id'");
    $post = array_pop($this->db->query($select)->fetchAll());
    return $post;
  }

  public function delete($id) {
    $this->db->query("DELETE FROM posts WHERE id = '$id'");
    return true;
  }

  public function save($data) {
    $author = Zend_Registry::get('author');
    if (empty($data['author_id'])) {
      $data['author_id'] = $author['id'];
    }
    if (empty($data['slug'])) {
      $data['slug'] = $this->makeSlug($data['title']);
    }
    if (empty($data['id'])) {
      $data['id'] = Crypto::uuid();
      $action = 'insert';
    } else {
      $action = 'update';
    }
    return $this->$action($data);
  }

  public function makeSlug($titleStr) {
    return str_replace(' ', '-', $titleStr);
  }
}

?>