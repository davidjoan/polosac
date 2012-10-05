<?php

/**
 * Contact form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContactForm extends BaseContactForm
{
   public function initialize()
  {
    $this->labels = array
    (
      'company_id'     => 'Empresa',
      'name'           => 'Nombre',
      'email'          => 'Correo',
      'phone'          => 'Telefono',
      'active'         => 'Activo?',
        
    );
  }  
  public function configure()
  {
  $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'company_id'           => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Company',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'name'                 => new sfWidgetFormInputText(array(), array('size' => 60)),
      'email'                => new sfWidgetFormInputText(array(), array('size' => 60)),
      'phone'                => new sfWidgetFormInputText(array(), array('size' => 15)),
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
      'company_id'     => 'combo',
      'name'           => 'name',
      'email'          => 'email',
      'phone'          => 'phone',
      'active'         => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
    ); 
  }
}