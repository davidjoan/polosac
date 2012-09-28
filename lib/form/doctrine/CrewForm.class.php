<?php

/**
 * Crew form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CrewForm extends BaseCrewForm
{
   public function initialize()
  {
    $this->labels = array
    (
      'bus_id'         => 'Bus',
      'name'           => 'Nombre',
      'dni'            => 'DNI',
      'driver_license' => 'Licencia de Manejo',
      'position'       => 'Cargo',
      'phone'          => 'Telefono',
      'active'         => 'Activo?'
        
    );
  }  
  public function configure()
  {
  $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'bus_id'               => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Bus',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'name'                 => new sfWidgetFormInputText(array(), array('size' => 60)),
      'dni'                  => new sfWidgetFormInputText(array(), array('size' => 8, 'maxlength' => 8)),
      'driver_license'       => new sfWidgetFormInputText(array(), array('size' => 60)),
      'position'             => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getPositions(),
                                  'expanded'         => false,
                                  'multiple'        => false
               
                                )),      
      'phone'                => new sfWidgetFormInputText(array(), array('size' => 20)),
      'active'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getStatuss(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                ))
      
    ));  
  
$this->addValidators(array
    (
      'dni'            => new sfValidatorString(array('max_length' => 8, 'min_length' => 8)),
    ));  

    $this->types = array
    (  
      'id'             => '=',
      'bus_id'         => 'combo',
      'name'           => 'name',
      'dni'            => 'fixed_number',
      'driver_license' => 'text',
      'position'       => array('combo', array('choices' => array_keys($this->getTable()->getPositions()))),
      'phone'          => 'phone',
      'active'         => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
    ); 
  }
}
