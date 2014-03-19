<?php use_stylesheet(sfConfig::get('sf_app').'/modules/crud.css') ?>
<?php use_javascript('general/crud.js') ?>

<div class="crud_list">
  <?php if (has_slot('breadcrumb')): ?>
    <div class="breadcrumb">
      <?php include_slot('breadcrumb') ?>
    </div>
  <?php endif ?>
  
  <div class="title">
    <?php if (has_slot('title')): ?>
      <?php include_slot('title') ?>
    <?php endif ?>
  </div>
  
  <div class="subtitle">
    <?php if (has_slot('subtitle')): ?>
      <?php include_slot('subtitle') ?>
    <?php else: ?>
      Listado
    <?php endif ?>
  </div>
  
  <?php if (has_slot('filter_top')): ?>
    <?php include_slot('filter_top') ?>
  <?php endif ?>
  
  <?php if (isset($filter_fields) || has_slot('filter_middle')): ?>
  <table class="search">
    <?php if (isset($filter_fields)): ?>
      <tr>
        <td>Buscar:</td>
        <td><?php echo input_filter_tag('filter', $sf_params->get('filter'), array('onkeyup' => 'executeListSearch(event);')) ?></td>
        <td>filtrado por:</td>
        <td><?php echo select_tag('filter_by', $filter_fields, $sf_params->get('filter_by'), array('onchange' => get_url($uri, $params))) ?></td>
        <td><?php echo button_to_get_url('Buscar', $uri, $params, array('id' => 'button_list_search', 'class' => 'inputsubmit')) ?></td>
      </tr>
    <?php endif ?>
    
    <tr>
      <td colspan="5">
        <?php if (has_slot('filter_middle')): ?>
          <?php include_slot('filter_middle') ?>
        <?php endif ?>
      </td>
    </tr>
    
    <?php if (isset($filter_fields)): ?>
      <tr>
        <td colspan="5"><?php include_partial('Generic/alphabet_links', array('uri' => $uri, 'params' => $params, 'filter' => $sf_params->get('filter'))) ?></td>
      </tr>
    <?php endif ?>
  </table>
  <?php endif ?>
  
  <?php if (has_slot('filter_bottom')): ?>
    <?php include_slot('filter_bottom') ?>
  <?php endif ?>
  
  <?php include_partial('Pager/pager_head', array('pager' => $pager)) ?>
  
  <?php include_partial('Crud/buttons_list', array('object' => $object, 'buttons' => $buttons, 'usClass' => $usClass)) ?>
  
  
  <?php if (!$sort): ?>
    <table class="list">
      <colgroup>
        <col width="2%">
        <?php foreach ($listColumns as $listColumn): ?>
          <col width="<?php echo $listColumn->columnWidth ?>%">
        <?php endforeach ?>
      </colgroup>
      
      <tr>
        <th class="column_title"></th>
        <?php foreach ($listColumns as $listColumn): ?>
          <th class="column_title" align="<?php echo $listColumn->align ?>"><?php echo order_link($sf_params->get('order_by'), $listColumn->field, $listColumn->title, $sf_params->get('order'), $uri, $params, $listColumn->canSort) ?></th>
        <?php endforeach ?>
      </tr>
      
      <?php $pager_count = $pager->getFirstIndice() ?>
      <?php $count = 0; foreach ($pager->getResults() as $record): ?>
        <tr id="item_<?php echo $record->getId() ?>" class="normal_row">
          <td align="right" style="color: #3B5998;">&nbsp;<?php echo $pager_count++ ?>&nbsp;&nbsp;</td>
          <?php foreach ($listColumns as $listColumn): ?>
            <td  align="<?php echo $listColumn->align ?>">
              <?php if ($listColumn->method == 'partial'): ?>
                <?php include_partial($modelClass.'/'.$listColumn->field, array($usClass => $record)) ?>
              <?php elseif ($listColumn->method == 'checkbox'): ?>
                <input type="checkbox" id="<?php echo $record->getSlug() ?>" name="<?php echo $record->getSlug() ?>" value="<?php echo $record->getSlug() ?>" onclick="toggleSlug(this, '<?php echo $usClass ?>_slug')" />
              <?php else: ?>
                <?php if ($listColumn->field == '' || $record->{$listColumn->method}() == ''):?>
                  &nbsp;
                <?php elseif ($listColumn->field == $edit_field):?>
                  <?php echo link_to($record->{$listColumn->method}(), sprintf($edit_uri, $usClass).'?slug='.$record->getSlug()) ?>
                <?php else: ?>
                  <?php echo $record->{$listColumn->method}() ?>
                <?php endif ?>
              <?php endif ?>
            </td>
          <?php endforeach ?>
          
        </tr>
      <?php $count++; endforeach ?>
      
      <?php for ($i = 0; $i < 10 - $count; $i++): ?>
        <tr class="empty_row">
          <td colspan="<?php echo $columns_number + 1 ?>"/>
        </tr>
      <?php endfor; ?>
      
      <tr>
        <th class="column_title"></th>
        <?php foreach ($listColumns as $listColumn): ?>
          <th class="column_title" align="<?php echo $listColumn->align ?>"><?php echo order_link($sf_params->get('order_by'), $listColumn->field, $listColumn->title, $sf_params->get('order'), $uri, $params, $listColumn->canSort, false) ?></th>
        <?php endforeach ?>
      </tr>
    </table>
  <?php else: ?>
    <?php include_partial('Crud/list_sort', get_objective_vars(get_defined_vars())) ?>
  <?php endif ?>
  
  <?php include_partial('Crud/buttons_list', array('object' => $object, 'buttons' => $buttons, 'usClass' => $usClass)) ?>
  
  <br/>
  <?php echo input_hidden_tag($usClass.'_slug', '')                          ?>
  <?php echo input_hidden_tag('order_by'      , $sf_params->get('order_by')) ?>
  <?php echo input_hidden_tag('order'         , $sf_params->get('order'))    ?>
  
  <?php include_partial('Pager/pager_foot', array('pager'  => $pager, 'uri' => $uri, 'params' => $params)) ?>
</div>
