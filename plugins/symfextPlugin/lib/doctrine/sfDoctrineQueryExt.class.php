<?php

/**
 * sfDoctrineQueryExt
 * 
 * @package    symfext
 * @subpackage doctrine
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfDoctrineQueryExt extends Doctrine_Query
{
  /**
   * Filter and arrange the query according some parameters and fields.
   * 
   * Important: 
   * When using "addSelect" must specify manually all the fields of the wanted tables,
   * to improve performance and retrieve a join object directly consider to use "*",
   * e.g. "c.*".
   * 
   * @param  array $params       The original parameters to filter
   * @param  array $array_fields The extra parameters to filter
   * 
   * @return DoctrineQuery       The current instance
   */
  public function filterAndArrange(array $params, $array_fields = array())
  {
    $table       = $params['module'];
    $table_alias = Doctrine::getTable($table)->getAlias();
    
    $filter_alias = $order_alias = $table_alias;
    foreach ($array_fields as $alias => $fields)
    {
      if (isset($params['filter_by']))
      {
        if (in_array($params['filter_by'], array_keys($fields), true))
        {
          $filter_alias = $alias;
        }
      }
      if (isset($params['order_by']))
      {
        if (in_array($params['order_by'], array_keys($fields), true))
        {
          $order_alias  = $alias;
        }
      }
    }
    
    if (isset($params['filter']))
    {
      $filter_by = $params['filter_by'];
      if (!empty($array_fields))
      {
        if (array_key_exists($filter_alias, $array_fields) && array_key_exists($params['filter_by'], $array_fields[$filter_alias]))
        {
          $filter_by = $array_fields[$filter_alias][$params['filter_by']];
        }
      }
      
      $filter_alias = $filter_alias != 'extra' ? $filter_alias.'.' : '';
      $field        = $filter_alias.$filter_by;
      $this->filterFieldByString($field, $params['filter']);
    }
    
    if (isset($params['order']))
    {
      $order_by = $params['order_by'];
      if (!empty($array_fields))
      {
        if (array_key_exists($order_alias, $array_fields) && array_key_exists($params['order_by'], $array_fields[$order_alias]))
        {
          $order_by = $array_fields[$order_alias][$params['order_by']];
        }
      }
      
      $order        = $params['order'] == 'a' ? 'ASC' : 'DESC';
      $order_alias  = $order_alias != 'extra' ? $order_alias.'.' : '';
      $field        = $order_alias.$order_by;
      $this->orderBy(sprintf('%s %s', $field, $order)); // TODO: ADD LOWER SUPPORT: CATEGORY LIST
    }
    
    return $this;
  }
  
  /**
   * Adds a like clause to the query with the parameters.
   *
   * @param  string $field  The field target of the query clause
   * @param  string $filter The filter to use in the like clause
   *
   * @return DoctrineQuery  The current instance
   */
  public function filterFieldByString($field, $filter)
  {
    if ($filter)
    {
      $filters = explode('|', Stringkit::strtolower($filter));
      $filters = array_diff($filters, array(''));
      foreach ($filters as $filter)
      {
        $this->addWhere(sprintf('LOWER(%s) LIKE "%%%s%%"', $field, addslashes($filter)));
     }
    }
    
    return $this;
  }
  
  /**
   * Adds a where clause to match an interval of dates.
   * 
   * @param  string $field  The field target of the query clause
   * @param  string $from   The initial date of the interval
   * @param  string $to     The final date of the interval
   * 
   * @return DoctrineQuery The current instance
   */
  public function andIntervalWhere($field, $from, $to)
  {
	  if ($from)
	  {
	    $this->andWhere(sprintf('DATE_FORMAT(%s, \'%%Y-%%m-%%d\') >= ?', $field), $from);
	  }
	  if ($to)
	  {
	    $this->andWhere(sprintf('DATE_FORMAT(%s, \'%%Y-%%m-%%d\') <= ?', $field), $to);
	  }

  	return $this;
  }
}
