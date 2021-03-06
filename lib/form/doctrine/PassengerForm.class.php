<?php

/**
 * Passenger form.
 *
 * @package    polosac
 * @subpackage form
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PassengerForm extends BasePassengerForm
{
  public function initialize()
  {
    $this->labels = array
    (
      'boarding_id'    => 'Embarque',
      'disembarking_id'=> 'Desembarque',
      'company_id'     => 'Empresa',
      'dni'            => 'Dni',
      'first_name'     => 'Nombres',
      'last_name'      => 'Apellidos',
      'active'         => 'Activo?',
        
    );
  }      
  public function configure()
  {
      $is_admin     = sfContext::getInstance()->getUser()->isAdmin();
      
      $company = null;
  
      if(!$is_admin)
      {
        $company_slug = sfContext::getInstance()->getUser()->getCompanySlug();
        $company = Doctrine::getTable('Company')->findOneBySlug($company_slug);
        $this->object->setCompany($company);
        $this->object->setCompanyId($company->getId());
        
        $this->setDefault('company_id', $company->getId());
      }
      
      
      
  $this->setWidgets(array
    (
      'id'                   => new sfWidgetFormInputHidden(),
      'boarding_id'          => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Boarding',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'disembarking_id'      => new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Disembarking',
                                    'add_empty' => '---Seleccionar---'
                                    )),
      'company_id'           => ($is_admin)?new sfWidgetFormDoctrineChoice(array(
                                    'model'   => 'Company',
                                    'add_empty' => '---Seleccionar---'
                                    )):new sfWidgetFormValue(array('value' => $company->getName())),
      'dni'                  => new sfWidgetFormInputText(array(), array('size' => 8, 'maxlength' => 8)),
      'first_name'           => new sfWidgetFormInputText(array(), array('size' => 60)),
      'last_name'            => new sfWidgetFormInputText(array(), array('size' => 60)),
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
      'boarding_id'    => 'combo',
      'disembarking_id'=> 'combo',
      'company_id'     => ($is_admin)?'combo':'-',
      'first_name'     => 'text',
      'last_name'      => 'text',
      'dni'            => 'fixed_number',
      'active'         => array('combo', array('choices' => array_keys($this->getTable()->getStatuss()))),
      'slug'           => '-',
      'created_at'     => '-',
      'updated_at'     => '-',
    ); 
  }
}

