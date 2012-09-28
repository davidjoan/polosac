<?php

/**
 * sfStringkitExt
 *
 * @package    symfext
 * @subpackage util
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfStringkitExt
{
  protected static
    $encoding    = 'UTF-8',
    $reUrl       = "/[^a-z0-9\-_\(\)\[\]?'çàáâãäåāæèéêëėēęìíîïīįòóôõōöøœùúûüůũūųýÿŷñ:ß]+/";
    
  /**
   * Constructor
   * 
   * @throws sfExceptionExt
   */
  public function __construct()
  {
    throw new sfExceptionExt('sfStringkitExt is a static class. No instances can be created.');
  }
  
  /**
   * Returns an array with each of the characters of the string.
   *
   * It has multibyte support.
   *
   * @param  string $string The string to split
   *
   * @return array The array with the characters
   */
  public static function str_split($string)
  {
    $container = array();
    $length    = mb_strlen($string);
    
    for ($i = 0; $i < $length; $i++)
    {
      $container[] = mb_substr($string, $i, 1, self::$encoding);
    }
    
    return $container;
  }
  
  /**
   * Returns a lower case string using the multibyte function.
   *
   * @param  string $filename The string to lower
   *
   * @return string The lower string
   */
  public static function strtolower($string)
  {
    return mb_strtolower($string, self::$encoding);
  }
  
  /**
   * Returns the same string but with the first character converted to lower case.
   *
   * @param  string $filename The string to evaluate
   *
   * @return string The converted string
   */
  public static function lcfirst($string)
  {
    $string{0} = self::strtolower($string{0});
    
    return $string;
  }
  
  /**
   * Returns a string with some weird characters replaced.
   *
   * @param  string $filename The string to evaluate
   *
   * @return string The fixed string
   */
  public static function fixWeirdCharacters($string)
  {
    $search  = array("’", "‘", "“", "”", "´", "–", "…" );
    $replace = array("'", "'", '"', '"', "'", "-","...");
    
    return str_replace($search, $replace, $string);
  }
  
  /**
   * Fix a filename to be used in the name of a real file.
   *
   * @param  string $filename The proposed filename
   *
   * @return string The fixed filename
   */
  public static function fixFilename($filename)
  {
    $filename = preg_replace("/[^a-zA-Z0-9_]+/", '_', self::strtolower($filename));
    
    return trim($filename, '_');
  }
  
  /**
   * Fix a string to be used as url.
   *
   * @param  string $url The original string
   *
   * @return string The fixed url
   */
  public static function fixUrl($url)
  {
    $url = self::fixWeirdCharacters($url);
    
    $url = preg_replace(self::$reUrl, '_', self::strtolower($url));
    
    return trim($url, '_');
  }
  
  /**
   * Fix a filter string.
   *
   * @param  string $filter The original filter
   *
   * @return string The fixed filter
   */
  public static function fixFilter($filter)
  {
    return str_replace('|', ' ', $filter);
  }
  
  /**
   * Unfix a filter string.
   *
   * @param  string $filter The fixed filter
   *
   * @return string The unfixed filter
   */
  public static function unfixFilter($filter)
  {
    return str_replace(' ', '|', $filter);
  }
  
  /**
   * Strips the white spaces from a string, replacing them just for one.
   *
   * @param  string $string The string to strip
   *
   * @return string The stripped string
   */
  public static function stripWhiteSpaces($string)
  {
    return preg_replace('/(\s)+/', ' ', trim($string));
  }
  
  /**
   * Returns a portion of string specified by the length parameter.
   *
   * @param  string  $string The string
   * @param  integer $length The desired length
   * @param  string  $suffix A suffix to the sub-string
   *
   * @return string  The sub-string
   */
  public static function substr($string, $length = 15, $suffix = '...')
  {
    return strlen($string) > $length ? substr($string, 0, $length - 3).$suffix : $string;
  }
  
  /**
   * Changes every end of line from CR, LF or CRLF to <br/>.
   *
   * @param  string $string The string
   *
   * @return string The fixed string
   */
  public static function fixEnfOfLine($string)
  {
    $string = str_replace("\r\n", "\n"   , $string);
    $string = str_replace("\r"  , "\n"   , $string);
    $string = str_replace("\n"  , '<br/>', $string);
    
    return $string;
  }
  
  /**
   * Changes every <br/> to CRLF.
   * 
   * @param  string $string The string
   * 
   * @return string The unfixed string
   */
  public static function unfixEnfOfLine($string)
  {
    return str_replace("<br/>", "\r\n", $string);
  }
}
