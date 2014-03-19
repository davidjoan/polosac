<?php

/**
 * sfWidgetFormSchemaFormatterExtendedField
 *
 * Contains a row format for a continuous field.
 *
 * @package    symfext
 * @subpackage widget
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWidgetFormSchemaFormatterExtendedField extends sfWidgetFormSchemaFormatterExt
{
  protected
    $rowFormat = "<tr>\n  <td class=\"label\">\n  <span %class%>%label%</span>\n</td>\n \n</tr> \n<tr>\n <td class=\"field\">\n  %field%%help%%hidden_fields% \n</td>\n</tr>\n";
}
