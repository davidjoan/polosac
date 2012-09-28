<?php

/**
 * Unit test library extended.
 *
 * @package    symfext
 * @subpackage test
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class lime_test_ext extends lime_test
{
  /**
   * Tests a directory and passes if it exists.
   *
   * @param string $dir     The directory 
   * @param string $message Display output message when the test passes
   *
   * @return boolean
   */
  public function isDir($dir, $message = '')
  {
  	if (!$result = $this->ok(is_dir($dir), $message))
  	{
  	  $this->set_last_test_errors(array(sprintf("%s is not a directory", $dir)));
  	}
  	
  	return $result;
  }
  
  /**
   * Tests a directory and passes if it does not exists.
   *
   * @param string $dir     The directory 
   * @param string $message Display output message when the test passes
   *
   * @return boolean
   */
  public function isntDir($dir, $message = '')
  {
  	if (!$result = $this->ok(!is_dir($dir), $message))
  	{
  	  $this->set_last_test_errors(array(sprintf("%s is a directory", $dir)));
  	}
  	
  	return $result;
  }
  
  /**
   * Tests a file and passes if it exists.
   *
   * @param string $file    The file
   * @param string $message Display output message when the test passes
   *
   * @return boolean
   */
  public function isFile($file, $message = '')
  {
  	if (!$result = $this->ok(is_file($file), $message))
  	{
  	  $this->set_last_test_errors(array(sprintf("%s is not a file", $file)));
  	}
  	
  	return $result;
  }
  
  /**
   * Tests a file and passes if it does not exists.
   *
   * @param string $file    The file
   * @param string $message Display output message when the test passes
   *
   * @return boolean
   */
  public function isntFile($file, $message = '')
  {
  	if (!$result = $this->ok(!is_file($file), $message))
  	{
  	  $this->set_last_test_errors(array(sprintf("%s is a file", $file)));
  	}
  	
  	return $result;
  }
  
  /**
   * Tests a link and passes if it exists.
   *
   * @param string $link    The link
   * @param string $message Display output message when the test passes
   *
   * @return boolean
   */
  public function isLink($link, $message = '')
  {
  	if (!$result = $this->ok(is_link($link), $message))
  	{
  	  $this->set_last_test_errors(array(sprintf("%s is not a link", $link)));
  	}
  	
  	return $result;
  }
  
  /**
   * Tests a link and passes if it does not exists.
   *
   * @param string $link    The link
   * @param string $message Display output message when the test passes
   *
   * @return boolean
   */
  public function isntLink($link, $message = '')
  {
  	if (!$result = $this->ok(!is_link($link), $message))
  	{
  	  $this->set_last_test_errors(array(sprintf("%s is a link", $link)));
  	}
  	
  	return $result;
  }
}
