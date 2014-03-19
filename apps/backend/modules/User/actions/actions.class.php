<?php

/**
 * User actions.
 *
 * @package    polosac
 * @subpackage User
 * @author     David Joan Tataje Mendoza <davidtataje@gmail.com>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserActions extends ActionsCrud
{
  protected function getExtraFilterAndArrangeFields()
  {
    return array('c' => array('company_name' => 'name'), 
                 'r' => array('role_name' => 'name'));
  }    
  protected function complementList(sfWebRequest $request, DoctrineQuery $q)
  {
    Doctrine::getTable($this->modelClass)->updateQueryForList($q);
    //sfDynamicFormEmbedder::resetParams('menu');
  }
}
