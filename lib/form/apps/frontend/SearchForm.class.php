<?php

class SearchFrontendForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array
    (
        'search'   => new sfWidgetFormInput(array(), array('size' => 40)),
     /*  'post_id'             => new sfWidgetFormJQueryCompleter(array
                                (
                                  'url'             => $this->genUrl('@menu_load_post'),
                                  'value_callback'  => array($this, 'getPostTitle'),
                                  'config'          => sprintf('{ max: "20" }')
                                ), array('size' => 50))*/
    ));   
    
     $this->setValidators(array(
        'search'    => new sfValidatorString(array('required' => true)),
    ));
     
    $this->widgetSchema->setNameFormat('search[%s]');     
  }
}