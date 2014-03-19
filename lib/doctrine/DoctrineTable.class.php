<?php

/**
 * DoctrineTable
 *
 * @package    polosac
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class DoctrineTable extends sfDoctrineTableExt
{
  public function findNextCode()
  {
    $q = $this->createAliasQuery()
         ->orderBy($this->getAlias().'.id DESC');
    
    $object = $q->fetchOne();
    $code   = $object ? substr($object->getCode(), -8) + 1 : 1000;
    
    return str_pad($code, 8, '0', STR_PAD_LEFT);
  }
}
