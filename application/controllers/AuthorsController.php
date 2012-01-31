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
}
