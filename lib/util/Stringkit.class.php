<?php

/**
 * Stringkit
 *
 * @package    polosac
 * @subpackage util
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class Stringkit extends sfStringkitExt
{
  protected static
    $reUrlAccess = "/[^a-z0-9\-_\\/(\)\[\]'çàáâãäåāæèéêëėēęìíîïīįòóôõōöøœùúûüůũūųýÿŷñ:]+/",
    $reTitle     = "/[^a-zA-Z0-9\-_\(\)\[\]'çàáâãäåāæèéêëėēęìíîïīįòóôõōöøœùúûüůũūųýÿŷñ ÇÀÁÂÃÄÅĀÆÈÉÊËĖĒĘÌÍÎÏĪĮÒÓÔÕŌÖØŒÙÚÛÜŮŨŪŲÝŸŶÑ]+/";
}
