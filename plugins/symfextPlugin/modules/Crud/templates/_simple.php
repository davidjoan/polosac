<?php use_stylesheet(sfConfig::get('sf_app').'/modules/crud.css') ?>
<?php use_javascript('general/crud.js') ?>
<div class="crud_list">
    <div class="title">
    <?php if (has_slot('subtitle_simple')): ?>
      <?php include_slot('subtitle_simple') ?>
    <?php endif ?>
  </div>
  <?php include_partial('Pager/pager_head', array('pager' => $pager)) ?>
    <table class="list">
      <colgroup>
        <?php foreach ($listColumns as $listColumn): ?>
          <col width="<?php echo $listColumn->columnWidth ?>%">
        <?php endforeach ?>
      </colgroup>
      
      <tr>
        <?php foreach ($listColumns as $listColumn): ?>
          <th class="column_title" align="<?php echo $listColumn->align ?>"><?php echo $listColumn->title ?></th>
        <?php endforeach ?>
      </tr>
      
      <?php $count = 0; foreach ($pager->getResults() as $record): ?>
        <tr id="item_<?php echo $record->getId() ?>" class="normal_row">
        
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
      <tr>
        <?php foreach ($listColumns as $listColumn): ?>
          <th class="column_title" align="<?php echo $listColumn->align ?>"><?php echo order_link($sf_params->get('order_by'), $listColumn->field, $listColumn->title, $sf_params->get('order'), $uri, $params, $listColumn->canSort, false) ?></th>
        <?php endforeach ?>
      </tr>
    </table>
    <?php if (has_slot('buttons_simple')): ?>
      <?php include_slot('buttons_simple') ?>
    <?php endif ?>
  <br/>
</div>