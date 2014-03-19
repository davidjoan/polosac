<?php

/**
 * sfWidgetFormSchemaFormatterExtendedRow
 * 
 * Contains a row format for an extended row.
 *
 * @package    symfext
 * @subpackage widget
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class sfWidgetFormSchemaFormatterExtendedRow extends sfWidgetFormSchemaFormatterExt
{
  protected
    $rowFormat = "<td class=\"label\">\n  <span %class%>%label%</span>\n</td>\n  <td class=\"field\">\n  %field%%help%%hidden_fields% \n</td>\n";
}
