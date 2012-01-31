<?php

class Application_Form_Login extends Zend_Form {
  public function init() {
    $this->setMethod('post');
    $this->addElement('text', 
                      'first_name', 
                      array(
                            'label'      => 'First Name:',
                            'required'   => true,
                            'filters'    => array('StringTrim'),
                            )
                      );
    $this->addElement('text', 
                      'last_name', 
                      array(
                            'label'      => 'Last Name:',
                            'required'   => true,
                            )
                      );
    $this->addElement('submit',
                      'submit',
                      array(
                            'ignore'   => true,
                            'label'    => 'Login',
                            )
                      );

  }
}