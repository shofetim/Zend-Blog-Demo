<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
  protected function _initAll() {
    //DB Setup
    $this->bootstrap('db');  
    Zend_Registry::set('db', $this->getResource('db'));
    
    //Front page should be a list of posts
    $route = new Zend_Controller_Router_Route('/',
                                              array(
                                                    'controller' => 'posts',
                                                    'action' => 'index',
                                                    )
                                              );
    Zend_Controller_Front::getInstance()->getRouter()->addRoute('/', $route);
  }

}