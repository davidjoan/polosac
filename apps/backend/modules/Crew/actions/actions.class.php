<?php

/**
 * Crew actions.
 *
 * @package    polosac
 * @subpackage Crew
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CrewActions extends ActionsCrud
{
  protected function getExtraFilterAndArrangeFields()
  {
    return array('b' => array('bus_name' => 'name'));
  }
  
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
    //sfDynamicFormEmbedder::resetParams('menu');
  }
}
