<?php

/**
 * Schedule form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ScheduleForm extends BaseScheduleForm
{
    
  protected
    $detailDynamicFormManager = null;
  public function initialize()
  {
    $this->labels = array
    (
      'bus_id'        => 'Bus',
      'place_from_id' => 'Origen',
      'place_to_id'   => 'Destino',
      'travel_date'   => 'Fecha de Viaje',
      'travel_time'   => 'Hora de Viaje',
      'number'        => 'N&uacute;mero de Viaje',
      'active'        => 'Activo?',
    );
  } 
  public function configure()
  {
    $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'bus_id'               => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Bus',
                                    'method'  => 'getBusNameForSChedule',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'place_from_id'        => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Place',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'place_to_id'          => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Place',
                                    'add_empty' => '---Seleccionar---'
                                    )),        
      'travel_date'          => new sfWidgetFormDateExt(array
                                (
                                  'format' => $this->widgetFormatter->getStandardDateFormat(),
                                  'year_start' => 2011,
                                  'year_end' => date('Y')
                                )),
      'travel_time'          => new sfWidgetFormTime(),
      'number'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getNumbers(),
                                  'expanded'         => false
                                )),
      'active'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getStatuss(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                ))
      
    ));  
  
    
    $this->setDefaults(array('travel_date' => date('Y-m-d'), 'travel_time' => date('H:i:s')));


    $this->types = array
    (  
      'id'             => '=',
      'bus_id'         => 'Combo',
      'place_from_id'  => 'Combo',
      'place_to_id'    => 'Combo',
      'travel_date'    => 'date',
      'travel_time'    => '=',
      'number'         => '=',
      'active'         => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
    ); 
    
  $this->addDetailsForm();
  
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array
    (
        new ScheduleSeetsValidator(),
        new ScheduleBusValidator(),
        new ScheduleCompanyValidator(),
      new sfValidatorSchemaCompare
      (
        'place_from_id', sfValidatorSchemaCompare::NOT_EQUAL, 'place_to_id',
        array('throw_global_error' => true),
        array('invalid'            => 'Los campos \'%place_from_id%\' y \'%place_to_id%\' deben ser diferentes.')
      )
    )));  
  }
  
    public function addDetailsForm()
  {
    $this->detailDynamicFormManager = new sfDynamicFormEmbedderManager('schedule_detail', $this->object->getScheduleDetails()->getRelation(), 'Detalle', $this, null, new sfCallable(array($this->object, 'getScheduleDetails')));
  }
  
}
