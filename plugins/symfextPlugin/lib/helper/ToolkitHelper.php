<?php

/**
 * ToolkitHelper
 *
 * @package    symfext
 * @subpackage helper
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */

/**
 * Returns a function to get the javascript crud functionality.
 * 
 * @param  string $uri      The original uri
 * @param  array  $params   An array of parameters for the javascript function
 * @param  string $function The javascript function to use to generate the final url
 * 
 * @return string The javascript function with the uri and parameters
 */
function get_url($uri, $params, $function = 'getUrl')
{
  return sprintf('%s(\'%s\', \'%s\')', $function, url_for($uri), json_encode($params));
}

/**
 * Returns a link_to_function using the get_url function.
 * 
 * @param  string  $name         Name of the link, i.e. string to appear between the <a> tags
 * @param  string  $uri          The original uri
 * @param  array   $params       An array of parameters for the javascript function
 * @param  array   $html_options Additional HTML compliant <a> tag parameters
 * 
 * @return string  The link with the javascript function with the uri and parameters
 */
function link_to_get_url($name, $uri, $params, $html_options = array())
{
  $function = get_url($uri, $params);
	
  return link_to_function($name, $function, $html_options);
}

/**
 * Returns a button_to_function using the get_url function.
 * 
 * @param  string  $name         Name of the button, i.e. string to appear between the <button> tags
 * @param  string  $uri          The original uri
 * @param  array   $params       An array of parameters for the javascript function
 * @param  array   $html_options Additional HTML compliant <button> tag parameters
 * 
 * @return string  The button with the javascript function with the uri and parameters
 */
function button_to_get_url($name, $uri, $params, $html_options = array())
{
  $function = get_url($uri, $params);
	
  return button_to_function($name, $function, $html_options);
}

/**
 * Returns a link_to_get_url function to sort a list of records.
 * 
 * @param  string  $current      The current field to order by
 * @param  string  $field        The normal field to order by
 * @param  string  $label        The name of the link
 * @param  string  $order        The order to use, a: ascendant, d: descendant
 * @param  string  $uri          The original uri for the sorting
 * @param  array   $params       The parameters for the link_to_get_url
 * @param  boolean $show_link    If the link should be shown, or just a plain text
 * @param  boolean $sort_sense   The sense of the sorting
 * 
 * @return string The link with the javascript function with the uri and parameters
 */
function order_link($current, $field, $label, $order, $uri, $params, $show_link, $sort_sense = true)
{
  $params['order_by']['value'] = $field;
  
  $link = '';
  if ($show_link == false)
  {
    $link = $label;
  }
  elseif (!$field && !$label)
  {
  	$link = '&nbsp;';
  }
  elseif ($current != $field)
  {
    $params['order']['value'] = $sort_sense ? 'a' : 'd';
  	$link = link_to_get_url($label, $uri, $params);
  }
  elseif ($order == 'a')
  {
    $params['order']['value'] = 'd';
  	$link = link_to_get_url($label.' &darr;', $uri, $params);
  }
  else
  {
    $params['order']['value'] = 'a';
  	$link = link_to_get_url($label.' &uarr;', $uri, $params);
  }
  
  return $link;
}

/**
 * Returns the route name of the last browse route.
 * 
 * @param  string $module If given, will return the last route of the module
 * 
 * @return string The last browse route name
 */
function get_entrance_route($module = null)
{
  $module = $module ? $module : sfContext::getInstance()->getRequest()->getParameter('module');
  
  return Toolkit::getEntranceRoute($module);
}

/**
 * Returns an array of vars without symfony's ones.
 * 
 * @param  array $vars The variables
 * 
 * @return array An array without symfony vars.
 */
function get_objective_vars($vars)
{
  $new_vars      = array();
  $vars_to_unset = array
                   (
                     'this', 
                     '_sfFile', 
                     'sf_type', 
                     'sf_context', 
                     'sf_request', 
                     'sf_params', 
                     'sf_response', 
                     'sf_user', 
                     'sf_data'
                   );
  
  foreach ($vars as $var => $value)
  {
    if (!in_array($var, $vars_to_unset))
    {
      $new_vars[$var] = $value;
    }
  }
  
  return $new_vars;
}
