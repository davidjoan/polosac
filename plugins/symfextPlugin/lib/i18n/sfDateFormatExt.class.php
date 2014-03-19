<?php

/**
 * sfDateFormatExt
 *
 * @package    symfext
 * @subpackage i18n
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfDateFormatExt extends sfDateFormat
{
  /**
   * Returns the current date time.
   * 
   * @param string $format The format for the date time
   * 
   * @return string The current date time
   */
  public function getCurrentDateTime($format = 'yyyy-MM-dd HH:mm:ss')
  {
    return $this->format(time(), $format);
  }
  
  /**
   * Returns the days of a month.
   * 
   * @param integer $from The initial day
   * @param integer $to   The final day
   * 
   * @return array  The days
   */
  public function getDaysArray($from = 1, $to = 31)
  {
    $days = range($from, $to);
    array_walk($days, create_function('&$v, $k', '$v = sprintf("%02d", $v);'));
    
    return array_combine($days, $days);
  }
  
  /**
   * Returns the months of a year.
   * 
   * A month number as the key and a formatted month name as the value.
   * 
   * @param string  $pattern The pattern
   * @param integer $from    The initial month
   * @param integer $to      The final month
   * 
   * @return array  The months
   */
  public function getMonthsArray($pattern = 'MMM', $from = 1, $to = 12)
  {
    $to++;
    for ($i = $from; $i < $to; $i++)
    {
      $mon = array('mon' => $i);
      $months[$this->getMon($mon, 'MM')] = $this->getMon($mon, $pattern);
    }
    
    return $months;
  }
  
  /**
   * Returns a range of years.
   * 
   * @param integer $from    The initial year
   * @param integer $to      The final year
   * 
   * @return array  The years
   */
  public function getYearsArray($from = 2004, $to = null)
  {
    if (null === $to)
    {
      $to = date('Y');
    }
    
    $years = range($from, $to);
    
    return array_combine($years, $years);
  }
}
