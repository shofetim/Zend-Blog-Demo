<?php

class PostsController extends Zend_Controller_Action {
  public function init() {
    $this->Post = new Application_Model_Post;
  }

  public function indexAction() {
    $this->view->Posts = $this->Post->getAll();
  }

  public function add() {
    
  }

  public function view($id) {
    $this->view->Post = $this->Post->getOne($id);
  }

  public function edit($id) {
    $this->view->Post = $this->Post->getOne($id);
  }

  public function delete($id) {
    $this->Post->delete($id);
  }

}
