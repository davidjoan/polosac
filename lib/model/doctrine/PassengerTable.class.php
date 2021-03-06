<?php

/**
 * PassengerTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PassengerTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object PassengerTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Passenger');
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
  
  public function updateQueryForList(DoctrineQuery $q)
  {
    $q->innerJoin('p.Company c');
    $q->leftJoin('p.Boarding b');
    $q->leftJoin('p.Disembarking d');
    if(!sfContext::getInstance()->getUser()->isAdmin())
    {
      $q->addWhere('c.slug = ?',sfContext::getInstance()->getUser()->getCompanySlug());    
    }
    
  }
  
  public function getQuery($slug = null)
  {
    $slug = (is_null($slug))?sfContext::getInstance()->getUser()->getCompanySlug():$slug;
    
    $q = $this->createAliasQuery()
         ->innerJoin('p.Company c')
         ->leftJoin('p.Boarding b');
    $q->leftJoin('p.Disembarking d');

    $q->addWhere('c.slug = ?',$slug);    
    
    $q->addWhere('p.active = ?', 1);
    return $q;
  }  
  
}