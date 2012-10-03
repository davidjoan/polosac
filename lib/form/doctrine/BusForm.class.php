<?php

/**
 * Bus form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BusForm extends BaseBusForm
{
   public function initialize()
  {
    $this->labels = array
    (
      'company_id'                      => 'Propietario',
      'code'                            => 'Placa',
      'mining_unit'                     => 'Unidad Minera',
      'padron'                          => 'Padrón',
      'category_class'                  => 'CategorÍa/Clase',
      'brand'                           => 'Marca',
      'model'                           => 'Modelo',
      'year_of_manufacture'             => 'Año de Fabricación',
      'fuel'                            => 'Combustible',
      'serial_number'                   => 'N° de Serie',
      'motor_number'                    => 'N° de Motor',
      'qty_seats'                       => 'N° de Asientos',
      'colors_list'                     => 'Color(es)',
      'body'                            => 'Carrocería',
      'card_property_number'            => 'N° de Tarjeta Propiedad',
      'effective_soat_from'             => 'Vigencia SOAT desde',
      'effective_soat_to'               => 'Vigencia SOAT hasta',
      'policy_number'                   => 'N° de Poliza',
      'effective_policy_from'           => 'Vigencia Poliza desde',
      'effective_policy_to'             => 'Vigencia Poliza hasta',
      'effective_technical_review_from' => 'Vigencia Revisión tecnica desde',
      'effective_technical_review_to'   => 'Vigencia Revisión tecnica hasta',
      'circulation_card_number'         => 'N° de Tarjeta de Circulación',
      'effective_circulation_card_from' => 'Vigencia Tarjeta Circulación desde',
      'effective_circulation_card_to'   => 'Vigencia Tarjeta Circulación hasta',
      'vehicle_use'                     => 'Uso de Vehiculo',
      'active'                          => 'activo'
      
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
      'code'                 => new sfWidgetFormInputText(array(), array('size' => 10)),
      'mining_unit'          => new sfWidgetFormInputText(array(), array('size' => 40)),
      'padron'               => new sfWidgetFormInputText(array(), array('size' => 10)),
      'category_class'       => new sfWidgetFormInputText(array(), array('size' => 40)),
      'brand'                => new sfWidgetFormInputText(array(), array('size' => 40)),
      'model'                => new sfWidgetFormInputText(array(), array('size' => 40)),
      'year_of_manufacture'  => new sfWidgetFormInputText(array(), array('size' => 4, 'maxlength' => 4)),
      'fuel'                 => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getFuel(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                )),
      'serial_number'        => new sfWidgetFormInputText(array(), array('size' => 20)),
      'motor_number'         => new sfWidgetFormInputText(array(), array('size' => 20)),
      'qty_seats'            => new sfWidgetFormInputText(array(), array('size' => 2, 'maxlength' => 2)),
      'colors_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Color')),
      'body'                 => new sfWidgetFormInputText(array(), array('size' => 40)),
      'card_property_number' => new sfWidgetFormInputText(array(), array('size' => 40)),
      
      'active'               => new sfWidgetFormChoice(array
                                (
                                  'choices'          => $this->getTable()->getStatuss(),
                                  'expanded'         => true,
                                  'renderer_options' => array('formatter' => array($this->widgetFormatter, 'radioFormatter'))
                                ))
      
    ));       
  }
}
