<?php $function = sprintf('%ssubmitForm("%s")', !$object->isNew() ? 'sureClose = false; ' : '', $sf_params->get('usClass')) ?>

<?php if (has_slot('buttons_edit')): ?>
  <?php include_slot('buttons_edit') ?>
<?php else: ?>
  <table class="buttons_container">
    <tr>
      <td align="<?php echo $right ? 'right' : 'left' ?>">
        <table class="buttons">
          <tr>
          <?php if (has_slot('buttons')): ?>
            <?php include_slot('buttons') ?>
          <?php endif ?>              
            <td><?php echo button_to_function($object ? ($object->isNew() ? 'Grabar' : 'Modificar') : 'Grabar Cambios', $function, array('type' => 'submit', 'id' => 'Save', 'class' => 'inputsubmit')) ?></td>
            <?php if (has_slot('buttons_edit_cancel')): ?>
              <?php include_slot('buttons_edit_cancel') ?>
            <?php else: ?>
              <td><?php echo button_to('Cancelar', get_entrance_route(), array('onclick' => true, 'class' => 'inputbutton inputaux')) ?></td>
            <?php endif ?>
          </tr>
        </table>
      </td>
    </tr>
  </table>
<?php endif ?>
