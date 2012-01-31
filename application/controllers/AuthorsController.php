<?php

class AuthorsController extends Zend_Controller_Action {
  public function init() {
    $this->Author = new Application_Model_Author;
  }

  public function viewAction() {
    $request = $this->getRequest()->getRequestUri();
    $this->view->Author = $this->Author->getOne($this->getParm($request));
  }

  private function getParm($str) {
    return substr($str, (strrpos($str, '/') + 1));
  }

  public function loginAction() {
    $request = $this->getRequest();
    $form = new Application_Form_Login();
    
    if ($this->getRequest()->isPost()) {
      if ($form->isValid($request->getPost())) {
        $author = $this->Author->getLookup($form->getValues());
        $_SESSION['author'] = $author;
        return $this->_helper->redirector('index', 'posts');
      }
    }
    $this->view->form = $form;
  }

}
