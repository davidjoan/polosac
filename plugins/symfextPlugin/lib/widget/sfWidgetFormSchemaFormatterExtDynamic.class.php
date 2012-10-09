<?php

/**
 * sfWidgetFormSchemaFormatterExtDynamic
 * 
 * Contains a row format for dynamic functionality.
 *
 * @package    symfext
 * @subpackage widget
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWidgetFormSchemaFormatterExtDynamic extends sfWidgetFormSchemaFormatterExt
{
  protected
    $rowFormat = "<tr>\n  <td class=\"label\">\n  <span %class%>%label%</span>\n</td>\n</tr>\n <tr>  <td class=\"field\">\n  %field%%help%%hidden_fields% \n</td>\n</tr>\n";
}
