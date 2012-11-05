<?php

/**
 * ScheduleDetail form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScheduleDetailClientForm extends BaseScheduleDetailForm
{
   public function initialize()
  {
    $this->labels = array
    (
      'schedule_id'    => 'Programación',
      'company_id'     => 'Empresa',
      'qty_seats'      => 'Cantidad de Asientos',
      'active'         => 'Activo?',
      'passenger_list' => 'Pasajeros',
      'qty_seats_hidden' => ''
        
        
    );
  }  
  public function configure()
  {   
  $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'schedule_id'          => new sfWidgetFormValue(array('value' => $this->object->getSchedule())),
      'company_id'           => new sfWidgetFormValue(array('value' => $this->object->getCompany()->getName())),
      'qty_seats'            => new sfWidgetFormValue(array('value' => $this->object->getQtySeats())),
      'qty_seats_hidden'     => new sfWidgetFormInputHidden(),
      'active'               => new sfWidgetFormValue(array('value' => $this->object->getActiveStr())),
      'passenger_list'       => new sfWidgetFormDoctrineChoice(array
                                (
                                  'model'            => $this->getRelatedModelName('ScheduleDetailPassenger'),
                                  'expanded'         => true,
                                  'multiple'         => true,
                                  'method'           => 'getInfo',
                                  'query'            => Doctrine::getTable('Passenger')->getQuery($this->object->getCompany()->getSlug()),
                                  'renderer_class'   => 'sfWidgetFormSelectDoubleList',
                                  'renderer_options' => array('label_unassociated' => 'No Seleccionados','label_associated'   => 'Seleccionados')
                                )),
    ));
  
  $this->setDefault('qty_seats_hidden', $this->object->getQtySeats());


    $this->types = array
    (  
      'id'             => '=',
      'active'         => '-',
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
      'schedule_id'    => '-',
      'company_id'     => '-',
      'qty_seats'      => '-',
      'passenger_list' => 'pass',
      'qty_seats_hidden' => 'pass'
      
    );
    
    if(sfContext::getInstance()->getUser()->isAdmin())
    {
      $this->validatorSchema->setPostValidator(new ScheduleDetailSeatsValidator());         
    }  else {
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array
    (
      new ScheduleDetailSeatsValidator(),
      new ScheduleDetailTravelTimeAndDateValidator()
    )));
  }         
    }
   
  
}

