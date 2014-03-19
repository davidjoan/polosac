<?php

/**
 * CompanyTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CompanyTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object CompanyTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Company');
    }
  const
    STATUS_ACTIVE       = 1,
    STATUS_INACTIVE     = 0;
    
  protected static
    $status                = array
                             (
                               self::STATUS_ACTIVE     => 'Si'  ,
                               self::STATUS_INACTIVE   => 'No',
                             );
                             
  public function getStatuss()
  {
    return self::$status;
  }    
}