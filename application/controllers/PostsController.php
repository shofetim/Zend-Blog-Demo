<?php

class PostsController extends Zend_Controller_Action {
  public function init() {
    $this->Post = new Application_Model_Post;
  }

  public function indexAction() {
    $this->view->Posts = $this->Post->fetchAll();
  }

  public function view($id) {
    $this->view->Post = $this->Post->fetchOne($id);
  }

  public function add() {
  }

  public function edit($id) {
    $this->view->Post = $this->Post->fetchOne($id);
  }

  public function delete($id) {
    $this->Post->delete($id);
  }

}
