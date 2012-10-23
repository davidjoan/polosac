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
      'passenger_list' => 'Pasajeros'
        
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
      'active'               => new sfWidgetFormValue(array('value' => $this->object->getActiveStr())),
      'passenger_list'       => new sfWidgetFormDoctrineChoice(array
                                (
                                  'model'            => $this->getRelatedModelName('Passenger'),
                                  'expanded'         => true,
                                  'multiple'         => true,
                                  'method'           => 'getInfo',
                                  'query'            => Doctrine::getTable('Passenger')->getQuery(),
                                  'renderer_class'   => 'sfWidgetFormSelectDoubleList',
                                  'renderer_options' => array('label_unassociated' => 'No Seleccionados','label_associated'   => 'Seleccionados')
                                )),
    ));
  


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
      'passenger_list' => 'pass'
      
    ); 
  }
}
