<?php

class PostsController extends Zend_Controller_Action {
  public function init() {
    $this->Post = new Application_Model_Post;
  }

  public function indexAction() {
    $this->view->Posts = $this->Post->getAll();
  }

  public function addAction() {
    $request = $this->getRequest();
    $form = new Application_Form_Post();
    
    if ($this->getRequest()->isPost()) {
      if ($form->isValid($request->getPost())) {
        $this->Post->save($form->getValues());
        return $this->_helper->redirector('index');
      }
    }
    $this->view->form = $form;
  }

  public function viewAction() {
    $request = $this->getRequest()->getRequestUri();
    $this->view->Post = $this->Post->getOne($this->getParm($request));
  }

  public function editAction($id) {
    $this->view->Post = $this->Post->getOne($id);
  }

  public function deleteAction() {
    $request = $this->getRequest()->getRequestUri();
    return $this->_helper->redirector('index');
  }

  private function getParm($str) {
    return substr($str, (strrpos($str, '/') + 1));
  }
}
