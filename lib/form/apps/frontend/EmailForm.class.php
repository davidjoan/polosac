<?php

class EmailFrontendForm extends sfForm
{
  
  public function configure()
  {
     $this->setWidgets(array(
        'email_to'   => new sfWidgetFormInput(array(), array('size' => 40)),
        'email_from' => new sfWidgetFormInput(array(), array('size' => 40)),
        'name'       => new sfWidgetFormInput(array(), array('size' => 40)),
        'subject'    => new sfWidgetFormInput(array(), array('size' => 40)),
        'message'    => new sfWidgetFormTextarea(array(), array('cols' => 50, 'rows' => 3)),
        'captcha'    => new sfWidgetFormInput(),
     ));
     
     $this->setValidators(array(
        'email_to'   => new sfValidatorEmail(),
        'email_from' => new sfValidatorEmail(),
        'name'       => new sfValidatorString(array('required' => true)),
        'subject'    => new sfValidatorString(array('required' => true)),
        'message'    => new sfValidatorString(array('min_length' => 4)),
        'captcha'    => new sfValidatorString(array('required' => true)),
    ));
     
    $this->widgetSchema->setNameFormat('email[%s]'); 
  }
}