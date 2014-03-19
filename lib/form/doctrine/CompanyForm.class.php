<?php

/**
 * Company form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CompanyForm extends BaseCompanyForm
{
   public function initialize()
  {
    $this->labels = array
    (
      'name'           => 'Nombre',
      'active'         => 'Activo?',
        
    );
  }  
  public function configure()
  {
  $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'name'                 => new sfWidgetFormInputText(array(), array('size' => 60)),
      'active'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getStatuss(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                ))
      
    ));  
  


    $this->types = array
    (  
      'id'             => '=',
      'name'           => 'text',
      'active'         => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
    ); 
  }
}
