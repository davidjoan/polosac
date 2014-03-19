<?php

/**
 * sfFilekitExt
 *
 * @package    symfext
 * @subpackage util
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfFilekitExt
{
  /**
   * Constructor
   * 
   * @throws sfExceptionExt
   */
  public function __construct()
  {
    throw new sfExceptionExt('sfFilekitExt is a static class. No instances can be created.');
  }
  
  /**
   * Returns an extension converted to .jpg if not .gif or .png:
   *
   * @param  string  $extension  The extension to convert
   *
   * @return string  The converted extension
   */
  public static function convertExtension($extension)
  {
    return in_array($extension, array('.gif', '.jpg', '.png')) ? $extension : '.jpg';
  }
  
  /**
   * Returns a path compose by the hash of the name.
   *
   * @param  string  $name      The name to make the path
   * @param  integer $levels    The levels of the path (or directories number)
   * @param  boolean $generate  If the name should be hashed first (true by default)
   *
   * @return string  The composed path
   */
  public static function generateHashPathForLevel($name, $levels, $generate = true)
  {
    if (0 == $levels)
    {
      return '';
    }
    
    $hash = $generate ? md5($name) : $name;
    $path = '/';
    for ($i = 0; $i < $levels; $i++)
    {
      $path .= substr($hash, $i, 1).'/';
    }
    
    return rtrim($path, '/');
  }
}
