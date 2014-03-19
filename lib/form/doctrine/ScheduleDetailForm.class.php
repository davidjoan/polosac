<?php

/**
 * ScheduleDetail form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScheduleDetailForm extends BaseScheduleDetailForm
{
   public function initialize()
  {
    $this->labels = array
    (
    //  'schedule_id'   => 'Programación',
      'company_id'    => 'Empresa',
      'qty_seats'     => 'Cantidad de Asientos',
      'active'        => 'Activo?',
        
    );
  }  
  public function configure()
  {
  $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
    /*  'schedule_id'          => new sfWidgetFormInputHidden(),*/
      'company_id'           => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Company',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'qty_seats'            => new sfWidgetFormInputText(array(), array('size' => 2, 'maxlength' => 2)),
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
      'active'         => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
      'schedule_id'    => '-',
      'company_id'  => 'Combo',
      'qty_seats'   => 'fixed_number',
      
    ); 
  }
}

