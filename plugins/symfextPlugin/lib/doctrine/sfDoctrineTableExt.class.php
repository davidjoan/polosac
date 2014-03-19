<?php

/**
 * sfDoctrineTableExt
 *
 * @package    symfext
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfDoctrineTableExt extends Doctrine_Table
{
  const
    YES = 1,
    NO  = 0;
  
  protected static
    $assertions = array
    (
      self::YES => 'Si',
      self::NO  => 'No',
    );
  
  /**
   * Returns the assertions array.
   * 
   * @return array Assertions
   */
  public function getAssertions()
  {
    return self::$assertions;
  }
  
  /**
   * Returns a collection of doctrine records base on the ids parameter.
   * 
   * @param array   $ids           The ids to find
   * @param integer $hidrationMode The hidration mode to use
   * 
   * @return DoctrineCollection    A collection of records
   */
  public function findByIds($ids, $hidrationMode = null)
  {
    if (!$ids)
    {
      $ids = array(0);
    }
    
    $q = $this->createAliasQuery()
         ->whereIn($this->getAlias().'.id', $ids);

    return $q->execute(array(), $hidrationMode);
  }
  
  /**
   * Returns a collection of doctrine records base on the slug parameter.
   * 
   * @param array   $slugs         The slugs to find
   * 
   * @return DoctrineCollection    A collection of records
   */
  public function findBySlugs($slugs)
  {
    $slug = $this->hasColumn('slug') ? 'slug' : 'id';
    $q = $this->createAliasQuery()
         ->whereIn($this->getAlias().'.'.$slug, $slugs);
    
    return $q->execute();
  }
  
  /**
   * Deletes the records base on the given slugs.
   * 
   * @param array   $slugs         The slugs of the record to delete
   */
  public function deleteBySlugs($slugs)
  {
    $records = $this->findBySlugs($slugs);
    if (false === $this->getTree())
    {
    	
      $records->delete();
    }
    else
    {
    //	Deb::print_r('paso');
      foreach ($records as $record)
      {
        $record->getNode()->delete();
      }
    }
  }
  
  /**
   * Deletes all the records of the current table instance.
   * 
   * @return integer The ids of the deleted records
   */
  public function deleteAll()
  {
    $deletes = $this->createQuery()
               ->delete()
               ->execute();
               
    return $deletes;
  }
  
  /**
   * Creates a query on this table.
   *
   * This method returns a new DoctrineQuery object and adds the component 
   * name of this table as the query 'from' part.
   * 
   * It always adds an alias to the component.
   * 
   * <code>
   * $table = Doctrine_Core::getTable('CategoryAttributExtension');
   * $table->createAliasQuery()
   *       ->where('cae.type = ?', 'Normal');
   * </code>
   *
   * http://www.doctrine-project.org/jira/browse/DC-492
   *
   * @param  string $alias Optional name for component aliasing
   * 
   * @return DoctrineQuery
   */
  public function createAliasQuery($alias = '')
  {
    $alias = empty($alias) ? $this->getAlias() : $alias;
    
    return $this->createQuery($alias);
  }
  
  /**
   * Returns an alias, base on the name of the data table
   * that represents this class.
   * 
   * @return string The alias
   */
  public function getAlias()
  {
    $name  = substr(get_class($this), 0, -5);
    $name  = sfInflector::underscore($name);
    $names = explode('_', $name);
    array_walk($names, create_function('&$v, $k', '$v = $v{0};'));
    $alias = implode('', $names);
    
    return $alias;
  }
  
  /**
   * Returns the current date time formatter.
   * 
   * @return DateFormat The date formatter
   */
  public function getDateTimeFormatter()
  {
    return sfContext::getInstance()->getUser()->getDateTimeFormatter();
  }
  
  /**
   * Returns the current number formatter.
   * 
   * @return NumberFormat The number formatter
   */
  public function getNumberFormatter()
  {
    return sfContext::getInstance()->getUser()->getNumberFormatter();
  }
  
  /**
   * Returns the relations for which this table is considered as one.
   * 
   * @return array An array of relations
   */
  public function getSingleRelations()
  {
    $singleRelations = array();
    foreach ($this->getRelations() as $name => $relation)
    {
      if (Doctrine_Relation::ONE == $relation['type'])
      {
        $singleRelations[$name] = $relation;
      }
    }
    
    return $singleRelations;
  }
  
  /**
   * Returns true if the collections do not contain the same doctrine records.
   * 
   * @param array $data1 The first array to compare
   * @param array $data2 The first array to compare
   * 
   * @return boolean True if the collections are different
   */
  public function compareCollections($data1, $data2)
  {
    $comp1 = array_udiff($data1, $data2, array($this, 'compareRecords'));
    $comp2 = array_udiff($data2, $data1, array($this, 'compareRecords'));
    
    return $comp1 || $comp2;
  }
  
  /**
   * Compares two records based on the id first and then on the oid.
   *
   * @param Doctrine_Record $a The first record
   * @param Doctrine_Record $b The second record
   *  
   * @return integer If the same 0, else 1 or -1
   */
  public function compareRecords($a, $b)
  {
    $a_id = $a->getId();
    $b_id = $b->getId();
    if ($a_id && $b_id)
    {
      if ($a_id == $b_id)
      {
        return 0;
      }
      
      return $a_id > $b_id ? 1 : -1;
    }
    
    if ($a->getOid() == $b->getOid())
    {
      return 0;
    }
    
    return $a->getOid() > $b->getOid() ? 1 : -1;
  }
  
  /**
   * Sorts the record's level which the moved record belongs to.
   * 
   * The record to be sorted needs to have an integer "rank" attribute.
   * 
   * Five possible cases:
   * 
   * 1.- 1  2  3  4  5  6  7  8  9
   *     1  2  6  3  4  5  7  8  9  Moved: 6, Pivot: 3
   *
   * 2.- 1  2  3  4  5  6  7  8  9
   *     1  2  4  5  6  3  7  8  9  Moved: 3, Pivot: 6
   *
   * 3.- 1  2  3  4  5  6  7  8  9
   *     9  1  2  3  4  5  6  7  8  Moved: 9, Pivot: 1
   *
   * 4.- 1  2  3  4  5  6  7  8  9
   *     2  3  4  5  6  7  8  9  1  Moved: 1, Pivot: 9
   * 
   * 5.- 1  2
   *     2  1                       Moved: 1, Pivot: 2
   *
   * @param array Sorted array of ids
   */
  public function sort($order)
  {
    $records = $this->generateSortedRecordsList($order);
    $order   = $this->generateSortedRankList($order);
    
    $count = count($order) - 1;
    $right_checking = false;
    $left_checking  = false;
    $left_to_right  = false;
    $right_to_left  = false;
    for ($i = 0; $i < $count; $i++)
    {
      if ($order[$i] > $order[$i + 1]) // 17 18 21 19 20
      {
        if ($i + 2 < $count + 1) // does not exceed the right limit
        {
          $right_checking = true;
        }
        elseif ($i - 1 > -1) // does not exceed the left limit
        {
          $left_checking = true;
        }
        
        if ($right_checking)
        {
          if ($order[$i] > $order[$i + 2]) // 17 18 21 19 20 22 23
          {
            $right_to_left = true;
          }
          elseif ($order[$i] < $order[$i + 2]) // 16 18 19 17 20 21 22 23
          {
            $left_to_right = true;
          }
        }
        elseif ($left_checking)
        {
          $left_to_right = true;
        }
        else
        {
          $left_to_right = true;
        }
        
        break;
      }
    }
    
    if ($right_to_left)
    {
      $j          = $i;
      $moved_rank = $order[$i];
      while (isset($order[$j + 1]) && $moved_rank > $order[$j + 1])
      {
        $records[$j]->setRank($records[$j + 1]->getRank());
        $records[$j]->save();
        $j++;
      }
      $records[$j]->setRank($moved_rank);
      $records[$j]->save();
    }
    elseif ($left_to_right)
    {
      $j = $i + 1;
      $moved_rank = $order[$i + 1];
      while (isset($order[$j - 1]) && $moved_rank < $order[$j - 1])
      {
        $records[$j]->setRank($records[$j - 1]->getRank());
        $records[$j]->save();
        $j--;
      }
      $records[$j]->setRank($moved_rank);
      $records[$j]->save();
    }
  }
  
  /**
   * Generates a sorted record collection base on the ids parameter.
   * 
   * @param array $ids The ids of the records
   * 
   * @return array[DoctrineRecord] The sorted collection
   */
  public function generateSortedRecordsList($ids)
  {
    $records = $this->findByIds($ids);
    
    $sorted_list = array();
    foreach ($ids as $key => $id)
    {
      foreach ($records as $record)
      {
        if ($record->getId() == $id)
        {
          $sorted_list[$key] = $record;
          continue 2;
        }
      }
    }
    
    return $sorted_list;
  }
  
  /**
   * Generates a sorted rank list base on the ids parameter.
   * 
   * @param array $ids The ids of the records
   * 
   * @return array The sorted rank list
   */
  public function generateSortedRankList($ids)
  {
    $records = $this->findByIds($ids);
    
    $sorted_list = array();
    foreach ($ids as $key => $id)
    {
      foreach ($records as $record)
      {
        if ($record['id'] == $id)
        {
          $sorted_list[$key] = $record->getRank();
          continue 2;
        }
      }
    }
    
    return $sorted_list;
  }
}
