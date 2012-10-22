<?php

/**
 * Passenger actions.
 *
 * @package    polosac
 * @subpackage Passenger
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PassengerActions extends ActionsCrud
{
  protected function getExtraFilterAndArrangeFields()
  {
    return array('c' => array('company_name' => 'name'), 'b' => array('boarding_name' => 'name'));
  }    
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
  }
}
