<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
  protected function _initAll() {
    $this->bootstrap('db');  
    Zend_Registry::set('db', $this->getResource('db'));
  }
}